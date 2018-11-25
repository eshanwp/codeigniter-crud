<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_to_cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')){
			return redirect(base_url());
		}
		
		$this->load->model('Cart/product/cart_product_service');
		$this->load->model('Cart/product/cart_product_model');
	}
	

	public function add()
	{
		$data = array(
			'id'      => 'sku_123ABC',
			'qty'     => 1,
			'price'   => 39.95,
			'name'    => 'T-Shirt',
			'coupon'  => 'XMAS-50OFF'
		);
		$this->cart->insert($data);
		echo "<pre>";
		print_r($this->cart->contents());
		echo "</pre>";
	}


	public function update()
	{
		$data = array(
	        'rowid' => '1164a59fe023937d41e11ddf6871b50c',
	        'qty'   => 3
		);
		$this->cart->update($data);
		echo "<pre>";
		print_r($this->cart->contents());
		echo "</pre>";
	}
	

	public function destroy(){
        $this->cart->destroy();
       
    }
	

}

