<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $this->load->model('Car_model');
        $data['cars'] = $this->Car_model->get_all();
        $this->load->view('public/index', $data); // halaman index
    }

    public function car_detail($id)
    {
        $this->load->model('Car_model');
        $data['car'] = $this->Car_model->get_by_id($id);

        if (!$data['car']) {
            show_404();
        }

        $this->load->view('public/detail', $data);
    }

    public function confirmation($car_id = null)
    {
        $this->load->model('Car_model');
        $this->load->model('User_model');

        $car = $this->Car_model->get_by_id($car_id);

        if (!$car) {
            show_404();
        }

        // ambil user yang sedang login
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_by_id($user_id);

        $data['car'] = $car;
        $data['user'] = $user;

        $this->load->view('public/confirm', $data);
    }

    public function store_transaction()
    {
        $this->load->model('Transaction_model');
        $this->load->model('Car_model');

        // pastikan user login
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth/login');
        }

        // ambil data dari form
        $car_id = $this->input->post('car_id');
        $rent_date = $this->input->post('rent_date');
        $return_date = $this->input->post('return_date');

        // hitung total biaya
        $car = $this->Car_model->get_by_id($car_id);
        if (!$car) {
            show_error("Mobil tidak ditemukan");
        }

        $start = new DateTime($rent_date);
        $end   = new DateTime($return_date);
        $days  = $start->diff($end)->days;

        if ($days < 1) {
            $this->session->set_flashdata('error', 'Tanggal kembali harus lebih besar dari tanggal pinjam.');
            redirect('cars/booking/' . $car_id);
        }

        $total = $days * $car->rent_price;

        // simpan transaksi
        $transaction_data = [
            'rent_date'   => $rent_date,
            'return_date' => $return_date,
            'total'       => $total,
            'status'      => 'pending',
            'user_id'     => $user_id,
            'car_id'      => $car_id,
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $this->Transaction_model->insert($transaction_data);

        // update status mobil jadi "rented"
        $this->Car_model->update($car_id, ['status' => 'rented']);

        // redirect ke halaman transaksi customer
        $this->session->set_flashdata('success', 'Pesanan berhasil dibuat.');
        redirect('/customertransactions');
    }

    public function search()
    {
        $keyword = $this->input->get('q'); // ambil dari query string ?q=keyword
        $this->load->model('Car_model');

        if (!$keyword) {
            redirect('/'); // kalau kosong, redirect ke beranda
        }

        $data['cars'] = $this->Car_model->search_by_name($keyword);
        $data['title'] = 'Hasil Pencarian: ' . $keyword;
        $this->load->view('public/index', $data);
    }
}
