<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')){
			return redirect(base_url());
		}
		
	}

	public function index()
	{
		//page data
		$data['page_title'] = 'Add Slider';
		$page_content['page_content'] ='slider';
		$data['main_breadcrumb'] = 'Slider';
		$data['sub_breadcrumb'] = 'Add Slider';
		$data['page_url'] = 'slider';

		$this->template->load('template/main_template', $page_content, $data);

	}

	private function _multiple_upload($uploadPath,$files)
	{

		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['remove_spaces'] = true;
		$config['overwrite'] = true;

		$this->load->library('upload', $config);

		$images = array();

		foreach ($files['name'] as $key => $image) {
			$_FILES['images[]']['name']= $files['name'][$key];
			$_FILES['images[]']['type']= $files['type'][$key];
			$_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
			$_FILES['images[]']['error']= $files['error'][$key];
			$_FILES['images[]']['size']= $files['size'][$key];

			$tmp = explode('.', $image);
			$file_extension[] = end($tmp);
			$img_name = round(microtime(true) * 1000);
			$fileName = $img_name.".".$file_extension[$key];
			$images[] = $fileName;

			$config['file_name'] = $fileName;

			$this->upload->initialize($config);

			if ($this->upload->do_upload('images[]')) {
				$this->upload->data();
			} else {
				return false;
			}
		}

		return $images;
	}
	
	public function ajax_save()
	{	

		$dynamic_form_model = new Dynamic_form_model();
		$dynamic_form_service = new Dynamic_form_service();

		foreach ($this->input->post('first_name[]') as $key => $value)
		{
			if (empty($value)) {
				$this->form_validation->set_rules('first_name_'.$key, 'First Name', 'trim|required');
			}
		}
		foreach ($this->input->post('last_name[]') as $key => $value)
		{
			if (empty($value)) {
				$this->form_validation->set_rules('last_name_'.$key, 'Last Name', 'trim|required');
			}
		}

		$ids = array();
		foreach ($_FILES['inputfile'] as  $key => $value)
		{
			if (isset($_FILES['inputfile']['name']) && $_FILES['inputfile']['name']!=""){
				for ($c=0; $c <count($_FILES['inputfile']['name']) ; $c++) { 
					if (empty($_FILES['inputfile']['name'][$c])) {
						$this->form_validation->set_rules('inputfile_'.$c, 'File', 'required');
					}

				}
			}
		}

		

		$this->form_validation->set_message('required', '{field} is Required');	
		if($this->form_validation->run() === false) {
			$result['status'] = false;
			$result['form_validation'] = $this->form_validation->error_array();

			if (empty($result['form_validation'])) {
				

				$eid = 0;
				$files = array();
				foreach ($_FILES as $key => $value) {
					if(!empty($value['name']))
					{
						$uploadPath = 'uploads/';
						$uploadFile = $this->_multiple_upload($uploadPath,$_FILES['inputfile']);

						
						if(!empty($uploadFile)){
							$ids = array();
							$first_nameArr = $_POST['first_name'];
							$last_nameArr = $_POST['last_name'];
							$file_data = $uploadFile;
							if(!empty($first_nameArr)){
								for($i = 0; $i < count($first_nameArr); $i++){
									if(!empty($first_nameArr[$i])){
										$first_name = $first_nameArr[$i];
										$last_name = $last_nameArr[$i];
										$file_name = $file_data[$i];

										$dynamic_form_model->setFirstName($first_name);
										$dynamic_form_model->setLastName($last_name);
										$dynamic_form_model->setFile($file_name);

										if ($dynamic_form_service->save($dynamic_form_model)) {
											$ids[]=$this->db->insert_id();
										}
										if (count($ids)> 0) {
											$result['status'] = true;
											$result['message'] = "Data inserted successfully.";
										}

									}
								}
							}
						}else{
							$result['status'] = false;
							$result['error'] = $this->upload->display_errors();
						}
						
					}         
				}
				
			}
		}
		print_r(json_encode($result));

	}

}

