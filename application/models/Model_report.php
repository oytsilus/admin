<?php
class Model_report extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_order($to_id=0) {
		$result = array();
		if($to_id != 0) {
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
				b.tod_id,
				b.mp_id,
				b.mp_code,
				b.mp_name,
				IFNULL(b.mbp_price,0) AS mbp_price,
				IFNULL(b.msp_price,0) AS msp_price,
				b.tod_qty,
				(IFNULL(b.mbp_price,0)*b.tod_qty) AS hpp,
				(IFNULL(b.msp_price,0)*b.tod_qty) AS penjualan,
				(IFNULL(IFNULL(b.msp_price,0)-IFNULL(b.mbp_price,0),0)*b.tod_qty) AS margin,
				b.mu_name,
				b.tod_flag
			FROM
			t_order AS a
			JOIN
			(
				SELECT *
				FROM t_order_detail
				WHERE tod_flag = 1
			) AS b ON a.to_id = b.to_id
			WHERE a.to_flag = 1 AND a.to_id = $to_id
			ORDER BY a.to_date ASC";
			$q = $this->db->query($sql);

			$result['num_rows'] = $q->num_rows();
			$result['result'] = $q->result_array();
		}

		return $result;
	}

	function report_labarugi($cust_id=0,$tgl_from=NULL,$tgl_to=NULL)
	{
		$where = ($cust_id != 0 ? " AND mc_id = $cust_id" : NULL);
		$where2 = NULL;
		if($tgl_from != NULL) {
			$from = $tgl_from;
			if($tgl_to != NULL) {
				$to = $tgl_to;
				$where2 .= " AND DATE(to_date) BETWEEN '$from' AND '$to'";
			}
			else {
				$where2 .= " AND DATE(to_date) BETWEEN '$from' AND NOW()";
			}

		}

		$sql = "SELECT * FROM r_laba_rugi WHERE tod_flag = 1 $where $where2 ORDER BY to_date ASC";
		$q = $this->db->query($sql);

		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();

		return $res;
	}

	public function insert_labarugi($to_id=0) {
		// Check if record exist, refuse insert
		$select = "SELECT COUNT(*) AS jml FROM r_laba_rugi WHERE to_id = $to_id";
		$check = $this->db->query($select);

		if($check->row()->jml > 0) {
			return 'FALSE';
		}
		else {
			$sql = "INSERT INTO r_laba_rugi
			(
				to_id,
				mc_id,
				mc_name,
				mc_address,
				mc_email,
				mc_code,
				mc_phone1,
				mc_fax,
				to_no,
				to_date,
				tod_id,
				mp_id,
				mp_code,
				mp_name,
				mbp_price,
				msp_price,
				tod_qty,
				hpp,
				penjualan,
				margin,
				mu_name,
				tod_flag
			)
			SELECT
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
				b.tod_id,
				b.mp_id,
				b.mp_code,
				b.mp_name,
				IFNULL(b.mbp_price,0) AS mbp_price,
				IFNULL(b.msp_price,0) AS msp_price,
				b.tod_qty,
				(IFNULL(b.mbp_price,0)*b.tod_qty) AS hpp,
				(IFNULL(b.msp_price,0)*b.tod_qty) AS penjualan,
				(IFNULL(IFNULL(b.msp_price,0)-IFNULL(b.mbp_price,0),0)*b.tod_qty) AS margin,
				b.mu_name,
				b.tod_flag
			FROM
			t_order AS a
			JOIN
			(
				SELECT *
				FROM t_order_detail
				WHERE tod_flag = 1
			) AS b ON a.to_id = b.to_id
			WHERE a.to_id = $to_id";
			$q = $this->db->query($sql);

			// Update flag 'is_laba_rugi' on 't_order'
			$this->db->where('to_id',$to_id);
			$this->db->update('t_order',array('to_is_report_labarugi'=>1));

			$return = ($this->db->affected_rows() > 0 ? 'TRUE' : 'FALSE');
		}
		return $return;
	}

	public function update_labarugi($to_id=0) {
		$return = 'FALSE';
		if($to_id != 0) {
			// Delete record
			$this->delete_labarugi($to_id);

			// Insert record
			$this->insert_labarugi($to_id);
		}
		return $return;
	}

	public function delete_labarugi($to_id) {
		$this->db->where('to_id',$to_id);
		$this->db->delete('r_laba_rugi');

		// Update flag 'is_laba_rugi' on 't_order'
		$this->db->where('to_id',$to_id);
		$this->db->update('t_order',array('to_is_report_labarugi'=>0));
	}

}
