<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerTransactions extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Transaction_model', 'Payment_model']);
        $this->load->library('session');

        // cek login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        // hanya role customer
        if ($this->session->userdata('role') != 'customer') {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('t.*, c.name as car_name, c.no_plat');
        $this->db->from('transactions t');
        $this->db->join('cars c', 't.car_id = c.id');
        $this->db->where('t.user_id', $user_id);
        $this->db->order_by('t.id', 'DESC');
        $data['transactions'] = $this->db->get()->result();

        $data['title'] = "My Transactions";
        render_template('customer/transactions/index', $data);
    }

    public function show($id)
    {
        $transaction = $this->Transaction_model->get_by_id($id);

        // pastikan transaksi milik user login
        if (!$transaction || $transaction->user_id != $this->session->userdata('user_id')) {
            redirect('customertransactions');
        }

        $data['transaction'] = $transaction;
        $data['title'] = "Transaction Detail";
        render_template('customer/transactions/detail', $data);
    }

    public function cancel($id)
    {
        $transaction = $this->Transaction_model->get_by_id($id);

        // validasi
        if (!$transaction || $transaction->user_id != $this->session->userdata('user_id')) {
            redirect('customertransactions');
        }

        // hanya bisa cancel jika status masih pending
        if ($transaction->status != 'pending') {
            $this->session->set_flashdata('error', 'Transaksi tidak bisa dibatalkan.');
            redirect('customertransactions/show/' . $id);
        }

        // update status transaksi
        $this->Transaction_model->update_status($id, 'cancel');

        // update status mobil jadi available lagi
        $this->db->where('id', $transaction->car_id)->update('cars', ['status' => 'available']);

        $this->session->set_flashdata('success', 'Transaksi berhasil dibatalkan.');
        redirect('customertransactions');
    }

    public function add_payment($transaction_id)
    {
        $transaction = $this->Transaction_model->get_by_id($transaction_id);

        // validasi: transaksi harus ada & milik user login
        if (!$transaction || $transaction->user_id != $this->session->userdata('user_id')) {
            redirect('customertransactions');
        }

        // cek kalau sudah ada pembayaran, tidak bisa tambah lagi
        $payments = $this->Payment_model->get_by_transaction($transaction_id);
        if ($payments) {
            $this->session->set_flashdata('error', 'Pembayaran sudah ada.');
            redirect('customertransactions/show/' . $transaction_id);
        }

        // upload bukti
        $config['upload_path']   = './uploads/payments/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        $payment_proof = null;
        if ($this->upload->do_upload('payment_proof')) {
            $uploadData = $this->upload->data();
            $payment_proof = $uploadData['file_name'];
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('customertransactions/show/' . $transaction_id);
        }

        $data = [
            'transaction_id' => $transaction_id,
            'method'         => $this->input->post('method'),
            'amount'         => $this->input->post('amount'),
            'payment_proof'  => $payment_proof,
            'status'         => 'pending',
            'created_at'     => date('Y-m-d H:i:s')
        ];

        $this->Payment_model->insert($data);

        $this->session->set_flashdata('success', 'Pembayaran berhasil diupload, menunggu verifikasi admin.');
        redirect('customertransactions/show/' . $transaction_id);
    }
}
