<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // Cek login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        // Ambil role user
        $role = $this->session->userdata('role');
        if ($role == 'admin') {
            // Load view admin
            $data['title'] = 'Admin Dashboard';
            render_template('admin/dashboard', $data);
        } elseif ($role == 'customer') {
            // Load view customer
            $data['title'] = 'Customer Dashboard';
            render_template('customer/dashboard', $data);
        } else {
            // fallback
            redirect('auth/login');
        }
    }
}