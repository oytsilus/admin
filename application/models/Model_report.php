<?php
class Model_report extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function report_labarugi($cust_id=0,$tgl_from=NULL,$tgl_to=NULL)
	{
		$where = ($cust_id != 0 ? " AND a.mc_id = $cust_id" : NULL);
		$where2 = NULL;
		if($tgl_from != NULL) {
			$from = $tgl_from;
			if($tgl_to != NULL) {
				$to = $tgl_to;
				$where2 .= " AND DATE(a.to_date) BETWEEN '$from' AND '$to'";
			}
			else {
				$where2 .= " AND DATE(a.to_date) BETWEEN '$from' AND NOW()";
			}

		}

		$sql = "SELECT
			a.to_id,
			a.mc_id,
			a.mc_name,
			a.mc_address,
			a.mc_email,
			a.mc_code,
			a.mc_phone1,
			a.mc_fax,
			a.to_no,
			a.to_date,
			b.mp_id,
			b.mp_code,
			b.mp_name,
			IFNULL(b.mbp_price,0) AS mbp_price,
			IFNULL(b.msp_price,0) AS msp_price,
			b.tod_qty,
			(IFNULL(b.mbp_price,0)*b.tod_qty) AS hpp,
			(IFNULL(b.msp_price,0)*b.tod_qty) AS penjualan,
			(IFNULL(IFNULL(b.msp_price,0)-IFNULL(b.mbp_price,0),0)*b.tod_qty) AS margin,
			b.mu_name
		FROM
		t_order AS a
		JOIN
		(
			SELECT *
			FROM t_order_detail
			WHERE tod_flag = 1
		) AS b ON a.to_id = b.to_id
		WHERE a.to_flag = 1 $where $where2
		ORDER BY a.to_date ASC";
		$q = $this->db->query($sql);

		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();

		return $res;
	}
}
