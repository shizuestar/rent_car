<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['form_validation', 'session']);

        // pastikan login dulu
        if(!$this->session->userdata('user_id') || $this->session->userdata('role') != 'admin'){
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Users';
        $data['users'] = $this->User_model->get_all();
        render_template('admin/users/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Create User';
        render_template('admin/users/create', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // validasi tambahan untuk customer
        if ($this->input->post('role') == 'customer') {
            $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');
            $this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[customers.nik]');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'role' => $this->input->post('role'),
                'password' => $this->input->post('password')
            ];

            $customer_data = null;
            if ($data['role'] == 'customer') {
                $customer_data = [
                    'no_telepon'   => $this->input->post('no_telepon'),
                    'nik'          => $this->input->post('nik'),
                    'alamat'       => $this->input->post('alamat'),
                ];
            }

            $this->User_model->insert($data, $customer_data);
            $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
            redirect('admin/users');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit User';
        $data['user'] = $this->User_model->get_by_id($id);
        render_template('admin/users/edit', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->input->post('role') == 'customer') {
            $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');
            $this->form_validation->set_rules('nik', 'NIK', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'role' => $this->input->post('role')
            ];
            if ($this->input->post('password')) {
                $data['password'] = $this->input->post('password');
            }

            $customer_data = null;
            if ($data['role'] == 'customer') {
                $customer_data = [
                    'no_telepon'   => $this->input->post('no_telepon'),
                    'nik'          => $this->input->post('nik'),
                    'alamat'       => $this->input->post('alamat'),
                ];
            }

            $this->User_model->update($id, $data, $customer_data);
            $this->session->set_flashdata('success', 'User berhasil diupdate!');
            redirect('admin/users');
        }
    }

    public function delete($id)
    {
        $this->User_model->delete($id);
        $this->session->set_flashdata('success', 'User berhasil dihapus!');
        redirect('admin/users');
    }
}
