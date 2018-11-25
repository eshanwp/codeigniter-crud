<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multiple_upload_service extends CI_Model {

	
	public function save_file($multiple_upload_model)
	{
		$data = array(
			'gallery_id' => $multiple_upload_model->getGalleryId(),
			'file_name' => $multiple_upload_model->getFileName(),
		);

		return $this->db->insert('gallery_img', $data);
	}
	
	public function get_exists_img()
	{
		$this->db->select('file_name');
		$query = $this->db->get('gallery_img');
        return $query->result();
	}
	

	public function delete_imgs_by_id($multiple_upload_model)
	{
		$data = array(
			'gallery_id' => $multiple_upload_model->getGalleryId(),
		);
		return $this->db->delete('gallery_img', $data);
	}
	public function delete_img($multiple_upload_model)
	{
		$data = array(
			'file_name' => $multiple_upload_model->getFileName()
		);
		return $this->db->delete('gallery_img', $data);
	}

}

