<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ingredient_model extends CI_Model
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

    public function getingredients()
    {
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get("ingredients", 1, 0);
        return $query->result();
    }

    public function detailIngredient($id)
    {
        $this->db->select('*')
            ->from('ingredients')
            ->where('id', $id)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function getDataIngredients()
    {
        $this->db->select('*')
            ->from('ingredients')
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
}
