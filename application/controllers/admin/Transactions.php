<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Transactions extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Transaction_model', 'Payment_model']);
        $this->load->library(['session', 'form_validation', 'upload']);

        if (!$this->session->userdata('user_id') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Transactions';
        $data['transactions'] = $this->Transaction_model->get_all();
        render_template('admin/transactions/index', $data);
    }

    public function detail($id)
    {
        $transaction = $this->Transaction_model->get_by_id($id);
        if (!$transaction) show_404();

        $data['title'] = 'Detail Transaction';
        $data['transaction'] = $transaction;
        render_template('admin/transactions/detail', $data);
    }

    public function store_payment($transaction_id)
    {
        $transaction = $this->Transaction_model->get_by_id($transaction_id);
        if (!$transaction) show_404();

        $this->form_validation->set_rules('method', 'Method', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->detail($transaction_id);
        } else {
            $upload_file = '';
            if (isset($_FILES['payment_proof']) && $_FILES['payment_proof']['name'] != '') {
                $config['upload_path'] = './uploads/payments/';
                $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['max_size'] = 2048;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('payment_proof')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/transactions/detail/' . $transaction_id);
                } else {
                    $upload_file = $this->upload->data('file_name');
                }
            }

            $data = [
                'transaction_id' => $transaction_id,
                'method' => $this->input->post('method'),
                'amount' => $this->input->post('amount'),
                'payment_proof' => $upload_file,
                'status' => 'verify'
            ];
            $this->Payment_model->insert($data);

            // update status transaksi jadi paid
            $this->Transaction_model->update_status($transaction_id, 'paid');

            $this->session->set_flashdata('success', 'Payment added successfully');
            redirect('admin/transactions/detail/' . $transaction_id);
        }
    }

    public function verify_payment($payment_id, $transaction_id)
    {
        $payment = $this->db->where('id', $payment_id)->get('payments')->row();
        if (!$payment) {
            show_404();
        }

        // update status payment
        $this->db->where('id', $payment_id)->update('payments', ['status' => 'verify']);

        // update status transaksi jadi paid
        $this->Transaction_model->update_status($transaction_id, 'paid');

        $this->session->set_flashdata('success', 'Payment verified successfully.');
        redirect('admin/transactions/detail/' . $transaction_id);
    }

    public function set_completed($id)
    {
        $transaction = $this->Transaction_model->get_by_id($id);
        if (!$transaction) {
            show_404();
        }

        if ($transaction->status == 'paid') {
            $this->Transaction_model->update_status($id, 'completed');
            $this->Car_model->update_status($transaction->car_id, 'available');
            $this->session->set_flashdata('success', 'Transaction marked as completed.');
        } else {
            $this->session->set_flashdata('error', 'Only paid transactions can be completed.');
        }

        redirect('admin/transactions/detail/' . $id);
    }
}
