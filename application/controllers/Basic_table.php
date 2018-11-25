<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basic_table extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')){
			return redirect(base_url());
		}
		$this->load->model('Basic_table/basic_table_service');
	}

	public function index()
	{
		//page data
		$data['page_title'] = 'Basic Table';
		$page_content['page_content'] ='basic_table';
		$data['main_breadcrumb'] = 'Table';
		$data['sub_breadcrumb'] = 'Basic Table';
		$data['page_url'] = 'basic_table';
		$this->template->load('template/main_template', $page_content, $data);

	}
	public function ajax_list()
	{	
		//load model
		$basic_table_service = new Basic_table_service();
		//get data
		$list = $this->basic_table_service->get_datatables();
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
			"recordsTotal" => $this->basic_table_service->count_all(),
			"recordsFiltered" => $this->basic_table_service->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	
}

