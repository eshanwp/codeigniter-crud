<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_events_service extends CI_Model {

	
	
	
	Public function get_events()
	{
		
		$this->db->select('*');
		$query = $this->db->get('calendar_events');
        return $query->result();
	}

	public function get_events_filter($calendar_events_model)
	{
		$start = $calendar_events_model->getStart();
		$end = $calendar_events_model->getEnd();
		return $this->db->where("start >=", $start)->where("end <=", $end)->where("status",1)->get("calendar_events");

		
	}
	public function update_event($calendar_events_model,$event_id)
	{
		$data = array(
			'title' => $calendar_events_model->getTitle(), 
			'description' => $calendar_events_model->getDescription(), 
			'options' => $calendar_events_model->getOptions(), 
			'start' => $calendar_events_model->getStart(), 
			'end' => $calendar_events_model->getEnd(),
			'status' => $calendar_events_model->getStatus(),
		);

		$this->db->where('id', $event_id);
        $this->db->update('calendar_events', $data);
		return true;

		
	}

}

