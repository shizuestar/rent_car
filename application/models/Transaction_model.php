    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Transaction_model extends CI_Model {

        private $table = 'transactions';

        public function get_all()
        {
            $this->db->select('t.*, u.name as customer_name, c.name as car_name, c.no_plat');
            $this->db->from('transactions t');
            $this->db->join('users u', 't.user_id = u.id');
            $this->db->join('cars c', 't.car_id = c.id');
            $this->db->order_by('t.id','DESC');
            return $this->db->get()->result();
        }

        public function get_by_id($id)
        {
            $this->db->select('t.*, 
                u.name as customer_name, 
                u.email as customer_email, 
                c.name as car_name, 
                c.no_plat');
            $this->db->from('transactions t');
            $this->db->join('users u', 't.user_id = u.id');
            $this->db->join('cars c', 't.car_id = c.id');
            $this->db->where('t.id',$id);
            $transaction = $this->db->get()->row();

            if($transaction) {
                // ambil data payments
                $transaction->payments = $this->db->where('transaction_id',$id)->get('payments')->result();
            }

            return $transaction;
        }

        public function update_status($id, $status)
        {
            return $this->db->where('id',$id)->update($this->table, ['status'=>$status]);
        }

        public function insert($data)
        {
            return $this->db->insert($this->table, $data);
        }
    }
