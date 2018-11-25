<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basic_form_service extends CI_Model {


	public function save($basic_form_model)
	{
		$data = array(
			'user_id' => $basic_form_model->getUserId(), 
			'first_name' => $basic_form_model->getFirstName(), 
			'last_name' => $basic_form_model->getLastName(), 
			'nic_number' => $basic_form_model->getNicNumber(), 
			'date_of_birth' => $basic_form_model->getDateOfBirth(), 
			'contact_no' => $basic_form_model->getContactNo(), 
			'email' => $basic_form_model->getEmail(), 
			'gender' => $basic_form_model->getGender(), 
			'experience' => $basic_form_model->getExperience(),
			'qualifications' => $basic_form_model->getQualifications(),		
			'created_date' => $basic_form_model->getCreatedDate()
		);

		return $this->db->insert('basic_form', $data);
	}

	
	public  function get_user_id()
    {
        $this->db->select('*');
        $this->db->from('basic_form');
        $this->db->order_by('user_id', 'DESC');
        $this->db->limit(1);
        $query=$this->db->get();
        return $query->row_array();

    }

}

