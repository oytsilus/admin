<?php 
class Model_unit extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_unit()
	{
		$sql = "SELECT * FROM m_unit WHERE mu_flag = 1 ORDER BY mu_id ASC";
		$q = $this->db->query($sql);
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
}