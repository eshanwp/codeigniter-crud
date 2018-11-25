<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')){
			return redirect(base_url());
		}
		
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

	public function index($product_url ='')
	{
		if (!empty($product_url)) {

			//page data
			$data['page_title'] = 'Product';
			$page_content['page_content'] ='cart/product';
			$data['main_breadcrumb'] = 'Cart';
			$data['sub_breadcrumb'] = 'Product';
			$data['page_url'] = 'cart/product';
			//end page data

			//Load Model
			$cart_product_service = new Cart_product_service();
			$cart_product_model = new Cart_product_model();

			//pass Cart Product Data
			$cart_product_model->setProductUrl($product_url);
			$data['product_data'] = $this->cart_product_service->get_selected_cart_product_data($cart_product_model);
			if (empty($data['product_data'])) {
				redirect(base_url().'cart/products_category/','refresh');
			}
			$this->template->load('template/main_template', $page_content, $data);

		}else{
			redirect(base_url().'cart/products_category/','refresh');
		}
		

	}
	

}

