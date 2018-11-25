<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_service extends CI_Model {

	public function login($login_model)
	{
		$email = $login_model->getEmail();
		$password = md5($login_model->getPassword());
		

		$results = $this->db->get_where('users',array('email'=> $email,'password'=>$password));
        
        if ($results ->num_rows() > 0){
            return $results->result();
        }else{
            return FALSE;
        }
		
	}

}

