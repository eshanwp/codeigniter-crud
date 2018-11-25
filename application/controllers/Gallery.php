<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')){
			return redirect(base_url());
		}
		$this->load->model('Gallery/multiple_upload_model');
		$this->load->model('Gallery/multiple_upload_service');
		$this->load->model('Gallery/gallery_data_model');
		$this->load->model('Gallery/gallery_data_service');
		$this->load->library("my_file_upload");
		
	}

	public function create_gallery()
	{
		//page data
		$data['page_title'] = 'Create Gallery';
		$page_content['page_content'] ='create_gallery';
		$data['main_breadcrumb'] = 'Gallery';
		$data['sub_breadcrumb'] = 'Create Gallery';
		$data['page_url'] = 'create_gallery';
		$this->template->load('template/main_template', $page_content, $data);

	}
	public function update_gallery($gallery_id)
	{
		//page data
		$data['page_title'] = 'Update Gallery';
		$page_content['page_content'] ='update_gallery';
		$data['main_breadcrumb'] = 'Gallery';
		$data['sub_breadcrumb'] = 'Update Gallery';
		$data['page_url'] = 'update_gallery';


		$multiple_upload_model = new Multiple_upload_model();
		$multiple_upload_service = new Multiple_upload_service();
		$gallery_data_model = new Gallery_data_model();
		$gallery_data_service = new Gallery_data_service();
		$gallery_data_model->setGalleryId($gallery_id);
		$get_select_gallery_data = $gallery_data_service->get_data_by_id($gallery_data_model);
		if (!empty($get_select_gallery_data)) {
			$data['gallery_data'] = $get_select_gallery_data;
		}


		$this->template->load('template/main_template', $page_content, $data);

	}
	public function index()
	{
		//page data
		$data['page_title'] = 'Create Gallery';
		$page_content['page_content'] ='create_gallery';
		$data['main_breadcrumb'] = 'Gallery';
		$data['sub_breadcrumb'] = 'Create Gallery';
		$data['page_url'] = 'create_gallery';
		$this->template->load('template/main_template', $page_content, $data);

	}
	public function view_gallery()
	{
		//page data
		$data['page_title'] = 'View Gallery';
		$page_content['page_content'] ='view_gallery';
		$data['main_breadcrumb'] = 'Gallery';
		$data['sub_breadcrumb'] = 'View Gallery';
		$data['page_url'] = 'view_gallery';
		$this->template->load('template/main_template', $page_content, $data);

	}
	public function gallery_list()
	{	
		//load model
		$gallery_data_service = new Gallery_data_service();

		//get data
		$list =$this->gallery_data_service->get_data();
		$no =0;
		foreach ($list as $key =>$gallery_data) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $gallery_data->gallery_name;
			$row[] = '<a href="'.base_url().'gallery/update_gallery/'.$gallery_data->gallery_id.'/" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>';
			$row[] = '<button class="btn btn-sm btn-danger" onclick="delete_data('.$gallery_data->gallery_id.')"><i class="glyphicon glyphicon-trash"></i></button>';
			
			$data[] = $row;
		}
		
		//set data to array
		$output = array(
			
			"data" => $data,
			
		);
		//output to json format
		echo json_encode($output);
		
	}
	
	

	//save data
	private function _ajax_save($save_staus)
	{	
		$gallery_data_model = new Gallery_data_model();
		$gallery_data_service = new Gallery_data_service();
		$multiple_upload_model = new Multiple_upload_model();
		$multiple_upload_service = new Multiple_upload_service();

		//set validation
		$this->form_validation->set_rules('gallery_name', 'Gallery Name', 'trim|required');

		if ($save_staus == 0) {
			$this->form_validation->set_rules('gallery_titel', 'Gallery Name', 'is_unique[gallery_data.gallery_titel]');
		}

		$this->form_validation->set_message('required', '{field} is Required');	
		$this->form_validation->set_message('is_unique', '{field} is Already Exists.');	
		if($this->form_validation->run() === true) {
			$gallery_data_model->setGalleryName($this->input->post('gallery_name'));
			$gallery_data_model->setGalleryTitel($this->input->post('gallery_titel'));

			$files = $_FILES['img_upload'];

			$img_name = $this->input->post('gallery_titel');
			
			$uploadPath = 'uploads/gallery/'.$img_name.'/';
			
			//load model
			$multiple_upload_service = new Multiple_upload_service();
			$exists_img = $this->multiple_upload_service->get_exists_img();

			//get exists_img data
			$exists_img_data = $this->multiple_upload_service->get_exists_img();

			
			if(!empty($files['name'][0])){
				
				if ($save_staus == 0) {
					if (!file_exists($uploadPath)) {
						mkdir($uploadPath, 0777, true);
					}
					
					//pass data to file upload
					$uploadFile = $this->my_file_upload->multiple_upload($img_name,$uploadPath,$exists_img_data,$files);

					if(!empty($uploadFile)){
						if ($gallery_data_service->save_data($gallery_data_model)) {
							$gallery_id	= $this->db->insert_id();
							$upload_img = $this->my_file_upload->rename_file($img_name,$img_name,$uploadPath);
							if (!empty($upload_img)) {
								
								//save multiple file data
								$ids = array();
								for($i = 0; $i < count($upload_img); $i++){
									$file_name = $upload_img[$i];
									$multiple_upload_model->setGalleryId($gallery_id);
									$multiple_upload_model->setFileName($file_name);

									if ($multiple_upload_service->save_file($multiple_upload_model)) {
										$ids[]=$this->db->insert_id();
									}
								}
							}

							if (count($ids)>=0) {
								//set successfully message
								$result['status'] = true;
								$result['message'] = "Data Inserted successfully.";
							}
						}
					}else{
						//set error message file upload
						$result['status'] = false;
						$result['message'] = array("img_upload"=>$this->upload->display_errors());
					}
				}elseif ($save_staus == 1) {

					$gallery_data_model = new Gallery_data_model();
					$gallery_data_service = new Gallery_data_service();

					// get gallery titel
					$gallery_data_model->setGalleryId($this->input->post('gallery_id'));
					$get_select_gallery_data = $gallery_data_service->get_data_by_id($gallery_data_model);
					$img_name_old = $get_select_gallery_data->gallery_titel;

					$old_uploadPath = 'uploads/gallery/'.$img_name_old.'/';

					

					$gallery_data_model = new Gallery_data_model();
					$gallery_data_service = new Gallery_data_service();
					
					$gallery_data_model->setGalleryName($this->input->post('gallery_name'));
					$gallery_data_model->setGalleryTitel($this->input->post('gallery_titel'));

					if (file_exists($old_uploadPath) && ($old_uploadPath == $uploadPath)) {

						//upload new images
						$uploadFile = $this->my_file_upload->multiple_upload($img_name_old,$old_uploadPath,$exists_img_data,$files);

						if(!empty($uploadFile)){


							$multiple_upload_model = new Multiple_upload_model();
							$multiple_upload_service = new Multiple_upload_service();
							$multiple_upload_model->setGalleryId($this->input->post('gallery_id'));


							//delete old image list from database
							if ($multiple_upload_service->delete_imgs_by_id($multiple_upload_model)) {
								// add new image list
								if ($gallery_data_service->update_data($gallery_data_model,$this->input->post('gallery_id'))) {

									$gallery_id	= $this->input->post('gallery_id');

									//rename new file name
									rename($old_uploadPath,$uploadPath);

									$upload_img = $this->my_file_upload->rename_file($img_name_old,$img_name,$uploadPath);

									if (!empty($upload_img)) {
										
										//save multiple file data
										$ids = array();
										for($i = 0; $i < count($upload_img); $i++){
											$file_name = $upload_img[$i];
											$multiple_upload_model->setGalleryId($gallery_id);
											$multiple_upload_model->setFileName($file_name);

											if ($multiple_upload_service->save_file($multiple_upload_model)) {
												$ids[]=$this->db->insert_id();
											}
										}
									}

									if (count($ids)>=0) {
										//set successfully message
										$result['status'] = true;
										$result['message'] = "Gallery Update successfully.";
									}
								}
							}



						}else{
						//set error message file upload
							$result['status'] = false;
							$result['message'] = array("img_upload"=>$this->upload->display_errors());
						}	
					}else{
									//set error message file upload
						$result['status'] = false;
						$result['message'] = array("img_upload"=>'Gallery is Already Exists');
					}
					
				}


			}else{

				$gallery_data_model = new Gallery_data_model();
				$gallery_data_service = new Gallery_data_service();

				// get gallery titel
				$gallery_data_model->setGalleryId($this->input->post('gallery_id'));
				$get_select_gallery_data = $gallery_data_service->get_data_by_id($gallery_data_model);
				$img_name_old = $get_select_gallery_data->gallery_titel;

				$old_uploadPath = 'uploads/gallery/'.$img_name_old.'/';


				$gallery_data_model = new Gallery_data_model();
				$gallery_data_service = new Gallery_data_service();

				$gallery_data_model->setGalleryName($this->input->post('gallery_name'));
				$gallery_data_model->setGalleryTitel($this->input->post('gallery_titel'));


				$multiple_upload_model = new Multiple_upload_model();
				$multiple_upload_service = new Multiple_upload_service();
				$multiple_upload_model->setGalleryId($this->input->post('gallery_id'));


				
				if (file_exists($old_uploadPath) && !file_exists($uploadPath)) {
					//delete old image list from database
					if ($multiple_upload_service->delete_imgs_by_id($multiple_upload_model)) {

						// add new image list
						if ($gallery_data_service->update_data($gallery_data_model,$this->input->post('gallery_id'))) {

							$gallery_id	= $this->input->post('gallery_id');

							//rename new file name
							rename($old_uploadPath,$uploadPath);



							$upload_img = $this->my_file_upload->rename_file($img_name_old,$img_name,$uploadPath);
							if (!empty($upload_img)) {

								//save multiple file data
								$ids = array();
								for($i = 0; $i < count($upload_img); $i++){
									$file_name = $upload_img[$i];
									$multiple_upload_model->setGalleryId($gallery_id);
									$multiple_upload_model->setFileName($file_name);

									if ($multiple_upload_service->save_file($multiple_upload_model)) {
										$ids[]=$this->db->insert_id();
									}
								}
							}

							if (count($ids)>=0) {
								//set successfully message
								$result['status'] = true;
								$result['message'] = "Gallery Update successfully.";
							}
						}
					}
				}else{
							//set error message file upload
					$result['status'] = false;
					$result['message'] = array("img_upload"=>'Gallery is Already Exists');
				}


				
			}

		}else{
			//set error message form validation
			$result['status'] = false;
			$result['message'] = $this->form_validation->error_array();
		}


		echo json_encode($result);
	}
	public function save()
	{
		$this->_ajax_save(0);

	}
	public function update()
	{
		$this->_ajax_save(1);

	}

	//delete image by name
	public function remove_img()
	{
		//load model
		$multiple_upload_model = new Multiple_upload_model();
		$multiple_upload_service = new Multiple_upload_service();

		$multiple_upload_model->setFileName($this->input->post('file_name'));

		if (!empty($this->input->post('file_to_remove'))) {
			$file_to_remove = $this->input->post('file_to_remove');
			if ($multiple_upload_service->delete_img($multiple_upload_model)) {
				if (unlink($file_to_remove)) {
					
					

					if (count($ids)>=0) {
						//set successfully message
						$result['status'] = true;

					}
				}
			}
		}
	}

	//delete gallery
	public function delete_gallery($gallery_id)
	{
		$this->load->helper('file');
		//load model
		$multiple_upload_model = new Multiple_upload_model();
		$multiple_upload_service = new Multiple_upload_service();
		$gallery_data_model = new Gallery_data_model();
		$gallery_data_service = new Gallery_data_service();

		$multiple_upload_model->setGalleryId($gallery_id);
		$gallery_data_model->setGalleryId($gallery_id);


		$get_select_gallery_data = $gallery_data_service->get_data_by_id($gallery_data_model);
		if (!empty($get_select_gallery_data)) {
			$uploadPath = 'uploads/gallery/'.$get_select_gallery_data->gallery_titel.'/';

			//start the transaction
			$this->db->trans_begin();

        	//delete gallery_data table
			$gallery_data_service->delete_data_by_id($gallery_data_model);

        	//delete gallery_img table
			$multiple_upload_service->delete_imgs_by_id($multiple_upload_model);

        	//make transaction complete
			$this->db->trans_complete();

        	//check if transaction status TRUE or FALSE
			if ($this->db->trans_status() === FALSE) {

            	//if something went wrong, rollback everything
				$this->db->trans_rollback();
				return FALSE;
			} else {
            	//if everything went right, delete the data from the database
				$this->db->trans_commit();
				if (delete_files($uploadPath, TRUE)) {
					rmdir($uploadPath);
					echo json_encode(array("status" => TRUE)); 
				}
			}

		}

	}
}

