<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Drinks extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Drinks_model', 'drinks');
        if ($this->user->is_role() != 1) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title    = 'Drink List';
        $user     = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $drink    = $this->drinks->getDrink();
        $category = $this->db->get('drink_categories')->result_array();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'drink'     => $drink,
            'category'  => $category,
        );

        $this->template->load('templates/admin/templates', 'manage-drinks/drinks', $data);
    }
    public function addnewdrink()
    {
        $title      = 'Drink List';
        $subtitle   = 'Add New Drink';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $category   = $this->db->get('drink_categories')->result_array();
        $drink_code = $this->drinks->drinkCode();
        if ($drink_code) {
            $code = $drink_code[0]->drink_code;
            $drink_code = generate_code('DRINK', $code);
        } else {
            $drink_code = 'DRINK001';
        }

        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('drink_code', 'Drink Code', 'required|is_unique[drinks.drink_code]', array('is_unique' => '%s The drink code already exists, Create a new drink code!'));
        $this->form_validation->set_rules('drink_name', 'Drink Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        $data = array(
            'title'         => $title,
            'subtitle'      => $subtitle,
            'user'          => $user,
            'category'      => $category,
            'drink_code'    => $drink_code,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'manage-drinks/drink-add', $data);
        } else {
            $category    = $this->input->post('category');
            $drink_code  = $this->input->post('drink_code');
            $drink_name  = $this->input->post('drink_name');
            $price       = $this->input->post('price');
            $stock       = $this->input->post('stock');
            $discount    = $this->input->post('discount');
            $description = $this->input->post('description');
            $status      = $this->input->post('status');
            $created     = date('Y-m-d H:i:s');

            $upload_image = $_FILES['drink_image']['name'];

            if ($upload_image = '') {
            } else {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['upload_path'] = './assets/img/product/drink';
                $config['max_size']     = '5048';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('drink_image')) {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/product/drink/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/product/drink/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }

                $data = [
                    'category'    => $category,
                    'drink_code'  => $drink_code,
                    'drink_name'  => $drink_name,
                    'drink_image' => $upload_image,
                    'price'       => $price,
                    'stock'       => $stock,
                    'discount'    => $discount,
                    'description' => $description,
                    'status'      => $status,
                    'created'     => $created,
                ];
                $this->drinks->insert('drinks', $data);
                $this->session->set_flashdata('message', 'Drink successfully added!');
                redirect(base_url('drinks/addnewdrink'), 'refresh');
            }
        }
    }
    public function editdrink($id)
    {
        $user      = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editdrink = $this->drinks->detailDrink($id);
        $category  = $this->drinks->getCategory();

        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('drink_code', 'Drink Code', 'required');
        $this->form_validation->set_rules('drink_name', 'Drink Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        if ($this->form_validation->run()) {
            if (!empty($_FILES['drink_image']['name'])) {

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/product/drink';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('drink_image')) {
                    echo $this->upload->display_errors();

                    $data = array(
                        'title'     => 'Menu List',
                        'subtitle'  => 'Edit Menu',
                        'user'      => $user,
                        'category'  => $category,
                        'editdrink' => $editdrink,
                    );
                    $this->template->load('templates/admin/templates', 'manage-drinks/drink-edit', $data);
                } else {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/product/drink/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/product/drink/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');

                    if ($editdrink->drink_image != null) {
                        $file = './assets/img/product/drink/' . $editdrink->drink_image;
                        unlink($file);
                    }

                    $data = array(
                        'id'          => $id,
                        'category'    => $this->input->post('category'),
                        'drink_code'  => $this->input->post('drink_code'),
                        'drink_name'  => $this->input->post('drink_name'),
                        'drink_image' => $upload_image,
                        'price'       => $this->input->post('price'),
                        'stock'       => $this->input->post('stock'),
                        'discount'    => $this->input->post('discount'),
                        'description' => $this->input->post('description'),
                        'status'      => $this->input->post('status'),
                    );
                    $this->drinks->update($id, $data, 'drinks');
                    $this->session->set_flashdata('message', 'Drink successfully update!');
                    redirect('drinks/editdrink/' . $id);
                }
            } else {
                $data = array(
                    'id'         => $id,
                    'category'   => $this->input->post('category'),
                    'drink_code' => $this->input->post('drink_code'),
                    'drink_name' => $this->input->post('drink_name'),
                    'price'      => $this->input->post('price'),
                    'stock'      => $this->input->post('stock'),
                    'discount'   => $this->input->post('discount'),
                    'description' => $this->input->post('description'),
                    'status'     => $this->input->post('status'),
                );
                $this->drinks->update($id, $data, 'drinks');
                $this->session->set_flashdata('message', 'Drink successfully update!');
                redirect('drinks/editdrink/' . $id);
            }
        }
        $data = array(
            'title'     => 'Drink List',
            'subtitle'  => 'Edit Drink',
            'user'      => $user,
            'category'  => $category,
            'editdrink' => $editdrink,
        );
        $this->template->load('templates/admin/templates', 'manage-drinks/drink-edit', $data);
    }
    public function readystock($id)
    {
        $data = array(
            'stock' => 'Ready-Stock',
        );

        $this->drinks->update($id, $data, 'drinks');
        $this->session->set_flashdata('changed', 'Drink stock changed successfully!');
        redirect(base_url('drinks'), 'refresh');
    }
    public function soldout($id)
    {
        $data = array(
            'stock' => 'Sold-Out',
        );

        $this->drinks->update($id, $data, 'drinks');
        $this->session->set_flashdata('changed', 'Drink stock changed successfully!');
        redirect(base_url('drinks'), 'refresh');
    }
    public function displayed($id)
    {
        $data = array(
            'status' => 'displayed',
        );

        $this->drinks->update($id, $data, 'drinks');
        $this->session->set_flashdata('changed', 'Drink has been displayed!');
        redirect(base_url('drinks'), 'refresh');
    }
    public function notdisplayed($id)
    {
        $data = array(
            'status' => 'not displayed',
        );

        $this->drinks->update($id, $data, 'drinks');
        $this->session->set_flashdata('changed', 'Drink not displayed!');
        redirect(base_url('drinks'), 'refresh');
    }
    public function deletedrink($id_drink)
    {
        $img = $this->drinks->imageDrink($id_drink);
        foreach ($img as $img) {
            unlink('./assets/img/product/drink/thumbs/' . $img->image);
        }
        $where = array('id_drink' => $id_drink);
        $this->drinks->delete($where, 'drink_images');
        $drink = $this->drinks->detailDrink($id_drink);
        unlink('./assets/img/product/drink/' . $drink->drink_image);
        $data = array('id' => $id_drink);
        $this->drinks->delete($data, 'drinks');
        $this->session->set_flashdata('message', 'Drink Successfully Delete!');
        redirect(base_url('drinks'), 'refresh');
    }
    public function categories()
    {
        $title  = 'Drink Categories';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $categories = $this->db->get('drink_categories')->result_array();

        $this->form_validation->set_rules('category_name', 'Name Category', 'required|is_unique[drink_categories.category_name]', array('is_unique' => '%s Existing category name, Create a new category!'));
        $this->form_validation->set_rules('sorting', 'Sorting', 'required');

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'categories' => $categories,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'manage-drinks/categories', $data);
        } else {
            $data = [
                'category_slug' => url_title($this->input->post('category_name'), 'dash', TRUE),
                'category_name' => escape($this->input->post('category_name')),
                'sorting'       => escape($this->input->post('sorting')),
                'created'       => escape(date('Y-m-d H:i:s')),
            ];
            $this->drinks->insert('drink_categories', $data);
            $this->session->set_flashdata('message', 'New drink categories added!');
            redirect(base_url('drinks/categories'), 'refresh');
        }
    }
    public function editcategory($id)
    {
        $title        = 'Drink Categories';
        $subtitle     = 'Edit Category';
        $user         = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editcategory = $this->drinks->getCategoryId($id);
        $categories   = $this->db->get('drink_categories')->result_array();

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'editcategory' => $editcategory,
            'categories'   => $categories,
        );

        $this->template->load('templates/admin/templates', 'manage-drinks/categories-edit', $data);
    }
    public function savecategory()
    {
        $id = $this->input->post('id');
        $data = [
            'category_slug' => url_title($this->input->post('category_name'), 'dash', TRUE),
            'category_name' => escape($this->input->post('category_name')),
            'sorting'       => escape($this->input->post('sorting')),
        ];
        $this->drinks->update($id, $data, 'drink_categories');
        $this->session->set_flashdata('message', 'Category successfully Update!');
        redirect(base_url('drinks/editcategory/') . $id, 'refresh');
    }
    public function deletecategory($id)
    {
        $where = array('id' => $id);
        $this->drinks->delete($where, 'drink_categories');
        $this->session->set_flashdata('message', 'Category successfully Delete!');
        redirect(base_url('drinks/categories'), 'refresh');
    }
    public function drinkimage($id_drink)
    {
        $title      = 'Drink List';
        $subtitle   = 'Drink Image';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $drink    = $this->drinks->detailDrink($id_drink);
        $image      = $this->drinks->imageDrink($id_drink);

        $this->form_validation->set_rules('image_name', 'Image Name', 'required');

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'drink'     => $drink,
            'image'     => $image,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'manage-drinks/drink-image', $data);
        } else {
            $image_name   = $this->input->post('image_name');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image = '') {
            } else {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/product/drink/thumbs';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    echo $this->upload->display_errors();
                } else {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/product/drink/thumbs/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/product/drink/thumbs/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');
                }

                $data = array(
                    'id_drink'    => $id_drink,
                    'image'       => $upload_image,
                    'image_name'  => $image_name,
                );
                $this->drinks->insert('drink_images', $data);
                $this->session->set_flashdata('message', 'drink image successfully added!');
                redirect('drinks/drinkimage/' . $id_drink);
            }
        }
    }
    public function deleteimage($id_drink, $id_image)
    {
        $image = $this->drinks->detailImage($id_image);
        unlink('./assets/img/product/drink/thumbs/' . $image->image);
        $where = array('id_image' => $id_image);
        $this->drinks->delete($where, 'drink_images');
        $this->session->set_flashdata('message', 'Drink image successfully deleted!');
        redirect('drinks/drinkimage/' . $id_drink);
    }
}
