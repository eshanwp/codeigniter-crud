<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multiple_upload_service extends CI_Model {

	
	public function save_file($multiple_upload_model)
	{
		$data = array(
			'user_id' => $multiple_upload_model->getId(), 
			'file' => $multiple_upload_model->getFile()
		);

		return $this->db->insert('multiple_upload', $data);
	}
	

}

