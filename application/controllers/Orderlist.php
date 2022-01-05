<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Orderlist extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Transaction_model', 'transaction');
        if ($this->user->is_role() != 3) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title  = 'Order List';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $invoice    = $this->transaction->getOrderList();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'invoice'   => $invoice,
        );

        $this->template->load('templates/admin/templates', 'orderlist/order-list', $data);
    }
    public function setcomplete()
    {
        $code = $this->input->post('code');
        $data = array(
            'order_status' => 'Complete',
        );
        $datatransaction = array(
            'status_queue' => 'Complete',
        );
        $where = array('transaction_code' => $code,);

        $this->transaction->update($where, $data, 'invoice');
        $this->transaction->update($where, $datatransaction, 'transaction');

        echo json_encode($data);
    }
}
