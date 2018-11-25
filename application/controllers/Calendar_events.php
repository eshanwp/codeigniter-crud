<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_events extends CI_Controller {

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
         
		//page data
		$data['page_title'] = 'Calendar Event';
		$page_content['page_content'] ='calendar_events';
		$data['main_breadcrumb'] = 'Calendar';
		$data['sub_breadcrumb'] = 'Calendar Events';
		$data['page_url'] = 'calendar_events';
          //end page data
		$this->template->load('template/main_template', $page_content, $data);

	}

     //load event data
	public function get_events()
     {
          //load model
          $calendar_events_model = new Calendar_events_model();
          $calendar_events_service = new Calendar_events_service();
         

          $events = $this->calendar_events_service->get_events();
          foreach ($events as $key =>$event) {
               $row = array();
               $row['id'] = $event->id;
               $row['title'] = $event->title;
               $row['description'] = $event->description;
               $event_option = explode('-', $event->options,2);
               $row['options'] =  end($event_option);
               $row['color'] = $event_option[0];
               $row['event_options'] = $event->options;
               $row['start'] = $event->start;
               $row['end'] = $event->end;
               $row['status'] = $event->status;
                
               $data[] = $row;
          }
          echo json_encode($data);
     }
    

     public function add_event()
     {
          $this->_eventEditing(0);

     }
     public function update_event()
     {
          $this->_eventEditing(1);

     }

     public function _eventEditing($status)
     {
          //load model
     	$calendar_events_model = new Calendar_events_model();
     	$calendar_events_service = new Calendar_events_service();

          //set validation
     	$this->form_validation->set_rules('event_name', 'Event Name', 'trim|required');
     	$this->form_validation->set_rules('description', 'Description', 'trim|required');
     	$this->form_validation->set_rules('event_options', 'Event Options', 'trim|required');
          $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
     	$this->form_validation->set_rules('end_date', 'End Date', 'trim|required|callback_time_validation');
          $this->form_validation->set_rules('event_status', 'Event Status', 'trim|required');
     	$this->form_validation->set_message('required', '{field} is Required');

          //check validation is true
     	if($this->form_validation->run() === true) {

               //send data
     		$calendar_events_model->setTitle($this->input->post('event_name'));
     		$calendar_events_model->setDescription($this->input->post('description'));
     		$calendar_events_model->setOptions($this->input->post('event_options'));
     		$calendar_events_model->setStart($this->input->post('start_date'));
               $calendar_events_model->setEnd($this->input->post('end_date'));
     		$calendar_events_model->setStatus($this->input->post('event_status'));
     		
               if ($status == 0) {
                   //check data is save
                    if ($calendar_events_service->add_event($calendar_events_model)) {

                         //set successfully message
                         $result['status'] = true;
                         $result['message'] = "Event Added Successfully.";
                    }
               }elseif ($status == 1) {
                    $event_id = $this->input->post('id');
                    if (!empty($event_id)) {
                         $calendar_events_service->update_event($calendar_events_model,$event_id);
                         $result['status'] = true;
                         $result['message'] = "Event Updated Successfully.";
                    }
               }
               
     	}else{
               //set error message form validation
     		$result['status'] = false;
     		$result['message'] = $this->form_validation->error_array();
     	}

          //print data
     	echo (json_encode($result));
          exit();
     }

     

     function time_validation(){
          


     	if (!empty($this->input->post('start_date')) && !empty($this->input->post('end_date')) ) {
               //get dagte to array
               $s_date = explode(' ',$this->input->post('start_date'));
               $e_date = explode(' ',$this->input->post('end_date'));
          

               $start_date = strtotime($s_date[0]);//get date and strtotime
               $start_time = strtotime($s_date[1]);// get time and strtotime
               $end_date = strtotime($e_date[0]); //get date and strtotime
               $end_time = strtotime($e_date[1]);//get time and strtotime
               
               if (($end_date == $start_date) && ($start_time >= $end_time)) {
                    
                    $this->form_validation->set_message('time_validation', 'Please Select Correct Event Time');
                    return false;
               }
               if (($end_date < $start_date)) {
                    
     			$this->form_validation->set_message('time_validation', 'Please Select Correct Event Time');
     			return false;
     		}

     		return true;
     	}
     }


 }

