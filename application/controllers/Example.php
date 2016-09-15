<?php
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class Example extends MY_Controller {
                
		function __construct() {
			parent::__construct();
			
			$this->load->helper('url');
			$this->load->helper('form');
		}

		function index(){
			$this->is_logged_in();
			$this->load->model('model_admin','ma');
			
			if( ! empty( $this->auth_role ) ) {
				$data = array(
						'site_title' => $this->site_title,
						'page_title' => 'Dashboard',
						'page' => 'admin/dashboard',
						'js_page' => 'admin/js/default',
						'js_scripts' => array(
							'vendors/jquery/dist/jquery.min', /* jQuery */
							'vendors/bootstrap/dist/js/bootstrap.min', /* Bootstrap */
							'vendors/fastclick/lib/fastclick', /* FastClick */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/Chart.js/dist/Chart.min', /* Chart.js */
							'vendors/gauge.js/dist/gauge.min', /* gauge.js */
							'vendors/bootstrap-progressbar/bootstrap-progressbar.min', /* bootstrap-progressbar */
							'vendors/iCheck/icheck.min', /* iCheck */
							'vendors/skycons/skycons', /* Skycons */
							'vendors/Flot/jquery.flot', /* Flot */
							'vendors/Flot/jquery.flot.pie',
							'vendors/Flot/jquery.flot.time',
							'vendors/Flot/jquery.flot.stack',
							'vendors/Flot/jquery.flot.resize',
							'js/flot/jquery.flot.orderBars', /* Flot plugins */
							'js/flot/date',
							'js/flot/jquery.flot.spline',
							'js/flot/curvedLines',
							'js/moment/moment.min', /* bootstrap daterange picker */
							'js/datepicker/daterangepicker'
						),
						'css_scripts' => array(
							'vendors/bootstrap/dist/css/bootstrap.min', /* Bootstrap */
							'vendors/font-awesome/css/font-awesome.min', /* Font Awesome */
							'vendors/nprogress/nprogress', /* NProgress */
							'vendors/iCheck/skins/flat/green', /* iCheck */
							'vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min' /* bootstrap-progressbar */
						)
				);
				
				$this->load->view('admin/template/home',$data);
			}
			else {
				redirect('logout');
			}
		}
		
		function count_result($limit,$offset){
			$this->load->model('model_admin','ma');
			
			$result = $this->ma->countResult($limit,$offset);
			print_r($result);
		}
		
		function pdf(){
			$this->pdf->load_view('admin/example_to_pdf');
			// (Optional) Setup the paper size and orientation
			/**
			* paper size : 'letter', 'A4', 'legal'
			* orientation : 'portrait' (default), 'landscape'
			*/
			$this->pdf->set_paper('A4', 'portrait');
			$this->pdf->render();
			$this->pdf->stream("name-file.pdf");
		}
	}
