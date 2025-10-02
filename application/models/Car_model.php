<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Car_model extends CI_Model
{

    private $table = 'cars';

    public function get_all()
    {
        $this->db->select('cars.*, categories.name as category_name');
        $this->db->from($this->table);
        $this->db->join('categories', 'categories.id = cars.category_id', 'left');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('cars.*, categories.name as category_name');
        $this->db->from('cars');
        $this->db->join('categories', 'categories.id = cars.category_id', 'left');
        $this->db->where('cars.id', $id);
        return $this->db->get()->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->table);
    }

    public function update_status($id, $status)
    {
        $this->db->where('id', $id)->update($this->table, ['status' => $status]);
    }
    public function search_by_name($keyword)
    {
        $this->db->select('cars.*, categories.name as category_name');
        $this->db->from('cars');
        $this->db->join('categories', 'categories.id = cars.category_id', 'left');
        $this->db->like('cars.name', $keyword); // search berdasarkan nama
        return $this->db->get()->result();
    }
}
