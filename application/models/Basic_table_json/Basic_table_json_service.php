<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basic_table_json_service extends CI_Model {


	public function get_datatables()
	{
		$this->db->select('*');
		$query = $this->db->get('customers');
        return $query->result();
	}

	


}

