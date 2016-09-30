<?php
/**
  * class No_format
  * author        : Agung.SW (agung.sulistyo.w@gmail.com)
  * description   : class of number format
  */
class No_format {

    /*
    * __constructor No_format()
    * @param NOTHING
    */
    function No_format()
    {
		//$this->load->model(array('common_query'));
		//$this->load->database();
    }

	function romawi($bulan)
	{
		switch ($bulan)
		{
			case '01' :
			return "I";
			break;
			case '02' :
			return "II";
			break;
			case '03' :
			return "III";
			break;
			case '04' :
			return "IV";
			break;
			case '05' :
			return "V";
			break;
			case '06' :
			return "VI";
			break;
			case '07' :
			return "VII";
			break;
			case '08' :
			return "VIII";
			break;
			case '09' :
			return "IX";
			break;
			case '10' :
			return "X";
			break;
			case '11' :
			return "XI";
			break;
			case '12' :
			return "XII";
			break;
		}
	}
	function konversi_bulan($bulan){
            if(strlen($bulan) == 1) return '0'.$bulan;
            else return $bulan;
        }

        function get_counter_3digit($counter)
	{
		if(strlen($counter) == 1) return '00'.$counter;
		else if(strlen($counter) == 2) return '0'.$counter;
		else if(strlen($counter) == 3) return $counter;
		else return FALSE;
	}

	function get_counter_4digit($counter)
	{
		if(strlen($counter) == 1) return '000'.$counter;
		else if(strlen($counter) == 2) return '00'.$counter;
		else if(strlen($counter) == 3) return '0'.$counter;
		else if(strlen($counter) == 4) return $counter;
		else return FALSE;
	}

	function get_counter_5digit($counter)
	{
		if(strlen($counter) == 1) return '0000'.$counter;
		else if(strlen($counter) == 2) return '000'.$counter;
		else if(strlen($counter) == 3) return '00'.$counter;
		else if(strlen($counter) == 4) return '0'.$counter;
		else if(strlen($counter) == 5) return $counter;
		else return FALSE;
	}

        function yearTwoDigits($year=NULL) {
            $year = ($year === NULL ? date("y") : $year);
            return substr($year, -2);
        }

	function get_kode($type='SAYUR')
	{
		$ci =& get_instance();

		$sql = "SELECT COUNT(*)+1 AS jml FROM m_product WHERE mp_flag = 1 AND mp_category = '$type'";
		$q = $ci->db->query($sql);
		$counter = $q->row()->jml;

		switch($type){
			case 'SAYUR' : $prefix = 'S'; break;
			case 'BUAH' : $prefix = 'B'; break;
			default : $prefix = 'DEF'; break;
		}

		return $prefix.$this->get_counter_3digit($counter);
	}

	public function idr_money($number = NULL,$num_of_dec = '0',$dec_separator='.',$thousand_separator=',',$idr_format = '') {
        $newNo = ($number == NULL || $number == '0' ? '0' : $number);
        return $idr_format.' '.  number_format($newNo, $num_of_dec, $dec_separator, $thousand_separator);
    }

	/**
	* 08/20/2016 => 2016-08-20
	**/
	function date_to_db($date=NULL) {
		if($date != NULL) {
			$exp = explode('/',$date);
			if(count($exp) > 0) {
				$return['string'] = $exp[2].'-'.$exp[0].'-'.$exp[1];
				$return['dd'] = $exp[1];
				$return['mm'] = $exp[0];
				$return['yy'] = $exp[2];
			}
			else {
				$return['string'] = NULL;
				$return['dd'] = NULL;
				$return['mm'] = NULL;
				$return['yy'] = NULL;
			}

			return $return;
		}
		else return array();
	}

	/**
	* 08/20/2016 => 2016-08-20
	**/
	function date_to_db2($date=NULL) {
		if($date != NULL) {
			$exp = explode('-',$date);
			if(count($exp) > 0) {
				$return['string'] = $exp[0].'-'.$exp[1].'-'.$exp[2];
				$return['dd'] = $exp[2];
				$return['mm'] = $exp[1];
				$return['yy'] = $exp[0];
			}
			else {
				$return['string'] = NULL;
				$return['dd'] = NULL;
				$return['mm'] = NULL;
				$return['yy'] = NULL;
			}

			return $return;
		}
		else return array();
	}


	/**
	* @return : 'PO009/VII/16'
	**/
	function generate_po_no($date=NULL)
	{
		$ci =& get_instance();
		$prefix = $ci->config->item('po_prefix');

		$getDate = $this->date_to_db($date);
		$sql = "SELECT COUNT(*)+1 AS jml
				FROM t_purchase
				WHERE tp_flag = 1
				AND MONTH(tp_date) = '".$getDate['mm']."' AND YEAR(tp_date) = '".$getDate['yy']."'";
		$q = $ci->db->query($sql);
		$counter = $q->row()->jml;

		return $prefix.$this->get_counter_3digit($counter).'/'.$this->romawi($getDate['mm']).'/'.$this->yearTwoDigits($getDate['yy']);
	}

	/**
	* @return : 'RI009/VII/16'
	**/
	function generate_receiving_no($date=NULL)
	{
		$ci =& get_instance();
		$prefix = $ci->config->item('receiving_prefix');

		$getDate = $this->date_to_db($date);
		$sql = "SELECT COUNT(*)+1 AS jml
				FROM t_receiving
				WHERE tr_flag = 1
				AND MONTH(tr_date) = '".$getDate['mm']."' AND YEAR(tr_date) = '".$getDate['yy']."'";

		$q = $ci->db->query($sql);
		$counter = $q->row()->jml;

		return $prefix.$this->get_counter_3digit($counter).'/'.$this->romawi($getDate['mm']).'/'.$this->yearTwoDigits($getDate['yy']);
	}

	function get_next_receiving($tr_id=0,$tp_id=0) {
		$ci =& get_instance();

		$sql = "SELECT COUNT(*) as jml_next_id
				FROM t_receiving AS a
				WHERE a.tr_flag = 1
				AND a.tp_id = $tp_id
				AND a.tr_id > $tr_id";
		$q = $ci->db->query($sql);

		return $q->row()->jml_next_id;
	}

	function get_next_pp($tpi_id=0,$tp_id=0) {
		$ci =& get_instance();

		$sql = "SELECT COUNT(*) as jml_next_id
				FROM t_purchase_payment_detail AS a
				WHERE a.tpid_flag = 1
				AND a.tp_id = $tp_id
				AND a.tpi_id > $tpi_id";
		$q = $ci->db->query($sql);

		return $q->row()->jml_next_id;
	}

	function get_next_delivery($td_id=0,$to_id=0) {
		$ci =& get_instance();

		$sql = "SELECT COUNT(*) as jml_next_id
				FROM t_delivery AS a
				WHERE a.td_flag = 1
				AND a.to_id = $to_id
				AND a.td_id > $td_id";
		$q = $ci->db->query($sql);

		return $q->row()->jml_next_id;
	}

	/**
	* @return : 'PP009/VII/16'
	**/
	function generate_pp_no($date=NULL)
	{
		$ci =& get_instance();
		$prefix = $ci->config->item('pp_prefix');

		$getDate = $this->date_to_db($date);
		$sql = "SELECT COUNT(*)+1 AS jml
				FROM t_purchase_payment
				WHERE tpi_flag = 1
				AND MONTH(tpi_date) = '".$getDate['mm']."' AND YEAR(tpi_date) = '".$getDate['yy']."'";

		$q = $ci->db->query($sql);
		$counter = $q->row()->jml;

		return $prefix.$this->get_counter_3digit($counter).'/'.$this->romawi($getDate['mm']).'/'.$this->yearTwoDigits($getDate['yy']);
	}

	/**
	* @return : 'SO009/VII/16'
	**/
	function generate_order_no($date=NULL)
	{
		$ci =& get_instance();
		$prefix = $ci->config->item('order_prefix');

		$getDate = $this->date_to_db($date);
		$sql = "SELECT COUNT(*)+1 AS jml
				FROM t_order
				WHERE to_flag = 1
				AND MONTH(to_date) = '".$getDate['mm']."' AND YEAR(to_date) = '".$getDate['yy']."'";
		$q = $ci->db->query($sql);
		$counter = $q->row()->jml;

		return $prefix.$this->get_counter_3digit($counter).'/'.$this->romawi($getDate['mm']).'/'.$this->yearTwoDigits($getDate['yy']);

		print_r($getDate);
	}

	/**
	* @return : 'INV009/VII/16'
	**/
	function generate_order_inv_no($date=NULL)
	{
		$ci =& get_instance();
		$prefix = $ci->config->item('order_inv_prefix');

		$getDate = $this->date_to_db($date);
		$sql = "SELECT COUNT(*)+1 AS jml
				FROM t_order
				WHERE to_flag = 1
				AND MONTH(to_date) = '".$getDate['mm']."' AND YEAR(to_date) = '".$getDate['yy']."'";
		$q = $ci->db->query($sql);
		$counter = $q->row()->jml;

		return $prefix.$this->get_counter_3digit($counter).'/'.$this->romawi($getDate['mm']).'/'.$this->yearTwoDigits($getDate['yy']);
	}

	/**
	* @return : 'D009/VII/16'
	**/
	function generate_delivery_no($date=NULL)
	{
		$ci =& get_instance();
		$prefix = $ci->config->item('delivery_prefix');

		$getDate = $this->date_to_db($date);
		$sql = "SELECT COUNT(*)+1 AS jml
				FROM t_delivery
				WHERE td_flag = 1
				AND MONTH(td_date) = '".$getDate['mm']."' AND YEAR(td_date) = '".$getDate['yy']."'";

		$q = $ci->db->query($sql);
		$counter = $q->row()->jml;

		return $prefix.$this->get_counter_3digit($counter).'/'.$this->romawi($getDate['mm']).'/'.$this->yearTwoDigits($getDate['yy']);
	}

	function get_next_op($top_id=0,$to_id=0) {
		$ci =& get_instance();

		$sql = "SELECT COUNT(*) as jml_next_id
				FROM t_order_payment_detail AS a
				WHERE a.topd_flag = 1
				AND a.to_id = $to_id
				AND a.top_id > $top_id";
		$q = $ci->db->query($sql);

		return $q->row()->jml_next_id;
	}

	/**
	* @return : 'OP009/VII/16'
	**/
	function generate_op_no($date=NULL)
	{
		$ci =& get_instance();
		$prefix = $ci->config->item('op_prefix');

		$getDate = $this->date_to_db($date);
		$sql = "SELECT COUNT(*)+1 AS jml
				FROM t_order_payment
				WHERE top_flag = 1
				AND MONTH(top_date) = '".$getDate['mm']."' AND YEAR(top_date) = '".$getDate['yy']."'";

		$q = $ci->db->query($sql);
		$counter = $q->row()->jml;

		return $prefix.$this->get_counter_3digit($counter).'/'.$this->romawi($getDate['mm']).'/'.$this->yearTwoDigits($getDate['yy']);
	}
}
?>
