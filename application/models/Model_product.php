<?php 
class Model_product extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_product()
	{
		$sql = "SELECT * FROM m_product WHERE mp_flag = 1 ORDER BY mp_category DESC, mp_name ASC";
		$q = $this->db->query($sql);
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
}