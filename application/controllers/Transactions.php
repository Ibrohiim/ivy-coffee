<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Transactions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Drinks_model', 'drinks');
        $this->load->model('Food_model', 'food');
        $this->load->model('Transaction_model', 'transaction');
        $this->load->model('Table_model', 'table');
        if ($this->user->is_role() != 1 && $this->user->is_role() != 4) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title  = 'Scan Transaction';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data = array(
            'title' => $title,
            'user' => $user,
        );

        $this->template->load('templates/admin/templates', 'transactions/scan-qrcode', $data);
    }
    public function scanningProcess()
    {
        $code               = $this->input->post('code');
        $cek_invoice        = $this->transaction->cek_invoice($code);
        if ($cek_invoice && $cek_invoice->payment_status == 'Complete') {
            $code               = $cek_invoice->transaction_code;
            $tablecode          = $cek_invoice->table_number;
            $table              = $this->table->getTableCode($tablecode);
            $customer_name      = $cek_invoice->customer_name;
            $order_type         = $cek_invoice->order_type;
            $transaction_date  = $cek_invoice->transaction_date;
            $total_transaction  = $cek_invoice->total_transaction;
            $payment_status     = $cek_invoice->payment_status;
            $data = array(
                'transaction_code'  => $code,
                'table_number'      => $table->table_name,
                'customer_name'     => $customer_name,
                'order_type'        => $order_type,
                'transaction_date' => $transaction_date,
                'total_transaction' => $total_transaction,
                'payment_status'    => $payment_status,
            );
            $this->session->set_flashdata('message', '<div class="alert alert-warning text-center" role="alert" style="margin-bottom: 0;"><strong>Already made a transaction!</strong></div>');
            $this->load->view('transactions/scan-result', $data);
        } else if (!$cek_invoice) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert" style="margin-bottom: 0;"><strong>Data not found!</strong></div>');
            $this->load->view('transactions/scan-result');
        } else {
            $code               = $cek_invoice->transaction_code;
            $tablecode          = $cek_invoice->table_number;
            $table              = $this->table->getTableCode($tablecode);
            $customer_name      = $cek_invoice->customer_name;
            $order_type         = $cek_invoice->order_type;
            $transaction_date  = $cek_invoice->transaction_date;
            $total_transaction  = $cek_invoice->total_transaction;
            $payment_status     = $cek_invoice->payment_status;

            $data = array(
                'transaction_code'  => $code,
                'table_number'      => $table->table_name,
                'customer_name'     => $customer_name,
                'order_type'        => $order_type,
                'transaction_date' => $transaction_date,
                'total_transaction' => $total_transaction,
                'payment_status'    => $payment_status,
            );
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert" style="margin-bottom: 0;"><strong>Transaction with code ' . $code . ' has been found!</strong></div>');
            $this->load->view('transactions/scan-result', $data);
        }
    }
    public function sales()
    {
        $transaction_code = date('dmY') . strtoupper(random_string('alnum', 10));
        redirect(base_url('transactions/salestransactions/' . $transaction_code));
    }
    public function salesTransactions($code = '')
    {
        $title  = 'Sales Transactions';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $invoice     = $this->transaction->getInvoice($code);
        $transaction = $this->transaction->getCart($code);
        $items       = $this->cart->contents();
        $table       = $this->table->tableTransaction();
        $transaction_code = $this->uri->segment(3);
        $drinkcategories  = $this->transaction->get_drink_categories();
        $site        = $this->configuration_model->getConfig();
        if ($invoice) {
            $data = array(
                'title' => $title,
                'user'  => $user,
                'table' => $table,
                'items' => $items,
                'site' => $site,
                'invoice'     => $invoice[0],
                'transaction' => $transaction,
                'drinkcategories'  => $drinkcategories,
                'transaction_code' => $transaction_code,
            );
            $this->template->load('templates/admin/templates', 'transactions/sales-transactions', $data);
        } else {
            redirect(base_url('transactions'));
        }
    }
    public function typesOfProducts($type)
    {
        if ($type == 'Drinks') {
            $data = $this->transaction->get_drink_categories();
        } else {
            $data = $this->transaction->get_food_categories();
        }
        echo json_encode($data);
    }
    public function checkDrinkCategory($category_id)
    {
        $drinks = $this->drinks->get_by_category($category_id);
        echo json_encode($drinks);
    }
    public function checkFoodCategory($category_id)
    {
        $food = $this->food->get_by_category($category_id);
        echo json_encode($food);
    }
    public function checkproduct($code)
    {
        if (substr($code, 0, 5) == 'DRINK') {
            $data = $this->drinks->get_by_drink($code);
        } else {
            $data = $this->food->get_by_food($code);
        }
        echo json_encode($data);
    }
    public function add_menu()
    {
        $product_code = $this->input->post('code');
        $quantity   = $this->input->post('quantity');
        $sale_price = $this->input->post('sale_price');
        $code       = $this->input->post('transaction_code');
        $date       = $this->input->post('transaction_date');
        $cek_code   = $this->transaction->cekCode($code, $product_code);
        $cek_qty    = $cek_code->quantity;
        $id_transaction = $cek_code->id_transaction;

        $sub_total = $quantity * $sale_price;
        $data = array(
            'transaction_code'  => $code,
            'code_product'      => $product_code,
            'price'             => $sale_price,
            'quantity'          => $quantity,
            'total_price'       => $sub_total,
            'transaction_date'  => $date,
        );
        if ($cek_code == !null) {
            $total_qty = $cek_qty + $quantity;
            $where = array('id_transaction' => $id_transaction);
            $newdata = [
                'quantity' => $total_qty,
            ];
            $this->transaction->update($where, $newdata, 'transaction');
            echo json_encode(array('status' => 'success'));
        } else {
            $this->db->insert('transaction', $data);
            echo json_encode(array('status' => 'success'));
        }
    }
    public function deletemenu()
    {
        $id = $this->input->post('id');

        $where = array('id_transaction' => $id);

        $this->transaction->delete($where, 'transaction');

        echo json_encode(array('status' => 'success'));
    }
    public function addtocart()
    {
        $code   = $this->input->post('code');
        $qty    = $this->input->post('qty');
        $price  = $this->input->post('price');
        if (substr($code, 0, 5) == 'DRINK') {
            $product    = $this->drinks->detail_by_code($code);
            $name       = $product[0]['drink_name'];
        } else {
            $product    = $this->food->detail_by_code($code);
            $name       = $product[0]['food_name'];
        }
        if ($product) {
            $data = array(
                'id'      => $code,
                'qty'     => $qty,
                'price'   => $price,
                'name'    => $name,
            );
            $this->cart->insert($data);
            echo json_encode(
                array(
                    'status' => 'success',
                    'data' => $this->cart->contents(),
                    'total_item' => $this->cart->total_items(),
                    'total_price' => $this->cart->total()
                )
            );
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
    public function deleteitem($rowid)
    {
        if ($this->cart->remove($rowid)) {
            echo number_format($this->cart->total());
        } else {
            echo "false";
        }
    }
    public function updateitem($rowid)
    {
        $rowid = $this->input->post('rowid');
        $qty = $this->input->post('qty');

        $data = array(
            'rowid' => $rowid,
            'qty' => $qty,
        );
        $this->cart->update($data);

        echo json_encode(array('status' => 'success'));
    }
    public function transactionprocess()
    {
        $transaction_code = $this->input->post('transaction_code');
        $grand_total    = $this->input->post('grand_total');
        $cashier        = $this->input->post('cashier');
        $order_type     = $this->input->post('order_type');
        $table_number   = $this->input->post('table_number');
        $customer_name  = $this->input->post('customer_name');
        $cek_invoice    = $this->transaction->cek_invoice($transaction_code);

        if ($cek_invoice && $cek_invoice->transaction_code == $transaction_code) {
            $where = array('transaction_code' => $transaction_code);
            $data = [
                'total_transaction' => $grand_total,
                'payment_status'    => 'Complete',
                'transaction_date'  => date('Y-m-d H:i:s'),
                'cashier'           => $cashier,
            ];
            $this->transaction->update($where, $data, 'invoice');
            $datatrans = [
                'transaction_date'  => date('Y-m-d H:i:s'),
            ];
            $this->transaction->update($where, $datatrans, 'transaction');
            echo $this->struckTransaction();
        } else {
            $newdata = array(
                'cashier'           => $cashier,
                'table_number'      => $table_number,
                'order_type'        => $order_type,
                'customer_name'     => $customer_name,
                'transaction_code'  => $transaction_code,
                'transaction_date'  => date('Y-m-d H:i:s'),
                'total_transaction' => $grand_total,
                'payment_status'    => 'Complete',
                'order_status'      => 'Waiting',
            );
            $this->db->insert('invoice', $newdata);

            foreach ($this->cart->contents() as $item) {
                $sub_total = $item['qty'] * $item['price'];
                $datacart = array(
                    'transaction_code'  => $transaction_code,
                    'code_product'        => $item['id'],
                    'price'             => $item['price'],
                    'quantity'          => $item['qty'],
                    'total_price'       => $sub_total,
                    'transaction_date'  => date('Y-m-d H:i:s'),
                    'status_queue'      => 'Waiting',
                );
                $this->db->insert('transaction', $datacart);
            }

            $table = array(
                'status' => 'active',
            );
            $where = array('table_code' => $table_number);
            $this->transaction->update($where, $table, 'customer_table');

            $this->cart->destroy();

            echo $this->struckTransaction();
        }
    }
    public function struckTransaction()
    {
        $code        = $this->input->post('transaction_code');
        $site        = $this->configuration_model->getConfig();
        $invoice     = $this->transaction->getInvoice($code);
        $transaction = $this->transaction->getCart($code);
        $cash        = $this->input->post('cash');
        $change      = $this->input->post('change');
        $data = [
            'site'      => $site,
            'invoice'   => $invoice[0],
            'transaction' => $transaction,
            'cash'      => $cash,
            'change'    => $change,
        ];
        $this->load->view('transactions/struck-transaction', $data);
    }
    public function listTransactions()
    {
        $title  = 'List Transactions';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $transaction = $this->transaction->dataInvoice();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'transaction' => $transaction,
        );

        $this->template->load('templates/admin/templates', 'transactions/list-transactions', $data);
    }
    public function detailTransaction($code)
    {
        $title      = 'List Transactions';
        $subtitle   = 'Detail Transactions';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $invoice    = $this->transaction->getInvoice($code);
        $transactions = $this->transaction->getCart($code);

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'invoice'   => $invoice[0],
            'transactions' => $transactions,
        );

        $this->template->load('templates/admin/templates', 'transactions/detail-transactions', $data);
    }
    public function deletetransaction($code)
    {
        $where = array('transaction_code' => $code);
        $this->transaction->delete($where, 'transaction');
        $this->transaction->delete($where, 'invoice');
        $this->session->set_flashdata('message', 'Transaction Successfully Delete!');
        redirect(base_url('transactions/listtransactions'), 'refresh');
    }
    public function cancelTransaction()
    {
        $cart = $this->cart->contents();
        if ($cart == true) {
            $this->cart->destroy();
        }
        redirect(base_url('transactions/sales/'));
    }
}
