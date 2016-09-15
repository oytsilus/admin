<?php
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_price extends MY_Controller {
		private $folder_view = 'admin/master/';
		private $controller = 'm_price';
		private $table = 'm_price';
		
		function __construct() {
			parent::__construct();
			
			date_default_timezone_set('Asia/Jakarta');
			
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('model_price','mp');
			$this->load->library('no_format');
		}
		
		function index(){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Daftar Harga',
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
				
				// Get harga
				$q = $this->mp->get_price();
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
						'page_title' => 'Set Harga',
						'page' => $this->folder_view.$this->controller.'/create',
						'js_page' => $this->folder_view.$this->controller.'/js',
						'js_scripts' => array(
							'vendors/jquery/dist/jquery.min', /* jQuery */
							'vendors/bootstrap/dist/js/bootstrap.min', /* Bootstrap */
							'vendors/fastclick/lib/fastclick', /* FastClick */
							'vendors/nprogress/nprogress', /* NProgress */
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
							'vendors/select2/dist/css/select2.min' /* Select2 */
						),
						'date_now' => date('m/d/Y')
				);
				
				if($_POST) {
					$post = $this->input->post();
					
					$x = 0;
					$datetime = explode('/',$post['tgl_berlaku']); // mm/dd/yyyy
					foreach($post['hbeli'] as $key=>$item) {
						if($item != '0' && $item != '') {
							$params = explode('|', $post['h_params'][$x]);
							$supplier = explode('|', $post['supplier']);
							
							$arr_ins[] = array(
								'mp_id' => $params[0],
								'ms_id' => $supplier[0],
								'ms_code' => $supplier[1],
								'ms_name' => $supplier[2],
								'mp_code' => $params[1],
								'mp_category' => $params[2],
								'mp_name' => $params[3],
								'mu_code' => $params[4],
								'mu_name' => $params[5],
								'mbp_datetime' => $datetime[2].'-'.$datetime[0].'-'.$datetime[1].' '.date('H:i:s'),
								'mbp_buy_price' => $item,
								'mbp_sell_price' => $post['hjual'][$x],
								'mbp_disc' => $post['disc'][$x],
								'mbp_disc_nominal' => $post['disc2'][$x],
								'mbp_flag' => 1
							);
						}
						
						$x++;
					}
					
					$this->db->insert_batch($this->table, $arr_ins);
					$this->session->set_flashdata('msg','Data tersimpan!');
					redirect($this->controller.'/create');
				}
				
				// Get harga
				$q = $this->mp->get_price();
				$data['num_rows'] = $q['num_rows'];
				$data['result'] = $q['result'];
				
				$this->load->view('admin/template/home',$data);
			}
			else {
				redirect('logout');
			}
		}
		
		function edit($id=0,$sup_id=0){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'History Harga',
						'page' => $this->folder_view.$this->controller.'/edit',
						'js_page' => $this->folder_view.$this->controller.'/js',
						'js_scripts' => array(
							'vendors/jquery/dist/jquery.min', /* jQuery */
							'vendors/bootstrap/dist/js/bootstrap.min', /* Bootstrap */
							'vendors/fastclick/lib/fastclick', /* FastClick */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/validator/validator', /* Validator.js */
							'js/moment/moment.min', /* Bootstrap daterangepicker */
							'js/datepicker/daterangepicker', /* Bootstrap daterangepicker */
							'vendors/select2/dist/js/select2.full.min' /* Select2 */
						),
						'css_scripts' => array(
							'vendors/bootstrap/dist/css/bootstrap.min', /* Bootstrap */
							'vendors/font-awesome/css/font-awesome.min', /* Font Awesome */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/select2/dist/css/select2.min' /* Select2 */
						),
						'date_now' => date('m/d/Y')
				);
				
				// Get data
				$q = $this->db->get_where('m_product',array('mp_id'=>$id));
				$res = $q->row_array();
				
				// Get harga
				$q = $this->mp->get_price_history($id,$sup_id);
				$data['num_rows'] = $q['num_rows'];
				$data['result'] = $q['result'];
				
				$data['id'] = $id;
				$data['sup_id'] = $sup_id;
				$data['kode'] = $res['mp_code'];
				$data['mp_name'] = $res['mp_name'];
				$data['mu_name'] = $res['mu_name'];
				
				if($_POST) {
					$post = $this->input->post();
					
					$x = 0;
					if(count($post['h_id_detail'] > 0)) {
						foreach($post['h_id_detail'] as $item) {
							$arr_ins = array(
								'mbp_buy_price' => $post['hbeli'][$x],
								'mbp_sell_price' => $post['hjual'][$x],
								'mbp_disc' => $post['disc'][$x],
								'mbp_disc_nominal' => $post['disc2'][$x],
							);
							
							$this->db->where('mbp_id',$item);
							$res = $this->db->update($this->table,$arr_ins);
							$x++;
						}
						
						if($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('msg','Data tersimpan!');
							redirect($this->controller.'/edit/'.$id.'/'.$sup_id);
						}
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
		
		function generate_harga() {
			if($_POST) {
				if($this->input->post('id','') == '') {
					echo "Silahkan pilih supplier!";
				}
				else {
					$exp = explode('|',$this->input->post('id'));
					
					// Get Harga
					$q = $this->mp->get_price($exp[0]);
					$data['num_rows'] = $q['num_rows'];
					$data['result'] = $q['result'];
					
					$this->load->view($this->folder_view.$this->controller.'/create_detail',$data);
				}
			}
			else echo "Invalid result!";
		}
	}