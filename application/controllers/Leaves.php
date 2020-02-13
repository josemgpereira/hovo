<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaves extends CI_Controller
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
			$adminEmEmail = $this->session->userdata('email');
			$company_email = ($this->employee_model->getEmpCompanyEmail($adminEmEmail))->company_email;
			//$data['employee'] = $this->employee_model->emselectactive(); // gets active employee details
			$data['employee'] = $this->employee_model->emselectactiveByCompanyEmail($company_email);
			$data['leavetypes'] = $this->leave_model->GetleavetypeInfo();
			//$data['application'] = $this->leave_model->AllLeaveAPPlication();
			$data['application'] = $this->leave_model->AllLeaveAPPlicationByCompanyEmail($company_email);
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
			$dep_id = $this->ferias_model->Getdepid($emid);
			$dep_id = $dep_id->dep_id;
			//$typeid = $this->input->post('typeid');
			$typeid = 0;
			$applydate = date('Y-m-d');
			$appstartdate = $this->input->post('startdate');
			$appenddate = $this->input->post('enddate');
			$type = $this->input->post('type');
			if (empty($appenddate)) {
				$appenddate = $appstartdate;
			} elseif ($type == 'Half Day' or $type == 'Full Day'){
				$appenddate = $appstartdate;
			}
			$hourAmount = $this->input->post('hourAmount');
			$reason = $this->input->post('reason');
			// $duration     = $this->input->post('duration');

			if ($type == 'Half Day') {
				$duration = $hourAmount;
			} else if ($type == 'Full Day') {
				$duration = 8;
			} else {
				//$formattedStart = new DateTime($appstartdate);
				//$formattedEnd = new DateTime($appenddate);

				//$duration = $formattedStart->diff($formattedEnd)->format("%d");
				//$duration = $duration * 8;

				$duration = $this->number_of_working_days($appstartdate,$appenddate);
				$duration = $duration * 8;
			}

			$leaveleftdays = $this->LeaveLeftDays($emid);
			$leavelefthour = $leaveleftdays * 8;

			$adminEmEmail = $this->session->userdata('email');
			$company_email = ($this->employee_model->getEmpCompanyEmail($adminEmEmail))->company_email;

			if ($leavelefthour < $duration) {
				echo "Saldo Insuficiente";
			} else {

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
					'leave_status' => 'Not Approve',
					'dep_id' => $dep_id,
					'company_email' => $company_email
				);
				if (empty($id)) {
					$employee = $this->employee_model->emselectByID($emid);
					$employee_first_name = $employee->first_name;
					$employee_last_name = $employee->last_name;
					$admins = $this->employee_model->getAllAdmins();
					foreach ($admins as $admin) {
						$admin_em_id = $admin->em_id;
						$admin_em_email = $admin->em_email;
						$admin_email_notif = $admin->email_notif;
						if($admin_email_notif == 1) $this->send_mail_new_leave($admin_em_email, $employee_first_name, $employee_last_name, $applydate, $appstartdate, $appenddate, $duration);
					}
					$employee_email = ($this->employee_model->getEmpEmail($emid))->em_email;
					$employee_notif = ($this->employee_model->getEmpEmailNotif($emid))->email_notif;
					if($employee_notif == 1) $this->send_mail_new_leave($employee_email, $employee_first_name, $employee_last_name, $applydate, $appstartdate, $appenddate, $duration);
					$success = $this->leave_model->Application_Apply($data);
					#$this->session->set_flashdata('feedback','Successfully Updated');
					#redirect("leave/Application");
					echo "Adicionado com sucesso";
				} else {
					$success = $this->leave_model->Application_Apply_Update($id, $data);
					#$this->session->set_flashdata('feedback','Successfully Updated');
					#redirect("leave/Application");
					echo "Atualizado com sucesso";
				}

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

	public function LeaveLeftDays($employeeID)
	{
		if ($this->session->userdata('user_login_access') != False) {
			$days = $this->ferias_model->Getempdays($employeeID);
			if(!empty($days)){
				$totaldays = $days->days;
			} else {
				$totaldays = 0;
			}
			return $totaldays;
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
			//$depid = $this->input->post('depid');
			$applydate = $this->input->post('applydate');
			$startdate = $this->input->post('startdate');
			$enddate = $this->input->post('enddate');
			$rejectreason = $this->input->post('rejectreason');
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters();

			$employee = $this->employee_model->emselectByID($employeeId);
			$employee_email = $employee->em_email;
			$employee_first_name = $employee->first_name;
			$employee_last_name = $employee->last_name;
			$employee_notif = $employee->email_notif;

			$depid = $employee->dep_id;

			if ($value == 'Approve') {
				$numempleave = $this->ferias_model->GetNumEmpLeave($startdate,$enddate,$depid);
				$numempleave = $numempleave->numempleave;
				$numempdep = $this->ferias_model->GetNumEmpDep($depid);
				$numempdep = $numempdep->numempdep;
				$minempdep = $this->ferias_model->GetMinEmpDep($depid);
				$minempdep = $minempdep->min_emp;

				if(($numempdep) <= $minempdep){
					exit("Mínimo de funcionários insuficiente");
				}

				if(($numempdep - $numempleave) <= $minempdep){
					exit("Dias já reservados");
				}
			}

			$data = array();
			$data = array('leave_status' => $value, 'reject_reason' => $rejectreason);

			$leaveleftdays = $this->LeaveLeftDays($employeeId);
			$leavelefthour = $leaveleftdays * 8;

			if ($value == 'Approve' && ($leavelefthour < $duration)) {
				echo "Saldo Insuficiente";
			} else {
				$success = $this->leave_model->updateAplicationAsResolved($id, $data);
				if($employee_notif == 1) $this->send_mail_leave_status($employee_email, $employee_first_name, $employee_last_name, $value, $applydate, $startdate, $enddate, $duration, $rejectreason);
				if ($value == 'Approve') {
					$dias = $this->ferias_model->Getempdays($employeeId);
					$dias = $dias->days;
					$duracao = $duration;
					$duracao = $dias - ($duracao / 8);
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
						echo "Atualizado com sucesso";
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
						echo "Atualizado com sucesso";
					}
				} else {
					echo "Atualizado com sucesso";
				}
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

	public function number_of_working_days($from, $to) {
		$workingDays = array(1,2,3,4,5);
		$holidayDays = array(
			'*-01-01', '*-04-25', '*-05-01', '*-06-10', '*-08-15', '*-10-05', '*-11-01', '*-12-01', '*-12-08', '*-12-25',
			'2020-04-10', '2020-04-12', '2020-06-11',
			'2021-04-02', '2021-04-04', '2021-06-03',
			'2022-04-15', '2022-04-17', '2022-06-16',
			'2023-04-07', '2023-04-09', '2023-06-08',
			'2024-03-29', '2024-03-31', '2024-05-30',
			'2025-04-18', '2025-04-20', '2025-06-19',
			'2026-04-03', '2026-04-05', '2026-06-04',
			'2027-03-26', '2027-03-28', '2027-05-27',
			'2028-04-14', '2028-04-16', '2028-06-15',
			'2029-03-30', '2029-04-01', '2029-05-31',
			'2030-04-19', '2030-04-21', '2030-06-20'

		);
		$from = new DateTime($from);
		$to = new DateTime($to);
		$to->modify('+1 day');
		$interval = new DateInterval('P1D');
		$periods = new DatePeriod($from, $interval, $to);

		$days = 0;
		foreach ($periods as $period) {
			if (!in_array($period->format('N'), $workingDays)) continue;
			if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
			if (in_array($period->format('*-m-d'), $holidayDays)) continue;
			$days++;
		}
		return $days;
	}

	public function emphistoric()
	{
		if ($this->session->userdata('user_login_access') != False) {
			$emid = $this->session->userdata('user_login_id');
			$data['employee'] = $this->employee_model->emselectByID($emid);
			$data['leavetypes'] = $this->leave_model->GetleavetypeInfo();
			$data['application'] = $this->leave_model->GetallApplication($emid);
			$this->load->view('backend/employee_historic', $data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}

	public function historic()
	{
		if ($this->session->userdata('user_login_access') != False) {
			$adminEmEmail = $this->session->userdata('email');
			$company_email = ($this->employee_model->getEmpCompanyEmail($adminEmEmail))->company_email;
			$data['employee'] = $this->employee_model->emselectactive(); // gets active employee details
			$data['leavetypes'] = $this->leave_model->GetleavetypeInfo();
			$data['application'] = $this->leave_model->allLeaveAplicationHistoric($company_email);
			$this->load->view('backend/historic', $data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}

	public function send_mail_leave_status($email,$first_name,$last_name,$status,$applydate,$startdate,$enddate,$duration,$rejectreason) {
		$this->load->config('email');
		$this->load->library('email');

		$from = $this->config->item('smtp_user');
		$to = $email;
		$subject = 'Aprovação de Férias';
		$data = array('email'=>$email, 'first_name'=>$first_name, 'last_name'=>$last_name, 'status'=>$status, 'applydate'=>$applydate, 'startdate'=>$startdate, 'enddate'=>$enddate, 'duration'=>$duration, 'rejectreason'=>$rejectreason);
		$message = $this->load->view('backend/email_leaves_approve_template.php',$data,TRUE);

		$this->email->set_newline("\r\n");
		$this->email->from($from, 'HolyManager');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()) {
			$this->session->set_flashdata('feedback','E-mail enviado com sucesso.');
		} else {
			//show_error($this->email->print_debugger());
			$this->session->set_flashdata("feedback","E-mail não enviado com sucesso.");
		}
	}

	public function send_mail_new_leave($email,$first_name,$last_name,$applydate,$startdate,$enddate,$duration) {
		$this->load->config('email');
		$this->load->library('email');

		$from = $this->config->item('smtp_user');
		$to = $email;
		$subject = 'Requisição de Férias';
		$data = array('first_name'=>$first_name, 'last_name'=>$last_name, 'applydate'=>$applydate, 'startdate'=>$startdate, 'enddate'=>$enddate, 'duration'=>$duration);
		$message = $this->load->view('backend/email_new_leave_template.php',$data,TRUE);

		$this->email->set_newline("\r\n");
		$this->email->from($from, 'HolyManager');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()) {
			$this->session->set_flashdata('feedback','E-mail enviado com sucesso.');
		} else {
			//show_error($this->email->print_debugger());
			$this->session->set_flashdata("feedback","E-mail não enviado com sucesso.");
		}
	}
}
