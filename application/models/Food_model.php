<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Food_model extends CI_Model
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
    public function update($id, $data, $table)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }
    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    // Category
    public function getCategory()
    {
        $this->db->select('*')
            ->from('food_categories')
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function getCategoryId($id)
    {
        $response = false;
        $query = $this->db->get_where('food_categories', array('id' => $id));
        if ($query && $query->num_rows()) {
            $response = $query->result();
        }
        return $response;
    }
    public function categoryHome()
    {
        $this->db->select('food.*, food_categories.category_name, food_categories.category_slug');
        $this->db->join('food_categories', 'food_categories.id=food.category', 'left');
        $this->db->group_by('food.category');
        $this->db->order_by('id', 'desc');
        return $this->db->get('food')->result();
    }
    public function categoryList($category)
    {
        $this->db->select('food.*, food_categories.category_name');
        $this->db->join('food_categories', 'food_categories.id=food.category', 'left');
        $this->db->where('food.status', 'displayed');
        $this->db->where('food.category', $category);
        $this->db->group_by('food.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('food')->result();
    }
    public function get_by_category($category)
    {
        $response = false;
        $query = $this->db->order_by('id', 'desc')->get_where('food', array('category' => $category, 'stock' => 'Ready-Stock'));
        if ($query && $query->num_rows()) {
            $response = $query->result_array();
        }
        return $response;
    }
    public function totalCategory($category)
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('food');
        $this->db->where('status', 'displayed');
        $this->db->where('category', $category);
        return $this->db->get()->row();
    }
    public function readCategory($category)
    {
        $this->db->select('*')
            ->from('food_categories')
            ->where('category_slug', $category)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    // Food
    public function totalfood()
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('food');
        $this->db->where('status', 'displayed');
        return $this->db->get()->row();
    }
    public function foodCode()
    {
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get("food", 1, 0);
        return $query->result();
    }
    public function getFood()
    {
        $this->db->select('food.*, food_categories.category_name, food_categories.category_slug');
        $this->db->join('food_categories', 'food_categories.id=food.category', 'left');
        $this->db->group_by('food.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('food')->result_array();
    }
    public function detailFood($id)
    {
        $this->db->select('*')
            ->from('food')
            ->where('id', $id)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function navFood()
    {
        $this->db->select('food.*, food_categories.category_name, food_categories.category_slug');
        $this->db->join('food_categories', 'food_categories.id=food.category', 'left');
        $this->db->group_by('food.category');
        $this->db->order_by('food_categories.sorting', 'ASC');
        return $this->db->get('food')->result();
    }

    public function foodHome()
    {
        $this->db->select('food.*, food_categories.category_name');
        $this->db->join('food_categories', 'food_categories.id=food.category', 'left');
        $this->db->where('food.status', 'displayed');
        $this->db->group_by('food.id');
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(4);
        return $this->db->get('food')->result_array();
    }
    public function foodList()
    {
        $this->db->select('food.*, food_categories.category_name');
        $this->db->join('food_categories', 'food_categories.id=food.category', 'left');
        $this->db->where('food.status', 'displayed');
        $this->db->group_by('food.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('food')->result();
    }
    public function read($code)
    {
        $this->db->select('food.*, food_categories.category_name');
        $this->db->join('food_categories', 'food_categories.id=food.category', 'left');
        $this->db->where('food.status', 'displayed');
        $this->db->where('food.food_code', $code);
        $this->db->group_by('food.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('food')->row();
    }
    public function foodRelated($id_category)
    {
        $this->db->select('food.*, food_categories.category_name');
        $this->db->join('food_categories', 'food_categories.id=food.category', 'left');
        $this->db->where('food.status', 'displayed');
        $this->db->where('food.category', $id_category);
        $this->db->group_by('food.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('food')->result();
    }
    public function get_by_food($food_id)
    {
        $response = false;
        $query = $this->db->get_where('food', array('food_code' => $food_id));
        if ($query && $query->num_rows()) {
            $response = $query->result_array();
        }
        return $response;
    }
    public function detail_by_code($code)
    {
        $response = false;
        $this->db->where('food.food_code', $code);
        $this->db->join('food_categories', 'food_categories.id = food.category', 'left');
        $query = $this->db->get('food');
        if ($query && $query->num_rows()) {
            $response = $query->result_array();
        }
        return $response;
    }
    public function detailFoodDashboard()
    {
        $this->db->select('food.*, food_categories.category_name');
        $this->db->join('food_categories', 'food_categories.id=food.category', 'left');
        $this->db->where('food.status', 'displayed');
        $this->db->group_by('food.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('food')->result();
    }
    public function favoriteFood($monthfavorite, $year)
    {
        $this->db->select('transaction.*, SUM(transaction.quantity) AS total_qty, food.food_name AS name, food.food_code AS code, food.food_image AS image, food.discount AS discount, food.stock AS stock')
            ->join('food', 'food.food_code=transaction.code_product')
            ->where('MONTH(transaction.transaction_date)', $monthfavorite)
            ->where('YEAR(transaction.transaction_date)', $year)
            ->group_by('transaction.code_product')
            ->order_by('total_qty', 'desc')
            ->limit(4);
        return $this->db->get('transaction')->result_array();
    }
}
