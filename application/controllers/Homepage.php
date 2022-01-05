<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Homepage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
		$this->load->model('Drinks_model', 'drinks');
		$this->load->model('Food_model', 'food');
		$this->load->model('configuration_model', 'config_m');
		$this->load->model('Transaction_model', 'transaction');
		$this->load->model('Table_model', 'table');
		$this->load->model('Offers_model', 'offers');
	}
	public function index()
	{
		$title 		 = 'Ivy Coffee | Home';
		$user		 = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$date = date('Y-m-d');
		$year   = date('Y');
		$monthfavorite = date('m') - 1;

		$site		 = $this->config_m->getConfig();
		$slider 	 = $this->config_m->getSlider();
		$service 	 = $this->config_m->homepageService();
		$keywords 	 = $this->config_m->getConfig('keywords');
		$description = $this->config_m->getConfig('description');
		$navDrink	 = $this->drinks->navDrink();
		$drinks 	 = $this->drinks->favoriteDrink($monthfavorite, $year);
		$navFood	 = $this->food->navFood();
		$food 	 	 = $this->food->favoriteFood($monthfavorite, $year);
		$offers 	 = $this->offers->homepage_Offers($date);

		$data = array(
			'title'  	=> $title,
			'user'   	=> $user,
			'site' 		=> $site,
			'slider'	=> $slider,
			'navDrink' 	=> $navDrink,
			'drinks' 	=> $drinks,
			'navFood' 	=> $navFood,
			'food' 		=> $food,
			'offers'    => $offers,
			'service' 	=> $service,
			'keywords' 	=> $keywords,
			'description' => $description,
		);

		$this->template->load('templates/homepage/templates', 'homepage/index', $data);
	}
	public function drinks($category_slug = '')
	{
		if ($category_slug == null) {
			$title 		  = 'Ivy Coffee | Drinks';
			$drinks       = $this->drinks->drinkList();
		} else {
			$category    = $this->drinks->readCategory($category_slug);
			$id_category = $category->id;

			$title 	= $category->category_name;
			$drinks = $this->drinks->categoryList($id_category);
		}
		$data = array(
			'title'     	=> $title,
			'drinks'  		=> $drinks,
			'categoryhome'  => $this->drinks->categoryHome(),
		);

		$this->template->load('templates/homepage/templates', 'homepage/drinks', $data);
	}
	public function food($category_slug = '')
	{
		if ($category_slug == null) {
			$title	= 'Ivy Coffee | Food';
			$food	= $this->food->foodList();
		} else {
			$category    = $this->food->readCategory($category_slug);
			$id_category = $category->id;

			$title 	= $category->category_name;
			$food 	= $this->food->categoryList($id_category);
		}
		$data = array(
			'title'     	=> $title,
			'food'  		=> $food,
			'categoryhome'  => $this->food->categoryHome(),
		);

		$this->template->load('templates/homepage/templates', 'homepage/food', $data);
	}
	public function detail($code)
	{
		if (substr($code, 0, 4) != 'FOOD') {
			$drinks    		= $this->drinks->read($code);
			$code 			= $drinks->id;
			$id_category 	= $drinks->category;
			$title      	= $drinks->drink_name;
			$site       	= $this->config_m->getConfig();
			$image      	= $this->drinks->imageDrink($code);
			$drink_related 	= $this->drinks->drinkRelated($id_category);

			$data = array(
				'title'     => $title,
				'drinks'   	=> $drinks,
				'site'      => $site,
				'image'     => $image,
				'drink_related' => $drink_related,
			);

			$this->template->load('templates/homepage/templates', 'homepage/detail-drink', $data);
		} else {
			$food    		= $this->food->read($code);
			$code 			= $food->id;
			$id_category 	= $food->category;
			$title      	= $food->food_name;
			$site       	= $this->config_m->getConfig();
			$food_related 	= $this->food->foodRelated($id_category);

			$data = array(
				'title'     => $title,
				'food'   	=> $food,
				'site'      => $site,
				'food_related' => $food_related,
			);

			$this->template->load('templates/homepage/templates', 'homepage/detail-food', $data);
		}
	}
	public function shopping()
	{
		$title  = 'Ivy Coffee | Shopping Cart';
		$cart   = $this->cart->contents();
		$table  = $this->transaction->shoppingTable();

		$this->form_validation->set_rules('table_number', 'Table Number', 'required');
		$this->form_validation->set_rules('customer_name', 'Name', 'required');

		$data = array(
			'title'      => $title,
			'cart'       => $cart,
			'table'      => $table,
		);

		if ($this->form_validation->run() == false) {
			$this->template->load('templates/homepage/templates', 'homepage/shopping-cart', $data);
		} else {
			$code = $this->input->post('transaction_code');

			$this->load->library('ciqrcode');
			$config['cacheable']    = true;
			$config['cachedir']     = './assets/';
			$config['errorlog']     = './assets/';
			$config['imagedir']     = './assets/img/qrcode/';
			$config['quality']      = true;
			$config['size']         = '1024';
			$config['black']        = array(224, 255, 255);
			$config['white']        = array(70, 130, 180);
			$this->ciqrcode->initialize($config);

			$image_name = $code . '.png';

			$params['data'] = $code;
			$params['level'] = 'H';
			$params['size'] = 10;
			$params['savename'] = FCPATH . $config['imagedir'] . $image_name;
			$this->ciqrcode->generate($params);

			$data = array(
				'table_number'      => $this->input->post('table_number'),
				'order_type'        => $this->input->post('ordertype'),
				'customer_name'     => htmlspecialchars($this->input->post('customer_name', 'true')),
				'transaction_code'  => $code,
				'qrcode'            => $image_name,
				'transaction_date'  => date('Y-m-d H:i:s'),
				'total_transaction' => $this->input->post('total_transaction'),
				'payment_status'    => 'Pending',
				'order_status'      => 'Waiting',
			);
			$this->db->insert('invoice', $data);

			foreach ($this->cart->contents() as $item) {
				$sub_total = $item['qty'] * $item['price'];
				$data = array(
					'transaction_code'  => $code,
					'code_product'      => $item['id'],
					'price'             => $item['price'],
					'quantity'          => $item['qty'],
					'total_price'       => $sub_total,
					'transaction_date'  => date('Y-m-d H:i:s'),
					'status_queue'      => 'Waiting',
				);
				$this->db->insert('transaction', $data);
			}

			$this->cart->destroy();

			redirect('homepage/confirmorder/' . $code);
		}
	}
	public function confirmOrder($code)
	{
		$title  = ' Ivy Coffee | Confirmation Order';
		$cart   = $this->transaction->shoppingTransaction($code);
		$confirmorder = $this->transaction->cek_invoice($code);
		$code   	  = $confirmorder->transaction_code;
		$tablecode = $confirmorder->table_number;
		$tablecode = $confirmorder->table_number;
		$table  = $this->table->getTableCode($tablecode);

		$data = array(
			'title' => $title,
			'confirmorder' => $confirmorder,
			'cart'  => $cart,
			'table' => $table,
		);

		$this->template->load('templates/homepage/templates', 'homepage/confirm-order', $data);
	}
	public function loadcart()
	{
		$data = array(
			'items' => $this->cart->contents(),
		);
		$this->load->view('homepage/cart', $data);
	}
	public function addtocart()
	{
		$code   = $this->input->post('code');
		$qty    = $this->input->post('qty');
		$price  = $this->input->post('price');
		$name   = $this->input->post('name');

		$data = array(
			'id'     => $code,
			'qty'    => $qty,
			'price'  => $price,
			'name'   => $name,
		);

		$this->cart->insert($data);
		echo $this->loadcart();
	}
	public function removecart()
	{
		$id = $this->input->post('id');

		$this->cart->remove($id);

		echo $this->loadcart();
	}
	public function clearcart()
	{
		$this->cart->destroy();

		echo $this->loadcart();
	}
	public function decrementqty()
	{
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');

		$data = array(
			'rowid' => $id,
			'qty' => $qty - 1,
		);
		$this->cart->update($data);

		echo $this->loadcart();
	}
	public function incrementqty()
	{
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');

		$data = array(
			'rowid' => $id,
			'qty' => $qty + 1,
		);
		$this->cart->update($data);

		echo $this->loadcart();
	}
	public function dinein()
	{
		$this->session->unset_userdata('ordertype');
		$this->session->set_userdata('ordertype', 'Dine In');
		echo $this->loadcart();
	}
	public function takeaway()
	{
		$this->session->unset_userdata('ordertype');
		$this->session->set_userdata('ordertype', 'Take Away');
		echo $this->loadcart();
	}
	public function offers()
	{
		$date = date('Y-m-d');
		$data = array(
			'title'       => 'Ivy Coffee | Special Offers',
			'offers'      => $this->offers->homepage_Offers($date),
			'drinkoffers' => $this->offers->getDrinkOffers(),
			'foodoffers' => $this->offers->getFoodOffers(),
		);

		$this->template->load('templates/homepage/templates', 'homepage/offers', $data);
	}
	public function about()
	{
		$data = array(
			'title' => 'About Ivy Coffee',
			'about' => $this->config_m->getAbout(),
		);

		$this->template->load('templates/homepage/templates', 'homepage/about', $data);
	}
	public function contact()
	{
		$title = 'Ivy Coffee | Contact';

		$data = array(
			'title'      => $title,
		);

		$this->template->load('templates/homepage/templates', 'homepage/contact', $data);
	}
}
