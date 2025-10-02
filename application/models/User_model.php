<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    private $table = 'users';
    private $customer_table = 'customers';

    public function get_by_email($email)
    {
        return $this->db->where('email', $email)->get($this->table)->row();
    }

    public function verify_password($email, $password)
    {
        $user = $this->get_by_email($email);
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    public function get_all()
    {
        // join dengan customers (LEFT JOIN supaya admin tetap tampil meski tidak ada data customer)
        $this->db->select('u.*, c.no_telepon, c.nik, c.alamat');
        $this->db->from($this->table . ' u');
        $this->db->join('customers c', 'c.user_id = u.id', 'left');
        $this->db->order_by('u.id', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('u.*, c.no_telepon, c.nik, c.alamat');
        $this->db->from($this->table . ' u');
        $this->db->join('customers c', 'c.user_id = u.id', 'left');
        $this->db->where('u.id', $id);
        return $this->db->get()->row();
    }

    public function insert($data, $customer_data = null)
    {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $this->db->insert($this->table, $data);
        $user_id = $this->db->insert_id();

        // kalau role = customer → buat juga di customers
        if ($data['role'] == 'customer' && $customer_data) {
            $customer_data['user_id'] = $user_id;
            $this->db->insert($this->customer_table, $customer_data);
        }

        return $user_id;
    }

    public function update($id, $data, $customer_data = null)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }

        $this->db->where('id', $id)->update($this->table, $data);

        // update data customer kalau role = customer
        if ($data['role'] == 'customer' && $customer_data) {
            $exists = $this->db->where('user_id', $id)->get($this->customer_table)->row();
            if ($exists) {
                $this->db->where('user_id', $id)->update($this->customer_table, $customer_data);
            } else {
                $customer_data['user_id'] = $id;
                $this->db->insert($this->customer_table, $customer_data);
            }
        }

        return true;
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->table);
        // customers ikut kehapus otomatis karena foreign key cascade
        return true;
    }
}
