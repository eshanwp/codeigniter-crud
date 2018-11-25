<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// Creating Custom Library in Codeigniter
class My_file_upload {
 
    function __construct()
    {
       	$this->ci =& get_instance();
        $this->ci->load->library('upload');
    }

    public function multiple_upload($img_name,$uploadPath,$exists_img_data = null,$files,$upload_type =null,$use_external_uploader =null)
	{

		//config file upload
		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '2000000';
		$config['remove_spaces'] = true;
		$config['overwrite'] = true;

		$this->ci->load->library('upload', $config);

		$images = array();
		if ($use_external_uploader =='no') {
			$count = count($files['name']);
		}else{
			$count = count($files['name'])-1;
		}
		
		

		if (!is_null($exists_img_data)) {
			$row = array();
			foreach ($exists_img_data as $key =>$exists_img_name) {
				$row[] = $exists_img_name->file_name;
			}
			$exists_img_count = implode(',', $row);
		}

		
		if (!empty($exists_img_count)) {
			$exists_img_count = substr($exists_img_count, strrpos($exists_img_count, '-') + 1);
			$exists_img_count = explode('.',$exists_img_count);
			$exists_img_count = current($exists_img_count) +1;
		}else{
			$exists_img_count = 1;
		}

		//upload file
		for($key=0; $key<$count; $key++){
			$_FILES['images[]']['name']= $files['name'][$key];
			$_FILES['images[]']['type']= $files['type'][$key];
			$_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
			$_FILES['images[]']['error']= $files['error'][$key];
			$_FILES['images[]']['size']= $files['size'][$key];

			$tmp = explode('.', $files['name'][$key]);
			$file_extension[] = end($tmp);
			if ($upload_type == 's') {
				$fileName = $img_name.".".$file_extension[$key];
			
			}else{
				$fileName = $img_name."-".(str_pad($key+$exists_img_count, 3, '0', STR_PAD_LEFT)).".".$file_extension[$key];
			
			}
			$images[] = $fileName;

			$config['file_name'] = $fileName;

			$this->ci->upload->initialize($config);

			if ($this->ci->upload->do_upload('images[]')) {
				$this->ci->upload->data();
			} else {
				return false;
			}
		}

		return $images;
	}

 	public function rename_file($img_name,$new_img_name = "",$uploadPath)
	{
		
		$appendedFiles = array();
		$uploadsFiles = array_diff(scandir($uploadPath), array('.', '..'));
		$input = preg_quote($img_name, '~');
		$uploadsFiles = preg_grep('~' . $input . '~', $uploadsFiles);

		$i=1;
		$i = str_pad($i, 3, '0', STR_PAD_LEFT);
		foreach($uploadsFiles as $key => $file) {
			if(is_dir($file))
				continue;


			$get_type_ar = explode('.', $file);
			$get_type = end($get_type_ar);
			if ($get_type=='jpg') {
				$newName = $new_img_name.'-'.$i . '.jpg';
			}elseif ($get_type=='png') {
				$newName = $new_img_name.'-'.$i . '.png';
			}


			$upload_img[] =$newName;
			if (rename($uploadPath.$file, $uploadPath.$newName)) {
				
			}else {
				return false;
			}
			
			$i++;
			$i = str_pad($i, 3, '0', STR_PAD_LEFT);

			

		}

		return $upload_img;
	}

}