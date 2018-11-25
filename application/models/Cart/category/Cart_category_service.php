<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_category_service extends CI_Model {


	public function get_cart_category_data()
	{
		$this->db->select('*');
		$query = $this->db->get('cart_category');
        return $query->result();
	}

	public function get_selected_cart_category_id_by_category_url($cart_category_model)
	{

		$data = array(
			'category_url' => $cart_category_model->getCategoryUrl(),
		);
		$this->db->select('category_id');
		$query = $this->db->get_where('cart_category', $data);
        
        if ($query->num_rows() > 0){

            return $query->row();

        }else{
            return FALSE;
        }

		
	}
	


}

