<?php
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class Report extends MY_Controller {
		private $folder_view = 'admin/';
		private $controller = 'report';

		function __construct() {
			parent::__construct();

			date_default_timezone_set('Asia/Jakarta');

			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('model_report','mr');
			$this->load->library(array('no_format','tanggal'));
		}

		function laba_rugi(){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');

			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Laporan Laba Rugi',
						'page' => $this->folder_view.$this->controller.'/labarugi_filter',
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

					// Get customer
					$qs = $this->db->get_where('m_customer',array('mc_id'=>$cust[0]))->row_array();
					$no_doc = $this->no_format->generate_receiving_no($data['date_now']);

					$mc_id = ($cust[0] == '' ? 0 : $cust[0]);
					$tgl_from = $date[2].'-'.$date[0].'-'.$date[1];
					$tgl_to = $date2[2].'-'.$date2[0].'-'.$date2[1];

					$this->session->set_flashdata('next_page',base_url($this->controller.'/print_labarugi/'.$mc_id.'/'.$tgl_from.'/'.$tgl_to));
				}

				$data['company_address'] = $this->config->item('company_address');

				$this->load->view('admin/template/home',$data);
			}
			else {
				redirect('logout');
			}
		}

		function print_labarugi($cust_id=0,$tgl_from=NULL,$tgl_to=NULL) {
			$this->is_logged_in();
			if( ! empty( $this->auth_role ) ) {
				if($cust_id != 0) {
					$data = array(
							'site_title' => $this->site_title,
							'page_title' => 'Cetak Report Delivery',
							'page' => $this->folder_view.$this->controller.'/labarugi_print',
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
					$q = $this->mr->report_labarugi($cust_id,$tgl_from,$tgl_to);
					$data['result'] = $q['result'];
					$data['num_rows'] = $q['num_rows'];

					$this->load->view('admin/template/home',$data);
				}
			}
		}
	}
