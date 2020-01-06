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

    }
?>    
