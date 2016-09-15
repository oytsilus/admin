<?php
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class Ajax extends MY_Controller {
		private $controller = 'm_price';
		private $table = 'm_price';
		private $folder_view = 'admin/m_price';
		
		function __construct() {
			parent::__construct();
			
			date_default_timezone_set('Asia/Jakarta');
			
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('model_price','mp');
			$this->load->library('no_format');
		}
		
		function add_supplier() {
			$result['string'] = $result['value'] = $result['name'] = NULL;
			if($_POST) {
				$post = $this->input->post();
				
				$arr_ins = array(
					'ms_code'=>$post['kode'],
					'ms_name'=>$post['name'],
					'ms_flag'=>1
				);
				
				if($this->db->insert('m_supplier', $arr_ins)) {
					$id = $this->db->insert_id();
					
					$result['status'] = 'TRUE';
					$result['string'] = '<option value="'.$id.'|'.$post['kode'].''.$post['name'].'">'.$post['name'].'</option>';
					$result['value'] = $id.'|'.$post['kode'].''.$post['name'];
					$result['name'] = $post['name'];
				}
				else {
					$result['status'] = 'FALSE';
				}
			}
			else {
				$result['status'] = 'FAlSE';
			}
			
			echo json_encode($result);
		}
		
		function generate_sup_detail() {
			if($_POST) {
				if($this->input->post('id','') == '') {
					echo "Silahkan pilih supplier!";
				}
				else {
					// Get Supplier
					$q = $this->db->get_where('m_supplier',array('ms_id'=>$this->input->post('id',0)));
					$row = $q->row_array();
					$num_rows = $q->num_rows();
					
					//Return field
					$return['ms_address'] = $row['ms_address'];
					$return['ms_code'] = $row['ms_code'];
					$return['ms_phone1'] = $row['ms_phone1'];
					$return['ms_email'] = $row['ms_email'];
					$return['ms_pic'] = $row['ms_pic'];
					$return['status'] = 'TRUE';
				}
			}
			else $return['status'] = 'FALSE';
			
			echo json_encode($return);
			
		}
		
		function idr_format() {
			if($_POST) {
				$return['string'] = $this->no_format->idr_money($this->input->post('jumlah'));
				$return['status'] = 'TRUE';
			}
			else {
				$return['string'] = NULL;
				$return['status'] = 'FALSE';
			}
			
			echo json_encode($return);
		}
		
		function generate_cust_detail() {
			if($_POST) {
				if($this->input->post('id','') == '') {
					echo "Silahkan pilih customer!";
				}
				else {
					// Get Customer
					$q = $this->db->get_where('m_customer',array('mc_id'=>$this->input->post('id',0)));
					$row = $q->row_array();
					$num_rows = $q->num_rows();
					
					//Return field
					$return['mc_address'] = $row['mc_address'];
					$return['mc_code'] = $row['mc_code'];
					$return['mc_phone1'] = $row['mc_phone1'];
					$return['mc_email'] = $row['mc_email'];
					$return['mc_pic'] = $row['mc_pic'];
					$return['status'] = 'TRUE';
				}
			}
			else $return['status'] = 'FALSE';
			
			echo json_encode($return);
			
		}
		
		function add_customer() {
			$result['string'] = $result['value'] = $result['name'] = NULL;
			if($_POST) {
				$post = $this->input->post();
				
				$arr_ins = array(
					'mc_code'=>$post['kode'],
					'mc_name'=>$post['name'],
					'mc_flag'=>1
				);
				
				if($this->db->insert('m_customer', $arr_ins)) {
					$id = $this->db->insert_id();
					
					$result['status'] = 'TRUE';
					$result['string'] = '<option value="'.$id.'|'.$post['kode'].''.$post['name'].'">'.$post['name'].'</option>';
					$result['value'] = $id.'|'.$post['kode'].''.$post['name'];
					$result['name'] = $post['name'];
				}
				else {
					$result['status'] = 'FALSE';
				}
			}
			else {
				$result['status'] = 'FAlSE';
			}
			
			echo json_encode($result);
		}
		
		function generate_cus_detail() {
			if($_POST) {
				if($this->input->post('id','') == '') {
					echo "Silahkan pilih customer!";
				}
				else {
					// Get Customer
					$q = $this->db->get_where('m_customer',array('mc_id'=>$this->input->post('id',0)));
					$row = $q->row_array();
					$num_rows = $q->num_rows();
					
					//Return field
					$return['mc_address'] = $row['mc_address'];
					$return['mc_code'] = $row['mc_code'];
					$return['mc_phone1'] = $row['mc_phone1'];
					$return['mc_email'] = $row['mc_email'];
					$return['mc_pic'] = $row['mc_pic'];
					$return['status'] = 'TRUE';
				}
			}
			else $return['status'] = 'FALSE';
			
			echo json_encode($return);
			
		}
	}