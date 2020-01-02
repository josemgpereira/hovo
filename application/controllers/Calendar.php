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
			$data['result'] = $this->db->get("events")->result();
			foreach ($data['result'] as $key => $value) {
				$data['data'][$key]['title'] = $value->title;
				$data['data'][$key]['start'] = $value->start_date;
				$data['data'][$key]['end'] = $value->end_date;
				$data['data'][$key]['backgroundColor'] = "#00a65a";
			}
			$this->load->view('backend/calendar', $data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}
}
