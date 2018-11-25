<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basic_form extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')){
			return redirect(base_url());
		}
		$this->load->model('Basic_form/basic_form_model');
		$this->load->model('Basic_form/basic_form_service');
		$this->load->model('Multiple_upload/multiple_upload_model');
		$this->load->model('Multiple_upload/multiple_upload_service');
		$this->load->library("my_file_upload");
	}

	public function index()
	{
		//page data
		$data['page_title'] = 'Basic Form';
		$page_content['page_content'] ='basic_form';
		$data['main_breadcrumb'] = 'Form';
		$data['sub_breadcrumb'] = 'Basic Form';
		$data['page_url'] = 'basic_form';
		//end page data
		$this->template->load('template/main_template', $page_content, $data);

	}
	
	//save data
	public function ajax_save()
	{	
		//load model
		$basic_form_model = new Basic_form_model();
		$basic_form_service = new Basic_form_service();
		$multiple_upload_model = new Multiple_upload_model();
		$multiple_upload_service = new Multiple_upload_service();
		
		//set validation
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('nic_number', 'NIC Number', 'trim|required');
		$this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required');
		$this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('experience', 'Experience', 'trim|required');
		$this->form_validation->set_rules('qualifications[]', 'Qualifications', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_message('required', '{field} is Required');	
		$this->form_validation->set_message('valid_email', 'Invalid {field}');

		//check validation is true
		if($this->form_validation->run() === true) {
			//get new id
			$get_last_data = $basic_form_service->get_user_id();
			// print_r($get_last_data);
			// exit();
			$last_id = $get_last_data['user_id'];
			if (empty($last_id)) {
				$last_id = 'uid-000000';
			}
			$var = explode("-",$last_id);
			$new_id = $var[0].'-'.str_pad(++$var[1], 6,0,STR_PAD_LEFT);

			$img_name = $new_id;
			$uploadPath = 'uploads/';
			$files = $_FILES['inputfile'];
			
			$uploadFile = $this->my_file_upload->multiple_upload($img_name,$uploadPath,null,$files,null,'no');
					
			if(!empty($uploadFile)){

				//save multiple file data
				$ids = array();
				for($i = 0; $i < count($uploadFile); $i++){
					$user_id = $new_id;
					$file_name = $uploadFile[$i];


					$multiple_upload_model->setId($user_id);
					$multiple_upload_model->setFile($file_name);

					if ($multiple_upload_service->save_file($multiple_upload_model)) {
						$ids[]=$this->db->insert_id();

					}
				}
				

				if (count($ids)>0) {
					//send data to model
					$basic_form_model->setUserId($new_id);
					$basic_form_model->setFirstName($this->input->post('first_name'));
					$basic_form_model->setLastName($this->input->post('last_name'));
					$basic_form_model->setNicNumber($this->input->post('nic_number'));
					$basic_form_model->setDateOfBirth($this->input->post('date_of_birth'));
					$basic_form_model->setContactNo($this->input->post('contact_no'));
					$basic_form_model->setEmail($this->input->post('email'));
					$basic_form_model->setGender($this->input->post('gender'));
					$basic_form_model->setExperience($this->input->post('experience'));
					$qualifications = implode(',', $this->input->post('qualifications[]'));
					$basic_form_model->setQualifications($qualifications);
					$basic_form_model->setCreatedDate(date("Y-m-d"));

					//check data is save
					if ($basic_form_service->save($basic_form_model)) {
						//set successfully message
						$result['status'] = true;
						$result['message'] = "Data inserted successfully.";
					}
				}
				
				
				
				

			}else{
				//set error message file upload
				$result['status'] = false;
				$result['message'] = array("inputfile"=>$this->upload->display_errors());
			}
		}else{
			//set error message form validation
			$result['status'] = false;
			$result['message'] = $this->form_validation->error_array();
		}
		print_r (json_encode($result));
	}

}

