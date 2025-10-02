<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cars extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('user_id') || $this->session->userdata('role') != 'admin'){
            redirect('auth/login');
        }
        $this->load->model(['Car_model', 'Category_model']);
        $this->load->library(['form_validation', 'upload']);
    }

    public function index()
    {
        $data['title'] = "Cars";
        $data['cars'] = $this->Car_model->get_all();
        render_template('admin/cars/index', $data);
    }

    public function create()
    {
        $data['title'] = "Create Car";
        $data['categories'] = $this->Category_model->get_all();
        render_template('admin/cars/create', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('no_plat', 'No Plat', 'required|is_unique[cars.no_plat]');
        $this->form_validation->set_rules('rent_price', 'Rent Price', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $config['upload_path']   = './uploads/cars/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048;
            $this->upload->initialize($config);

            $image = null;
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $image = 'uploads/cars/' . $uploadData['file_name'];
            }

            $data = [
                'category_id' => $this->input->post('category_id'),
                'name'        => $this->input->post('name'),
                'type'        => $this->input->post('type'),
                'description' => $this->input->post('description'),
                'year'        => $this->input->post('year'),
                'no_plat'     => $this->input->post('no_plat'),
                'rent_price'  => $this->input->post('rent_price'),
                'status'      => 'available',
                'image'       => $image,
                'created_at'  => date('Y-m-d H:i:s'),
            ];

            $this->Car_model->insert($data);
            $this->session->set_flashdata('success', 'Car berhasil ditambahkan!');
            redirect('admin/cars');
        }
    }

    public function edit($id)
    {
        $data['title'] = "Edit Car";
        $data['car'] = $this->Car_model->get_by_id($id);
        $data['categories'] = $this->Category_model->get_all();
        render_template('admin/cars/edit', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('rent_price', 'Rent Price', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $car = $this->Car_model->get_by_id($id);

            $config['upload_path']   = './uploads/cars/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048;
            $this->upload->initialize($config);

            $image = $car->image;
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $image = 'uploads/cars/' . $uploadData['file_name'];
            }

            $data = [
                'category_id' => $this->input->post('category_id'),
                'name'        => $this->input->post('name'),
                'type'        => $this->input->post('type'),
                'description' => $this->input->post('description'),
                'year'        => $this->input->post('year'),
                'no_plat'     => $this->input->post('no_plat'),
                'rent_price'  => $this->input->post('rent_price'),
                'status'      => $this->input->post('status'),
                'image'       => $image,
                'updated_at'  => date('Y-m-d H:i:s'),
            ];

            $this->Car_model->update($id, $data);
            $this->session->set_flashdata('success', 'Car berhasil diupdate!');
            redirect('admin/cars');
        }
    }

    public function delete($id)
    {
        $this->Car_model->delete($id);
        $this->session->set_flashdata('success', 'Car berhasil dihapus!');
        redirect('admin/cars');
    }
}
