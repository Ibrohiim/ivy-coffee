<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Offers_model extends CI_Model
{
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
    }
    public function update($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function edit($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table,);
    }

    public function getOffers()
    {
        return $this->db->get('offers')->result_array();
    }

    public function offersCode()
    {
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get("offers", 1, 0);
        return $query->result();
    }

    public function detailOffers($id)
    {
        $this->db->select('*')
            ->from('offers')
            ->where('id', $id)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function homepage_Offers($date)
    {
        $this->db->select('offers.*');
        $this->db->where('offers.status', 'activated');
        $this->db->where('offers.expired > ', $date);
        $this->db->group_by('offers.id');
        $this->db->order_by('id', 'asc');
        return $this->db->get('offers')->result_array();
    }

    public function getDrinkOffers()
    {
        $this->db->select('drinks.*');
        $this->db->where('drinks.status', 'displayed');
        $this->db->where('drinks.discount !=0');
        $this->db->group_by('drinks.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('drinks')->result();
    }
    public function getFoodOffers()
    {
        $this->db->select('food.*');
        $this->db->where('food.status', 'displayed');
        $this->db->where('food.discount !=0');
        $this->db->group_by('food.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('food')->result();
    }
}
