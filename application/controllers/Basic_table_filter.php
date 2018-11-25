<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basic_table_filter extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')){
			return redirect(base_url());
		}
		$this->load->model('Basic_table_filter/basic_table_filter_service');
	}

	public function index()
	{	
		//load model
		$basic_table_filter_service = new basic_table_filter_service();
		//page data
		$data['page_title'] = 'Basic Table Custom Filter';
		$page_content['page_content'] ='basic_table_filter';
		$data['main_breadcrumb'] = 'Table';
		$data['sub_breadcrumb'] = 'Basic Table Custom Filter';
		$data['page_url'] = 'basic_table_filter';

		//get country data
		$countries = $this->basic_table_filter_service->get_list_countries();

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
		$basic_table_filter_service = new basic_table_filter_service();

		//get data
		$list = $this->basic_table_filter_service->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customers) {
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

		//set data to array
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->basic_table_filter_service->count_all(),
			"recordsFiltered" => $this->basic_table_filter_service->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	
}

