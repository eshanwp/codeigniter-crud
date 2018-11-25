<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basic_table_json_filter_service extends CI_Model {

    var $table = 'customers';
   
    
    public function get_datatables($country ='',$FirstName='',$LastName='')
    {  

        $this->db->like('country',$country);
        $this->db->like('FirstName', $FirstName);
        $this->db->like('LastName', $LastName);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_list_countries()
    {
        $this->db->select('country');
        $this->db->from($this->table);
        $this->db->order_by('country','asc');
        $query = $this->db->get();
        $result = $query->result();
 
        $countries = array();
        foreach ($result as $row) 
        {
            $countries[] = $row->country;
        }
        return $countries;
    }


}

