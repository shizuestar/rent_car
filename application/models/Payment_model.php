<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{

    private $table = 'payments';

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_by_transaction($transaction_id)
    {
        return $this->db->where('transaction_id', $transaction_id)->get($this->table)->result();
    }

    public function verify($id)
    {
        return $this->db->where('id', $id)->update($this->table, ['status' => 'verify']);
    }
}
