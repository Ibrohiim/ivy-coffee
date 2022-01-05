<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Configuration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'user');
        $this->load->model('Configuration_model', 'configuration');
        if ($this->user->is_role() != 1) {
            redirect('auth/blocked');
        }
    }

    //-- Config --//
    public function index()
    {
        $title  = 'Configuration';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $config = $this->configuration->getConfig();

        $this->form_validation->set_rules('website_name', 'Website Name', 'required');

        $data = array(
            'title'  => $title,
            'user'   => $user,
            'config' => $config,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/config/config-web', $data);
        } else {
            $data = [
                'id_config'     => $data['configuration']->id_config,
                'website_name'  => $this->input->post('website_name'),
                'tagline'       => $this->input->post('tagline'),
                'website'       => $this->input->post('website'),
                'keywords'      => $this->input->post('keywords'),
                'metatext'      => $this->input->post('metatext'),
                'email'         => $this->input->post('email'),
                'telephone'     => $this->input->post('telephone'),
                'address'       => $this->input->post('address'),
                'facebook'      => $this->input->post('facebook'),
                'instagram'     => $this->input->post('instagram'),
                'description'   => $this->input->post('description'),
                'payment_account' => $this->input->post('payment_account'),
            ];
            $this->db->update('configuration', $data);
            $this->session->set_flashdata('message', 'The data has been updated!');
            redirect('configuration');
        }
    }
    public function configlogo()
    {
        $title  = 'Config Logo';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $config = $this->configuration->getConfig();

        $this->form_validation->set_rules('website_name', 'Website Name', 'required');

        $data = array(
            'title'  => $title,
            'user'   => $user,
            'config' => $config,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/config/config-logo', $data);
        } else {
            $website_name = $this->input->post('website_name');

            $icon = $_FILES['icon']['name'];
            if ($icon) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/configuration/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('icon')) {
                    $old_image = $data['config']['icon'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/configuration/' . $old_image);
                    }
                    $icon = $this->upload->data('file_name');
                    $this->db->set('icon', $icon);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $logo = $_FILES['logo']['name'];
            if ($logo) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/configuration/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('logo')) {
                    $old_image = $data['config']['logo'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/configuration/' . $old_image);
                    }
                    $logo = $this->upload->data('file_name');
                    $this->db->set('logo', $logo);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = array(
                'website_name' => $website_name,
            );
            $this->db->update('configuration', $data);
            $this->session->set_flashdata('message', 'The data has been updated!');
            redirect('configuration/configlogo');
        }
    }
    //-- Service --//
    public function service()
    {
        $title   = 'Service Settings';
        $user    = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $service = $this->configuration->getService();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'service'   => $service,
        );

        $this->template->load('templates/admin/templates', 'configuration/service/index', $data);
    }
    public function addnewservice()
    {
        $title      = 'Service Settings';
        $subtitle   = 'Add New Service';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/service/service-add', $data);
        } else {
            $title          = $this->input->post('title');
            $description    = $this->input->post('description');
            $status         = $this->input->post('status');

            $data = [
                'title'         => $title,
                'description'   => $description,
                'status'        => $status,
            ];
            $this->configuration->insert('service', $data);
            $this->session->set_flashdata('message', ' Service successfully added!');
            redirect(base_url('configuration/addnewservice'), 'refresh');
        }
    }
    public function edit($id)
    {
        $user        = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editservice = $this->configuration->detailService($id);

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        $data = array(
            'title'     => 'Service Settings',
            'subtitle'  => 'Edit Service',
            'user'      => $user,
            'editservice' => $editservice,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/service/service-edit', $data);
        } else {

            $data = array(
                'id'            => $id,
                'title'         => $this->input->post('title'),
                'description'   => $this->input->post('description'),
                'status'        => $this->input->post('status'),
            );
            $where = array(
                'id' => $id
            );
            $this->configuration->update($where, $data, 'service');
            $this->session->set_flashdata('message', 'Service successfully update!');
            redirect('configuration/edit/' . $id);
        }
    }
    public function delete($id)
    {
        $where = array('id' => $id);
        $this->configuration->delete($where, 'service');
        $this->session->set_flashdata('message', 'Service Successfully Delete!');
        redirect(base_url('configuration/service'), 'refresh');
    }
    public function displayed($id)
    {
        $data = array(
            'status' => 'displayed',
        );
        $where = array('id' => $id);

        $this->configuration->update($where, $data, 'service');
        $this->session->set_flashdata('changed', 'Service has been displayed!');
        redirect(base_url('configuration/service'), 'refresh');
    }
    public function notdisplayed($id)
    {
        $data = array(
            'status' => 'not displayed',
        );
        $where = array('id' => $id);

        $this->configuration->update($where, $data, 'service');
        $this->session->set_flashdata('changed', 'Service not displayed!');
        redirect(base_url('configuration/service'), 'refresh');
    }
    //-- Sidebar --//
    public function sidebarmenu()
    {
        $title = 'Sidebar Menu';
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $menu = $this->db->get('sidebar_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('sorting', 'Sorting', 'required');

        $data = array(
            'title' => $title,
            'user'  => $user,
            'menu'  => $menu,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/sidebar/index', $data);
        } else {
            $data = [
                'menu' => escape($this->input->post('menu')),
                'url_menu' => escape($this->input->post('url')),
                'icon' => escape($this->input->post('icon')),
                'sorting' => escape($this->input->post('sorting')),
                'submenu' => escape($this->input->post('submenu')),
            ];
            $this->configuration->insert('sidebar_menu', $data);
            $this->session->set_flashdata('message', 'New menu added!');
            redirect(base_url('configuration/sidebarmenu'), 'refresh');
        }
    }
    public function editmenu($id)
    {
        $title      = 'Sidebar Menu';
        $subtitle   = 'Edit Menu';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editmenu   = $this->configuration->getMenuId($id);
        $menu       = $this->db->get('sidebar_menu')->result_array();

        $data = array(
            'title'    => $title,
            'subtitle' => $subtitle,
            'user'     => $user,
            'editmenu' => $editmenu,
            'menu'     => $menu,
        );

        $this->template->load('templates/admin/templates', 'configuration/sidebar/menu-edit', $data);
    }
    public function updatemenu()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('sorting', 'Sorting', 'required');

        if ($this->form_validation->run() == false) {
            $this->editmenu($id);
        } else {
            $data = [
                'menu'     => escape($this->input->post('menu')),
                'icon'     => escape($this->input->post('icon')),
                'url_menu' => escape($this->input->post('url')),
                'sorting'  => escape($this->input->post('sorting')),
                'submenu'  => escape($this->input->post('submenu')),
            ];
            $where = array(
                'id' => $id
            );
            $this->configuration->update($where, $data, 'sidebar_menu');
            $this->session->set_flashdata('message', 'Menu successfully Update!');
            redirect(base_url('configuration/editmenu/') . $id, 'refresh');
        }
    }
    public function deletemenu($id)
    {
        $where = array('id' => $id);
        $this->configuration->delete($where, 'sidebar_menu');
        $this->session->set_flashdata('message', 'Menu successfully Delete!');
        redirect(base_url('configuration/sidebarmenu'), 'refresh');
    }
    public function submenu()
    {
        $title = 'Sidebar SubMenu';
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $submenu = $this->configuration->getSubMenu();
        $menu = $this->db->get('sidebar_menu')->result_array();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'menu'      => $menu,
            'submenu'   => $submenu,
        );

        $this->template->load('templates/admin/templates', 'configuration/sidebar/submenu', $data);
    }
    public function addsubmenu()
    {
        $title    = 'Sidebar SubMenu';
        $subtitle = 'Add Submenu';
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $menu = $this->db->get('sidebar_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'menu'      => $menu,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/sidebar/submenu-add', $data);
        } else {
            $data = [
                'title'     => escape($this->input->post('title')),
                'menu_id'   => escape($this->input->post('menu_id')),
                'url'       => escape($this->input->post('url')),
                'icon'      => escape($this->input->post('icon')),
                'is_active' => escape($this->input->post('is_active')),
            ];
            $this->configuration->insert('sidebar_submenu', $data);
            $this->session->set_flashdata('message', 'New Sub Menu added!');
            redirect(base_url('configuration/addsubmenu'), 'refresh');
        }
    }
    public function editsubmenu($id)
    {
        $title      = 'Sidebar SubMenu';
        $subtitle   = 'Edit Submenu';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editsubmenu = $this->configuration->edit_submenu($id);
        $menu       = $this->db->get('sidebar_menu')->result_array();

        $data = array(
            'title'       => $title,
            'subtitle'    => $subtitle,
            'user'        => $user,
            'menu'        => $menu,
            'editsubmenu' => $editsubmenu,
        );

        $this->template->load('templates/admin/templates', 'configuration/sidebar/submenu-edit', $data);
    }
    public function savesubmenu()
    {
        $id     = $this->input->post('id');
        $data   = [
            'title'     => escape($this->input->post('title')),
            'menu_id'   => escape($this->input->post('menu_id')),
            'url'       => escape($this->input->post('url')),
            'icon'      => escape($this->input->post('icon')),
            'is_active' => escape($this->input->post('is_active')),
        ];
        $where = array(
            'id' => $id
        );
        $this->configuration->update($where, $data, 'sidebar_submenu');
        $this->session->set_flashdata('message', 'Sub Menu successfully Update!');
        redirect(base_url('configuration/editsubmenu/') . $id, 'refresh');
    }
    public function deletesubmenu($id)
    {
        $where = array('id' => $id);
        $this->configuration->delete($where, 'sidebar_submenu');
        $this->session->set_flashdata('message', 'Submenu successfully Delete!');
        redirect(base_url('configuration/submenu'), 'refresh');
    }
    public function activesubmenu($id)
    {
        $data = array(
            'is_active' => 1,
        );
        $where = array(
            'id' => $id
        );
        $this->configuration->update($where, $data, 'sidebar_submenu');
        $this->session->set_flashdata('changed', 'Your Submenu has been actived!');
        redirect(base_url('configuration/submenu'), 'refresh');
    }
    public function notactivesubmenu($id)
    {
        $data = array(
            'is_active' => 0,
        );
        $where = array(
            'id' => $id
        );
        $this->configuration->update($where, $data, 'sidebar_submenu');
        $this->session->set_flashdata('changed', 'Your Submenu not activated!');
        redirect(base_url('configuration/submenu'), 'refresh');
    }
    //-- Slider --//
    public function slider()
    {
        $title  = 'Slider Settings';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $slider = $this->configuration->slider();

        $data = array(
            'title'  => $title,
            'user'   => $user,
            'slider' => $slider,
        );

        $this->template->load('templates/admin/templates', 'configuration/slider/index', $data);
    }
    public function addnewslider()
    {
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('caption', 'Caption', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');
        $this->form_validation->set_rules('text_link', 'Text Link', 'required');

        $data = array(
            'title'     => 'Slider Settings',
            'subtitle'  => 'Add New Slider',
            'user'   => $user,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/slider/slider-add', $data);
        } else {
            $name      = $this->input->post('name');
            $title     = $this->input->post('title');
            $caption   = $this->input->post('caption');
            $link      = $this->input->post('link');
            $text_link = $this->input->post('text_link');
            $is_active = $this->input->post('is_active');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image = '') {
            } else {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['upload_path'] = './assets/img/configuration/slider';
                $config['max_size']     = '5048';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $upload_image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }

                $data = [
                    'name'      => $name,
                    'title'     => $title,
                    'caption'   => $caption,
                    'image'     => $upload_image,
                    'link'      => $link,
                    'text_link' => $text_link,
                    'is_active' => $is_active,
                ];
                $this->configuration->insert('slider_settings', $data);
                $this->session->set_flashdata('message', 'Slider successfully added!');
                redirect(base_url('configuration/addnewslider'), 'refresh');
            }
        }
    }
    public function editslider($id)
    {
        $user        = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editslider = $this->configuration->detailSlider($id);

        $this->form_validation->set_rules('name', 'Slider Name', 'required');
        $this->form_validation->set_rules('title', 'Slider Title', 'required');
        $this->form_validation->set_rules('caption', 'Slider Caption', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');
        $this->form_validation->set_rules('text_link', 'Text Link', 'required');

        if ($this->form_validation->run()) {
            if (!empty($_FILES['image']['name'])) {

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/configuration/slider/';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    echo $this->upload->display_errors();

                    $data = array(
                        'title'     => 'Slider Settings',
                        'subtitle'  => 'Edit Slider',
                        'user'      => $user,
                        'editslider' => $editslider,
                    );
                    $this->template->load('templates/admin/templates', 'configuration/slider/slider-edit', $data);
                } else {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/configuration/slider/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/configuration/slider/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');

                    if ($editslider->image != null) {
                        $file = './assets/img/configuration/slider/' . $editslider->image;
                        unlink($file);
                    }

                    $data = array(
                        'id_slider'     => $id,
                        'name'          => $this->input->post('name'),
                        'title'         => $this->input->post('title'),
                        'caption'       => $this->input->post('caption'),
                        'link'          => $this->input->post('link'),
                        'text_link'     => $this->input->post('text_link'),
                        'is_active'     => $this->input->post('is_active'),
                        'image'         => $upload_image,
                    );
                    $where = array(
                        'id_slider' => $id
                    );
                    $this->configuration->update($where, $data, 'slider_settings');
                    $this->session->set_flashdata('message', 'Slider successfully update!');
                    redirect('configuration/editslider/' . $id);
                }
            } else {
                $data = array(
                    'id_slider'     => $id,
                    'name'          => $this->input->post('name'),
                    'title'         => $this->input->post('title'),
                    'caption'       => $this->input->post('caption'),
                    'link'          => $this->input->post('link'),
                    'text_link'     => $this->input->post('text_link'),
                    'is_active'     => $this->input->post('is_active'),
                );
                $where = array(
                    'id_slider' => $id
                );
                $this->configuration->update($where, $data, 'slider_settings');
                $this->session->set_flashdata('message', 'Slider successfully update!');
                redirect('configuration/editslider/' . $id);
            }
        }
        $data = array(
            'title'     => 'Slider Settings',
            'subtitle'  => 'Edit Slider',
            'user'      => $user,
            'editslider' => $editslider,
        );
        $this->template->load('templates/admin/templates', 'configuration/slider/slider-edit', $data);
    }
    public function deleteslider($id)
    {
        $where = array('id_slider' => $id);
        $image = $this->db->get_where('slider_settings', array('id_slider' => $id))->row();
        $file = ('./assets/img/configuration/slider/' . $image->image);
        if (is_readable($file) && unlink($file)) {
            $this->configuration->delete($where, 'slider_settings');
            $this->session->set_flashdata('message', 'Slider Successfully Delete!');
        } else {
            $this->session->set_flashdata('message', 'Slider Failed to Delete!');
        }
        redirect(base_url('configuration/slider'), 'refresh');
    }
    public function publish($id)
    {
        $data = array(

            'is_active' => 1,
        );
        $where = array(
            'id_slider' => $id
        );

        $this->configuration->update($where, $data, 'slider_settings');
        $this->session->set_flashdata('changed', 'Your slider has been published!');
        redirect(base_url('configuration/slider'), 'refresh');
    }
    public function draft($id)
    {
        $data = array(

            'is_active' => 0,
        );
        $where = array(
            'id_slider' => $id
        );

        $this->configuration->update($where, $data, 'slider_settings');
        $this->session->set_flashdata('changed', 'Your slider has been drafted!');
        redirect(base_url('configuration/slider'), 'refresh');
    }
    //-- About --//
    public function about()
    {
        $title  = 'About Settings';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $about = $this->configuration->getAbout();

        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run()) {
            if (!empty($_FILES['about_image']['name'])) {

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/configuration/';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('about_image')) {
                    echo $this->upload->display_errors();

                    $data = array(
                        'title'  => $title,
                        'user'   => $user,
                        'about' => $about,
                    );
                    $this->template->load('templates/admin/templates', 'configuration/about/index', $data);
                } else {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/configuration/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/configuration/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');

                    if ($about['image'] != null) {
                        $file = './assets/img/configuration/' . $about['image'];
                        unlink($file);
                    }

                    $data = array(
                        'id'            => $about['id'],
                        'title'         => $this->input->post('title'),
                        'image'         => $upload_image,
                        'description'   => $this->input->post('description'),
                        'quotes'        => $this->input->post('quotes'),
                        'author'        => $this->input->post('author'),
                    );
                    $this->db->update('about', $data);
                    $this->session->set_flashdata('message', 'About successfully update!');
                    redirect('configuration/about');
                }
            } else {
                $data = array(
                    'id'            => $about['id'],
                    'title'         => $this->input->post('title'),
                    'description'   => $this->input->post('description'),
                    'quotes'        => $this->input->post('quotes'),
                    'author'        => $this->input->post('author'),
                );
                $this->db->update('about', $data);
                $this->session->set_flashdata('message', 'About successfully update!');
                redirect('configuration/about');
            }
        }
        $data = array(
            'title'     => $title,
            'user'      => $user,
            'about'     => $about,
        );
        $this->template->load('templates/admin/templates', 'configuration/about/index', $data);
    }
}
