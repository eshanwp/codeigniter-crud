<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Join_table extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')){
			return redirect(base_url());
		}
		$this->load->model('join_table/join_table_service');
	}

	public function index()
	{
		//page data
		$data['page_title'] = 'Join Table';
		$page_content['page_content'] ='join_table';
		$data['main_breadcrumb'] = 'Table';
		$data['sub_breadcrumb'] = 'Join Table';
		$data['page_url'] = 'join_table';
		$this->template->load('template/main_template', $page_content, $data);

	}
	public function ajax_list()
	{	
		//load model
		$join_table_service = new join_table_service();
		//get data
		$list = $this->join_table_service->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $orders) {
			$no++;
			$row = array();
			$row[] = $orders->OrderID;
			$row[] = $orders->FirstName.' '.$orders->LastName;
			$row[] = $orders->OrderDate;

			$data[] = $row;
		}

		//set data to array
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->join_table_service->count_all(),
			"recordsFiltered" => $this->join_table_service->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	
}

