<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Food extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Food_model', 'food');
        if ($this->user->is_role() != 1) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title    = 'Food List';
        $user     = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $food     = $this->food->getFood();
        $category = $this->db->get('food_categories')->result_array();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'food'      => $food,
            'category'  => $category,
        );

        $this->template->load('templates/admin/templates', 'manage-food/food', $data);
    }
    public function addnewfood()
    {
        $title      = 'Food List';
        $subtitle   = 'Add New Food';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $category   = $this->db->get('food_categories')->result_array();
        $food_code = $this->food->foodCode();
        if ($food_code) {
            $code = $food_code[0]->food_code;
            $food_code = generate_code('FOOD', $code);
        } else {
            $food_code = 'FOOD001';
        }

        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('food_code', 'Food Code', 'required|is_unique[food.food_code]', array('is_unique' => '%s The food code already exists, Create a new food code!'));
        $this->form_validation->set_rules('food_name', 'Food Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        $data = array(
            'title'         => $title,
            'subtitle'      => $subtitle,
            'user'          => $user,
            'category'      => $category,
            'food_code'     => $food_code,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'manage-food/food-add', $data);
        } else {
            $category    = $this->input->post('category');
            $food_code   = $this->input->post('food_code');
            $food_name   = $this->input->post('food_name');
            $price       = $this->input->post('price');
            $stock       = $this->input->post('stock');
            $discount    = $this->input->post('discount');
            $description = $this->input->post('description');
            $status      = $this->input->post('status');
            $created     = date('Y-m-d H:i:s');

            $upload_image = $_FILES['food_image']['name'];

            if ($upload_image = '') {
            } else {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['upload_path'] = './assets/img/product/food';
                $config['max_size']     = '5048';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('food_image')) {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/product/food/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/product/food/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }

                $data = [
                    'category'    => $category,
                    'food_code'   => $food_code,
                    'food_name'   => $food_name,
                    'food_image'  => $upload_image,
                    'price'       => $price,
                    'stock'       => $stock,
                    'discount'    => $discount,
                    'description' => $description,
                    'status'      => $status,
                    'created'     => $created,
                ];
                $this->food->insert('food', $data);
                $this->session->set_flashdata('message', 'Food successfully added!');
                redirect(base_url('food/addnewfood'), 'refresh');
            }
        }
    }
    public function editfood($id)
    {
        $user      = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editfood  = $this->food->detailFood($id);
        $category  = $this->food->getCategory();

        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('food_code', 'Food Code', 'required');
        $this->form_validation->set_rules('food_name', 'Food Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        if ($this->form_validation->run()) {
            if (!empty($_FILES['food_image']['name'])) {

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/product/food';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('food_image')) {
                    echo $this->upload->display_errors();

                    $data = array(
                        'title'     => 'Food List',
                        'subtitle'  => 'Edit Food',
                        'user'      => $user,
                        'category'  => $category,
                        'editfood'  => $editfood,
                    );
                    $this->template->load('templates/admin/templates', 'manage-food/food-edit', $data);
                } else {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/product/food/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/product/food/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');

                    if ($editfood->food_image != null) {
                        $file = './assets/img/product/food/' . $editfood->food_image;
                        unlink($file);
                    }

                    $data = array(
                        'id'          => $id,
                        'category'    => $this->input->post('category'),
                        'food_code'   => $this->input->post('food_code'),
                        'food_name'   => $this->input->post('food_name'),
                        'food_image'  => $upload_image,
                        'price'       => $this->input->post('price'),
                        'stock'       => $this->input->post('stock'),
                        'discount'    => $this->input->post('discount'),
                        'description' => $this->input->post('description'),
                        'status'      => $this->input->post('status'),
                    );
                    $this->food->update($id, $data, 'food');
                    $this->session->set_flashdata('message', 'Drink successfully update!');
                    redirect('food/editfood/' . $id);
                }
            } else {
                $data = array(
                    'id'         => $id,
                    'category'   => $this->input->post('category'),
                    'food_code'  => $this->input->post('food_code'),
                    'food_name'  => $this->input->post('food_name'),
                    'price'      => $this->input->post('price'),
                    'stock'      => $this->input->post('stock'),
                    'discount'   => $this->input->post('discount'),
                    'description' => $this->input->post('description'),
                    'status'     => $this->input->post('status'),
                );
                $this->food->update($id, $data, 'food');
                $this->session->set_flashdata('message', 'Food successfully update!');
                redirect('food/editfood/' . $id);
            }
        }
        $data = array(
            'title'     => 'Food List',
            'subtitle'  => 'Edit Food',
            'user'      => $user,
            'category'  => $category,
            'editfood'  => $editfood,
        );
        $this->template->load('templates/admin/templates', 'manage-food/food-edit', $data);
    }
    public function readystock($id)
    {
        $data = array(
            'stock' => 'Ready-Stock',
        );

        $this->food->update($id, $data, 'food');
        $this->session->set_flashdata('changed', 'Food stock changed successfully!');
        redirect(base_url('food'), 'refresh');
    }
    public function soldout($id)
    {
        $data = array(
            'stock' => 'Sold-Out',
        );

        $this->food->update($id, $data, 'food');
        $this->session->set_flashdata('changed', 'Food stock changed successfully!');
        redirect(base_url('food'), 'refresh');
    }
    public function displayed($id)
    {
        $data = array(
            'status' => 'displayed',
        );

        $this->food->update($id, $data, 'food');
        $this->session->set_flashdata('changed', 'Food has been displayed!');
        redirect(base_url('food'), 'refresh');
    }
    public function notdisplayed($id)
    {
        $data = array(
            'status' => 'not displayed',
        );

        $this->food->update($id, $data, 'food');
        $this->session->set_flashdata('changed', 'Food not displayed!');
        redirect(base_url('food'), 'refresh');
    }
    public function deletefood($id_food)
    {
        $food = $this->food->detailFood($id_food);
        unlink('./assets/img/product/food/' . $food->food_image);
        $data = array('id' => $id_food);
        $this->food->delete($data, 'food');
        $this->session->set_flashdata('message', 'Food Successfully Delete!');
        redirect(base_url('food'), 'refresh');
    }
    public function categories()
    {
        $title  = 'Food Categories';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $categories = $this->db->get('food_categories')->result_array();

        $this->form_validation->set_rules('category_name', 'Name Category', 'required|is_unique[food_categories.category_name]', array('is_unique' => '%s Existing category name, Create a new category!'));
        $this->form_validation->set_rules('sorting', 'Sorting', 'required');

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'categories' => $categories,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'manage-food/categories', $data);
        } else {
            $data = [
                'category_slug' => url_title($this->input->post('category_name'), 'dash', TRUE),
                'category_name' => escape($this->input->post('category_name')),
                'sorting'       => escape($this->input->post('sorting')),
                'created'       => escape(date('Y-m-d H:i:s')),
            ];
            $this->food->insert('food_categories', $data);
            $this->session->set_flashdata('message', 'New food categories added!');
            redirect(base_url('food/categories'), 'refresh');
        }
    }
    public function editcategory($id)
    {
        $title        = 'Food Categories';
        $subtitle     = 'Edit Category';
        $user         = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editcategory = $this->food->getCategoryId($id);
        $categories   = $this->db->get('food_categories')->result_array();

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'editcategory' => $editcategory,
            'categories'   => $categories,
        );

        $this->template->load('templates/admin/templates', 'manage-food/categories-edit', $data);
    }
    public function savecategory()
    {
        $id = $this->input->post('id');
        $data = [
            'category_slug' => url_title($this->input->post('category_name'), 'dash', TRUE),
            'category_name' => escape($this->input->post('category_name')),
            'sorting'       => escape($this->input->post('sorting')),
        ];
        $this->food->update($id, $data, 'food_categories');
        $this->session->set_flashdata('message', 'Category successfully Update!');
        redirect(base_url('food/editcategory/') . $id, 'refresh');
    }
    public function deletecategory($id)
    {
        $where = array('id' => $id);
        $this->food->delete($where, 'food_categories');
        $this->session->set_flashdata('message', 'Category successfully Delete!');
        redirect(base_url('food/categories'), 'refresh');
    }
}
