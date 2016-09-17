<?php 
class Model_user extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_user()
	{
		$sql = "SELECT user_id,username,email,full_name,banned,created_at,
				CASE 
					WHEN auth_level = 9 THEN 'Admin'
					WHEN auth_level = 1 THEN 'Regular User'
					ELSE 'Other'
				END
				AS auth_level
				FROM users WHERE 1 ORDER BY username ASC";
		$q = $this->db->query($sql);
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
}