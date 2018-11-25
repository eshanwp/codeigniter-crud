<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_data_service extends CI_Model {

	
	public function save_data($gallery_data_model)
	{
		$data = array(
			'gallery_name' => $gallery_data_model->getGalleryName(),
			'gallery_titel' => $gallery_data_model->getGalleryTitel(),
		);

		return $this->db->insert('gallery_data', $data);
	}
	
	public function get_data()
	{
		$this->db->select('*');
		$query = $this->db->get('gallery_data');
        return $query->result();
	}
	public function get_data_by_id($gallery_data_model)
	{
		$data = array(
			'gallery_id' => $gallery_data_model->getGalleryId(),
		);
		$results = $this->db->get_where('gallery_data',$data);
        
        if ($results ->num_rows() > 0){
            return $results->row();
        }else{
            return FALSE;
        }
	}

	public function delete_data_by_id($gallery_data_model)
	{
		$data = array(
			'gallery_id' => $gallery_data_model->getGalleryId(),
		);
		return $this->db->delete('gallery_data', $data);
	}

	public function update_data($gallery_data_model,$gallery_id)
	{
		$data = array(
			'gallery_name' => $gallery_data_model->getGalleryName(),
			'gallery_titel' => $gallery_data_model->getGalleryTitel(),
		);
		$this->db->where('gallery_id', $gallery_id);
		return $this->db->update('gallery_data', $data);
		
	}
}

