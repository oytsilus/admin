<?php
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class Purchase_order extends MY_Controller {
		private $folder_view = 'admin/purchasing/';
		private $controller = 'purchase_order';
		private $table = 't_purchase';
		private $table2 = 't_purchase_invoice';
		
		function __construct() {
			parent::__construct();
			
			date_default_timezone_set('Asia/Jakarta');
			
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('model_po','mp');
			$this->load->library(array('no_format','tanggal'));
		}
		
		function index(){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Daftar PO',
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
				
				// Get PO
				$q = $this->mp->get_po();
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
						'page_title' => 'Buat PO Baru',
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
							'vendors/bootbox/bootbox.min', /* Bootbox */
							'vendors/bootstrap-toggle/js/bootstrap-toggle.min' /* Bootstrap Toggle.js */
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
					$date1 = explode('/',$post['inv_date']); // mm/dd/yyyy
					$date2 = explode('/',$post['inv_due_date']); // mm/dd/yyyy
					
					// Get supplier
					$qs = $this->db->get_where('m_supplier',array('ms_id'=>$supp[0]))->row_array();
					$no_po = $this->no_format->generate_po_no($data['date_now']);
					
					// Insert : tbl_purchase
					$arr_ins0 = array(
						'tp_no' => $no_po,
						'ms_id' => $supp[0],
						'tp_date' => $date[2].'-'.$date[0].'-'.$date[1],
						'ms_code' => $supp[1],
						'ms_name' => $supp[2],
						'ms_address' => $qs['ms_address'],
						'ms_phone1' => $qs['ms_phone1'],
						'ms_email' => $qs['ms_email'],
						'tp_pic' => $post['up'],
						'tp_description' => $post['note'],
						'tp_subtotal' => $post['subtotal'],
						'tp_disc' => $post['disc'],
						'tp_disc_nominal' => $post['disc_nominal'],
						'tp_ppn' => $post['ppn'],
						'tp_ppn_nominal' => $post['ppn_nominal'],
						'tp_datetime_input' => $date[2].'-'.$date[0].'-'.$date[1].' '.date('H:i:s'),
						'tp_status' => 'OPEN',
						'tp_status_payment' => 'UNPAID',
						'tp_total' => $post['total'],
						'tpi_date' => $date1[2].'-'.$date1[0].'-'.$date1[1],
						'tpi_no' => $post['inv_no'],
						'tpi_due_date' => $post['inv_due_date'],
						'tp_flag' => 1
					);
					if($this->db->insert($this->table,$arr_ins0)) {
						$id = $this->db->insert_id();
						
						$x = 0;
						$dateTkirim = array();
						foreach($post['qty'] as $item) {
							if($item != '0' && $item != '') {
								$params = explode('|', $post['h_params'][$x]);
								if($post['jkirim'][$x] == '') {
									$newDateTKirim = NULL;
								}
								else {
									$dateTkirim = explode('/', $post['jkirim'][$x]); // mm/dd/yyyy
									$newDateTKirim = $dateTkirim[2].'-'.$dateTkirim[0].'-'.$dateTkirim[1];
								}
								
								$arr_ins[] = array(
									'tp_id' => $id,
									'mp_id' => $params[1],
									'mp_code' => $params[2],
									'mp_category' => $params[3],
									'mp_name' => $params[4],
									'mu_code' => $params[5],
									'mu_name' => $params[6],
									'mbp_price' => $params[7],
									'tpd_qty' => $post['qty'][$x],
									'tpd_outstanding' => $post['qty'][$x],
									'tpd_delivery_date' => $newDateTKirim,
									'tpd_flag' => 1
								);
							}
							$x++;
						}
					
						$this->db->insert_batch($this->table.'_detail', $arr_ins);
						$first_detail_id = $this->db->insert_id(); 
						$last_detail_id = $first_detail_id+(count($arr_ins)-1);
						
						/*
						* disabled dulu, belum pasti
						// Insert Purchase Invoice
						if($post['inv_no'] != '') {
							$arr_ins1 = array(
								'ms_id' => $supp[0],
								'ms_code' => $supp[1],
								'ms_name' => $supp[2],
								'ms_address' => $qs['ms_address'],
								'ms_phone1' => $qs['ms_phone1'],
								'ms_email' => $qs['ms_email'],	
								'mc_address' => $post['ship_address'],
								'tpi_date' => $date1[2].'-'.$date1[0].'-'.$date1[1],
								'tpi_no' => $post['inv_no'],
								'tpi_due_date' => $date2[2].'-'.$date2[0].'-'.$date2[1],
								'tpi_flag' => 1
							);
							
							if($this->db->insert($this->table2,$arr_ins1)) {
								$id2 = $this->db->insert_id();
								
								$y = 0;
								$dateTkirim = array();
								foreach($post['qty'] as $item) {
									if($item != '0' && $item != '') {
										$params = explode('|', $post['h_params'][$y]);
										if($post['jkirim'][$y] == '') {
											$newDateTKirim = NULL;
										}
										else {
											$dateTkirim = explode('/', $post['jkirim'][$y]); // mm/dd/yyyy
											$newDateTKirim = $dateTkirim[2].'-'.$dateTkirim[0].'-'.$dateTkirim[1];
										}
										
										$arr_ins2[] = array(
											'tpi_id' => $id2,
											'mp_id' => $params[1],
											'mp_code' => $params[2],
											'mp_category' => $params[3],
											'mp_name' => $params[4],
											'mu_code' => $params[5],
											'mu_name' => $params[6],
											'tp_id' => $id,
											'tp_no' => $no_po,
											'tpd_id' => $first_detail_id,
											'mbp_price' => $params[7],
											'tpd_delivery_date' => $newDateTKirim,
											'tpid_qty' => $post['qty'][$y],
											'tpid_flag' => 1
										);
										
										$first_detail_id++;
									}
									$y++;
								}
								
								$this->db->insert_batch($this->table2.'_detail', $arr_ins2);
							}
						}
						*/
						
						$this->session->set_flashdata('msg','Data tersimpan!');
						$this->session->set_flashdata('next_page',base_url($this->controller.'/print_po/'.$id));
						redirect($this->controller.'/create');
					}
				}
				
				// PO No
				$data['po_no'] = $this->no_format->generate_po_no($data['date_now']);
				$data['company_address'] = $this->config->item('company_address');
				
				$this->load->view('admin/template/home',$data);
			}
			else {
				redirect('logout');
			}
		}
		
		function edit($id=0){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Ubah PO',
						'page' => $this->folder_view.$this->controller.'/edit',
						'js_page' => $this->folder_view.$this->controller.'/js',
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
							'vendors/bootbox/bootbox.min', /* Bootbox */
							'vendors/bootstrap-toggle/js/bootstrap-toggle.min' /* Bootstrap Toggle.js */
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
				
				// Get po
				$q = $this->db->get_where('t_purchase',array('tp_id'=>$id));
				$res = $q->row_array();
				
				// Get po detail
				$q = $this->mp->get_detail_po($id);
				$data['num_rows'] = $q['num_rows'];
				$data['result'] = $q['result'];
				
				$tp_date = ($res['tp_date'] != '' && $res['tp_date'] != '0000-00-00' ? explode('-',$res['tp_date']) : NULL); // yyyy-mm-dd
				$tpi_date = ($res['tpi_date'] != '' && $res['tpi_date'] != '0000-00-00' ? explode('-',$res['tpi_date']) : NULL); // yyyy-mm-dd
				$tpi_duedate = ($res['tpi_due_date'] != '' || $res['tpi_due_date'] != '0000-00-00' ? explode('-',$res['tpi_due_date']) : NULL); // yyyy-mm-dd
				
				$data['id'] = $id;
				$data['po_no'] = $res['tp_no'];
				$data['tp_date'] = ($tp_date != NULL ? $tp_date[1].'/'.$tp_date[2].'/'.$tp_date[0] : NULL);
				$data['ms_id'] = $res['ms_id'];
				$data['ms_code'] = $res['ms_code'];
				$data['ms_name'] = $res['ms_name'];
				$data['company_address'] = $res['mc_address'];
				$data['ms_phone1'] = $res['ms_phone1'];
				$data['ms_fax'] = $res['ms_fax'];
				$data['ms_email'] = $res['ms_email'];
				$data['tp_pic'] = $res['tp_pic'];
				$data['ms_address'] = $res['ms_address'];
				$data['tp_description'] = $res['tp_description'];
				$data['tpi_no'] = $res['tpi_no'];
				$data['tpi_date'] = ($tpi_date != NULL ? $tpi_date[1].'/'.$tpi_date[2].'/'.$tpi_date[0] : NULL);
				$data['tpi_due_date'] = ($res['tpi_due_date'] != '' && $res['tpi_due_date'] != '0000-00-00' ? $tpi_duedate[1].'/'.$tpi_duedate[2].'/'.$tpi_duedate[0] : NULL);
				$data['tp_subtotal'] = $res['tp_subtotal'];
				$data['tp_disc'] = $res['tp_disc'];
				$data['tp_disc_nominal'] = $res['tp_disc_nominal'];
				$data['tp_ppn'] = $res['tp_ppn'];
				$data['tp_ppn_nominal'] = $res['tp_ppn_nominal'];
				$data['tp_total'] = $res['tp_total'];
				
				$qDet = $this->mp->get_detail_po($id);
				$data['result_detail'] = $qDet['result'];
				$data['num_rows_detail'] = $qDet['num_rows'];;
				
				if($_POST) {
					$post = $this->input->post();
					$supp = explode('|',$post['supplier']);
					$date = explode('/',$post['tgl']); // mm/dd/yyyy
					$date1 = explode('/',$post['inv_date']); // mm/dd/yyyy
					$date2 = explode('/',$post['inv_due_date']); // mm/dd/yyyy
					
					// Get supplier
					$qs = $this->db->get_where('m_supplier',array('ms_id'=>$supp[0]))->row_array();
					
					// updte : tbl_purchase
					$arr_ins0 = array(
						'ms_id' => $supp[0],
						'tp_date' => $date[2].'-'.$date[0].'-'.$date[1],
						'ms_code' => $supp[1],
						'ms_name' => $supp[2],
						'ms_address' => $qs['ms_address'],
						'mc_address' => $post['ship_address'],
						'ms_phone1' => $qs['ms_phone1'],
						'ms_email' => $qs['ms_email'],
						'tp_pic' => $post['up'],
						'tp_description' => $post['note'],
						'tp_subtotal' => $post['subtotal'],
						'tp_disc' => $post['disc'],
						'tp_disc_nominal' => $post['disc_nominal'],
						'tp_ppn' => $post['ppn'],
						'tp_ppn_nominal' => $post['ppn_nominal'],
						'tp_status' => 'OPEN',
						'tp_status_payment' => 'UNPAID',
						'tp_total' => $post['total'],
						'tpi_date' => $date1[2].'-'.$date1[0].'-'.$date1[1],
						'tpi_no' => $post['inv_no'],
						'tpi_due_date' => $date2[2].'-'.$date2[0].'-'.$date2[1],
						'tp_flag' => 1
					);
					
					$this->db->where('tp_id',$id);
					$this->db->update($this->table,$arr_ins0);
					$affectedRows = $this->db->affected_rows();
					
					if($affectedRows > 0) {
						$x = 0;
						$dateTkirim = array();
						foreach($post['h_tpd_id'] as $item) {
							//if($item != '0' && $item != '') {
								$params = explode('|', $post['h_params'][$x]);
								if($post['jkirim'][$x] == '') {
									$newDateTKirim = NULL;
								}
								else {
									$dateTkirim = explode('/', $post['jkirim'][$x]); // mm/dd/yyyy
									$newDateTKirim = $dateTkirim[2].'-'.$dateTkirim[0].'-'.$dateTkirim[1];
								}
								
								if($item != '0') {
									// Delete jika tpd_id tidak ada di form
									// Delete where not exist in array
									if(isset($post['h_tpd_id'])) {
										$arr_ids = array();
										foreach($post['h_tpd_id'] as $check) {
											$arr_ids[] = $check;
										}
										$this->db->where_not_in('tpd_id',$arr_ids);
									}
									$this->db->where(array('tp_id'=>$id));
									$this->db->update($this->table.'_detail', array('tpd_flag'=>0));
								}
								
								// Jika tpd_id == 0 => Insert
								if($post['h_tpd_id'][$x] == '0') {
									$arr_ins = array(
										'tp_id' => $id,
										'mp_id' => $params[1],
										'mp_code' => $params[2],
										'mp_category' => $params[3],
										'mp_name' => $params[4],
										'mu_code' => $params[5],
										'mu_name' => $params[6],
										'mbp_price' => $params[7],
										'tpd_qty' => $post['qty'][$x],
										'tpd_outstanding' => $post['qty'][$x],
										'tpd_delivery_date' => $newDateTKirim,
										'tpd_flag' => 1
									);
									$this->db->insert($this->table.'_detail', $arr_ins);
								}
								else { // tpd_id != 0 => Update
									$arr_upd = array(
										'tp_id' => $id,
										'mp_id' => $params[1],
										'mp_code' => $params[2],
										'mp_category' => $params[3],
										'mp_name' => $params[4],
										'mu_code' => $params[5],
										'mu_name' => $params[6],
										'mbp_price' => $params[7],
										'tpd_qty' => $post['qty'][$x],
										'tpd_outstanding' => $post['qty'][$x],
										'tpd_delivery_date' => $newDateTKirim
									);
									
									$this->db->where('tpd_id',$post['h_tpd_id'][$x]);
									$this->db->update($this->table.'_detail',$arr_upd);
								}
							//}
							$x++;
						}
						
						$this->session->set_flashdata('msg','Data tersimpan!');
						$this->session->set_flashdata('next_page',base_url($this->controller.'/print_po/'.$id));
						redirect($this->controller.'/edit/'.$id);
					}
				}
				
				$this->load->view('admin/template/home',$data);
			}
			else {
				redirect('logout');
			}
		}
		
		function delete() {
			if($_POST) {
				// Delete PO detail
				$this->db->where('tp_id',$this->input->post('id'));
				$this->db->update($this->table.'_detail',array('tpd_flag'=>0));
				
				// Delete PO
				$this->db->where('tp_id',$this->input->post('id'));
				$this->db->update($this->table,array('tp_flag'=>0));
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
				$q = $this->mp->get_price($exp[0],$this->input->post('mp_id',array()));
				$data['num_rows_det'] = $q['num_rows'];
				$data['result_det'] = $q['result'];
				
				$this->load->view($this->folder_view.$this->controller.'/create_modal',$data);
			} else {
				echo "Invalid result!";
			}
		}
		
		function submit_po_detail() {
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
		
		function print_po($po_id=0) {
			$this->is_logged_in();
			if( ! empty( $this->auth_role ) ) {
				if($po_id != 0) {
					$data = array(
							'site_title' => $this->site_title,
							'page_title' => 'Ubah PO',
							'page' => $this->folder_view.$this->controller.'/print_po',
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
					$user = get_user($this->auth_user_id);
					$q = $this->db->get_where('t_purchase',array('tp_id'=>$po_id))->row_array();
					$data['ms_id'] = $q['ms_id'];
					$data['tp_no'] = $q['tp_no'];
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
					$data['prepared_by'] = $user['full_name'];
					
					// Get PO Detail
					//$q2 = $this->db->get_where('t_purchase_detail', array('tp_id'=>$po_id,'tpd_flag'=>1));
					$q2 = $this->mp->get_detail_po($po_id);
					$data['num_rows'] = $q2['num_rows'];
					$data['result'] = $q2['result'];
					
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
	}