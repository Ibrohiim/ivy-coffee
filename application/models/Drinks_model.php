<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Drinks_model extends CI_Model
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
            ->from('drink_categories')
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function getCategoryId($id)
    {
        $response = false;
        $query = $this->db->get_where('drink_categories', array('id' => $id));
        if ($query && $query->num_rows()) {
            $response = $query->result();
        }
        return $response;
    }
    public function categoryHome()
    {
        $this->db->select('drinks.*, drink_categories.category_name, drink_categories.category_slug, COUNT(drink_images.id_image) AS total_image');
        $this->db->join('drink_categories', 'drink_categories.id=drinks.category', 'left');
        $this->db->join('drink_images', 'drink_images.id_drink=drinks.id', 'left');
        $this->db->group_by('drinks.category');
        $this->db->order_by('id', 'desc');
        return $this->db->get('drinks')->result();
    }
    public function categoryList($category)
    {
        $this->db->select('drinks.*, drink_categories.category_name, COUNT(drink_images.id_image) AS total_image');
        $this->db->join('drink_categories', 'drink_categories.id=drinks.category', 'left');
        $this->db->join('drink_images', 'drink_images.id_drink=drinks.id', 'left');
        $this->db->where('drinks.status', 'displayed');
        $this->db->where('drinks.category', $category);
        $this->db->group_by('drinks.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('drinks')->result();
    }
    public function get_by_category($category)
    {
        $response = false;
        $query = $this->db->order_by('id', 'desc')->get_where('drinks', array('category' => $category, 'stock' => 'Ready-Stock'));
        if ($query && $query->num_rows()) {
            $response = $query->result_array();
        }
        return $response;
    }
    public function totalCategory($category)
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('drinks');
        $this->db->where('status', 'displayed');
        $this->db->where('category', $category);
        return $this->db->get()->row();
    }
    public function readCategory($category)
    {
        $this->db->select('*')
            ->from('drink_categories')
            ->where('category_slug', $category)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    // Drinks
    // public function totaldrink()
    // {
    //     $this->db->select('COUNT(*) AS total');
    //     $this->db->from('drinks');
    //     $this->db->where('status', 'displayed');
    //     return $this->db->get()->row();
    // }
    public function drinkCode()
    {
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get("drinks", 1, 0);
        return $query->result();
    }
    public function getDrink()
    {
        $this->db->select('drinks.*, drink_categories.category_name, drink_categories.category_slug, COUNT(drink_images.id_image) AS total_image');
        $this->db->join('drink_categories', 'drink_categories.id=drinks.category', 'left');
        $this->db->join('drink_images', 'drink_images.id_drink=drinks.id', 'left');
        $this->db->group_by('drinks.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('drinks')->result_array();
    }

    public function detailDrink($id)
    {
        $this->db->select('*')
            ->from('drinks')
            ->where('id', $id)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function navDrink()
    {
        $this->db->select('drinks.*, drink_categories.category_name, drink_categories.category_slug');
        $this->db->join('drink_categories', 'drink_categories.id=drinks.category', 'left');
        $this->db->group_by('drinks.category');
        $this->db->order_by('drink_categories.sorting', 'ASC');
        return $this->db->get('drinks')->result();
    }

    public function drinkHome()
    {
        $this->db->select('drinks.*, drink_categories.category_name, COUNT(drink_images.id_image) AS total_image');
        $this->db->join('drink_categories', 'drink_categories.id=drinks.category', 'left');
        $this->db->join('drink_images', 'drink_images.id_drink=drinks.id', 'left');
        $this->db->where('drinks.status', 'displayed');
        $this->db->group_by('drinks.id');
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(4);
        return $this->db->get('drinks')->result_array();
    }
    public function drinkList()
    {
        $this->db->select('drinks.*, drink_categories.category_name, COUNT(drink_images.id_image) AS total_image');
        $this->db->join('drink_categories', 'drink_categories.id=drinks.category', 'left');
        $this->db->join('drink_images', 'drink_images.id_drink=drinks.id', 'left');
        $this->db->where('drinks.status', 'displayed');
        $this->db->group_by('drinks.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('drinks')->result();
    }
    public function read($code)
    {
        $this->db->select('drinks.*, drink_categories.category_name, COUNT(drink_images.id_image) AS total_image');
        $this->db->join('drink_categories', 'drink_categories.id=drinks.category', 'left');
        $this->db->join('drink_images', 'drink_images.id_drink=drinks.id', 'left');
        $this->db->where('drinks.status', 'displayed');
        $this->db->where('drinks.drink_code', $code);
        $this->db->group_by('drinks.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('drinks')->row();
    }
    public function drinkRelated($id_category)
    {
        $this->db->select('drinks.*, drink_categories.category_name, COUNT(drink_images.id_image) AS total_image');
        $this->db->join('drink_categories', 'drink_categories.id=drinks.category', 'left');
        $this->db->join('drink_images', 'drink_images.id_drink=drinks.id', 'left');
        $this->db->where('drinks.status', 'displayed');
        $this->db->where('drinks.category', $id_category);
        $this->db->group_by('drinks.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('drinks')->result();
    }
    public function get_by_drink($code)
    {
        $response = false;
        $query = $this->db->get_where('drinks', array('drink_code' => $code));
        if ($query && $query->num_rows()) {
            $response = $query->result_array();
        }
        return $response;
    }
    public function detail_by_code($code)
    {
        $response = false;
        $this->db->where('drinks.drink_code', $code);
        $this->db->join('drink_categories', 'drink_categories.id = drinks.category', 'left');
        $query = $this->db->get('drinks');
        if ($query && $query->num_rows()) {
            $response = $query->result_array();
        }
        return $response;
    }
    public function detailDrinkDashboard()
    {
        $this->db->select('drinks.*, drink_categories.category_name, COUNT(drink_images.id_image) AS total_image');
        $this->db->join('drink_categories', 'drink_categories.id=drinks.category', 'left');
        $this->db->join('drink_images', 'drink_images.id_drink=drinks.id', 'left');
        $this->db->where('drinks.status', 'displayed');
        $this->db->group_by('drinks.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('drinks')->result();
    }
    public function favoriteDrink($monthfavorite, $year)
    {
        $this->db->select('transaction.*, SUM(transaction.quantity) AS total_qty, drinks.drink_name AS name, drinks.drink_code AS code, drinks.drink_image AS image, drinks.discount AS discount, drinks.stock AS stock')
            ->join('drinks', 'drinks.drink_code=transaction.code_product')
            ->where('MONTH(transaction.transaction_date)', $monthfavorite)
            ->where('YEAR(transaction.transaction_date)', $year)
            ->group_by('transaction.code_product')
            ->order_by('total_qty', 'desc')
            ->limit(4);
        return $this->db->get('transaction')->result_array();
    }

    // Drink Image
    public function imageDrink($id)
    {
        $this->db->select('*')
            ->from('drink_images')
            ->where('id_drink', $id)
            ->order_by('id_image', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function detailImage($id_image)
    {
        $this->db->select('*')
            ->from('drink_images')
            ->where('id_image', $id_image)
            ->order_by('id_image', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
}
