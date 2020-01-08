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

			if (empty($data['result'])){
				$data['data'][0]['title'] = "";
				$data['data'][0]['start'] = "";
				$data['data'][0]['end'] = "";
				$data['data'][0]['backgroundColor'] = "";
			}

			foreach ($data['result'] as $key => $value) {
				if($value->leave_status == 'Approve'){
					$data['name'] = $this->calendar_model->nameSelectByID($value->em_id);
					$data['data'][$key]['title'] = $data['name']->first_name . ' ' . $data['name']->last_name;
					$data['data'][$key]['start'] = $value->start_date;
					$end_date = new DateTime($value->end_date);
					$end_date->modify('+1 day');
					$end_date = $end_date->format('Y-m-d');
					$data['data'][$key]['end'] = $end_date;
					//$data['data'][$key]['end'] = ($value->end_date)->modify('+1 day');
					#$data['data'][$key]['backgroundColor'] = "#00a65a";
					$data['data'][$key]['backgroundColor'] = $this->rand_color();
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

	public function rand_color() {
		return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
	}
}
