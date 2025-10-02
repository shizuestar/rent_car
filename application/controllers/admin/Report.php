<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Report extends CI_Controller
{
    public function index()
    {
        render_template('admin/transactions/report'); // view form filter
    }

    public function reportPdf()
    {
        $start_date = $this->input->post('start_date');
        $end_date   = $this->input->post('end_date');
        $status     = $this->input->post('status');

        $this->db->select('
        t.*, 
        u.name as user_name, 
        cu.nama_lengkap as customer_name, 
        cu.no_telepon, 
        c.name as car_name, 
        c.no_plat
    ');
        $this->db->from('transactions t');
        $this->db->join('users u', 't.user_id = u.id');
        $this->db->join('customers cu', 'u.id = cu.user_id', 'left');
        $this->db->join('cars c', 't.car_id = c.id');

        if ($start_date && $end_date) {
            $this->db->where('t.rent_date <=', $end_date);
            $this->db->where('t.return_date >=', $start_date);
        }

        if ($status && $status != 'all') {
            $this->db->where('t.status', $status);
        }

        $transactions = $this->db->get()->result();

        $data['transactions'] = $transactions;
        $data['start_date']   = $start_date;
        $data['end_date']     = $end_date;
        $data['status']       = $status;

        $html = $this->load->view('admin/transactions/admin_report_pdf', $data, TRUE);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("laporan-transaksi.pdf", array("Attachment" => false));
    }
}
