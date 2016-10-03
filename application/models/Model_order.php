<?php
class Model_order extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_order($o_no=NULL)
	{
		$where = ($o_no != NULL ? " AND tp_no = '".$o_no."'" : NULL);
		$sql = "SELECT * FROM t_order WHERE to_flag = 1 $where ORDER BY to_datetime_input DESC, to_date DESC";
		$q = $this->db->query($sql);

		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();

		return $res;
	}

	function get_detail_order($o_id=0) {
		if($o_id != 0) {
			$sql = "SELECT a.*, IFNULL(b.jml_terima,0) AS jml_terima, IFNULL(a.tod_qty*a.msp_price,0) AS total_harga
					FROM t_order_detail AS a
					LEFT JOIN
					(
						SELECT tdd_id, to_id, tod_id, SUM(IFNULL(tdd_qty,0)) AS jml_terima
						FROM t_delivery_detail
						WHERE tdd_flag = 1 AND tdd_qty > 0
						GROUP BY to_id, mp_id
					)AS b
					ON a.tod_id = b.tod_id
					WHERE a.tod_flag = 1
					AND a.to_id = $o_id AND CAST(a.tod_qty AS CHAR) > 0
					ORDER BY a.mp_name ASC";

			$q = $this->db->query($sql);

			$res['num_rows'] = $q->num_rows();
			$res['result'] = $q->result_array();

			return $res;
		}
	}

	function get_price_history($id=0,$sup_id=0) {
		$where = ($sup_id != 0 ? "AND ms_id = $sup_id" : NULL);
		$sql = "SELECT * FROM m_price WHERE mbp_flag = 1 AND mp_id = $id $where ORDER BY mbp_datetime DESC";
		$q = $this->db->query($sql);

		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();

		return $res;
	}

	/**
	* Get latest price
	**/
	function get_price($arr_mp_id=array())
	{
		$this->load->library('string');

		// AND mp_id NOT IN(mp_id)
		$where2 = $where2a = NULL;
		if(!empty($arr_mp_id) && $arr_mp_id != NULL) {
			$where2 = " AND mp_id".$this->string->arrayToWhereNotIn($arr_mp_id);
			$where2a = " AND a.mp_id".$this->string->arrayToWhereNotIn($arr_mp_id);
		}

		$sql = "SELECT x.*, y.mbp_id, y.ms_id, y.mbp_datetime, y.ms_code, y.ms_name, y.mbp_buy_price, y.mbp_sell_price, y.mbp_sell_price2, y.mbp_sell_price3, y.mbp_disc, y.mbp_disc_nominal, y.mbp_flag
				FROM
				(
					SELECT *
					FROM m_product
					WHERE mp_flag = 1
					ORDER BY mp_category DESC, mp_name ASC
				) AS x
				JOIN
				(
					SELECT a.*
					FROM m_price AS a
					INNER JOIN
					(
						SELECT mbp_id, mp_id, MAX(mbp_datetime) AS maks
						FROM m_price
						WHERE mbp_flag = 1 AND mbp_datetime <= NOW()
						$where2
						GROUP BY mp_id
					) AS q
					ON a.mp_id = q.mp_id AND a.mbp_datetime = q.maks
					$where2a
				) AS y
				ON x.mp_id = y.mp_id";
		$q = $this->db->query($sql);

		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();

		return $res;
	}

	function get_order_status($order_id) {
		$sql = "SELECT SUM(IFNULL(a.tod_qty,0)) AS jml_pesan, SUM(IFNULL(b.jml_terima,0)) AS jml_terima
				FROM t_order_detail AS a
				LEFT JOIN
				(
					SELECT tod_id, to_id, SUM(IFNULL(tdd_qty,0)) AS jml_terima
					FROM t_delivery_detail
					WHERE tdd_flag = 1
					GROUP BY to_id, mp_id
				)AS b
				ON a.tod_id = b.tod_id
				WHERE a.tod_flag = 1
				AND a.to_id = $order_id
				ORDER BY a.mp_name ASC";

		$q = $this->db->query($sql)->row_array();
		$return['jml_pesan'] = $q['jml_pesan'];
		$return['jml_terima'] = $q['jml_terima'];
		$return['full_delivery_date'] = NULL;

		if(floatval($q['jml_terima']) <= 0) {
			$return['status'] = 'OPEN';
		}
		else {
			if(floatval($q['jml_pesan']) > floatval($q['jml_terima'])) {
				$return['status'] = 'OPEN';
			}
			else {
				$return['status'] = 'CLOSED';
				$return['full_delivery_date'] = date('Y-m-d');
			}
		}

		return $return;
	}

	function get_po_payment_status($po_id=0) {
		$sql ="SELECT a.tp_id, a.tp_total,IFNULL(b.jml_bayar,0) AS jml_bayar, IF(a.tp_total = IFNULL(b.jml_bayar,0),'LUNAS','OPEN') AS status_bayar
				FROM t_purchase AS a
				LEFT JOIN
				(
					SELECT tp_id, tp_total, SUM(tpid_payment_amount) AS jml_bayar
					FROM t_purchase_payment_detail
					WHERE tpid_flag = 1
					GROUP BY tp_id
				) AS b
				ON a.tp_id = b.tp_id
				WHERE a.tp_flag = 1 AND a.tp_id = $po_id";
		$q = $this->db->query($sql)->row_array();
		$return['tp_total'] = $q['tp_total'];
		$return['jml_bayar'] = $q['jml_bayar'];
		$return['status'] = $q['status_bayar'];
		$return['tp_paid_date'] = ($q['status_bayar'] == 'LUNAS' ? date('Y-m-d') : NULL);

		return $return;
	}

	function get_order_payment_status($order_id=0) {
		$sql ="SELECT a.to_id, a.to_total,IFNULL(b.jml_bayar,0) AS jml_bayar, IF(a.to_total = IFNULL(b.jml_bayar,0),'LUNAS','OPEN') AS status_bayar
				FROM t_order AS a
				LEFT JOIN
				(
					SELECT to_id, to_total, SUM(topd_payment_amount) AS jml_bayar
					FROM t_order_payment_detail
					WHERE topd_flag = 1
					GROUP BY to_id
				) AS b
				ON a.to_id = b.to_id
				WHERE a.to_flag = 1 AND a.to_id = $order_id";
		$q = $this->db->query($sql)->row_array();
		$return['to_total'] = $q['to_total'];
		$return['jml_bayar'] = $q['jml_bayar'];
		$return['status'] = $q['status_bayar'];
		$return['to_paid_date'] = ($q['status_bayar'] == 'LUNAS' ? date('Y-m-d') : NULL);

		return $return;
	}
}
