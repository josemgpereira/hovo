<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('login_model');
		$this->load->model('dashboard_model');
		$this->load->model('employee_model');
		$this->load->model('leave_model');
		$this->load->model('settings_model');
		$this->load->model('project_model');
		$this->load->model('calendar_model');
	}

	public function index()
	{
		if ($this->session->userdata('user_login_access') == 1)
			redirect('dashboard/Dashboard');
		$data = array();
		$this->load->view('login');
	}

	public function Leaves()
	{
		if ($this->session->userdata('user_login_access') != False) {
			$data['result'] = $this->db->get("emp_leave")->result();
			foreach ($data['result'] as $key => $value) {
				if($value->leave_status == 'Approve'){
					$data['name'] = $this->calendar_model->nameSelectByID($value->em_id);
					$data['data'][$key]['title'] = $data['name']->first_name . ' ' . $data['name']->last_name;
					$data['data'][$key]['start'] = $value->start_date;
					$data['data'][$key]['end'] = $value->end_date;
					$data['data'][$key]['backgroundColor'] = "#00a65a";
				}else {
					$data['data'][$key]['title'] = "";
					$data['data'][$key]['start'] = "";
					$data['data'][$key]['end'] = "";
					$data['data'][$key]['backgroundColor'] = "";
				}
			}
			$this->load->view('backend/calendar', $data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}
}
