<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dynamic_form_service extends CI_Model {


	public function save($dynamic_form_model)
	{
		$data = array(
			'first_name' => $dynamic_form_model->getFirstName(), 
			'last_name' => $dynamic_form_model->getLastName(),
			'file' => $dynamic_form_model->getFile(),
		);

		return $this->db->insert('dynamic_form', $data);
	}

	
	
	

}

