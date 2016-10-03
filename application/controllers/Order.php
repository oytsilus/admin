<?php
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class Order extends MY_Controller {
		private $folder_view = 'admin/sales/';
		private $controller = 'order';
		private $table = 't_order';

		function __construct() {
			parent::__construct();

			date_default_timezone_set('Asia/Jakarta');

			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('model_order','mo');
			$this->load->library(array('no_format','tanggal'));
		}

		function index(){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');

			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Daftar Order',
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
				$q = $this->mo->get_order();
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
			$this->load->model('model_report','mr');

			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Buat Order Baru',
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
						'date_now' => date('m/d/Y'),
						'date_inv' => date('m/d/Y')
				);

				if($_POST) {
					$post = $this->input->post();

					$cust = explode('|',$post['customer']);
					$date = explode('/',$post['tgl']); // mm/dd/yyyy
					$date1 = explode('/',$post['inv_date']); // mm/dd/yyyy
					$date2 = explode('/',$post['inv_due_date']); // mm/dd/yyyy

					$order_date = (count($date) > 0 ? $date[2].'-'.$date[0].'-'.$date[1] : NULL); //mm/dd/yyyy
					$inv_date = (count($date1) > 0 ? $date1[2].'-'.$date1[0].'-'.$date1[1] : NULL);

					// Get customer
					$qc = $this->db->get_where('m_customer',array('mc_id'=>$cust[0]))->row_array();
					$doc_no = $this->no_format->generate_order_no($post['tgl']);
					$doc2_no = $this->no_format->generate_order_inv_no($post['inv_due_date']);

					// Insert : tbl_purchase
					$arr_ins0 = array(
						'to_no' => $doc_no,
						'mc_id' => $cust[0],
						'to_date' => $order_date,
						'mc_code' => $cust[1],
						'mc_name' => $cust[2],
						'mc_address' => $post['cus_address'],
						'mc_phone1' => $qc['mc_phone1'],
						'mc_email' => $qc['mc_email'],
						'to_pic' => $post['up'],
						'to_description' => $post['note'],
						'to_subtotal' => $post['subtotal'],
						'to_disc' => $post['disc'],
						'to_disc_nominal' => $post['disc_nominal'],
						'to_ppn' => $post['ppn'],
						'to_ppn_nominal' => $post['ppn_nominal'],
						'to_datetime_input' => $date[2].'-'.$date[0].'-'.$date[1].' '.date('H:i:s'),
						'to_status' => 'OPEN',
						'to_status_payment' => 'UNPAID',
						'to_total' => $post['total'],
						'toi_date' => $inv_date,
						'toi_no' => $doc2_no,
						'toi_due_date' => $post['inv_due_date'],
						'to_flag' => 1
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
									'to_id' => $id,
									'mp_id' => $params[1],
									'mp_code' => $params[2],
									'mp_category' => $params[3],
									'mp_name' => $params[4],
									'mu_code' => $params[5],
									'mu_name' => $params[6],
									'mbp_price' => $params[8],
									'msp_price' => $params[7],
									'tod_qty' => $post['qty'][$x],
									'td_outstanding' => $post['qty'][$x],
									'td_delivery_date' => $newDateTKirim,
									'tod_flag' => 1
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
								'mc_id' => $cust[0],
								'mc_code' => $cust[1],
								'mc_name' => $cust[2],
								'mc_address' => $qc['mc_address'],
								'mc_phone1' => $qc['mc_phone1'],
								'mc_email' => $qc['mc_email'],
								'mc_address' => $post['ship_address'],
								'toi_date' => $date1[2].'-'.$date1[0].'-'.$date1[1],
								'toi_no' => $post['inv_no'],
								'toi_due_date' => $date2[2].'-'.$date2[0].'-'.$date2[1],
								'toi_flag' => 1
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
											'toi_id' => $id2,
											'mp_id' => $params[1],
											'mp_code' => $params[2],
											'mp_category' => $params[3],
											'mp_name' => $params[4],
											'mu_code' => $params[5],
											'mu_name' => $params[6],
											'to_id' => $id,
											'to_no' => $doc_no,
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

						// Insert report laba Rugi
						$this->mr->insert_labarugi($id);

						$this->session->set_flashdata('msg','Data tersimpan!');
						$this->session->set_flashdata('next_page',base_url($this->controller.'/print_order/'.$id));
						$this->session->set_flashdata('next_page2',base_url($this->controller.'/print_invoice/'.$id));
						redirect($this->controller.'/create');
					}
				}

				// Order No
				$data['order_no'] = $this->no_format->generate_order_no($data['date_now']);

				// Invoice No
				$data['inv_no'] = $this->no_format->generate_order_inv_no($data['date_now']);
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
			$this->load->model('model_report','mr');

			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Ubah Order',
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
				$q = $this->db->get_where('t_order',array('to_id'=>$id));
				$res = $q->row_array();

				// Get po detail
				$q = $this->mo->get_detail_order($id);
				$data['num_rows'] = $q['num_rows'];
				$data['result'] = $q['result'];

				$to_date = ($res['to_date'] != '' && $res['to_date'] != '0000-00-00' ? explode('-',$res['to_date']) : NULL); // yyyy-mm-dd
				$toi_date = ($res['toi_date'] != '' && $res['toi_date'] != '0000-00-00' ? explode('-',$res['toi_date']) : NULL); // yyyy-mm-dd
				$toi_duedate = ($res['toi_due_date'] != '' || $res['toi_due_date'] != '0000-00-00' ? explode('-',$res['toi_due_date']) : NULL); // yyyy-mm-dd

				$data['id'] = $id;
				$data['order_no'] = $res['to_no'];
				$data['to_date'] = ($to_date != NULL ? $to_date[1].'/'.$to_date[2].'/'.$to_date[0] : NULL);
				$data['mc_id'] = $res['mc_id'];
				$data['mc_code'] = $res['mc_code'];
				$data['mc_name'] = $res['mc_name'];
				$data['company_address'] = $res['mc_address'];
				$data['mc_phone1'] = $res['mc_phone1'];
				$data['mc_fax'] = $res['mc_fax'];
				$data['mc_email'] = $res['mc_email'];
				$data['to_pic'] = $res['to_pic'];
				$data['mc_address'] = $res['mc_address'];
				$data['to_description'] = $res['to_description'];
				$data['toi_no'] = $res['toi_no'];
				$data['toi_date'] = ($toi_date != NULL ? $toi_date[1].'/'.$toi_date[2].'/'.$toi_date[0] : NULL);
				$data['toi_due_date'] = ($res['toi_due_date'] != '' && $res['toi_due_date'] != '0000-00-00' ? $toi_duedate[1].'/'.$toi_duedate[2].'/'.$toi_duedate[0] : NULL);
				$data['to_subtotal'] = $res['to_subtotal'];
				$data['to_disc'] = $res['to_disc'];
				$data['to_disc_nominal'] = $res['to_disc_nominal'];
				$data['to_ppn'] = $res['to_ppn'];
				$data['to_ppn_nominal'] = $res['to_ppn_nominal'];
				$data['to_total'] = $res['to_total'];

				$qDet = $this->mo->get_detail_order($id);
				$data['result_detail'] = $qDet['result'];
				$data['num_rows_detail'] = $qDet['num_rows'];;

				if($_POST) {
					$post = $this->input->post();
					$cust = explode('|',$post['customer']);
					$date = explode('/',$post['tgl']); // mm/dd/yyyy
					$date1 = explode('/',$post['inv_date']); // mm/dd/yyyy
					$due_date = NULL;
					if($post['inv_due_date'] != '') {
							$date2 = explode('/',$post['inv_due_date']); // mm/dd/yyyy
							$due_date = $date2[2].'-'.$date2[0].'-'.$date2[1];
					}

					// Get customer
					$qc = $this->db->get_where('m_customer',array('mc_id'=>$cust[0]))->row_array();

					// updte : tbl_order
					$arr_ins0 = array(
						'mc_id' => $cust[0],
						'to_date' => $date[2].'-'.$date[0].'-'.$date[1],
						'mc_code' => $cust[1],
						'mc_name' => $cust[2],
						'mc_address' => $post['cus_address'],
						'mc_phone1' => $qc['mc_phone1'],
						'mc_email' => $qc['mc_email'],
						'to_pic' => $post['up'],
						'to_description' => $post['note'],
						'to_subtotal' => $post['subtotal'],
						'to_disc' => $post['disc'],
						'to_disc_nominal' => $post['disc_nominal'],
						'to_ppn' => $post['ppn'],
						'to_ppn_nominal' => $post['ppn_nominal'],
						'to_status' => 'OPEN',
						'to_status_payment' => 'UNPAID',
						'to_total' => $post['total'],
						'toi_date' => $date1[2].'-'.$date1[0].'-'.$date1[1],
						'toi_no' => $post['inv_no'],
						'toi_due_date' => $due_date,
						'to_flag' => 1
					);

					$this->db->where('to_id',$id);
					$this->db->update($this->table,$arr_ins0);
					$affectedRows = $this->db->affected_rows();

					//if($affectedRows > 0) {
						$x = 0;
						$dateTkirim = array();
						foreach($post['h_tod_id'] as $item) {
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
									if(isset($post['h_tod_id'])) {
										$arr_ids = array();
										foreach($post['h_tod_id'] as $check) {
											$arr_ids[] = $check;
										}
										$this->db->where_not_in('tod_id',$arr_ids);
									}
									$this->db->where(array('to_id'=>$id));
									$this->db->update($this->table.'_detail', array('tod_flag'=>0));
								}

								// Jika tod_id == 0 => Insert
								if($post['h_tod_id'][$x] == '0') {
									$arr_ins = array(
										'to_id' => $id,
										'mp_id' => $params[1],
										'mp_code' => $params[2],
										'mp_category' => $params[3],
										'mp_name' => $params[4],
										'mu_code' => $params[5],
										'mu_name' => $params[6],
										'mbp_price' => $params[8],
										'msp_price' => $params[7],
										'tod_qty' => $post['qty'][$x],
										'td_outstanding' => $post['qty'][$x],
										'td_delivery_date' => $newDateTKirim,
										'tod_flag' => 1
									);
									$this->db->insert($this->table.'_detail', $arr_ins);
								}
								else { // tod_id != 0 => Update
									$arr_upd = array(
										'to_id' => $id,
										'mp_id' => $params[1],
										'mp_code' => $params[2],
										'mp_category' => $params[3],
										'mp_name' => $params[4],
										'mu_code' => $params[5],
										'mu_name' => $params[6],
										'mbp_price' => $params[8],
										'msp_price' => $params[7],
										'tod_qty' => $post['qty'][$x],
										'td_outstanding' => $post['qty'][$x],
										'td_delivery_date' => $newDateTKirim
									);

									$this->db->where('tod_id',$post['h_tod_id'][$x]);
									$this->db->update($this->table.'_detail',$arr_upd);
								}
							//}
							$x++;
						}

						// Update report laba rugi
						$this->mr->update_labarugi($id);

						$this->session->set_flashdata('msg','Data tersimpan!');
						$this->session->set_flashdata('next_page',base_url($this->controller.'/print_order/'.$id));
						$this->session->set_flashdata('next_page2',base_url($this->controller.'/print_invoice/'.$id));
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
			$this->load->model('model_report','mr');

			if($_POST) {
				// Delete PO detail
				$this->db->where('to_id',$this->input->post('id'));
				$this->db->update($this->table.'_detail',array('tod_flag'=>0));

				// Delete PO
				$this->db->where('to_id',$this->input->post('id'));
				$this->db->update($this->table,array('to_flag'=>0));

				// Delete laporan laba Rugi
				$this->mr->delete_labarugi($this->input->post('id'));
				$res['status'] = 'TRUE';
			}
			else {
				$res['status'] = 'FALSE';
			}

			echo json_encode($res);
		}

		function show_modal() {
			if($_POST) {
				// Get Harga
				$q = $this->mo->get_price($this->input->post('mp_id',array()));
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

		function print_order($po_id=0) {
			$this->is_logged_in();
			if( ! empty( $this->auth_role ) ) {
				if($po_id != 0) {
					$data = array(
							'site_title' => $this->site_title,
							'page_title' => 'Print Order',
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
					$q = $this->db->get_where('t_order',array('to_id'=>$po_id))->row_array();
					$data['mc_id'] = $q['mc_id'];
					$data['to_no'] = $q['to_no'];
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
					$data['prepared_by'] = $user['full_name'];

					// Get PO Detail
					//$q2 = $this->db->get_where('t_purchase_detail', array('to_id'=>$po_id,'tpd_flag'=>1));
					$q2 = $this->mo->get_detail_order($po_id);
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
			$q = $this->db->get_where('t_order',array('to_id'=>$po_id))->row_array();
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
			$q2 = $this->db->get_where('t_purchase_detail', array('to_id'=>$po_id,'tpd_flag'=>1));
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
			$q = $this->db->get_where('t_purchase',array('to_id'=>$po_id))->row_array();
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
			$q2 = $this->db->get_where('t_purchase_detail', array('to_id'=>$po_id,'tpd_flag'=>1));
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

		function print_invoice($po_id=0) {
			$this->is_logged_in();
			if( ! empty( $this->auth_role ) ) {
				if($po_id != 0) {
					$data = array(
							'site_title' => $this->site_title,
							'page_title' => 'Print Invoice',
							'page' => $this->folder_view.$this->controller.'/print_inv',
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

					// Get Order
					$user = get_user($this->auth_user_id);
					$q = $this->db->get_where('t_order',array('to_id'=>$po_id))->row_array();
					$data['mc_id'] = $q['mc_id'];
					$data['to_no'] = $q['toi_no'];
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
					$data['prepared_by'] = $user['full_name'];

					// Get Order Detail
					//$q2 = $this->db->get_where('t_purchase_detail', array('to_id'=>$po_id,'tpd_flag'=>1));
					$q2 = $this->mo->get_detail_order($po_id);
					$data['num_rows'] = $q2['num_rows'];
					$data['result'] = $q2['result'];

					$this->load->view('admin/template/home',$data);
				}
			}
		}
	}
