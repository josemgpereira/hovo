<?php

	class Ferias_model extends CI_Model {


	function __consturct(){
	parent::__construct();
	
	}

	public function Getempdays($emp_id){
		$sql = "SELECT `days` FROM `leaves` WHERE `leaves`.`emp_id`='$emp_id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
		}

	public function Application_Apply($data){
		$this->db->insert('emp_leave',$data);
	}

	public function Application_Apply_Update($id, $data){
		$this->db->where('id', $id);
		$this->db->update('emp_leave', $data);
	}

	public function UpdateLeaves($emp_id,$data){
		$this->db->where('emp_id', $emp_id);
		$this->db->update('leaves', $data);
	}

	public function Getdepid($em_id){
		$sql = "SELECT `dep_id` FROM `employee` WHERE `employee`.`em_id`='$em_id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

	public function GetNumEmpLeave($start_date,$end_date,$dep_id){
		$sql = "SELECT COUNT(em_id) AS numempleave FROM emp_leave WHERE start_date<='$start_date' and end_date >='$end_date' and dep_id='$dep_id' and leave_status='Approve'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

	public function GetNumEmpDep($dep_id){
		$sql = "SELECT COUNT(em_id) AS numempdep FROM employee WHERE dep_id='$dep_id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

	public function GetMinEmpDep($dep_id){
		$sql = "SELECT min_emp FROM department WHERE id='$dep_id'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
		}

    }
?>    
