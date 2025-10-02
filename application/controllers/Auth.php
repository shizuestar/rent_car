<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['form_validation', 'session']);
    }

    public function login()
    {
        // Kalau sudah login, redirect ke dashboard
        if ($this->session->userdata('user_id')) redirect('dashboard');

        $data['title'] = 'Login';
        $this->load->view('auth/login', $data);
    }

    public function process_login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->User_model->verify_password($email, $password);
            if ($user) {
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'name'    => $user->name,
                    'email'   => $user->email,
                    'role'    => $user->role
                ]);

                // Redirect berdasarkan role
                if ($user->role == 'admin') {
                    redirect('/dashboard');
                } elseif ($user->role == 'customer') {
                    redirect('/dashboard');
                } else {
                    redirect('auth/login'); // fallback
                }
            } else {
                $this->session->set_flashdata('error', 'Email atau password salah');
                redirect('auth/login');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    public function register()
    {
        // Kalau sudah login, redirect ke dashboard
        if ($this->session->userdata('user_id')) redirect('dashboard');

        $data['title'] = 'Register Customer';
        $this->load->view('auth/register', $data);
    }

    public function process_register()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[customers.nik]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            $this->load->model('User_model');

            $user_data = [
                'name'     => $this->input->post('name'),
                'email'    => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'role'     => 'customer',
            ];

            $customer_data = [
                'nama_lengkap' => $this->input->post('name'),
                'no_telepon'   => $this->input->post('no_telepon'),
                'nik'          => $this->input->post('nik'),
                'alamat'       => $this->input->post('alamat'),
            ];

            $this->User_model->insert($user_data, $customer_data);

            $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
            redirect('auth/login');
        }
    }
}
