<?php
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_product extends MY_Controller {
        private $folder_view = 'admin/master/';
		private $controller = 'm_product';
		private $table = 'm_product';
			
		function __construct() {
			parent::__construct();
			
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('model_product','mp');
			$this->load->library('no_format');
		}
		
		function index(){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Daftar Item',
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
				
				// Get product
				$q = $this->mp->get_product();
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
						'page_title' => 'Tambah Item',
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
				
				// Get kode item
				$data['kode'] = $this->no_format->get_kode('SAYUR');
				
				if($_POST) {
					$post = $this->input->post();
					$exp = explode('|',$post['unit']);
					
					$arr_ins = array(
						'mu_id' => $exp[0],
						'mp_code' => $post['kode'],
						'mu_code' => $exp[1],
						'mu_name' => $exp[2],
						'mp_category' => $post['category'],
						'mp_name' => $post['name'],
						'mp_flag' => 1
					);
					
					if($this->db->insert('m_product', $arr_ins)) {
						$this->session->set_flashdata('msg','Data tersimpan!');
						redirect('m_product/create');
					}
				}
				
				$this->load->view('admin/template/home',$data);
			}
			else {
				redirect('logout');
			}
		}
		
		function get_kode() {
			$res = array('status'=>'FALSE','kode'=>NULL);
			
			if($_POST) {
				$res['status'] = 'TRUE';
				
				$res['kode'] = $this->no_format->get_kode($this->input->post('tipe'));
			}
			
			echo json_encode($res);
		}
		
		function edit($id=0){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Ubah Item',
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
				$q = $this->db->get_where('m_product',array('mp_id'=>$id));
				$res = $q->row_array();
				
				$data['id'] = $id;
				$data['kode'] = $res['mp_code'];
				$data['mp_name'] = $res['mp_name'];
				$data['mp_category'] = $res['mp_category'];
				$data['mu_id'] = $res['mu_id'];
				$data['unit'] = $res['mu_id'].'|'.$res['mu_code'].'|'.$res['mu_name'];
				
				if($_POST) {
					$post = $this->input->post();
					$exp = explode('|',$post['unit']);
					
					$arr_ins = array(
						'mu_id' => $exp[0],
						'mp_code' => $post['kode'],
						'mu_code' => $exp[1],
						'mu_name' => $exp[2],
						'mp_category' => $post['category'],
						'mp_name' => $post['name'],
						'mp_flag' => 1
					);
					
					$this->db->where('mp_id',$id);
					$res = $this->db->update('m_product',$arr_ins);
					if($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('msg','Data tersimpan!');
						redirect('m_product/edit/'.$id);
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
				$this->db->where('mp_id',$this->input->post('id'));
				$this->db->update('m_product',array('mp_flag'=>0));
				$res['status'] = 'TRUE';
			}
			else {
				$res['status'] = 'FALSE';
			}
			
			echo json_encode($res);
		}
	}