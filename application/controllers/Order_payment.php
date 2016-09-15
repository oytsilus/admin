<?php
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class Order_payment extends MY_Controller {
		private $folder_view = 'admin/sales/';
		private $controller = 'order_payment';
		private $table = 't_order_payment';
		private $table2 = 't_order_payment_detail';
		
		function __construct() {
			parent::__construct();
			
			date_default_timezone_set('Asia/Jakarta');
			
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('model_order_payment','mo');
			$this->load->library(array('no_format','tanggal','string'));
		}
		
		function index(){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Daftar Pembayaran',
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
				
				// Get payment
				$q = $this->mo->get_payment();
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
						'page_title' => 'Buat Pembayaran',
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
					$supp = explode('|',$post['customer']);
					$date = explode('/',$post['tgl']); // mm/dd/yyyy
					
					// Get customer
					$qs = $this->db->get_where('m_customer',array('mc_id'=>$supp[0]))->row_array();
					$no_doc = $this->no_format->generate_op_no($data['date_now']);
					
					// Get PO No
					$order_no = array();
					$order_id = array();
					
					if(count($post['h_order_no']) > 0) {
						foreach($post['h_order_no'] as $po) {
							$order_no[] = $po;
						}
					}
					$unique_order_no = array_unique($order_no);
					
					if(count($post['h_order_id']) > 0) {
						foreach($post['h_order_id'] as $poID) {
							$order_id[] = $poID;
						}
					}
					$unique_order_id = array_unique($order_id);
					
					// Insert : tbl_order_payment
					$arr_ins0 = array(
						'top_no' => $no_doc,
						'mc_id' => $supp[0],
						'top_date' => $date[2].'-'.$date[0].'-'.$date[1],
						'top_total' => $post['total'],
						'mc_code' => $supp[1],
						'mc_name' => $supp[2],
						'mc_address' => $qs['mc_address'],
						'mc_phone1' => $qs['mc_phone1'],
						'mc_email' => $qs['mc_email'],
						'mc_fax' => $qs['mc_fax'],
						'top_desc' => $post['note'],
						'top_datetime_input' => date("Y-m-d H:i:s"),
						'top_payee' => $post['payee'],
						'to_id' => $unique_order_id[0],
						'to_no' => $unique_order_no[0],
						'top_flag' => 1
					);
					
					if($this->db->insert($this->table,$arr_ins0)) {
						$id = $this->db->insert_id();
						
						$x = 0;
						$dateTkirim = array();
						$arr_ins = array();
						$arr_params = array();
						$order_ids = array();
						foreach($post['dibayar'] as $item) {
							if($item != '0' && $item != '') {
								// $params = $row['to_id'].'|'.$row['to_no'].'|'.$row['to_total'].'|'.$row['to_deadline_payment'];
								
								$params = explode('|', $post['h_params'][$x]);
								$outstanding = intval($params[2]-$item);
								$order_ids[] = $params[0];
								
								$arr_ins[] = array(
									'top_id' => $id,
									'to_id' => $params[0],
									'to_no' => $params[1],
									'mc_id' => $supp[0],
									'mc_code' => $supp[1],
									'mc_name' => $supp[2],
									'to_date' => $params[7],
									'to_total' => $params[2],
									'topd_deadline_payment' => $params[3],
									'to_outstanding' => $outstanding,
									'topd_payment_amount' => $item,
									'topd_flag' => 1
								);
							}
							$x++;
						}
						
						$this->db->insert_batch($this->table.'_detail', $arr_ins);
						
						// Update PO status
						$arr_params['order_id'] = $order_ids; // array : po id
						$this->update_order_status($arr_params);
						
						$this->session->set_flashdata('msg','Data tersimpan!');
						$this->session->set_flashdata('next_page',base_url($this->controller.'/print_payment/'.$id));
						redirect($this->controller.'/create');
					}
				}
				
				// Form No
				$data['doc_no'] = $this->no_format->generate_op_no($data['date_now']);
				$data['company_address'] = $this->config->item('company_address');
				
				// Get user
				$payee = NULL;
				if(!empty($this->auth_role)) {
					$arr_payee = get_users($this->auth_username);
					$payee = $arr_payee['full_name'];
				}
				$data['payee'] = $payee;
				
				$this->load->view('admin/template/home',$data);
			}
			else {
				redirect('logout');
			}
		}
		
		function update_order_status($params=array()) {
			$this->load->model('model_order','moo');
			
			if(!empty($params)) {
				$arr_order_id = $params['order_id'];
				$jml_item_po = count($arr_order_id);
				$unique_arr_order_id = array_unique($arr_order_id);
				
				if($jml_item_po > 0) {
					foreach($unique_arr_order_id as $order_id) {
						
						$order_status = $this->moo->get_order_payment_status($order_id);
						$this->db->where(array('to_id'=>$order_id));
						$this->db->update('t_order',array('to_status_payment'=>$order_status['status'],'to_paid_date'=>$order_status['to_paid_date']));
						
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
						'page_title' => 'Ubah Pembayaran',
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
				
				// Get payment
				$q = $this->mo->get_payment(NULL,$id);
				$res = $q['row_array'];
				
				// Get payment detail
				$q = $this->mo->get_payment_detail($id);
				$data['num_rows'] = $q['num_rows'];
				$data['result'] = $q['result'];
				
				$top_date = ($res['top_date'] != '' && $res['top_date'] != '0000-00-00' ? explode('-',$res['top_date']) : NULL); // yyyy-mm-dd
				
				$data['id'] = $id;
				$data['top_no'] = $res['top_no'];
				$data['top_date'] = ($top_date != NULL ? $top_date[1].'/'.$top_date[2].'/'.$top_date[0] : NULL);				
				$data['mc_id'] = $res['mc_id'];
				$data['mc_code'] = $res['mc_code'];
				$data['mc_name'] = $res['mc_name'];
				$data['mc_phone1'] = $res['mc_phone1'];
				$data['mc_email'] = $res['mc_email'];
				$data['top_desc'] = $res['top_desc'];
				$data['top_payee'] = $res['top_payee'];
				$data['mc_address'] = $res['mc_address'];
				
				if($_POST) {
					$post = $this->input->post();
					
					$supp = explode('|',$post['customer']);
					$date = explode('/',$post['tgl']); // mm/dd/yyyy
					
					// Get customer
					$qs = $this->db->get_where('m_customer',array('mc_id'=>$supp[0]))->row_array();
					$no_doc = $this->no_format->generate_op_no($data['date_now']);
					
					// Get PO No
					$order_no = array();
					$order_id = array();
					
					if(count($post['h_order_no']) > 0) {
						foreach($post['h_order_no'] as $po) {
							$order_no[] = $po;
						}
					}
					$unique_order_no = array_unique($order_no);
					
					if(count($post['h_order_id']) > 0) {
						foreach($post['h_order_id'] as $poID) {
							$order_id[] = $poID;
						}
					}
					$unique_order_id = array_unique($order_id);
					
					// Insert : tbl_order_payment
					$arr_ins0 = array(
						'top_no' => $no_doc,
						'mc_id' => $supp[0],
						'top_date' => $date[2].'-'.$date[0].'-'.$date[1],
						'top_total' => $post['total'],
						'mc_code' => $supp[1],
						'mc_name' => $supp[2],
						'mc_address' => $qs['mc_address'],
						'mc_phone1' => $qs['mc_phone1'],
						'mc_email' => $qs['mc_email'],
						'mc_fax' => $qs['mc_fax'],
						'top_desc' => $post['note'],
						'top_datetime_input' => date("Y-m-d H:i:s"),
						'top_payee' => $post['payee'],
						'to_id' => $unique_order_id[0],
						'to_no' => $unique_order_no[0],
						'top_flag' => 1
					);
					
					$this->db->where('top_id',$id);
					$this->db->update($this->table,$arr_ins0);
					$affectedRows = $this->db->affected_rows();
					
					//if($affectedRows > 0) {						
						$x = 0;
						$dateTkirim = array();
						$arr_ins = array();
						$arr_params = array();
						$order_ids = array();
						foreach($post['h_topd_id'] as $item) {
							// Delete next payment
							if(isset($post['h_topd_id'])) {
								$arr_ids2 = array();
								foreach($post['h_topd_id'] as $check) {
									$arr_ids2[] = $check;
								}
								$this->db->where_not_in('topd_id',$arr_ids2);
							}
							$this->db->where(array('top_id'=>$id));
							$delOther = $this->db->get($this->table.'_detail');
							if($delOther->num_rows() > 0) {
								$dataOther = $delOther->result_array();
								foreach($dataOther as $row) {
									$this->db->where(array('topd_flag'=>1,'to_id'=>$row['to_id']));
									$this->db->update($this->table.'_detail',array('topd_flag'=>0));
								}
							}
							
							//if($item != '0' && $item != '') {
								$params = explode('|', $post['h_params'][$x]);
								$outstanding = intval($params[8]-$post['dibayar'][$x]);
								$order_ids[] = $params[0];
								
								if(intval($post['dibayar'][$x]) != intval($params[2])) {
									// Delete t_receiving_detail with same po id
									$arr_where_det = array('to_id'=>$params[0],'topd_id >'=>$post['h_topd_id'][$x]);
									
									$this->db->where($arr_where_det);
									$this->db->update($this->table.'_detail', array('topd_flag'=>0));
									
									$arr_ins = array(
										'top_id' => $id,
										'to_id' => $params[0],
										'to_no' => $params[1],
										'mc_id' => $supp[0],
										'mc_code' => $supp[1],
										'mc_name' => $supp[2],
										'to_date' => $params[7],
										'to_total' => $params[8],
										'topd_deadline_payment' => $params[3],
										'to_outstanding' => $outstanding,
										'topd_payment_amount' => $post['dibayar'][$x],
										'topd_flag' => 1
									);
									
									$this->db->where('topd_id',$post['h_topd_id'][$x]);
									$this->db->update($this->table.'_detail',$arr_ins);
								}
							//}
							$x++;
						}
						
						// Update PO status
						$arr_params['order_id'] = $order_ids; // array : po id
						$this->update_order_status($arr_params);
						
						$this->session->set_flashdata('msg','Data tersimpan!');
						$this->session->set_flashdata('next_page',base_url($this->controller.'/print_payment/'.$id));
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
				$this->db->where('top_id',$this->input->post('id',0));
				$this->db->update($this->table.'_detail',array('topd_flag'=>0));
				
				// Delete table
				$this->db->where('top_id',$this->input->post('id',0));
				$this->db->update($this->table,array('top_flag'=>0));
				
				// Update Order status
				$this->db->where('to_id',$this->input->post('to_id',0));
				$this->db->update('t_order',array('to_status_payment'=>'OPEN','to_paid_date'=>NULL));
				
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
				$q = $this->mo->get_price($exp[0],$this->input->post('mp_id',array()));
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
					echo "Silahkan pilih customer!";
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
				$exp = ($this->input->post('id',0) == 0 ? NULL : explode('|',$this->input->post('id')));
				// Get Harga
				$id_cus = ($exp != NULL ? $exp[0] : 0);
				$q = $this->mo->get_order($id_cus,$this->input->post('order_id',array()),'LUNAS','NOT_IN');
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
					$order_id = $this->input->post('id',NULL);
					// Get Detail PO
					$q = $this->mo->get_order(0,$order_id,'LUNAS');
					$data['num_rows'] = $q['num_rows'];
					$data['result'] = $q['result'];
					
					$this->load->view($this->folder_view.$this->controller.'/create_detail2',$data);
				}
			}
			else echo "Invalid result!";
		}
		
		function print_payment($r_id=0) {
			$this->is_logged_in();
			if( ! empty( $this->auth_role ) ) {
				if($r_id != 0) {
					$data = array(
							'site_title' => $this->site_title,
							'page_title' => 'Cetak Pembayaran',
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
					
					// Get Payment
					$user = get_user($this->auth_user_id);
					$q = $this->db->get_where('t_order_payment',array('top_id'=>$r_id))->row_array();
					$data['mc_id'] = $q['mc_id'];
					$data['top_no'] = $q['top_no'];
					$data['mc_name'] = $q['mc_name'];
					$data['mc_address'] = $q['mc_address'];
					$data['mc_phone1'] = $q['mc_phone1'];
					$data['mc_fax'] = $q['mc_fax'];
					$data['mc_email'] = $q['mc_email'];
					$data['top_total'] = $q['top_total'];
					$data['top_date'] = $this->tanggal->tgl_indo4($q['top_date']);
					$data['top_desc'] = $q['top_desc'];
					$data['prepared_by'] = $user['full_name'];
					
					// Get Payment Detail
					//$q2 = $this->db->get_where('t_receiving_detail', array('tr_id'=>$r_id,'trd_flag'=>1));
					$query2 = $this->mo->get_payment_detail($r_id);
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
			$q = $this->db->get_where('t_order',array('to_id'=>$order_id))->row_array();
			$data['to_no'] = $q['to_no'];
			$data['mc_id'] = $q['mc_id'];
			$data['mc_name'] = $q['mc_name'];
			$data['mc_address'] = $q['mc_address'];
			$data['mc_phone1'] = $q['mc_phone1'];
			$data['mc_fax'] = $q['mc_fax'];
			$data['mc_email'] = $q['mc_email'];
			$data['to_pic'] = $q['to_pic'];
			$data['to_date'] = $this->tanggal->tgl_indo4($q['to_date']);
			$data['to_description'] = $q['to_description'];
			$data['to_subtotal'] = $this->no_format->idr_money($q['to_subtotal']);
			$data['to_disc'] = $q['to_disc'];
			$data['to_disc_nominal'] = $this->no_format->idr_money($q['to_disc_nominal']);
			$data['to_ppn'] = $q['to_ppn'];
			$data['to_ppn_nominal'] = $this->no_format->idr_money($q['to_ppn_nominal']);
			$data['to_total'] = $this->no_format->idr_money($q['to_total']);
			$data['prepared_by'] = $this->config->item('company_prepared_by');
			
			// Get PO Detail
			$q2 = $this->db->get_where('t_order_detail', array('to_id'=>$order_id,'tpd_flag'=>1));
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
			$q = $this->db->get_where('t_order',array('to_id'=>$order_id))->row_array();
			$data['mc_id'] = $q['mc_id'];
			$data['mc_name'] = $q['mc_name'];
			$data['mc_address'] = $q['mc_address'];
			$data['mc_phone1'] = $q['mc_phone1'];
			$data['mc_fax'] = $q['mc_fax'];
			$data['mc_email'] = $q['mc_email'];
			$data['to_pic'] = $q['to_pic'];
			$data['to_date'] = $this->tanggal->tgl_indo4($q['to_date']);
			$data['to_description'] = $q['to_description'];
			$data['to_subtotal'] = $this->no_format->idr_money($q['to_subtotal']);
			$data['to_disc'] = $q['to_disc'];
			$data['to_disc_nominal'] = $this->no_format->idr_money($q['to_disc_nominal']);
			$data['to_ppn'] = $q['to_ppn'];
			$data['to_ppn_nominal'] = $this->no_format->idr_money($q['to_ppn_nominal']);
			$data['to_total'] = $this->no_format->idr_money($q['to_total']);
			$data['prepared_by'] = $this->config->item('company_prepared_by');
			
			// Get PO Detail
			$q2 = $this->db->get_where('t_order_detail', array('to_id'=>$order_id,'tpd_flag'=>1));
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
						'page_title' => 'Report Delivery',
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
					$supp = explode('|',$post['customer']);
					$date = explode('/',$post['tgl_from']); // mm/dd/yyyy
					$date2 = explode('/',$post['tgl_to']); // mm/dd/yyyy
					
					// Get customer
					$qs = $this->db->get_where('m_customer',array('mc_id'=>$supp[0]))->row_array();
					$no_doc = $this->no_format->generate_receiving_no($data['date_now']);
					
					$mc_id = ($supp[0] == '' ? 0 : $supp[0]);
					$tgl_from = $date[2].'-'.$date[0].'-'.$date[1];
					$tgl_to = $date2[2].'-'.$date2[0].'-'.$date2[1];
					
					$this->session->set_flashdata('next_page',base_url($this->controller.'/print_report/'.$mc_id.'/'.$tgl_from.'/'.$tgl_to));
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
					
					// Get customer
					$sup = $this->db->get_where('m_customer', array('mc_id'=>$sup_id))->row_array();
					$data['mc_id'] = $sup_id;
					$data['mc_name'] = $sup['mc_name'];
					$data['mc_code'] = $sup['mc_code'];
					$data['mc_address'] = $sup['mc_address'];
					$data['mc_phone1'] = $sup['mc_phone1'];
					$data['mc_fax'] = $sup['mc_fax'];
					$data['mc_email'] = $sup['mc_email'];
					$data['str_tgl_from'] = $this->tanggal->tgl_indo2($tgl_from);
					$data['str_tgl_to'] = $this->tanggal->tgl_indo2($tgl_to);
					$user = get_user($this->auth_user_id);
					$data['prepared_by'] = $user['full_name'];
					
					// Get Receiving
					$user = get_user($this->auth_user_id);
					$q = $this->mo->report_delivery($sup_id,$tgl_from,$tgl_to);
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