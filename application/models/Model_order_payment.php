<?php 
class Model_order_payment extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_payment($form_no=NULL,$top_id=0)
	{
		$where = ($form_no != NULL ? " AND a.top_no = '".$form_no."'" : NULL);
		$where2 = ($top_id != 0 ? " AND a.top_id = $top_id" : NULL);
		$sql = "SELECT a.*,b.total_tagihan,b.total_bayar,IF(b.total_tagihan > b.total_bayar, 'OPEN', 'LUNAS') AS 	status_pembayaran,(b.total_tagihan-b.total_bayar) AS hutang_bayar
				FROM t_order_payment AS a
				JOIN(
					SELECT topd_id, top_id, topd_flag, SUM(to_total) AS total_tagihan, SUM(topd_payment_amount) AS total_bayar
					FROM t_order_payment_detail 
					WHERE topd_flag = 1
					GROUP BY top_id
				)AS b ON b.top_id = a.top_id
				WHERE a.top_flag = 1
				$where $where2
				GROUP BY a.top_id
				ORDER BY a.top_datetime_input DESC, a.top_date DESC";
		$q = $this->db->query($sql);
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		$res['row_array'] = $q->row_array();
		
		return $res;
	}
	
	/**
	* Get latest price
	**/
	function get_price($cus_id=0,$arr_mp_id=array())
	{
		$this->load->library('string');
		
		$where = ($cus_id != 0 ? " AND mc_id = $cus_id" : NULL);
		// AND mp_id NOT IN(mp_id)
		$where2 = $where2a = NULL;
		if(!empty($arr_mp_id) && $arr_mp_id != NULL) {
			$where2 = " AND mp_id".$this->string->arrayToWhereNotIn($arr_mp_id);
			$where2a = " AND a.mp_id".$this->string->arrayToWhereNotIn($arr_mp_id);
		}
		
		$sql = "SELECT x.*, y.mbp_id, y.mc_id, y.mbp_datetime, y.mc_code, y.mc_name, y.mbp_buy_price, y.mbp_sell_price, y.mbp_sell_price2, y.mbp_sell_price3, y.mbp_disc, y.mbp_disc_nominal, y.mbp_flag
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
						GROUP BY mp_id,mc_id
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
	
	function get_order($cus_id=0,$order_id=array(),$status_not='LUNAS',$sign='IN')
	{
		$this->load->library('string');
		
		// AND to_id IN(po_id)
		$where2 = NULL;
		if(!empty($order_id) && $order_id != NULL) {
			if($sign == 'IN') {
				$where2 = " AND q.to_id".$this->string->arrayToWhereIn($order_id);
			}
			else {
				$where2 = " AND q.to_id".$this->string->arrayToWhereNotIn($order_id);
			}
		}
		
		$where = ($cus_id != 0 ? " AND q.mc_id = $cus_id" : NULL);
		$where3 = ($status_not != NULL ? " AND q.status_pembayaran != '$status_not'" : NULL);
		/*
		$sql = "SELECT q.*,IFNULL(q2.total_bayar,0) AS total_bayar,IFNULL(q2.status_pembayaran,'OPEN') AS status_pembayaran,IFNULL((q.to_total-IFNULL(q2.total_bayar,0)),0) AS hutang_bayar
				FROM t_order AS q
				LEFT JOIN
				(
					SELECT a.*,b.to_id, b.total_tagihan,b.total_bayar,IF(b.total_tagihan > b.total_bayar, 'OPEN', 'LUNAS') AS status_pembayaran, (b.total_tagihan-b.total_bayar) AS hutang_bayar
					FROM t_order_payment AS a
					JOIN(
						SELECT topd_id, top_id, to_id, topd_flag, SUM(to_total) AS total_tagihan, SUM(topd_payment_amount) AS total_bayar
						FROM t_order_payment_detail 
						WHERE topd_flag = 1
						GROUP BY to_id
					)AS b ON b.top_id = a.top_id
					WHERE a.top_flag = 1
					GROUP BY a.top_id
					ORDER BY a.top_datetime_input DESC, a.top_date DESC
				) AS q2 ON q.to_id = q2.to_id
				WHERE q.to_flag = 1 $where $where2 $where3
				GROUP BY to_id
				ORDER BY q.to_datetime_input DESC, q.to_date DESC";
				*/
		$sql = "SELECT q.*
		FROM 
		(
			SELECT a.*,IFNULL(b.total_bayar,0) AS total_bayar, IF(a.to_total = IFNULL(b.total_bayar,0),'LUNAS','OPEN') AS status_pembayaran,IFNULL((a.to_total-IFNULL(b.total_bayar,0)),0) AS hutang_bayar
			FROM t_order AS a
			LEFT JOIN
			(
				SELECT to_id, to_total, SUM(topd_payment_amount) AS total_bayar
				FROM t_order_payment_detail
				WHERE topd_flag = 1
				GROUP BY to_id
			) AS b
			ON a.to_id = b.to_id
			WHERE a.to_flag = 1
			ORDER BY a.to_datetime_input DESC, a.to_date DESC
		)AS q
		WHERE 1 $where $where2 $where3";
		$q = $this->db->query($sql);
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
	
	function get_order_detail($cus_id=0)
	{
		$this->db->select('a.to_id, a.to_no, a.to_date, b.*');
		$this->db->from('t_order AS a');
		$this->db->join('t_order_detail AS b', 'b.to_id = a.to_id');
		$this->db->where_in('a.to_id',$cus_id);
		$where = "(b.tdd_status != 'CLOSED' OR b.tdd_status IS NULL) AND a.to_flag = 1 AND b.tod_flag = 1";
		$this->db->where($where);
		$q = $this->db->get();
		//echo $this->db->last_query();
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
	
	function get_payment_detail($id=0)
	{
		$this->db->select('a.*, b.*, c.to_date, c.to_status, c.to_total AS total_order');
		$this->db->from('t_order_payment AS a');
		$this->db->join('t_order_payment_detail AS b', 'b.top_id = a.top_id');
		$this->db->join('t_order AS c', 'c.to_id = b.to_id','right');
		$this->db->where('a.top_id',$id);
		$this->db->where(array('a.top_flag'=>1,'b.topd_flag'=>1));
		$q = $this->db->get();
		//echo $this->db->last_query();
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		return $res;
	}
	
	function report_delivery($cus_id=0,$tgl_from=NULL,$tgl_to=NULL)
	{
		$where = ($cus_id != 0 ? " AND a.mc_id = $cus_id" : NULL);
		$where2 = NULL;
		if($tgl_from != NULL) {
			$from = $tgl_from;
			if($tgl_to != NULL) {
				$to = $tgl_to;
				$where2 .= " AND DATE(a.td_date) BETWEEN '$from' AND '$to'";
			}
			else {
				$where2 .= " AND DATE(a.td_date) BETWEEN '$from' AND NOW()";
			}
			
		}
		
		$sql = "SELECT a.td_no, a.td_date, a.td_date, a.td_ship_no, a.mc_id, a.mc_name, a.mc_code, a.mc_address, 	a.mc_phone1, a.mc_fax, a.mc_email, b.mp_id, b.mp_code, b.mp_category, b.mp_name, b.mu_name, IFNULL(b.jml,0) AS jml, b.mbp_price
		FROM t_delivery AS a
		JOIN 
		(
			SELECT tdd_id, td_id, mp_id, mp_code, mp_category, mp_name, mu_name, SUM(tdd_qty) AS jml, mbp_price 
			FROM t_delivery_detail 
			WHERE tdd_flag = 1
			GROUP BY td_id, mp_id
		) AS b ON a.td_id = b.td_id
		WHERE a.td_flag = 1 $where $where2
		GROUP BY a.td_date,b.mp_id
		ORDER BY a.td_date ASC, b.mp_name ASC";
		$q = $this->db->query($sql);
		
		$res['num_rows'] = $q->num_rows();
		$res['result'] = $q->result_array();
		
		$res['arr_mp_id'] = array();
		$res['arr_mp_name'] = array();
		$res['arr_mp_code'] = array();
		$res['arr_mu_name'] = array();
		$res['arr_td_date'] = array();
		if($res['num_rows'] > 0) {
			foreach($res['result'] as $row) {
				$res['arr_mp_id'][] = $row['mp_id'];
				$res['arr_mp_name'][] = $row['mp_name'].'|'.$row['mp_id'].'|'.$row['mu_name'];
				$res['arr_mp_code'][] = $row['mp_code'];
				$res['arr_mu_name'][] = $row['mu_name'];
				$res['arr_td_date'][] = $row['td_date'].'|'.$this->tanggal->tgl_indo_date_month($row['td_date']);
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
	
	function get_order_status($id=0) {
		$array = array('to_id'=>$id);
		$q = $this->db->get_where('t_order',$array);
		return ($q->num_rows() > 0 ? $q->row()->to_status : NULL);
	}
	
	function is_other_delivered($order_id=0,$mp_id=0,$curr_id=0){
		$this->db->where(array('to_id'=>$order_id,'mp_id'=>$mp_id,'tdd_flag'=>1,'tdd_id >'=>$curr_id));
		$q = $this->db->get('t_delivery_detail');
		$rows = $q->result_array();
		
		$result['num_rows'] = $q->num_rows();
		$result['result'] = $rows;
		return $result;
	}
	
	function update_order_status($td_id=0) {
		$this->load->model('model_order','mp');
		
		// Get PO id
		$get = $this->db->get_where('t_delivery',array('td_id'=>$td_id));
		$row = $get->row_array();
		
		// Update t_order_detail
		$det = $this->db->get_where('t_delivery_detail',array('td_id'=>$td_id));
		
		if($det->num_rows() > 0) {
			foreach($det->result_array() as $row) {
				$getTod = $this->db->get_where('t_order_detail',array('tod_id'=>$row['tod_id']))->row_array();
				
				if(intval($row['to_id']) != 0) {
					// Jml terima < dari jumlah di PO, status => PENDING
					// Jml terima = jumlah di PO, status => CLOSED
					if(floatval($row['tdd_qty']) > 0) {
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
				
				// update t_order_detail
				$outstanding = floatval($getTod['tod_outstanding'])+floatval($row['tdd_qty']);
				$arr_upd1 = array(
					'td_outstanding' => $outstanding,
					'td_qty' => floatval($getTod['tod_qty'])-$outstanding,
					'td_status' => $new_status
				);
				
				$arr_where_upd1 = array('tod_id'=>$row['tod_id']);
				
				$this->db->where($arr_where_upd1);
				$this->db->update('t_order_detail',$arr_upd1);
				
				// update t_order
				$order_status = $this->mp->get_order_status($row['to_id']);
				$this->db->where(array('to_id'=>$row['to_id']));
				$this->db->update('t_order',array('to_status'=>$order_status['status'],'to_full_delivery_date'=>$order_status['full_delivery_date']));
			}
		}
		
		$status = 'TRUE';
	}
}