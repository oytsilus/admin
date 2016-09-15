<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('file_upload'))
{
	function file_upload($field_name, $allowed_types, $target_folder, $debug = FALSE)
	{
		$ci =& get_instance();

		if ( ! $_FILES[$field_name]['name']) return false;
		
		$config = array(
			'upload_path'	=> 'upload/' . $target_folder,
			'allowed_types'	=> $allowed_types
		);
		
		if ( ! file_exists($config['upload_path']))
		{
			mkdir($config['upload_path']);
		}
		
		$ci->load->library('upload');
		$ci->upload->initialize($config);
		
		if ( ! $ci->upload->do_upload($field_name))
		{
			echo ($debug == TRUE) ? $ci->upload->display_errors() : 'File upload failed. Please set debug = TRUE.';
			exit;
		}
		else
		{
			return $ci->upload->data();
		}
	}
}

if ( ! function_exists('remove_file'))
{
	function remove_file($db_name, $field_name, $id, $target_folder)
	{
		$ci =& get_instance();
		
		$file_directory = 'upload/' . $target_folder;
		$trash_folder = 'trash/' . $target_folder;
		
		$row = $ci->db->select($field_name)->where('unique_id', $unique_id)->get($db_name)->row_array();
		
		if ($row)
		{
			if ($row[$field_name])
			{
				if ( ! file_exists($trash_folder))
				{
					mkdir($trash_folder);
				}
				
				if (file_exists($file_directory . '/' . $row[$field_name]))
				{
					rename($file_directory . '/' . $row[$field_name], $trash_folder . '/' . $row[$field_name]);
				}
			}
		}
	}
}

function read_more($content,$limit=10){
	$content = strip_tags($content);
	$brkcon = explode(" ",$content);

	if(count($brkcon) > $limit){
		$wi = 0;
		$glimpse = "";
		//while($wi < 11){
		for($wi=0; $wi<$limit+1; $wi++) {
			$glimpse .= $brkcon[$wi]." ";
		}

		return $glimpse.'...';
	}else{
		return $content;
	}	
}

if(!function_exists('cleanDelimiter')) {
	/*
     * Clean delimiter ',' at the end of string
     */
    function cleanDelimiter($string) {
        // Clean ',' at the end of string
        return preg_replace("/(,)+$/", "", $string);
    }
}

if ( ! function_exists('cb_kategori'))
{
	function cb_kategori($val='')
	{
		$ci =& get_instance();
		$cat = $ci->config->item('kategori_sayur');

		$str = '<select id="category" name="category" class="form-control">';
		foreach($cat as $idx=>$val) {
			$selected = (strtoupper($idx) === strtoupper($val) ? ' selected="selected"' : NULL);
			$str .= '<option value="'.$idx.'"'.$selected.'>'.$val.'</option>';
		}
		$str .= '</select>';
		
		return $str;
	}
}

if ( ! function_exists('cb_unit'))
{
	function cb_unit($val='')
	{
		$ci =& get_instance();
		
		$sql = "SELECT * FROM m_unit WHERE mu_flag = 1";
		$q = $ci->db->query($sql);

		$str = '<select id="unit" name="unit" class="form-control">';
		foreach($q->result_array() as $row) {
			$selected = ($row['mu_id'] === $val ? ' selected="selected"' : NULL);
			$str .= '<option value="'.$row['mu_id'].'|'.$row['mu_code'].'|'.$row['mu_name'].'"'.$selected.'>'.$row['mu_name'].'</option>';
		}
		$str .= '</select>';
		
		return $str;
	}
}

if ( ! function_exists('cb_supplier'))
{
	function cb_supplier($val='',$id=NULL,$isreadonly=NULL)
	{
		$ci =& get_instance();
		
		$sql = "SELECT ms_id, ms_code, ms_name FROM m_supplier WHERE ms_flag = 1";
		$q = $ci->db->query($sql);
		
		$id = ($id == NULL ? 'supplier' : $id);
		$readonly = ($isreadonly != NULL ? ' readonly="readonly"' : NULL);
		$str = '<select id="'.$id.'" name="supplier" class="form-control select2_single"'.$readonly.'>';
		$str .= '<option value="">- Pilih Supplier - </option>';
		foreach($q->result_array() as $row) {
			$selected = ($row['ms_id'] === $val ? ' selected="selected"' : NULL);
			$str .= '<option value="'.$row['ms_id'].'|'.$row['ms_code'].'|'.$row['ms_name'].'"'.$selected.'>'.$row['ms_name'].' - '.$row['ms_code'].'</option>';
		}
		$str .= '</select>';
		
		return $str;
	}
}

if ( ! function_exists('get_user'))
{
	function get_user($user_id=0) {
		$ci =& get_instance();
		
		$query = $ci->db->get_where('users',array('user_id'=>$user_id));
		$user = array();
		
		if($query->num_rows() > 0) {
			$q = $query->row_array();
			$user['id'] = $q['user_id'];
			$user['username'] = $q['username'];
			$user['email'] = $q['email'];
			$user['full_name'] = $q['full_name'];
			$user['auth_level'] = $q['auth_level'];
		}
		
		return $user;
	}
}

if(!function_exists('get_qty_receiving'))
{
	function get_qty_receiving($mp_id=0,$date=NULL,$ms_id=0) {
		$ci =& get_instance();
		
		$sql = "SELECT b.trd_id, b.tr_id, b.mp_id, b.mp_name, b.mu_name, b.mu_code, SUM(b.trd_qty) AS jml_terima, b.mbp_price
				FROM t_receiving AS a
				LEFT JOIN t_receiving_detail as b ON a.tr_id = b.tr_id
				WHERE a.tr_flag = 1
				AND a.ms_id = $ms_id
				AND a.tr_ship_date = '$date'
				AND b.mp_id = $mp_id
				GROUP BY a.ms_id, a.tr_ship_date, b.mp_id";
		$q = $ci->db->query($sql);
		
		$row = $q->row_array();
		$result['qty'] = $row['jml_terima'];
		$result['price'] = $row['mbp_price'];
		
		// Get total
		$sql2 = "SELECT SUM(b.trd_qty) AS total_terima
				FROM t_receiving AS a
				LEFT JOIN t_receiving_detail as b ON a.tr_id = b.tr_id
				WHERE a.tr_flag = 1
				AND a.ms_id = $ms_id
				AND a.tr_ship_date = '$date'";
		
		return $result;
	}
}

if(!function_exists('get_users'))
{
	function get_users($username=NULL) {
		$ci =& get_instance();
		
		$q = $ci->db->get_where('users',array('username'=>$username));
		
		$row = $q->row_array();
		$result['full_name'] = $row['full_name'];
		$result['email'] = $row['email'];
		
		return $result;
	}
}

if ( ! function_exists('cb_customer'))
{
	function cb_customer($val='',$id=NULL,$isreadonly=NULL)
	{
		$ci =& get_instance();
		
		$sql = "SELECT mc_id, mc_code, mc_name FROM m_customer WHERE mc_flag = 1";
		$q = $ci->db->query($sql);
		
		$id = ($id == NULL ? 'customer' : $id);
		$readonly = ($isreadonly != NULL ? ' readonly="readonly"' : NULL);
		$str = '<select id="'.$id.'" name="customer" class="form-control select2_single"'.$readonly.'>';
		$str .= '<option value="">- Pilih Customer - </option>';
		foreach($q->result_array() as $row) {
			$selected = ($row['mc_id'] === $val ? ' selected="selected"' : NULL);
			$str .= '<option value="'.$row['mc_id'].'|'.$row['mc_code'].'|'.$row['mc_name'].'"'.$selected.'>'.$row['mc_name'].' - '.$row['mc_code'].'</option>';
		}
		$str .= '</select>';
		
		return $str;
	}
}

if(!function_exists('get_qty_delivery'))
{
	function get_qty_delivery($mp_id=0,$date=NULL,$mc_id=0) {
		$ci =& get_instance();
		
		$sql = "SELECT b.tdd_id, b.td_id, b.mp_id, b.mp_name, b.mu_name, b.mu_code, SUM(b.tdd_qty) AS jml_kirim, b.msp_price
				FROM t_delivery AS a
				LEFT JOIN t_delivery_detail as b ON a.td_id = b.td_id
				WHERE a.td_flag = 1
				AND a.mc_id = $mc_id
				AND a.td_date = '$date'
				AND b.mp_id = $mp_id
				GROUP BY a.mc_id, a.td_date, b.mp_id";
		$q = $ci->db->query($sql);
		
		$row = $q->row_array();
		$result['qty'] = $row['jml_kirim'];
		$result['price'] = $row['msp_price'];
		
		// Get total
		$sql2 = "SELECT SUM(b.tdd_qty) AS total_kirim
				FROM t_delivery AS a
				LEFT JOIN t_delivery_detail as b ON a.td_id = b.td_id
				WHERE a.td_flag = 1
				AND a.mc_id = $mc_id
				AND a.td_date = '$date'";
		
		return $result;
	}
}