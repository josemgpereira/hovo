<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ferias extends CI_Controller
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
		$this->load->model('ferias_model');
	}

	public function index()
	{
		#Redirect to Admin dashboard after authentication
		if ($this->session->userdata('user_login_access') == 1)
			redirect('dashboard/Dashboard');
		$data = array();
		#$data['settingsvalue'] = $this->dashboard_model->GetSettingsValue();
		$this->load->view('login');
	}


	public function Application()
	{
		if ($this->session->userdata('user_login_access') != False) {

			$data['employee'] = $this->employee_model->emselectactive(); // gets active employee details
			$data['leavetypes'] = $this->leave_model->GetleavetypeInfo();
			$data['application'] = $this->leave_model->AllLeaveAPPlication();
			$this->load->view('backend/ferias_approve', $data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}

	public function EmApplication()
	{
		if ($this->session->userdata('user_login_access') != False) {
			$emid = $this->session->userdata('user_login_id');
			$data['employee'] = $this->employee_model->emselectByID($emid);
			$data['leavetypes'] = $this->leave_model->GetleavetypeInfo();
			$data['application'] = $this->leave_model->GetallApplication($emid);
			$this->load->view('backend/ferias_apply', $data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}

	public function Add_Applications()
	{
		if ($this->session->userdata('user_login_access') != False) {
			$id = $this->input->post('id');
			$emid = $this->input->post('emid');
			//$typeid = $this->input->post('typeid');
			$typeid = 0;
			$applydate = date('Y-m-d');
			$appstartdate = $this->input->post('startdate');
			$appenddate = $this->input->post('enddate');
			if (empty($appenddate)) {
				$appenddate = $appstartdate;
			}
			$hourAmount = $this->input->post('hourAmount');
			$reason = $this->input->post('reason');
			$type = $this->input->post('type');
			// $duration     = $this->input->post('duration');

			if ($type == 'Half Day') {
				$duration = $hourAmount;
			} else if ($type == 'Full Day') {
				$duration = 8;
			} else {
				$formattedStart = new DateTime($appstartdate);
				$formattedEnd = new DateTime($appenddate);

				$duration = $formattedStart->diff($formattedEnd)->format("%d");
				$duration = $duration * 8;
			}

			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters();
			$this->form_validation->set_rules('startdate', 'Start Date', 'trim|required|xss_clean');
			if ($this->form_validation->run() == FALSE) {
				echo validation_errors();
				#redirect("employee/view?I=" .base64_encode($eid));
			} else {
				$data = array();
				$data = array(
					'em_id' => $emid,
					'typeid' => $typeid,
					'apply_date' => $applydate,
					'start_date' => $appstartdate,
					'end_date' => $appenddate,
					'reason' => $reason,
					'leave_type' => $type,
					'leave_duration' => $duration,
					'leave_status' => 'Not Approve'
				);
				if (empty($id)) {
					$success = $this->leave_model->Application_Apply($data);
					#$this->session->set_flashdata('feedback','Successfully Updated');
					#redirect("leave/Application");
					echo "Successfully Added";
				} else {
					$success = $this->leave_model->Application_Apply_Update($id, $data);
					#$this->session->set_flashdata('feedback','Successfully Updated');
					#redirect("leave/Application");
					echo "Successfully Updated";
				}

			}
		} else {
			redirect(base_url(), 'refresh');
		}
	}

	public function LeaveAssign()
	{
		if ($this->session->userdata('user_login_access') != False) {
			$employeeID = $this->input->get('employeeID');
			$days = $this->ferias_model->Getempdays($employeeID);
			if(!empty($days)){
				$totaldays = 'Saldo: ' . $days->days . ' dias';
			} else {
				$totaldays = 'Saldo: 0 dias';
			}
			echo $totaldays;
		} else {
			redirect(base_url(), 'refresh');
		}
	}

	public function GetemployeeGmLeave()
	{
		$year = $this->input->get('year');
		$id = $this->input->get('typeid');
		$emid = $this->input->get('emid');
		$assignleave = $this->leave_model->GetemassignLeaveType($emid, $id, $year);
		$totaldays = 0;
		foreach ($assignleave as $value) {
			$totaldays = $totaldays + $value->day;
		}
		$day = $totaldays;
		$leavetypes = $this->leave_model->GetleavetypeInfoid($id);
		$totalday = $day . '/' . $leavetypes->leave_day;
		echo $totalday;
	}

	public function approveLeaveStatus()
	{
		if ($this->session->userdata('user_login_access') != False) {
			$employeeId = $this->input->post('employeeId');
			$id = $this->input->post('lid');
			$value = $this->input->post('lvalue');
			$duration = $this->input->post('duration');
			$type = $this->input->post('type');
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters();

			$data = array();
			$data = array(
				'leave_status' => $value
			);
			$success = $this->leave_model->updateAplicationAsResolved($id, $data);
			if ($value == 'Approve') {
				$dias = $this->ferias_model->Getempdays($employeeId);
				$dias = $dias->days;
				$duracao = $duration;
				$duracao = $dias-($duracao/8);
				$data = array();
				$data = array(
					'days' => $duracao
				);

				$success = $this->ferias_model->UpdateLeaves($employeeId, $data);

				$determineIfNew = $this->leave_model->determineIfNewLeaveAssign($employeeId, $type);
				//How much taken
				$totalHour = $this->leave_model->getLeaveTypeTotal($employeeId, $type);
				//If already taken some
				if ($determineIfNew > 0) {
					$total = $totalHour[0]->totalTaken + $duration;
					$data = array();
					$data = array(
						'hour' => $total
					);
					$success = $this->leave_model->updateLeaveAssignedInfo($employeeId, $type, $data);
					$earnval = $this->leave_model->emEarnselectByLeave($employeeId);
					if (!empty($earnval)) {
						$data = array();
						$data = array(
							'present_date' => $earnval->present_date - ($duration / 8),
							'hour' => $earnval->hour - $duration
						);
						$success = $this->leave_model->UpdteEarnValue($employeeId, $data);
					}
					echo "Updated successfully";
				} else {
					//If not taken yet
					$data = array();
					$data = array(
						'emp_id' => $employeeId,
						'type_id' => $type,
						'hour' => $duration,
						'dateyear' => date('Y')
					);
					$success = $this->leave_model->insertLeaveAssignedInfo($data);
					echo "Updated successfully";
				}
			} else {
				echo "Updated successfully";
			}
		}
	}

	public function LeaveAppbyid()
	{
		if ($this->session->userdata('user_login_access') != False) {
			$id = $this->input->get('id');
			$emid = $this->input->get('emid');
			$data['leaveapplyvalue'] = $this->leave_model->GetLeaveApply($id);
			/*$leaveapplyvalue = $this->leave_model->GetEmLeaveApply($emid);*/
			echo json_encode($data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}
}
