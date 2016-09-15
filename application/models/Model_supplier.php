<?php 
class Model_supplier extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_supplier()
	{
		$sql = "SELECT * FROM m_supplier WHERE ms_flag = 1 ORDER BY ms_name ASC";
		$q = $this->db->query($sql);
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
}