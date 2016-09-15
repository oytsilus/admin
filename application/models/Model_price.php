<?php 
class Model_price extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_price($sup_id=0)
	{
		$where = ($sup_id != 0 ? " AND ms_id = $sup_id" : NULL);
		$sql = "SELECT x.*, y.mbp_id, y.ms_id, y.mbp_datetime, y.ms_code, y.ms_name, y.mbp_buy_price, y.mbp_sell_price, y.mbp_sell_price2, y.mbp_sell_price3, y.mbp_disc, y.mbp_disc_nominal, y.mbp_flag
				FROM
				(
					SELECT *
					FROM m_product
					WHERE mp_flag = 1
					ORDER BY mp_category DESC, mp_name ASC
				) AS x
				LEFT JOIN
				(
					SELECT a.*
					FROM m_price AS a
					INNER JOIN 
					(
						SELECT mbp_id, mp_id, MAX(mbp_datetime) AS maks
						FROM m_price
						WHERE mbp_flag = 1 AND mbp_datetime <= NOW()
						$where
						GROUP BY mp_id,ms_id
					) AS q
					ON a.mp_id = q.mp_id AND a.mbp_datetime = q.maks
					$where
				) AS y
				ON x.mp_id = y.mp_id";
		$q = $this->db->query($sql);
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
	
	function get_price_history($id=0,$sup_id=0) {
		$where = ($sup_id != 0 ? "AND ms_id = $sup_id" : NULL);
		$sql = "SELECT * FROM m_price WHERE mbp_flag = 1 AND mp_id = $id $where ORDER BY mbp_datetime DESC";
		$q = $this->db->query($sql);
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
}