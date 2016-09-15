<?php
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class Receiving extends MY_Controller {
		private $folder_view = 'admin/purchasing/';
		private $controller = 'receiving';
		private $table = 't_receiving';
		private $table2 = 't_purchase';
		
		function __construct() {
			parent::__construct();
			
			date_default_timezone_set('Asia/Jakarta');
			
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('model_receiving','mr');
			$this->load->library(array('no_format','tanggal'));
		}
		
		function index(){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Daftar Receive Item',
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
				
				// Get Receiving
				$q = $this->mr->get_receiving();
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
						'page_title' => 'Buat Receive Item',
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
					$supp = explode('|',$post['supplier']);
					$date = explode('/',$post['tgl']); // mm/dd/yyyy
					$date2 = explode('/',$post['tgl_receiving']); // mm/dd/yyyy
					
					// Get supplier
					$qs = $this->db->get_where('m_supplier',array('ms_id'=>$supp[0]))->row_array();
					$no_doc = $this->no_format->generate_receiving_no($data['date_now']);
					
					// Insert : tbl_receiving
					$arr_ins0 = array(
						'tr_no' => $no_doc,
						'ms_id' => $supp[0],
						'tr_date' => $date[2].'-'.$date[0].'-'.$date[1],
						'tr_ship_date' => $date2[2].'-'.$date2[0].'-'.$date2[1],
						'tr_ship_no' => $post['no_sj'],
						'ms_code' => $supp[1],
						'ms_name' => $supp[2],
						'ms_address' => $qs['ms_address'],
						'ms_phone1' => $qs['ms_phone1'],
						'ms_email' => $qs['ms_email'],
						'tr_desc' => $post['note'],
						'tr_datetime_input' => date("Y-m-d H:i:s"),
						'tr_flag' => 1
					);
					if($this->db->insert($this->table,$arr_ins0)) {
						$id = $this->db->insert_id();
						
						$x = 0;
						$dateTkirim = array();
						$arr_ins = array();
						$arr_params = array();
						$po_ids = array();
						foreach($post['qty'] as $item) {
							if($item != '0' && $item != '') {
								$params = explode('|', $post['h_params'][$x]);
								$po_ids[$x] = $params[7];
								
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
									'tr_id' => $id,
									'mp_id' => $params[1],
									'mp_code' => $params[2],
									'mp_category' => $params[3],
									'mp_name' => $params[4],
									'mu_code' => $params[5],
									'mu_name' => $params[6],
									'tp_id' => $params[7],
									'tp_no' => $params[8],
									'tpd_qty' => $params[9],
									'tpd_id' => $params[10],
									'mbp_price' => $params[11],
									'trd_qty' => $post['qty'][$x],
									'trd_status' => $new_status,
									'trd_flag' => 1
								);
								
								// Update t_purchase_detail
								$outstanding = floatval($params[9])-floatval($post['qty'][$x]);
								$arr_upd1 = array(
									'tpd_outstanding' => $outstanding,
									'trd_qty' => floatval($params[12])-$outstanding,
									'trd_status' => $new_status
								);
								
								$arr_where_upd1 = array('tpd_id'=>$params[10]);
								
								$this->db->where($arr_where_upd1);
								$this->db->update('t_purchase_detail',$arr_upd1);
							}
							$x++;
						}
						
						$this->db->insert_batch($this->table.'_detail', $arr_ins);
						
						// Update PO status
						$arr_params['status'] = $status; // array : status
						$arr_params['po_id'] = $po_ids; // array : po id
						$arr_params['tr_id'] = $id;
						$this->update_po_status($arr_params);
						
						$this->session->set_flashdata('msg','Data tersimpan!');
						$this->session->set_flashdata('next_page',base_url($this->controller.'/print_rec/'.$id));
						redirect($this->controller.'/create');
					}
				}
				
				// Form No
				$data['doc_no'] = $this->no_format->generate_receiving_no($data['date_now']);
				$data['company_address'] = $this->config->item('company_address');
				
				$this->load->view('admin/template/home',$data);
			}
			else {
				redirect('logout');
			}
		}
		
		function update_po_status($params=array()) {
			$this->load->model('model_po','mp');
			
			if(!empty($params)) {
				// Jumlah item receive >= jumlah item PO && detail status == 'CLOSED' : PO status => RECEIVED
				// Jumlah item receive != jumlah item PO && detail status == 'CLOSED,PENDING' : PO status => PARTIAL RECEIVED
				
				$arr_status = $params['status'];
				$arr_po_id = $params['po_id'];
				$jml_item_po = count($arr_po_id);
				$unique_arr_po_id = array_unique($arr_po_id);
				
				if($jml_item_po > 0) {
					foreach($unique_arr_po_id as $po_id) {
						/*
						$get_po_detail = $this->db->get_where('t_purchase_detail',array('tp_id'=>$po_id));
						$jml_item_receive = count($arr_status[$po_id]);
						
						if($jml_item_receive >= $get_po_detail->num_rows()) {
							$unique[$po_id] = array_unique($arr_status[$po_id]);
							if(in_array('PENDING',$unique[$po_id])) {
								$status[$po_id] = 'PARTIAL RECEIVED';
								$full_receive_date[$po_id] = date("Y-m-d");
							}
							else {
								$status[$po_id] = 'RECEIVED';
								$full_receive_date[$po_id] = date("Y-m-d");
							}
						}
						else {
							$status[$po_id] = 'PARTIAL RECEIVED';
							$full_receive_date[$po_id] = NULL;
						}
				
						$this->db->where(array('tp_id'=>$po_id));
						$this->db->update('t_purchase',array('tp_status'=>$status[$po_id],'tp_full_receive_date'=>$full_receive_date[$po_id]));
						
						$status = 'TRUE';
						*/
						
						if(intval($params['tr_id']) != 0) {
							$this->db->where('tr_id',$params['tr_id']);
							$this->db->update('t_receiving',array('tp_id'=>$po_id));
						}
						$po_status = $this->mp->get_po_status($po_id);
						$this->db->where(array('tp_id'=>$po_id));
						$this->db->update('t_purchase',array('tp_status'=>$po_status['status'],'tp_full_receive_date'=>$po_status['full_receive_date']));
						
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
						'page_title' => 'Ubah Receive Item',
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
				
				// Get receiving
				$q = $this->mr->get_receiving(NULL,$id);
				$res = $q['row_array'];
				
				// Get receiving detail
				$q = $this->mr->get_rec_detail($id);
				$data['num_rows'] = $q['num_rows'];
				$data['result'] = $q['result'];
				
				$tr_date = ($res['tr_date'] != '' && $res['tr_date'] != '0000-00-00' ? explode('-',$res['tr_date']) : NULL); // yyyy-mm-dd
				$tr_sdate = ($res['tr_ship_date'] != '' && $res['tr_ship_date'] != '0000-00-00' ? explode('-',$res['tr_ship_date']) : NULL); // yyyy-mm-dd
				
				$data['id'] = $id;
				$data['tr_no'] = $res['tr_no'];
				$data['tr_ship_no'] = $res['tr_ship_no'];
				$data['tr_date'] = ($tr_date != NULL ? $tr_date[1].'/'.$tr_date[2].'/'.$tr_date[0] : NULL);
				$data['tr_ship_date'] = ($tr_sdate != NULL ? $tr_sdate[1].'/'.$tr_sdate[2].'/'.$tr_sdate[0] : NULL);
				$data['ms_id'] = $res['ms_id'];
				$data['ms_code'] = $res['ms_code'];
				$data['ms_name'] = $res['ms_name'];
				$data['ms_phone1'] = $res['ms_phone1'];
				$data['ms_fax'] = $res['ms_fax'];
				$data['ms_email'] = $res['ms_email'];
				$data['tr_desc'] = $res['tr_desc'];
				$data['ms_address'] = $res['ms_address'];
				
				if($_POST) {
					$post = $this->input->post();
					
					$supp = explode('|',$post['supplier']);
					$date = explode('/',$post['tgl']); // mm/dd/yyyy
					$date2 = explode('/',$post['tgl_receiving']); // mm/dd/yyyy
					
					// Get supplier
					$qs = $this->db->get_where('m_supplier',array('ms_id'=>$supp[0]))->row_array();
					$no_doc = $this->no_format->generate_receiving_no($data['date_now']);
					
					// Insert : tbl_receiving
					$arr_ins0 = array(
						'tr_no' => $no_doc,
						'ms_id' => $supp[0],
						'tr_date' => $date[2].'-'.$date[0].'-'.$date[1],
						'tr_ship_date' => $date2[2].'-'.$date2[0].'-'.$date2[1],
						'tr_ship_no' => $post['no_sj'],
						'ms_code' => $supp[1],
						'ms_name' => $supp[2],
						'ms_address' => $qs['ms_address'],
						'ms_phone1' => $qs['ms_phone1'],
						'ms_email' => $qs['ms_email'],
						'tr_desc' => $post['note']
					);
					
					$this->db->where('tr_id',$id);
					$this->db->update($this->table,$arr_ins0);
					$affectedRows = $this->db->affected_rows();
					
					//if($affectedRows > 0) {						
						$x = 0;
						$dateTkirim = array();
						$arr_ins = array();
						$arr_params = array();
						$po_ids = array();
						foreach($post['h_trd_id'] as $item) {
							/*
							// Delete jika tpd_id tidak ada di form
							// Delete where not exist in array
							if(isset($post['h_trd_id'])) {
								$arr_ids = array();
								foreach($post['h_trd_id'] as $check) {
									$arr_ids[] = $check;
								}
								$this->db->where_not_in('trd_id',$arr_ids);
							}
							$this->db->where(array('tr_id'=>$id));
							$this->db->update($this->table.'_detail', array('trd_flag'=>0));
							//echo $this->db->last_query();
							*/
							
							// Delete next received
							if(isset($post['h_trd_id'])) {
								$arr_ids2 = array();
								foreach($post['h_trd_id'] as $check) {
									$arr_ids2[] = $check;
								}
								$this->db->where_not_in('trd_id',$arr_ids2);
							}
							$this->db->where(array('tr_id'=>$id));
							$delOther = $this->db->get($this->table.'_detail');
							if($delOther->num_rows() > 0) {
								$dataOther = $delOther->result_array();
								foreach($dataOther as $row) {
									$this->db->where(array('mp_id'=>$row['mp_id'],'tp_id'=>$row['tp_id']));
									$this->db->update($this->table.'_detail',array('trd_flag'=>0));
								}
							}
							
							//if($item != '0' && $item != '') {
								$params = explode('|', $post['h_params'][$x]);
								$po_ids[$x] = $params[7];
								$status = array();
								
								if(floatval($post['qty'][$x]) != floatval($params[9])) {
									// Delete t_receiving_detail with same po id & item id
									$arr_where_det = array('tp_id'=>$params[7],'mp_id'=>$params[1],'trd_id >'=>$params[0]);
									
									$this->db->where($arr_where_det);
									$this->db->update($this->table.'_detail', array('trd_flag'=>0));
									
									if(intval($params[7]) != 0) {
										// Jml terima < dari jumlah di PO, status => PENDING
										// Jml terima = jumlah di PO, status => CLOSED
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
										'tr_id' => $id,
										'mp_id' => $params[1],
										'mp_code' => $params[2],
										'mp_category' => $params[3],
										'mp_name' => $params[4],
										'mu_code' => $params[5],
										'mu_name' => $params[6],
										'tp_id' => $params[7],
										'tp_no' => $params[8],
										'tpd_id' => $params[10],
										'mbp_price' => $params[11],
										'trd_qty' => $post['qty'][$x],
										'trd_status' => $new_status,
										'trd_flag' => 1
									);
									
									$this->db->where('trd_id',$params[0]);
									$this->db->update($this->table.'_detail',$arr_ins);
									
									// Update t_purchase_detail
									$outstanding = floatval($params[12])-floatval($post['qty'][$x]);
									$arr_upd1 = array(
										'tpd_outstanding' => $outstanding,
										'trd_qty' => floatval($params[12])-$outstanding,
										'trd_status' => $new_status
									);
									
									$arr_where_upd1 = array('tpd_id'=>$params[10]);
									
									$this->db->where($arr_where_upd1);
									$this->db->update('t_purchase_detail',$arr_upd1);
									//echo $this->db->last_query();
								}
							//}
							$x++;
						}
						
						//$this->db->insert_batch($this->table.'_detail', $arr_ins);
						
						// Update PO status
						$arr_params['status'] = $status; // array : status
						$arr_params['po_id'] = $po_ids; // array : po id
						$this->update_po_status($arr_params);
						
						$this->session->set_flashdata('msg','Data tersimpan!');
						$this->session->set_flashdata('next_page',base_url($this->controller.'/print_rec/'.$id));
						redirect($this->controller.'/edit/'.$id.'/'.$sup_id);
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
				$this->db->where('tr_id',$this->input->post('id'));
				$this->db->update($this->table.'_detail',array('trd_flag'=>0));
				
				// Delete table
				$this->db->where('tr_id',$this->input->post('id'));
				$this->db->update($this->table,array('tr_flag'=>0));
				
				// Update PO status
				$this->mr->update_po_status($this->input->post('id'));
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
				$q = $this->mr->get_price($exp[0],$this->input->post('mp_id',array()));
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
		* Show modal : Choose PO
		**/
		function show_modal2() {
			if($_POST) {
				$exp = explode('|',$this->input->post('id'));
				// Get Harga
				$q = $this->mr->get_po($exp[0],$this->input->post('po_id',array()),'CLOSED');
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
					echo "Silahkan pilih supplier!";
				}
				else {		
					$id = $this->input->post('id',NULL);
					// Get Detail PO
					$q = $this->mr->get_po_detail($id);
					$data['num_rows'] = $q['num_rows'];
					$data['result'] = $q['result'];
					
					$this->load->view($this->folder_view.$this->controller.'/create_detail2',$data);
				}
			}
			else echo "Invalid result!";
		}
		
		function print_rec($r_id=0) {
			$this->is_logged_in();
			if( ! empty( $this->auth_role ) ) {
				if($r_id != 0) {
					$data = array(
							'site_title' => $this->site_title,
							'page_title' => 'Cetak Receiving Item',
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
					
					// Get Receiving
					$user = get_user($this->auth_user_id);
					$q = $this->db->get_where('t_receiving',array('tr_id'=>$r_id))->row_array();
					$data['ms_id'] = $q['ms_id'];
					$data['tr_no'] = $q['tr_no'];
					$data['ms_name'] = $q['ms_name'];
					$data['ms_address'] = $q['ms_address'];
					$data['ms_phone1'] = $q['ms_phone1'];
					$data['ms_fax'] = $q['ms_fax'];
					$data['ms_email'] = $q['ms_email'];
					$data['tr_ship_no'] = $q['tr_ship_no'];
					$data['tr_ship_date'] = $this->tanggal->tgl_indo4($q['tr_ship_date']);
					$data['tr_desc'] = $q['tr_desc'];
					$data['prepared_by'] = $user['full_name'];
					
					// Get Receiving Detail
					//$q2 = $this->db->get_where('t_receiving_detail', array('tr_id'=>$r_id,'trd_flag'=>1));
					$query2 = $this->mr->get_rec_detail($r_id);
					$q2 = $query2['result'];
					$data['num_rows'] = $query2['num_rows'];
					$data['result'] = $query2['result'];
					
					$this->load->view('admin/template/home',$data);
				}
			}
		}
		
		function pdf($po_id=0){
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
			$q = $this->db->get_where('t_purchase',array('tp_id'=>$po_id))->row_array();
			$data['tp_no'] = $q['tp_no'];
			$data['ms_id'] = $q['ms_id'];
			$data['ms_name'] = $q['ms_name'];
			$data['ms_address'] = $q['ms_address'];
			$data['ms_phone1'] = $q['ms_phone1'];
			$data['ms_fax'] = $q['ms_fax'];
			$data['ms_email'] = $q['ms_email'];
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
			$q2 = $this->db->get_where('t_purchase_detail', array('tp_id'=>$po_id,'tpd_flag'=>1));
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
		
		function pdf2($po_id=0){
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
			$q = $this->db->get_where('t_purchase',array('tp_id'=>$po_id))->row_array();
			$data['ms_id'] = $q['ms_id'];
			$data['ms_name'] = $q['ms_name'];
			$data['ms_address'] = $q['ms_address'];
			$data['ms_phone1'] = $q['ms_phone1'];
			$data['ms_fax'] = $q['ms_fax'];
			$data['ms_email'] = $q['ms_email'];
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
			$q2 = $this->db->get_where('t_purchase_detail', array('tp_id'=>$po_id,'tpd_flag'=>1));
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
						'page_title' => 'Laporan Pembelian Per-Supplier',
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
					$supp = explode('|',$post['supplier']);
					$date = explode('/',$post['tgl_from']); // mm/dd/yyyy
					$date2 = explode('/',$post['tgl_to']); // mm/dd/yyyy
					
					// Get supplier
					$qs = $this->db->get_where('m_supplier',array('ms_id'=>$supp[0]))->row_array();
					$no_doc = $this->no_format->generate_receiving_no($data['date_now']);
					
					$ms_id = ($supp[0] == '' ? 0 : $supp[0]);
					$tgl_from = $date[2].'-'.$date[0].'-'.$date[1];
					$tgl_to = $date2[2].'-'.$date2[0].'-'.$date2[1];
					
					$this->session->set_flashdata('next_page',base_url($this->controller.'/print_report/'.$ms_id.'/'.$tgl_from.'/'.$tgl_to));
				}
				
				// Form No
				$data['doc_no'] = $this->no_format->generate_receiving_no($data['date_now']);
				$data['company_address'] = $this->config->item('company_address');
				
				$this->load->view('admin/template/home',$data);
			}
			else {
				redirect('logout');
			}
		}
		
		function print_report($sup_id=0,$tgl_from=NULL,$tgl_to=NULL) {
			$this->is_logged_in();
			if( ! empty( $this->auth_role ) ) {
				if($sup_id != 0) {
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
					
					// Get Supplier
					$sup = $this->db->get_where('m_supplier', array('ms_id'=>$sup_id))->row_array();
					$data['ms_id'] = $sup_id;
					$data['ms_name'] = $sup['ms_name'];
					$data['ms_code'] = $sup['ms_code'];
					$data['ms_address'] = $sup['ms_address'];
					$data['ms_phone1'] = $sup['ms_phone1'];
					$data['ms_fax'] = $sup['ms_fax'];
					$data['ms_email'] = $sup['ms_email'];
					$data['str_tgl_from'] = $this->tanggal->tgl_indo2($tgl_from);
					$data['str_tgl_to'] = $this->tanggal->tgl_indo2($tgl_to);
					$user = get_user($this->auth_user_id);
					$data['prepared_by'] = $user['full_name'];
					
					// Get Receiving
					$user = get_user($this->auth_user_id);
					$q = $this->mr->report_delivery($sup_id,$tgl_from,$tgl_to);
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