<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')){
			return redirect(base_url());
		}
		$this->load->model('Cart/category/cart_category_service');
		$this->load->model('Cart/category/cart_category_model');
		$this->load->model('Cart/product/cart_product_service');
		$this->load->model('Cart/product/cart_product_model');
	}
	function _remap($method,$args)
	{

		if (method_exists($this, $method))
		{
			$this->$method($args);
		}
		else
		{
			$this->index($method,$args);
		}
	}

	public function index($category_url='')
	{
		

		if (empty($category_url)) {
			
			//Load Model
			$cart_category_service = new Cart_category_service();

			//pass Cart Category Data
			$data['category_datas'] = $this->cart_category_service->get_cart_category_data();

		}else{
			//Load Model
			$cart_category_model = new Cart_category_model();
			$cart_category_service = new Cart_category_service();

			//get category url id
			$cart_category_model->setCategoryUrl($category_url);
			$get_category_id = $this->cart_category_service->get_selected_cart_category_id_by_category_url($cart_category_model);
			if (!empty($get_category_id)) {
				//Load Model
				$cart_product_service = new Cart_product_service();
				$cart_product_model = new Cart_product_model();

				//pass Cart Category Data
				$cart_product_model->setCategoryUrl($get_category_id->category_id);
				$data['category_product_datas'] = $this->cart_product_service->get_selected_cart_category_product_data($cart_product_model);
				
			
			}else{
				redirect(base_url().'cart/products_category/','refresh');
			}
			
			
			
			
		}

		//page data
		$data['page_title'] = 'Products Category';
		$page_content['page_content'] ='cart/products_category';
		$data['main_breadcrumb'] = 'Cart';
		$data['sub_breadcrumb'] = 'Products Category';
		$data['page_url'] = 'cart/products_category';
		//end page data

		$this->template->load('template/main_template', $page_content, $data);

	}
	

}

