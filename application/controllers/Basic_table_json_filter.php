<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basic_table_json_filter extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')){
			return redirect(base_url());
		}
		$this->load->model('Basic_table_json_filter/basic_table_json_filter_service');
	}

	public function index()
	{
		//load model
		$basic_table_json_filter_service = new Basic_table_json_filter_service();
		//page data
		$data['page_title'] = 'Basic Table JSON Custom Filter';
		$page_content['page_content'] ='basic_table_json_filter';
		$data['main_breadcrumb'] = 'Table';
		$data['sub_breadcrumb'] = 'Basic Table JSON Custom Filter';
		$data['page_url'] = 'basic_table_json_filter';

		//get country data
		$countries = $this->basic_table_json_filter_service->get_list_countries();

		//set country list
		$opt = array('' => 'All Country');
		foreach ($countries as $country) {
			$opt[$country] = $country;
		}

		$data['form_country'] = form_dropdown('',$opt,'','id="country" class="form-control"');

		$this->template->load('template/main_template', $page_content, $data);

	}
	public function ajax_list()
	{
		//load model
		$basic_table_json_filter_service = new Basic_table_json_filter_service();
		//post data
		$country = $this->input->post('country');
		$FirstName = $this->input->post('FirstName');
		$LastName = $this->input->post('LastName');

		//get data
		$list =$this->basic_table_json_filter_service->get_datatables($country,$FirstName,$LastName);
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

