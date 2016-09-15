<?php
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_customer extends MY_Controller {
		private $folder_view = 'admin/master/';
		private $controller = 'm_customer';
		private $table = 'm_customer';
		
		function __construct() {
			parent::__construct();
			
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('model_customer','mc');
			$this->load->library('no_format');
		}
		
		function index(){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Daftar Customer',
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
				
				// Get customer
				$q = $this->mc->get_customer();
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
						'page_title' => 'Tambah Customer',
						'page' => $this->folder_view.$this->controller.'/create',
						'js_page' => $this->folder_view.$this->controller.'/js',
						'js_scripts' => array(
							'vendors/jquery/dist/jquery.min', /* jQuery */
							'vendors/bootstrap/dist/js/bootstrap.min', /* Bootstrap */
							'vendors/fastclick/lib/fastclick', /* FastClick */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/validator/validator' /* Validator.js */
						),
						'css_scripts' => array(
							'vendors/bootstrap/dist/css/bootstrap.min', /* Bootstrap */
							'vendors/font-awesome/css/font-awesome.min', /* Font Awesome */
							'vendors/nprogress/nprogress' /* NProgress */
						)
				);
				
				if($_POST) {
					$post = $this->input->post();
					
					$arr_ins = array(
						'mc_code' => $post['kode'],
						'mc_name' => $post['name'],
						'mc_address' => $post['address'],
						'mc_phone1' => $post['phone'],
						'mc_fax' => $post['fax'],
						'mc_pic' => $post['pic'],
						'mc_email' => $post['email'],
						'mc_flag' => 1
					);
					
					if($this->db->insert($this->table, $arr_ins)) {
						$this->session->set_flashdata('msg','Data tersimpan!');
						redirect($this->controller.'/create');
					}
				}
				
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
						'page_title' => 'Ubah Customer',
						'page' => $this->folder_view.$this->controller.'/edit',
						'js_page' => $this->folder_view.$this->controller.'/js',
						'js_scripts' => array(
							'vendors/jquery/dist/jquery.min', /* jQuery */
							'vendors/bootstrap/dist/js/bootstrap.min', /* Bootstrap */
							'vendors/fastclick/lib/fastclick', /* FastClick */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/validator/validator' /* Validator.js */
						),
						'css_scripts' => array(
							'vendors/bootstrap/dist/css/bootstrap.min', /* Bootstrap */
							'vendors/font-awesome/css/font-awesome.min', /* Font Awesome */
							'vendors/nprogress/nprogress' /* NProgress */
						)
				);
				
				// Get data
				$q = $this->db->get_where($this->table,array('mc_id'=>$id));
				$res = $q->row_array();
				
				$data['id'] = $id;
				$data['kode'] = $res['mc_code'];
				$data['mc_name'] = $res['mc_name'];
				$data['mc_address'] = $res['mc_address'];
				$data['mc_phone1'] = $res['mc_phone1'];
				$data['mc_fax'] = $res['mc_fax'];
				$data['mc_pic'] = $res['mc_pic'];
				$data['mc_email'] = $res['mc_email'];
				
				if($_POST) {
					$post = $this->input->post();
					
					$arr_ins = array(
						'mc_code' => $post['kode'],
						'mc_name' => $post['name'],
						'mc_address' => $post['address'],
						'mc_phone1' => $post['phone'],
						'mc_fax' => $post['fax'],
						'mc_pic' => $post['pic'],
						'mc_email' => $post['email'],
						'mc_flag' => 1
					);
					
					$this->db->where('mc_id',$id);
					$res = $this->db->update($this->table,$arr_ins);
					if($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('msg','Data tersimpan!');
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
				$this->db->where('mc_id',$this->input->post('id'));
				$this->db->update($this->table,array('mc_flag'=>0));
				$res['status'] = 'TRUE';
			}
			else {
				$res['status'] = 'FALSE';
			}
			
			echo json_encode($res);
		}
	}