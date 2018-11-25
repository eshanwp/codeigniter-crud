<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->load->model('Login/login_model');
		$this->load->model('Login/login_service');
	}

	public function index()
	{
		$data['page_title'] = 'Login';
		$page_name['page_content'] ='login';
		$this->template->load('template/login_template', $page_name, $data);

	}
	public function ajax_login()
	{
		$login_model = new Login_model();
		$login_service = new Login_service();
		
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_message('required', '{field} is Required');	
		$this->form_validation->set_message('valid_email', 'Invalid {field}');	
		if($this->form_validation->run() === true) {

			$login_model->setEmail($this->input->post('email'));
			$login_model->setPassword($this->input->post('password'));

			if ($login_service->login($login_model)) {
				$login_result = $login_service->login($login_model);
				$session_data = array(
					'user_name' => $login_result[0]->user_name,
					'email' => $login_result[0]->email
				);
				$this->session->set_userdata('logged_in', $session_data);
				$result['status'] = true;
				$result['message'] = "Login successfully.";
			}else{
				$result['status'] = false;
				$result['message'] = array('login_error'=> 'Invalid Email Address and Password');
			}
			
		}else{
			$result['status'] = false;
			$result['message'] = $this->form_validation->error_array();
		}
		echo json_encode($result);
	}

}

