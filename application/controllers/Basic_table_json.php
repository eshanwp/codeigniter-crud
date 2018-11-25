<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basic_table_json extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')){
			return redirect(base_url());
		}
		$this->load->model('Basic_table_json/basic_table_json_service');
	}

	public function index()
	{
		//page data
		$data['page_title'] = 'Basic Table JSON';
		$page_content['page_content'] ='basic_table_json';
		$data['main_breadcrumb'] = 'Table';
		$data['sub_breadcrumb'] = 'Basic Table JSON';
		$data['page_url'] = 'basic_table_json';
		$this->template->load('template/main_template', $page_content, $data);

	}
	public function ajax_list()
	{	
		//load model
		$basic_table_json_service = new Basic_table_json_service();
		//get data
		$list =$this->basic_table_json_service->get_datatables();
		$no =0;
		foreach ($list as $key =>$customers) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $customers->FirstName;
			$row[] = $customers->LastName;
			$row[] = $customers->phone;
			$row[] = $customers->address;
			$row[] = $customers->city;
			$row[] = $customers->country;

			$data[] = $row;
		}
		//set column name
		$columns[0]['title'] = 'No';
		$columns[1]['title'] = 'First Name';
		$columns[2]['title'] = 'Last Name';
		$columns[3]['title'] = 'Phone';
		$columns[4]['title'] = 'Address';
		$columns[5]['title'] = 'City';
		$columns[6]['title'] = 'Country';

		//set data to array
		$output = array(
			
			"columns" => $columns,
			"data" => $data,
			
		);
		//output to json format
		echo json_encode($output);
		
	}
	
}

