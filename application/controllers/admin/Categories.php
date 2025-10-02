<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('user_id') || $this->session->userdata('role') != 'admin'){
            redirect('auth/login');
        }
        $this->load->model('Category_model');
        $this->load->library('form_validation');

    }

    public function index()
    {
        $data['title'] = "Categories";
        $data['categories'] = $this->Category_model->get_all();
        render_template('admin/categories/index', $data);
    }

    public function create()
    {
        $data['title'] = "Create Category";
        render_template('admin/categories/create', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = [
                'name'        => $this->input->post('name'),
                'description' => $this->input->post('description'),
            ];
            $this->Category_model->insert($data);
            $this->session->set_flashdata('success', 'Category berhasil ditambahkan!');
            redirect('admin/categories');
        }
    }

    public function edit($id)
    {
        $data['title'] = "Edit Category";
        $data['category'] = $this->Category_model->get_by_id($id);
        render_template('admin/categories/edit', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'name'        => $this->input->post('name'),
                'description' => $this->input->post('description'),
            ];
            $this->Category_model->update($id, $data);
            $this->session->set_flashdata('success', 'Category berhasil diupdate!');
            redirect('admin/categories');
        }
    }

    public function delete($id)
    {
        $this->Category_model->delete($id);
        $this->session->set_flashdata('success', 'Category berhasil dihapus!');
        redirect('admin/categories');
    }
}