<?php 
class Model_customer extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_customer()
	{
		$sql = "SELECT * FROM m_customer WHERE mc_flag = 1 ORDER BY mc_name ASC";
		$q = $this->db->query($sql);
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
}