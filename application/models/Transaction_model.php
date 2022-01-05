<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
    }
    public function edit($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    public function update($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function getInvoice($code)
    {
        $response = false;
        $this->db->select('invoice.*, SUM(transaction.quantity) AS total_qty, SUM(transaction.total_price) AS amount_paid, customer_table.table_name')
            ->join('transaction', 'transaction.transaction_code=invoice.transaction_code', 'left')
            ->join('customer_table', 'customer_table.table_code=invoice.table_number', 'left')
            ->where('invoice.transaction_code', $code)
            ->order_by('invoice.transaction_code', 'desc');
        $query = $this->db->get('invoice');
        if ($query && $query->num_rows()) {
            $response = $query->result_array();
        }
        return $response;
    }
    public function cek_invoice($code)
    {
        $query = $this->db->where('transaction_code', $code)->get('invoice');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function getCart($code)
    {
        $this->db->select('transaction.*, drinks.drink_code, drinks.drink_name, drinks.discount, food.food_code, food.food_name, food.discount as food_discount');
        $this->db->join('drinks', 'drinks.drink_code=transaction.code_product', 'left');
        $this->db->join('food', 'food.food_code=transaction.code_product', 'left');
        $this->db->where('transaction.transaction_code', $code);
        $this->db->order_by('id_transaction', 'desc');
        return $this->db->get('transaction')->result();
    }
    public function detailCart($code)
    {
        $this->db->select('drinks.*, food.*')
            ->from('drinks, food')
            ->where('drink_code', $code)
            ->or_where('food_code', $code);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_drink_categories($limit_offset = array())
    {
        if (!empty($limit_offset)) {
            $query = $this->db->get('drink_categories', $limit_offset['limit'], $limit_offset['offset']);
        } else {
            $query = $this->db->get('drink_categories');
        }
        return $query->result();
    }
    public function get_food_categories($limit_offset = array())
    {
        if (!empty($limit_offset)) {
            $query = $this->db->get('food_categories', $limit_offset['limit'], $limit_offset['offset']);
        } else {
            $query = $this->db->get('food_categories');
        }
        return $query->result();
    }
    public function cekCode($transaction_code, $code)
    {
        $this->db->select('transaction.*');
        $this->db->where('transaction_code', $transaction_code);
        $this->db->where('code_product', $code);
        return $this->db->get('transaction')->row();
    }
    public function dataInvoice()
    {
        $this->db->select('invoice.*, customer_table.table_name');
        $this->db->join('customer_table', 'customer_table.table_code=invoice.table_number', 'left');
        $this->db->order_by('id_invoice', 'desc');
        return $this->db->get('invoice')->result_array();
    }
    public function shoppingTransaction($code)
    {
        $this->db->select('transaction.*');
        $this->db->where('transaction.transaction_code', $code);
        $this->db->order_by('id_transaction', 'desc');
        return $this->db->get('transaction')->result();
    }
    public function shoppingTable()
    {
        $this->db->select('customer_table.*');
        $this->db->where('customer_table.status', 'leave');
        $this->db->group_by('customer_table.id');
        $this->db->order_by('id', 'asc');
        return $this->db->get('customer_table')->result_array();
    }
    public function LatestInvoice()
    {
        $this->db->select('invoice.*, customer_table.table_name');
        $this->db->join('customer_table', 'customer_table.table_code=invoice.table_number', 'left');
        $this->db->order_by('id_invoice', 'desc');
        $this->db->limit(10);
        return $this->db->get('invoice')->result_array();
    }
    public function dailyTransaction($day, $month, $year)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->join('invoice', 'invoice.transaction_code=transaction.transaction_code', 'left');
        $this->db->join('drinks', 'drinks.drink_code=transaction.code_product', 'left');
        $this->db->join('food', 'food.food_code=transaction.code_product', 'left');
        $this->db->where('DAY(invoice.transaction_date)', $day);
        $this->db->where('MONTH(invoice.transaction_date)', $month);
        $this->db->where('YEAR(invoice.transaction_date)', $year);
        return $this->db->get()->result();
    }

    // Order List \\
    public function getOrderList()
    {
        $this->db->select('invoice.*, customer_table.table_name');
        $this->db->join('customer_table', 'customer_table.table_code=invoice.table_number', 'left');
        $this->db->where('payment_status', 'Complete');
        $this->db->order_by('transaction_date', 'asc');
        return $this->db->get('invoice')->result_array();
    }

    // Reports & statistic \\
    public function dailyReports($date, $month, $year)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->join('invoice', 'invoice.transaction_code=transaction.transaction_code', 'left');
        $this->db->join('drinks', 'drinks.drink_code=transaction.code_product', 'left');
        $this->db->join('food', 'food.food_code=transaction.code_product', 'left');
        $this->db->where('DAY(invoice.transaction_date)', $date);
        $this->db->where('MONTH(invoice.transaction_date)', $month);
        $this->db->where('YEAR(invoice.transaction_date)', $year);
        return $this->db->get()->result();
    }

    public function monthReports($month, $year)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('MONTH(transaction_date)', $month);
        $this->db->where('YEAR(transaction_date)', $year);
        $this->db->where('payment_status', 'Complete');
        return $this->db->get()->result();
    }

    public function yearReports($year)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('YEAR(transaction_date)', $year);
        $this->db->where('payment_status', 'Complete');
        return $this->db->get()->result();
    }
}
