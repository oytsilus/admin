<?php
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class Delivery extends MY_Controller {
		private $folder_view = 'admin/sales/';
		private $controller = 'delivery';
		private $table = 't_delivery';
		private $table2 = 't_order';
		
		function __construct() {
			parent::__construct();
			
			date_default_timezone_set('Asia/Jakarta');
			
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('model_delivery','md');
			$this->load->library(array('no_format','tanggal'));
		}
		
		function index(){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Daftar Pengiriman',
						'page' => $this->folder_view.$this->controller.'/index',
						'js_page' => $this->folder_view.$this->controller.'/index_js',
						'js_scripts' => array(
							'vendors/jquery/dist/jquery.min', /* jQuery */
							'vendors/bootstrap/dist/js/bootstrap.min', /* Bootstrap */
							'vendors/fastclick/lib/fastclick', /* FastClick */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/iCheck/icheck.min', /* iCheck */
							'vendors/datatables.net/js/jquery.dataTables.min', /* Datatables */
							'vendors/datatables.net-bs/js/dataTables.bootstrap.min', /* Datatables */
							'vendors/datatables.net-buttons/js/dataTables.buttons.min', /* Datatables */
							'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min', /* Datatables */
							'vendors/datatables.net-buttons/js/buttons.flash.min', /* Datatables */
							'vendors/datatables.net-buttons/js/buttons.html5.min', /* Datatables */
							'vendors/datatables.net-buttons/js/buttons.print.min', /* Datatables */
							'vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min', /* Datatables */
							'vendors/datatables.net-keytable/js/dataTables.keyTable.min', /* Datatables */
							'vendors/datatables.net-responsive/js/dataTables.responsive.min', /* Datatables */
							'vendors/datatables.net-responsive-bs/js/responsive.bootstrap', /* Datatables */
							'vendors/datatables.net-scroller/js/datatables.scroller.min', /* Datatables */
							'vendors/jszip/dist/jszip.min',
							'vendors/pdfmake/build/pdfmake.min',
							'vendors/pdfmake/build/vfs_fonts',
							'vendors/bootbox/bootbox.min' /* Bootbox */
						),
						'css_scripts' => array(
							'vendors/bootstrap/dist/css/bootstrap.min', /* Bootstrap */
							'vendors/font-awesome/css/font-awesome.min', /* Font Awesome */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/iCheck/skins/flat/green', /* iCheck */
							'vendors/datatables.net-bs/css/dataTables.bootstrap.min', /* Datatable */
							'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min', /* Datatable */
							'vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap', /* Datatable */
							'vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min', /* Datatable */
							'vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min' /* Datatable */
						)
				);
				
				// Get Delivery
				$q = $this->md->get_delivery();
				$data['num_rows'] = $q['num_rows'];
				$data['result'] = $q['result'];
				
				$this->load->view('admin/template/home',$data);
			}
			else {
				redirect('logout');
			}
		}
		
		function create(){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Buat Pengiriman',
						'page' => $this->folder_view.$this->controller.'/create',
						'js_page' => $this->folder_view.$this->controller.'/js',
						'js_scripts' => array(
							'vendors/jquery/dist/jquery.min', /* jQuery */
							'vendors/bootstrap/dist/js/bootstrap.min', /* Bootstrap */
							'vendors/fastclick/lib/fastclick', /* FastClick */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/iCheck/icheck.min', /* iCheck */
							'vendors/validator/validator', /* Validator.js */
							'js/moment/moment.min', /* Bootstrap daterangepicker */
							'js/datepicker/daterangepicker', /* Bootstrap daterangepicker */
							'vendors/select2/dist/js/select2.full.min', /* Select2 */	
							'vendors/datatables.net/js/jquery.dataTables.min', /* Datatables */
							'vendors/datatables.net-bs/js/dataTables.bootstrap.min', /* Datatables */
							'vendors/datatables.net-buttons/js/dataTables.buttons.min', /* Datatables */
							'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min', /* Datatables */
							'vendors/datatables.net-buttons/js/buttons.flash.min', /* Datatables */
							'vendors/datatables.net-buttons/js/buttons.html5.min', /* Datatables */
							'vendors/datatables.net-buttons/js/buttons.print.min', /* Datatables */
							'vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min', /* Datatables */
							'vendors/datatables.net-keytable/js/dataTables.keyTable.min', /* Datatables */
							'vendors/datatables.net-responsive/js/dataTables.responsive.min', /* Datatables */
							'vendors/datatables.net-responsive-bs/js/responsive.bootstrap', /* Datatables */
							'vendors/datatables.net-scroller/js/datatables.scroller.min', /* Datatables */
							'vendors/accounting/accounting.min', /* Accounting.js */							
							'vendors/bootbox/bootbox.min' /* Bootbox */
						),
						'css_scripts' => array(
							'vendors/bootstrap/dist/css/bootstrap.min', /* Bootstrap */
							'vendors/font-awesome/css/font-awesome.min', /* Font Awesome */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/iCheck/skins/flat/green', /* iCheck */
							'vendors/select2/dist/css/select2.min', /* Select2 */
							'vendors/datatables.net-bs/css/dataTables.bootstrap.min', /* Datatable */
							'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min', /* Datatable */
							'vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap', /* Datatable */
							'vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min', /* Datatable */
							'vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min' /* Datatable */
						),
						'date_now' => date('m/d/Y')
				);
				
				if($_POST) {
					$post = $this->input->post();
					$cust = explode('|',$post['customer']);
					$date = explode('/',$post['tgl']); // mm/dd/yyyy
					
					// Get customer
					$qs = $this->db->get_where('m_customer',array('mc_id'=>$cust[0]))->row_array();
					$no_doc = $this->no_format->generate_delivery_no($data['date_now']);
					
					// Insert : tbl_receiving
					$arr_ins0 = array(
						'td_no' => $no_doc,
						'mc_id' => $cust[0],
						'td_date' => $date[2].'-'.$date[0].'-'.$date[1],
						'mc_code' => $cust[1],
						'mc_name' => $cust[2],
						'mc_address' => $qs['mc_address'],
						'mc_phone1' => $qs['mc_phone1'],
						'mc_email' => $qs['mc_email'],
						'to_pic' => $post['up'],
						'td_desc' => $post['note'],
						'td_driver_name' => $post['driver_name'],
						'td_car_no' => $post['car_no'],
						'td_datetime_input' => date("Y-m-d H:i:s"),
						'td_flag' => 1
					);
					if($this->db->insert($this->table,$arr_ins0)) {
						$id = $this->db->insert_id();
						
						$x = 0;
						$dateTkirim = array();
						$arr_ins = array();
						$arr_params = array();
						$order_ids = array();
						foreach($post['qty'] as $item) {
							if($item != '0' && $item != '') {
								$params = explode('|', $post['h_params'][$x]);
								$order_ids[$x] = $params[7];
								
								$status[$params[7]][$x] = 'OPEN';
								
								if(intval($params[7]) != 0) {
									// Jml terima < dari jumlah di PO, status => PENDING
									// Jml terima = jumlah di PO, status => CLOSED
									if(floatval($params[9]) == floatval($post['qty'][$x])) {
										$status[$params[7]][$x] = 'CLOSED';
										$new_status = 'CLOSED'; 
									}
									else {
										$status[$params[7]][$x] = 'PENDING';
										$new_status = 'PENDING';
									}
								}
								else {
									$new_status = 'CLOSED';
								}
								
								$arr_ins[] = array(
									'td_id' => $id,
									'mp_id' => $params[1],
									'mp_code' => $params[2],
									'mp_category' => $params[3],
									'mp_name' => $params[4],
									'mu_code' => $params[5],
									'mu_name' => $params[6],
									'to_id' => $params[7],
									'to_no' => $params[8],
									'tod_qty' => $params[9],
									'tod_id' => $params[10],
									'mbp_price' => $params[13],
									'msp_price' => $params[11],
									'tdd_qty' => $post['qty'][$x],
									'tdd_status' => $new_status,
									'tdd_flag' => 1
								);
								
								// Update t_order_detail
								$outstanding = floatval($params[9])-floatval($post['qty'][$x]);
								$arr_upd1 = array(
									'td_outstanding' => $outstanding,
									'td_qty' => floatval($params[12])-$outstanding,
									'td_status' => $new_status
								);
								
								$arr_where_upd1 = array('tod_id'=>$params[10]);
								
								$this->db->where($arr_where_upd1);
								$this->db->update('t_order_detail',$arr_upd1);
							}
							$x++;
						}
						
						$this->db->insert_batch($this->table.'_detail', $arr_ins);
						
						// Update Order status
						$arr_params['status'] = $status; // array : status
						$arr_params['order_id'] = $order_ids; // array : po id
						$arr_params['td_id'] = $id;
						$this->update_order_status($arr_params);
						
						$this->session->set_flashdata('msg','Data tersimpan!');
						$this->session->set_flashdata('next_page',base_url($this->controller.'/print_del/'.$id));
						redirect($this->controller.'/create');
					}
				}
				
				// Form No
				$data['doc_no'] = $this->no_format->generate_delivery_no($data['date_now']);
				$data['company_address'] = $this->config->item('company_address');
				
				$this->load->view('admin/template/home',$data);
			}
			else {
				redirect('logout');
			}
		}
		
		function update_order_status($params=array()) {
			$this->load->model('model_order','mo');
			
			if(!empty($params)) {
				// Jumlah item receive >= jumlah item PO && detail status == 'CLOSED' : PO status => RECEIVED
				// Jumlah item receive != jumlah item PO && detail status == 'CLOSED,PENDING' : PO status => PARTIAL RECEIVED
				
				$arr_status = $params['status'];
				$arr_order_id = $params['order_id'];
				$jml_item_po = count($arr_order_id);
				$unique_arr_order_id = array_unique($arr_order_id);
				
				if($jml_item_po > 0) {
					foreach($unique_arr_order_id as $order_id) {
						/*
						$get_po_detail = $this->db->get_where('t_purchase_detail',array('tp_id'=>$order_id));
						$jml_item_receive = count($arr_status[$order_id]);
						
						if($jml_item_receive >= $get_po_detail->num_rows()) {
							$unique[$order_id] = array_unique($arr_status[$order_id]);
							if(in_array('PENDING',$unique[$order_id])) {
								$status[$order_id] = 'PARTIAL RECEIVED';
								$full_receive_date[$order_id] = date("Y-m-d");
							}
							else {
								$status[$order_id] = 'RECEIVED';
								$full_receive_date[$order_id] = date("Y-m-d");
							}
						}
						else {
							$status[$order_id] = 'PARTIAL RECEIVED';
							$full_receive_date[$order_id] = NULL;
						}
				
						$this->db->where(array('tp_id'=>$order_id));
						$this->db->update('t_purchase',array('tp_status'=>$status[$order_id],'tp_full_receive_date'=>$full_receive_date[$order_id]));
						
						$status = 'TRUE';
						*/
						
						if(intval($params['td_id']) != 0) {
							$this->db->where('td_id',$params['td_id']);
							$this->db->update('t_delivery',array('to_id'=>$order_id));
						}
						$order_status = $this->mo->get_order_status($order_id);
						$this->db->where(array('to_id'=>$order_id));
						$this->db->update('t_order',array('to_status'=>$order_status['status'],'to_full_delivery_date'=>$order_status['full_delivery_date']));
						
						$status = 'TRUE';
					}
				}
			}
			else {
				$status = 'FALSE';
			}
			
			return $status;
		}
		
		function edit($id=0){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Ubah Pengiriman',
						'page' => $this->folder_view.$this->controller.'/edit',
						//'js_page' => $this->folder_view.$this->controller.'/js',
						'js_page2' => $this->folder_view.$this->controller.'/js_edit',
						'js_scripts' => array(
							'vendors/jquery/dist/jquery.min', /* jQuery */
							'vendors/bootstrap/dist/js/bootstrap.min', /* Bootstrap */
							'vendors/fastclick/lib/fastclick', /* FastClick */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/iCheck/icheck.min', /* iCheck */
							'vendors/validator/validator', /* Validator.js */
							'js/moment/moment.min', /* Bootstrap daterangepicker */
							'js/datepicker/daterangepicker', /* Bootstrap daterangepicker */
							'vendors/select2/dist/js/select2.full.min', /* Select2 */	
							'vendors/datatables.net/js/jquery.dataTables.min', /* Datatables */
							'vendors/datatables.net-bs/js/dataTables.bootstrap.min', /* Datatables */
							'vendors/datatables.net-buttons/js/dataTables.buttons.min', /* Datatables */
							'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min', /* Datatables */
							'vendors/datatables.net-buttons/js/buttons.flash.min', /* Datatables */
							'vendors/datatables.net-buttons/js/buttons.html5.min', /* Datatables */
							'vendors/datatables.net-buttons/js/buttons.print.min', /* Datatables */
							'vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min', /* Datatables */
							'vendors/datatables.net-keytable/js/dataTables.keyTable.min', /* Datatables */
							'vendors/datatables.net-responsive/js/dataTables.responsive.min', /* Datatables */
							'vendors/datatables.net-responsive-bs/js/responsive.bootstrap', /* Datatables */
							'vendors/datatables.net-scroller/js/datatables.scroller.min', /* Datatables */
							'vendors/accounting/accounting.min', /* Accounting.js */							
							'vendors/bootbox/bootbox.min' /* Bootbox */
						),
						'css_scripts' => array(
							'vendors/bootstrap/dist/css/bootstrap.min', /* Bootstrap */
							'vendors/font-awesome/css/font-awesome.min', /* Font Awesome */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/iCheck/skins/flat/green', /* iCheck */
							'vendors/select2/dist/css/select2.min', /* Select2 */
							'vendors/datatables.net-bs/css/dataTables.bootstrap.min', /* Datatable */
							'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min', /* Datatable */
							'vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap', /* Datatable */
							'vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min', /* Datatable */
							'vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min' /* Datatable */
						),
						'date_now' => date('m/d/Y')
				);
				
				// Get delivery
				$q = $this->md->get_delivery(NULL,$id);
				$res = $q['row_array'];
				
				// Get delivery detail
				$q = $this->md->get_del_detail($id);
				$data['num_rows'] = $q['num_rows'];
				$data['result'] = $q['result'];
				
				$td_date = ($res['td_date'] != '' && $res['td_date'] != '0000-00-00' ? explode('-',$res['td_date']) : NULL); // yyyy-mm-dd
				
				$data['id'] = $id;
				$data['td_no'] = $res['td_no'];
				$data['td_date'] = ($td_date != NULL ? $td_date[1].'/'.$td_date[2].'/'.$td_date[0] : NULL);
				$data['mc_id'] = $res['mc_id'];
				$data['mc_code'] = $res['mc_code'];
				$data['mc_name'] = $res['mc_name'];
				$data['mc_phone1'] = $res['mc_phone1'];
				$data['mc_fax'] = $res['mc_fax'];
				$data['mc_email'] = $res['mc_email'];
				$data['td_desc'] = $res['td_desc'];
				$data['mc_address'] = $res['mc_address'];
				$data['to_pic'] = $res['to_pic'];
				$data['td_driver_name'] = $res['td_driver_name'];
				$data['td_car_no'] = $res['td_car_no'];
				
				if($_POST) {
					$post = $this->input->post();
					
					$cust = explode('|',$post['customer']);
					$date = explode('/',$post['tgl']); // mm/dd/yyyy
					
					// Get supplier
					$qs = $this->db->get_where('m_customer',array('mc_id'=>$cust[0]))->row_array();
					$no_doc = $this->no_format->generate_delivery_no($data['date_now']);
					
					// Insert : tbl_delivery
					$arr_ins0 = array(
						'td_no' => $no_doc,
						'mc_id' => $cust[0],
						'td_date' => $date[2].'-'.$date[0].'-'.$date[1],
						'mc_code' => $cust[1],
						'mc_name' => $cust[2],
						'mc_address' => $qs['mc_address'],
						'mc_phone1' => $qs['mc_phone1'],
						'mc_email' => $qs['mc_email'],
						'to_pic' => $post['up'],
						'td_desc' => $post['note'],
						'td_driver_name' => $post['driver_name'],
						'td_car_no' => $post['car_no'],
						'td_datetime_input' => date("Y-m-d H:i:s"),
						'td_flag' => 1
					);
					
					$this->db->where('td_id',$id);
					$this->db->update($this->table,$arr_ins0);
					$affectedRows = $this->db->affected_rows();
					
					//if($affectedRows > 0) {						
						$x = 0;
						$dateTkirim = array();
						$arr_ins = array();
						$arr_params = array();
						$order_ids = array();
						foreach($post['h_tdd_id'] as $item) {
							/*
							// Delete jika tpd_id tidak ada di form
							// Delete where not exist in array
							if(isset($post['t_tdd_id'])) {
								$arr_ids = array();
								foreach($post['t_tdd_id'] as $check) {
									$arr_ids[] = $check;
								}
								$this->db->where_not_in('trd_id',$arr_ids);
							}
							$this->db->where(array('td_id'=>$id));
							$this->db->update($this->table.'_detail', array('trd_flag'=>0));
							//echo $this->db->last_query();
							*/
							
							// Delete next received
							if(isset($post['h_tdd_id'])) {
								$arr_ids2 = array();
								foreach($post['h_tdd_id'] as $check) {
									$arr_ids2[] = $check;
								}
								$this->db->where_not_in('tdd_id',$arr_ids2);
							}
							$this->db->where(array('td_id'=>$id));
							$delOther = $this->db->get($this->table.'_detail');
							if($delOther->num_rows() > 0) {
								$dataOther = $delOther->result_array();
								foreach($dataOther as $row) {
									$this->db->where(array('mp_id'=>$row['mp_id'],'to_id'=>$row['to_id']));
									$this->db->update($this->table.'_detail',array('tdd_flag'=>0));
								}
							}
							
							//if($item != '0' && $item != '') {
								$params = explode('|', $post['h_params'][$x]);
								$order_ids[$x] = $params[7];
								$status = array();
								
								if(floatval($post['qty'][$x]) != floatval($params[9])) {
									// Delete t_delivery_detail with same order id & item id
									$arr_where_det = array('to_id'=>$params[7],'mp_id'=>$params[1],'tdd_id >'=>$params[0]);
									
									$this->db->where($arr_where_det);
									$this->db->update($this->table.'_detail', array('tdd_flag'=>0));
									
									if(intval($params[7]) != 0) {
										// Jml terima < dari jumlah di Order, status => PENDING
										// Jml terima = jumlah di Order, status => CLOSED
										if(floatval($params[12]) == floatval($post['qty'][$x])) {
											$status[$params[7]][$x] = 'CLOSED';
											$new_status = 'CLOSED'; 
										}
										else {
											$status[$params[7]][$x] = 'PENDING';
											$new_status = 'PENDING';
										}
									}
									else {
										$new_status = 'CLOSED';
									}
									
									$arr_ins = array(
										'td_id' => $id,
										'mp_id' => $params[1],
										'mp_code' => $params[2],
										'mp_category' => $params[3],
										'mp_name' => $params[4],
										'mu_code' => $params[5],
										'mu_name' => $params[6],
										'to_id' => $params[7],
										'to_no' => $params[8],
										'tod_id' => $params[10],
										'mbp_price' => $params[13],
										'msp_price' => $params[11],
										'tdd_qty' => $post['qty'][$x],
										'tdd_status' => $new_status,
										'tdd_flag' => 1
									);
									
									$this->db->where('tdd_id',$params[0]);
									$this->db->update($this->table.'_detail',$arr_ins);
									
									// Update t_order_detail
									$outstanding = floatval($params[9])-floatval($post['qty'][$x]);
									$arr_upd1 = array(
										'td_outstanding' => $outstanding,
										'td_qty' => floatval($params[12])-$outstanding,
										'td_status' => $new_status
									);
									
									$arr_where_upd1 = array('tod_id'=>$params[10]);
									
									$this->db->where($arr_where_upd1);
									$this->db->update('t_order_detail',$arr_upd1);
								}
							//}
							$x++;
						}
						
						// Update Order status
						$arr_params['status'] = $status; // array : status
						$arr_params['order_id'] = $order_ids; // array : po id
						$arr_params['td_id'] = $id;
						$this->update_order_status($arr_params);
						
						$this->session->set_flashdata('msg','Data tersimpan!');
						$this->session->set_flashdata('next_page',base_url($this->controller.'/print_del/'.$id));
						redirect($this->controller.'/edit/'.$id);
					//}
				}
				
				$this->load->view('admin/template/home',$data);
				
			}
			else {
				redirect('logout');
			}
		}
		
		function delete() {
			if($_POST) {
				// Delete table detail
				$this->db->where('td_id',$this->input->post('id'));
				$this->db->update($this->table.'_detail',array('tdd_flag'=>0));
				
				// Delete table
				$this->db->where('td_id',$this->input->post('id'));
				$this->db->update($this->table,array('td_flag'=>0));
				
				// Update Order status
				$this->md->update_order_status($this->input->post('id'));
				$res['status'] = 'TRUE';
			}
			else {
				$res['status'] = 'FALSE';
			}
			
			echo json_encode($res);
		}
		
		function show_modal() {
			if($_POST) {
				$exp = explode('|',$this->input->post('id'));
				// Get Harga
				$q = $this->md->get_price($exp[0],$this->input->post('mp_id',array()));
				$data['num_rows_det'] = $q['num_rows'];
				$data['result_det'] = $q['result'];
				
				$this->load->view($this->folder_view.$this->controller.'/create_modal',$data);
			} else {
				echo "Invalid result!";
			}
		}
		
		function submit_detail() {
			if($_POST) {
				if($this->input->post('id','') == '') {
					echo "Silahkan pilih supplier!";
				}
				else {		
					//$id = explode('-',$this->input->post('id',NULL));
					$id = $this->input->post('id',NULL);
					// Get Harga
					$this->db->where_in('mbp_id',$id);
					$q = $this->db->get('m_price');
					$data['num_rows'] = $q->num_rows();
					$data['result'] = $q->result_array();
					
					$this->load->view($this->folder_view.$this->controller.'/create_detail',$data);
				}
			}
			else echo "Invalid result!";
		}
		
		/**
		* Show modal : Choose Order
		**/
		function show_modal2() {
			if($_POST) {
				$exp = explode('|',$this->input->post('id'));
				// Get Harga
				$q = $this->md->get_order($exp[0],$this->input->post('o_id',array()),'CLOSED');
				$data['num_rows_det'] = $q['num_rows'];
				$data['result_det'] = $q['result'];
				
				$this->load->view($this->folder_view.$this->controller.'/create_modal2',$data);
			} else {
				echo "Invalid result!";
			}
		}
		
		function submit_detail2() {
			if($_POST) {
				if($this->input->post('id','') == '') {
					echo "Silahkan pilih customer!";
				}
				else {		
					$id = $this->input->post('id',NULL);
					// Get Detail Order
					$q = $this->md->get_order_detail($id);
					$data['num_rows'] = $q['num_rows'];
					$data['result'] = $q['result'];
					
					$this->load->view($this->folder_view.$this->controller.'/create_detail2',$data);
				}
			}
			else echo "Invalid result!";
		}
		
		function print_del($d_id=0) {
			$this->is_logged_in();
			if( ! empty( $this->auth_role ) ) {
				if($d_id != 0) {
					$data = array(
							'site_title' => $this->site_title,
							'page_title' => 'Cetak Surat Jalan',
							'page' => $this->folder_view.$this->controller.'/print',
							'js_scripts' => array(
								'vendors/jquery/dist/jquery.min', /* jQuery */
								'vendors/bootstrap/dist/js/bootstrap.min', /* Bootstrap */
								'vendors/fastclick/lib/fastclick', /* FastClick */
								'vendors/nprogress/nprogress' /* NProgress */
							),
							'css_scripts' => array(
								'vendors/bootstrap/dist/css/bootstrap.min', /* Bootstrap */
								'vendors/font-awesome/css/font-awesome.min', /* Font Awesome */
								'vendors/nprogress/nprogress' /* NProgress */
							),
							'date_now' => date('m/d/Y')
					);
					
					// Get Company Data
					$data['company_name'] = $this->config->item('company_name');
					$data['company_address'] = $this->config->item('company_address');
					$data['company_phone'] = $this->config->item('company_phone');
					$data['company_fax'] = $this->config->item('company_fax');
					$data['company_email'] = $this->config->item('company_email');
					
					// Get Delivery
					$user = get_user($this->auth_user_id);
					$q = $this->db->get_where('t_delivery',array('td_id'=>$d_id))->row_array();
					$data['mc_id'] = $q['mc_id'];
					$data['td_no'] = $q['td_no'];
					$data['mc_name'] = $q['mc_name'];
					$data['mc_address'] = $q['mc_address'];
					$data['mc_phone1'] = $q['mc_phone1'];
					$data['mc_fax'] = $q['mc_fax'];
					$data['mc_email'] = $q['mc_email'];
					$data['td_desc'] = $q['td_desc'];
					$data['to_pic'] = $q['to_pic'];
					$data['td_driver_name'] = $q['td_driver_name'];
					$data['prepared_by'] = $user['full_name'];
					
					// Get Delivery Detail
					//$q2 = $this->db->get_where('t_receiving_detail', array('td_id'=>$d_id,'trd_flag'=>1));
					$query2 = $this->md->get_del_detail($d_id);
					$q2 = $query2['result'];
					$data['num_rows'] = $query2['num_rows'];
					$data['result'] = $query2['result'];
					
					$this->load->view('admin/template/home',$data);
				}
			}
		}
		
		function pdf($order_id=0){
			$data = array(
					'site_title' => $this->site_title,
					'page_title' => 'Cetak PO',
					'page' => $this->folder_view.$this->controller.'/pdf_po',
					'date_now' => date('m/d/Y')
			);
			
			// Get Company Data
			$data['company_name'] = $this->config->item('company_name');
			$data['company_address'] = $this->config->item('company_address');
			$data['company_phone'] = $this->config->item('company_phone');
			$data['company_fax'] = $this->config->item('company_fax');
			$data['company_email'] = $this->config->item('company_email');
			
			// Get PO
			$q = $this->db->get_where('t_purchase',array('tp_id'=>$order_id))->row_array();
			$data['tp_no'] = $q['tp_no'];
			$data['mc_id'] = $q['mc_id'];
			$data['mc_name'] = $q['mc_name'];
			$data['mc_address'] = $q['mc_address'];
			$data['mc_phone1'] = $q['mc_phone1'];
			$data['mc_fax'] = $q['mc_fax'];
			$data['mc_email'] = $q['mc_email'];
			$data['tp_pic'] = $q['tp_pic'];
			$data['tp_date'] = $this->tanggal->tgl_indo4($q['tp_date']);
			$data['tp_description'] = $q['tp_description'];
			$data['tp_subtotal'] = $this->no_format->idr_money($q['tp_subtotal']);
			$data['tp_disc'] = $q['tp_disc'];
			$data['tp_disc_nominal'] = $this->no_format->idr_money($q['tp_disc_nominal']);
			$data['tp_ppn'] = $q['tp_ppn'];
			$data['tp_ppn_nominal'] = $this->no_format->idr_money($q['tp_ppn_nominal']);
			$data['tp_total'] = $this->no_format->idr_money($q['tp_total']);
			$data['prepared_by'] = $this->config->item('company_prepared_by');
			
			// Get PO Detail
			$q2 = $this->db->get_where('t_purchase_detail', array('tp_id'=>$order_id,'tpd_flag'=>1));
			$data['num_rows'] = $q2->num_rows();
			$data['result'] = $q2->result_array();
			
			$this->load->view($this->folder_view.$this->controller.'/pdf_po',$data);
			// Get output html
			//$html = $this->output->get_output();
			
			// Load library
			//$this->load->library('dompdf_gen');
			
			// Convert to PDF
			//$this->dompdf->load_html($html);
			//$this->dompdf->set_paper('A4', 'portrait');
			//$this->dompdf->render();
			//$this->dompdf->stream("welcome.pdf");
			
			//$this->pdf->load_view($html);
			// (Optional) Setup the paper size and orientation
			/**
			* paper size : 'letter', 'A4', 'legal'
			* orientation : 'portrait' (default), 'landscape'
			*/
			//$this->pdf->set_paper('A4', 'portrait');
			//$this->pdf->render();
			//$this->pdf->stream("name-file.pdf");
		}
		
		function pdf2($order_id=0){
			$data = array(
					'site_title' => $this->site_title,
					'page_title' => 'Ubah PO',
					'page' => $this->folder_view.$this->controller.'/pdf_po',
					'js_scripts' => array(
						'vendors/jquery/dist/jquery.min', /* jQuery */
						'vendors/bootstrap/dist/js/bootstrap.min', /* Bootstrap */
						'vendors/fastclick/lib/fastclick', /* FastClick */
						'vendors/nprogress/nprogress' /* NProgress */
					),
					'css_scripts' => array(
						'vendors/bootstrap/dist/css/bootstrap.min', /* Bootstrap */
						'vendors/font-awesome/css/font-awesome.min', /* Font Awesome */
						'vendors/nprogress/nprogress' /* NProgress */
					),
					'date_now' => date('m/d/Y')
			);
			
			// Get Company Data
			$data['company_name'] = $this->config->item('company_name');
			$data['company_address'] = $this->config->item('company_address');
			$data['company_phone'] = $this->config->item('company_phone');
			$data['company_fax'] = $this->config->item('company_fax');
			$data['company_email'] = $this->config->item('company_email');
			
			// Get PO
			$q = $this->db->get_where('t_purchase',array('tp_id'=>$order_id))->row_array();
			$data['mc_id'] = $q['mc_id'];
			$data['mc_name'] = $q['mc_name'];
			$data['mc_address'] = $q['mc_address'];
			$data['mc_phone1'] = $q['mc_phone1'];
			$data['mc_fax'] = $q['mc_fax'];
			$data['mc_email'] = $q['mc_email'];
			$data['tp_pic'] = $q['tp_pic'];
			$data['tp_date'] = $this->tanggal->tgl_indo4($q['tp_date']);
			$data['tp_description'] = $q['tp_description'];
			$data['tp_subtotal'] = $this->no_format->idr_money($q['tp_subtotal']);
			$data['tp_disc'] = $q['tp_disc'];
			$data['tp_disc_nominal'] = $this->no_format->idr_money($q['tp_disc_nominal']);
			$data['tp_ppn'] = $q['tp_ppn'];
			$data['tp_ppn_nominal'] = $this->no_format->idr_money($q['tp_ppn_nominal']);
			$data['tp_total'] = $this->no_format->idr_money($q['tp_total']);
			$data['prepared_by'] = $this->config->item('company_prepared_by');
			
			// Get PO Detail
			$q2 = $this->db->get_where('t_purchase_detail', array('tp_id'=>$order_id,'tpd_flag'=>1));
			$data['num_rows'] = $q2->num_rows();
			$data['result'] = $q2->result_array();
				
			$this->load->view($this->folder_view.$this->controller.'/pdf_po');
			// (Optional) Setup the paper size and orientation
			/**
			* paper size : 'letter', 'A4', 'legal'
			* orientation : 'portrait' (default), 'landscape'
			*/
			$this->pdf->set_paper('legal', 'portrait');
			$this->pdf->render();
			$this->pdf->stream("name-file.pdf");
		}
		
		function report_delivery(){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Laporan Penjualan Per-Customer',
						'page' => $this->folder_view.$this->controller.'/report_filter',
						'js_page' => $this->folder_view.$this->controller.'/js',
						'js_scripts' => array(
							'vendors/jquery/dist/jquery.min', /* jQuery */
							'vendors/bootstrap/dist/js/bootstrap.min', /* Bootstrap */
							'vendors/fastclick/lib/fastclick', /* FastClick */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/iCheck/icheck.min', /* iCheck */
							'vendors/validator/validator', /* Validator.js */
							'js/moment/moment.min', /* Bootstrap daterangepicker */
							'js/datepicker/daterangepicker', /* Bootstrap daterangepicker */
							'vendors/select2/dist/js/select2.full.min', /* Select2 */							
							'vendors/bootbox/bootbox.min' /* Bootbox */
						),
						'css_scripts' => array(
							'vendors/bootstrap/dist/css/bootstrap.min', /* Bootstrap */
							'vendors/font-awesome/css/font-awesome.min', /* Font Awesome */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/iCheck/skins/flat/green', /* iCheck */
							'vendors/select2/dist/css/select2.min' /* Select2 */
						),
						'date_now' => date('m/d/Y')
				);
				
				if($_POST) {
					$post = $this->input->post();
					$cust = explode('|',$post['customer']);
					$date = explode('/',$post['tgl_from']); // mm/dd/yyyy
					$date2 = explode('/',$post['tgl_to']); // mm/dd/yyyy
					
					// Get supplier
					$qs = $this->db->get_where('m_customer',array('mc_id'=>$cust[0]))->row_array();
					$no_doc = $this->no_format->generate_receiving_no($data['date_now']);
					
					$mc_id = ($cust[0] == '' ? 0 : $cust[0]);
					$tgl_from = $date[2].'-'.$date[0].'-'.$date[1];
					$tgl_to = $date2[2].'-'.$date2[0].'-'.$date2[1];
					
					$this->session->set_flashdata('next_page',base_url($this->controller.'/print_report/'.$mc_id.'/'.$tgl_from.'/'.$tgl_to));
				}
				
				// Form No
				$data['doc_no'] = $this->no_format->generate_delivery_no($data['date_now']);
				$data['company_address'] = $this->config->item('company_address');
				
				$this->load->view('admin/template/home',$data);
			}
			else {
				redirect('logout');
			}
		}
		
		function print_report($cust_id=0,$tgl_from=NULL,$tgl_to=NULL) {
			$this->is_logged_in();
			if( ! empty( $this->auth_role ) ) {
				if($cust_id != 0) {
					$data = array(
							'site_title' => $this->site_title,
							'page_title' => 'Cetak Report Delivery',
							'page' => $this->folder_view.$this->controller.'/print_report',
							'js_scripts' => array(
								'vendors/jquery/dist/jquery.min', /* jQuery */
								'vendors/bootstrap/dist/js/bootstrap.min', /* Bootstrap */
								'vendors/fastclick/lib/fastclick', /* FastClick */
								'vendors/nprogress/nprogress' /* NProgress */
							),
							'css_scripts' => array(
								'vendors/bootstrap/dist/css/bootstrap.min', /* Bootstrap */
								'vendors/font-awesome/css/font-awesome.min', /* Font Awesome */
								'vendors/nprogress/nprogress' /* NProgress */
							),
							'date_now' => date('m/d/Y')
					);
					
					// Get Customer
					$cust = $this->db->get_where('m_customer', array('mc_id'=>$cust_id))->row_array();
					$data['mc_id'] = $cust_id;
					$data['mc_name'] = $cust['mc_name'];
					$data['mc_code'] = $cust['mc_code'];
					$data['mc_address'] = $cust['mc_address'];
					$data['mc_phone1'] = $cust['mc_phone1'];
					$data['mc_fax'] = $cust['mc_fax'];
					$data['mc_email'] = $cust['mc_email'];
					$data['str_tgl_from'] = $this->tanggal->tgl_indo2($tgl_from);
					$data['str_tgl_to'] = $this->tanggal->tgl_indo2($tgl_to);
					$user = get_user($this->auth_user_id);
					$data['prepared_by'] = $user['full_name'];
					
					// Get Delivery
					$user = get_user($this->auth_user_id);
					$q = $this->md->report_delivery($cust_id,$tgl_from,$tgl_to);
					$data['result'] = $q['result'];
					
					$data['arr_mp_id'] = array_unique($q['arr_mp_id']);
					$data['arr_mp_name'] = array_unique($q['arr_mp_name']);
					sort($data['arr_mp_name']);
					$data['arr_date'] = array_unique($q['arr_tr_ship_date']);
					$data['arr_tr_ship_date'] = array_unique($q['arr_tr_ship_date']);
					
					$this->load->view('admin/template/home',$data);
				}
			}
		}
	}