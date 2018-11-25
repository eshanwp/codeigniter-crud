<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_events_view extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')){
			return redirect(base_url());
		}
		$this->load->model('Calendar_events/calendar_events_model');
		$this->load->model('Calendar_events/calendar_events_service');
	}

	public function index()
	{
          //load model
		$calendar_events_model = new Calendar_events_model();
		$calendar_events_service = new Calendar_events_service();

		//page data
		$data['page_title'] = 'Calendar Event View';
		$page_content['page_content'] ='calendar_events_view';
		$data['main_breadcrumb'] = 'Calendar';
		$data['sub_breadcrumb'] = 'Calendar Events View';
		$data['page_url'] = 'calendar_events_view';
          //end page data
		$this->template->load('template/main_template', $page_content, $data);

	}
	
     //load event data
	public function get_events()
	{	
          //load model
		$calendar_events_model = new Calendar_events_model();
		$calendar_events_service = new Calendar_events_service();

     	//End Date
		$end = $this->input->get("end");

          $startdt = new DateTime('now'); // setup a local datetime
          $startdt->add(DateInterval::createFromDateString('yesterday')); //set stat date yesterday
     	$start_format = $startdt->format('Y-m-d H:i:s');

     	$enddt = new DateTime('now'); // setup a local datetime
     	$enddt->setTimestamp($end); // Set the date based on timestamp
     	$end_format = $enddt->format('Y-m-d H:i:s');


     	$calendar_events_model->setStart($start_format);
     	$calendar_events_model->setEnd($end_format);
          $events = $this->calendar_events_service->get_events_filter($calendar_events_model);

     	$data_events = array();

          //create array and set data
     	foreach($events->result() as $r) {

               //get event_options name remove color code
               $event_options = explode('-', $r->options,2);
     		$data_events[] = array(
     			"id" => $r->id,
     			"title" => $r->title,
                    "description" => $r->description,
                    "options" => end($event_options),
                    "color" => $event_options[0],
                    "event_options" => $r->options,
     			"end" => $r->end,
                    "start" => $r->start,
     			"status" => $r->status,
     		);
     	}

          //print data
     	echo json_encode(array("events" => $data_events));
     	exit();
     }

    
    
 }

