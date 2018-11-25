<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_product_service extends CI_Model {



	

	public function get_selected_cart_category_product_data($cart_product_model)
	{

		$data = array(
			'category_url' => $cart_product_model->getCategoryUrl(),
		);

		$query = $this->db->get_where('cart_product', $data);
        
        if ($query->num_rows() > 0){

            return $query->result();

        }else{
            return FALSE;
        }

		
	}
	public function get_selected_cart_product_data($cart_product_model)
	{

		$data = array(
			'product_url' => $cart_product_model->getProductUrl(),
		);

		$query = $this->db->get_where('cart_product', $data);
        
        if ($query->num_rows() > 0){

            return $query->row();

        }else{
            return FALSE;
        }

		
	}




}

