<?php 
class Model_purchase_payment extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_payment($form_no=NULL,$tpi_id=0)
	{
		$where = ($form_no != NULL ? " AND a.tpi_no = '".$form_no."'" : NULL);
		$where2 = ($tpi_id != 0 ? " AND a.tpi_id = $tpi_id" : NULL);
		$sql = "SELECT a.*,b.total_tagihan,b.total_bayar,IF(b.total_tagihan > b.total_bayar, 'OPEN', 'LUNAS') AS 	status_pembayaran,(b.total_tagihan-b.total_bayar) AS hutang_bayar
				FROM t_purchase_payment AS a
				JOIN(
					SELECT tpid_id, tpi_id, tpid_flag, SUM(tp_total) AS total_tagihan, SUM(tpid_payment_amount) AS total_bayar
					FROM t_purchase_payment_detail 
					WHERE tpid_flag = 1
					GROUP BY tpi_id
				)AS b ON b.tpi_id = a.tpi_id
				WHERE a.tpi_flag = 1
				$where $where2
				GROUP BY a.tpi_id
				ORDER BY a.tpi_datetime_input DESC, a.tpi_date DESC";
		$q = $this->db->query($sql);
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		$res['row_array'] = $q->row_array();
		
		return $res;
	}
	
	/**
	* Get latest price
	**/
	function get_price($sup_id=0,$arr_mp_id=array())
	{
		$this->load->library('string');
		
		$where = ($sup_id != 0 ? " AND ms_id = $sup_id" : NULL);
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
						$where $where
						GROUP BY mp_id,ms_id
					) AS q
					ON a.mp_id = q.mp_id AND a.mbp_datetime = q.maks
					$where $where2a
				) AS y
				ON x.mp_id = y.mp_id";
		$q = $this->db->query($sql);
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
	
	function get_po($sup_id=0,$po_id=array(),$status_not='LUNAS',$sign='IN')
	{
		$this->load->library('string');
		
		// AND tp_id IN(po_id)
		$where2 = NULL;
		if(!empty($po_id) && $po_id != NULL) {
			if($sign == 'IN') {
				$where2 = " AND q.tp_id".$this->string->arrayToWhereIn($po_id);
			}
			else {
				$where2 = " AND q.tp_id".$this->string->arrayToWhereNotIn($po_id);
			}
		}
		
		$where = ($sup_id != 0 ? " AND q.ms_id = $sup_id" : NULL);
		$where3 = ($status_not != NULL ? " AND q.status_pembayaran != '$status_not'" : NULL);
		/*
		$sql = "SELECT q.*,IFNULL(q2.total_bayar,0) AS total_bayar,IFNULL(q2.status_pembayaran,'OPEN') AS status_pembayaran,IFNULL((q.tp_total-IFNULL(q2.total_bayar,0)),0) AS hutang_bayar
				FROM t_purchase AS q
				LEFT JOIN
				(
					SELECT a.*,b.tp_id, b.total_tagihan,b.total_bayar,IF(b.total_tagihan > b.total_bayar, 'OPEN', 'LUNAS') AS status_pembayaran, (b.total_tagihan-b.total_bayar) AS hutang_bayar
					FROM t_purchase_payment AS a
					JOIN(
						SELECT tpid_id, tpi_id, tp_id, tpid_flag, SUM(tp_total) AS total_tagihan, SUM(tpid_payment_amount) AS total_bayar
						FROM t_purchase_payment_detail 
						WHERE tpid_flag = 1
						GROUP BY tp_id
					)AS b ON b.tpi_id = a.tpi_id
					WHERE a.tpi_flag = 1
					GROUP BY a.tpi_id
					ORDER BY a.tpi_datetime_input DESC, a.tpi_date DESC
				) AS q2 ON q.tp_id = q2.tp_id
				WHERE q.tp_flag = 1 $where $where2 $where3
				GROUP BY tp_id
				ORDER BY q.tp_datetime_input DESC, q.tp_date DESC";
				*/
		$sql = "SELECT q.*
		FROM 
		(
			SELECT a.*,IFNULL(b.total_bayar,0) AS total_bayar, IF(a.tp_total = IFNULL(b.total_bayar,0),'LUNAS','OPEN') AS status_pembayaran,IFNULL((a.tp_total-IFNULL(b.total_bayar,0)),0) AS hutang_bayar
			FROM t_purchase AS a
			LEFT JOIN
			(
				SELECT tp_id, tp_total, SUM(tpid_payment_amount) AS total_bayar
				FROM t_purchase_payment_detail
				WHERE tpid_flag = 1
				GROUP BY tp_id
			) AS b
			ON a.tp_id = b.tp_id
			WHERE a.tp_flag = 1
			ORDER BY a.tp_datetime_input DESC, a.tp_date DESC
		)AS q
		WHERE 1 $where $where2 $where3";
		$q = $this->db->query($sql);
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
	
	function get_po_detail($sup_id=0)
	{
		$this->db->select('a.tp_id, a.tp_no, a.tp_date, b.*');
		$this->db->from('t_purchase AS a');
		$this->db->join('t_purchase_detail AS b', 'b.tp_id = a.tp_id');
		$this->db->where_in('a.tp_id',$sup_id);
		$where = "(b.trd_status != 'CLOSED' OR b.trd_status IS NULL) AND a.tp_flag = 1 AND b.tpd_flag = 1";
		$this->db->where($where);
		$q = $this->db->get();
		//echo $this->db->last_query();
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
	
	function get_payment_detail($id=0)
	{
		$this->db->select('a.*, b.*, c.tp_status, c.tp_total AS total_po');
		$this->db->from('t_purchase_payment AS a');
		$this->db->join('t_purchase_payment_detail AS b', 'b.tpi_id = a.tpi_id');
		$this->db->join('t_purchase AS c', 'c.tp_id = b.tp_id','right');
		$this->db->where('a.tpi_id',$id);
		$this->db->where(array('a.tpi_flag'=>1,'b.tpid_flag'=>1));
		$q = $this->db->get();
		//echo $this->db->last_query();
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
	
	function report_delivery($sup_id=0,$tgl_from=NULL,$tgl_to=NULL)
	{
		$where = ($sup_id != 0 ? " AND a.ms_id = $sup_id" : NULL);
		$where2 = NULL;
		if($tgl_from != NULL) {
			$from = $tgl_from;
			if($tgl_to != NULL) {
				$to = $tgl_to;
				$where2 .= " AND DATE(a.tr_ship_date) BETWEEN '$from' AND '$to'";
			}
			else {
				$where2 .= " AND DATE(a.tr_ship_date) BETWEEN '$from' AND NOW()";
			}
			
		}
		
		$sql = "SELECT a.tr_no, a.tr_date, a.tr_ship_date, a.tr_ship_no, a.ms_id, a.ms_name, a.ms_code, a.ms_address, 	a.ms_phone1, a.ms_fax, a.ms_email, b.mp_id, b.mp_code, b.mp_category, b.mp_name, b.mu_name, IFNULL(b.jml,0) AS jml, b.mbp_price
		FROM t_receiving AS a
		JOIN 
		(
			SELECT trd_id, tr_id, mp_id, mp_code, mp_category, mp_name, mu_name, SUM(trd_qty) AS jml, mbp_price 
			FROM t_receiving_detail 
			WHERE trd_flag = 1
			GROUP BY tr_id, mp_id
		) AS b ON a.tr_id = b.tr_id
		WHERE a.tr_flag = 1 $where $where2
		GROUP BY a.tr_ship_date,b.mp_id
		ORDER BY a.tr_ship_date ASC, b.mp_name ASC";
		$q = $this->db->query($sql);
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		$res['arr_mp_id'] = array();
		$res['arr_mp_name'] = array();
		$res['arr_mp_code'] = array();
		$res['arr_mu_name'] = array();
		$res['arr_tr_ship_date'] = array();
		if($res['num_rows'] > 0) {
			foreach($res['result'] as $row) {
				$res['arr_mp_id'][] = $row['mp_id'];
				$res['arr_mp_name'][] = $row['mp_name'].'|'.$row['mp_id'].'|'.$row['mu_name'];
				$res['arr_mp_code'][] = $row['mp_code'];
				$res['arr_mu_name'][] = $row['mu_name'];
				$res['arr_tr_ship_date'][] = $row['tr_ship_date'].'|'.$this->tanggal->tgl_indo_date_month($row['tr_ship_date']);
			}
			/*
			array_unique($arr_mp_id);
			array_unique($arr_mp_name);
			
			if(count($arr_mp_id) > 0) {
				$x = 0;
				foreach($arr_mp_name as $row) {
					$res[$arr_mp_id[$x]]
					$x++;
				}
			}*/
		}
		
		return $res;
	}
	
	function get_po_status($id=0) {
		$array = array('tp_id'=>$id);
		$q = $this->db->get_where('t_purchase',$array);
		return ($q->num_rows() > 0 ? $q->row()->tp_status : NULL);
	}
	
	function is_other_received($po_id=0,$mp_id=0,$curr_id=0){
		$this->db->where(array('tp_id'=>$po_id,'mp_id'=>$mp_id,'trd_flag'=>1,'trd_id >'=>$curr_id));
		$q = $this->db->get('t_receiving_detail');
		$rows = $q->result_array();
		
		$result['num_rows'] = $q->num_rows();
		$result['result'] = $rows;
		return $result;
	}
	
	function update_po_status($tr_id=0) {
		$this->load->model('model_po','mp');
		
		// Get PO id
		$get = $this->db->get_where('t_receiving',array('tr_id'=>$tr_id));
		$row = $get->row_array();
		
		// Update t_purchase_detail
		$det = $this->db->get_where('t_receiving_detail',array('tr_id'=>$tr_id));
		
		if($det->num_rows() > 0) {
			foreach($det->result_array() as $row) {
				$getTpd = $this->db->get_where('t_purchase_detail',array('tpd_id'=>$row['tpd_id']))->row_array();
				
				if(intval($row['tp_id']) != 0) {
					// Jml terima < dari jumlah di PO, status => PENDING
					// Jml terima = jumlah di PO, status => CLOSED
					if(floatval($row['trd_qty']) > 0) {
						$status = 'PENDING';
						$new_status = 'PENDING'; 
					}
					else {
						$status = 'CLOSED';
						$new_status = 'CLOSED';
					}
				}
				else {
					$new_status = 'CLOSED';
				}
				
				// update t_purchase_detail
				$outstanding = floatval($getTpd['tpd_outstanding'])+floatval($row['trd_qty']);
				$arr_upd1 = array(
					'tpd_outstanding' => $outstanding,
					'trd_qty' => floatval($getTpd['tpd_qty'])-$outstanding,
					'trd_status' => $new_status
				);
				
				$arr_where_upd1 = array('tpd_id'=>$row['tpd_id']);
				
				$this->db->where($arr_where_upd1);
				$this->db->update('t_purchase_detail',$arr_upd1);
				
				// update t_purchase
				$po_status = $this->mp->get_po_status($row['tp_id']);
				$this->db->where(array('tp_id'=>$row['tp_id']));
				$this->db->update('t_purchase',array('tp_status'=>$po_status['status'],'tp_full_receive_date'=>$po_status['full_receive_date']));
			}
		}
		
		$status = 'TRUE';
	}
}