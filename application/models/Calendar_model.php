<?php

class Calendar_model extends CI_Model
{


	function __consturct()
	{
		parent::__construct();

	}

	public function nameSelectByID($emid)
	{
		$sql = "SELECT first_name, last_name FROM `employee` WHERE `em_id`='$emid'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}
}

?>
