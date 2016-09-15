<?php
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_supplier extends MY_Controller {
		private $folder_view = 'admin/master/';
		private $controller = 'm_supplier';
		private $table = 'm_supplier';
		
		function __construct() {
			parent::__construct();
			
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('model_supplier','ms');
			$this->load->library('no_format');
		}
		
		function index(){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Daftar Supplier',
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
				
				// Get supplier
				$q = $this->ms->get_supplier();
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
						'page_title' => 'Tambah Supplier',
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
						'ms_code' => $post['kode'],
						'ms_name' => $post['name'],
						'ms_address' => $post['address'],
						'ms_phone1' => $post['phone'],
						'ms_fax' => $post['fax'],
						'ms_email' => $post['email'],
						'ms_pic' => $post['pic'],
						'ms_flag' => 1
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
						'page_title' => 'Ubah Supplier',
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
				$q = $this->db->get_where($this->table,array('ms_id'=>$id));
				$res = $q->row_array();
				
				$data['id'] = $id;
				$data['kode'] = $res['ms_code'];
				$data['ms_name'] = $res['ms_name'];
				$data['ms_address'] = $res['ms_address'];
				$data['ms_phone1'] = $res['ms_phone1'];
				$data['ms_fax'] = $res['ms_fax'];
				$data['ms_email'] = $res['ms_email'];
				$data['ms_pic'] = $res['ms_pic'];
				
				if($_POST) {
					$post = $this->input->post();
					
					$arr_ins = array(
						'ms_code' => $post['kode'],
						'ms_name' => $post['name'],
						'ms_address' => $post['address'],
						'ms_phone1' => $post['phone'],
						'ms_fax' => $post['fax'],
						'ms_email' => $post['email'],
						'ms_pic' => $post['pic'],
						'ms_flag' => 1
					);
					
					$this->db->where('ms_id',$id);
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
				$this->db->where('ms_id',$this->input->post('id'));
				$this->db->update($this->table,array('ms_flag'=>0));
				$res['status'] = 'TRUE';
			}
			else {
				$res['status'] = 'FALSE';
			}
			
			echo json_encode($res);
		}
	}