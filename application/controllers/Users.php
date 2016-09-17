<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
	private $site_name = '@swCMS';
	private $folder_view = 'admin/master/';
	private $controller = 'm_user';
	private $table = 'users';
	
    public function __construct()
    {
        parent::__construct();

        // Force SSL
        //$this->force_ssl();

        // Form and URL helpers always loaded (just for convenience)
        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('model_user','mu');
		$this->load->library('no_format');
    }
	
	// -----------------------------------------------------------------------

    /**
     * Demonstrate being redirected to login.
     * If you are logged in and request this method,
     * you'll see the message, otherwise you will be
     * shown the login form. Once login is achieved,
     * you will be redirected back to this method.
     */
    public function index()
    {
        if( $this->require_role('admin') ) {
            $data = array(
					'site_title' => $this->site_title,
					'page_title' => 'Daftar User',
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
			
			// Get user
			$q = $this->mu->get_user();
			$data['num_rows'] = $q['num_rows'];
			$data['result'] = $q['result'];
			
			$this->load->view('admin/template/home',$data);
        }
		else {
			echo "You have no authorized access to this page";
		}
    }
	
	// -----------------------------------------------------------------------
	
	/**
	* Create user
	**/
	
	function create(){
		$this->is_logged_in();
		$this->load->model('model_user','mu');
		$this->load->model('examples_model');
		$this->load->model('validation_callables');
		$this->load->library('form_validation');
		$def_auth = '1'; // Default auth_level = 1 (Regular User)
		
		if( ! empty( $this->auth_role ) ) {
			$data = array(
					'site_title' => $this->site_title,
					'page_title' => 'Tambah User',
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
				
				$user_data = array(
					'username' => $post['username'],
					'passwd' => $post['passwd'],
					'full_name' => $post['full_name'],
					'email' => $post['email'],
					'auth_level' => $post['auth_level'],
					'created_at' => date('Y-m-d H:i:s')
				);
				
				$this->form_validation->set_data( $user_data );
				
				$validation_rules = [
					[
						'field' => 'username',
						'label' => 'username',
						'rules' => 'max_length[12]|is_unique[' . config_item('user_table') . '.username]',
						'errors' => [
							'is_unique' => 'Username already in use.'
						]
					],
					[
						'field' => 'passwd',
						'label' => 'passwd',
						'rules' => [
							'trim',
							'required',
							[ 
								'_check_password_strength', 
								[ $this->validation_callables, '_check_password_strength' ] 
							]
						],
						'errors' => [
							'required' => 'The password field is required.'
						]
					],
					[
						'field'  => 'email',
						'label'  => 'email',
						'rules'  => 'trim|required|valid_email|is_unique[' . config_item('user_table') . '.email]',
						'errors' => [
							'is_unique' => 'Email address already in use.'
						]
					],
					[
						'field' => 'auth_level',
						'label' => 'auth_level',
						'rules' => 'required|integer|in_list[1,6,9]'
					]
				];

				$this->form_validation->set_rules( $validation_rules );

				if( $this->form_validation->run() )
				{
					$user_data['passwd']     = $this->authentication->hash_passwd($user_data['passwd']);
					$user_data['user_id']    = $this->examples_model->get_unused_id();
					$user_data['created_at'] = date('Y-m-d H:i:s');

					// If username is not used, it must be entered into the record as NULL
					if( empty( $user_data['username'] ) )
					{
						$user_data['username'] = NULL;
					}

					$this->db->set($user_data)
						->insert(config_item('user_table'));

					if( $this->db->affected_rows() == 1 ) {
						$msg = '<h1>Congratulations</h1>' . '<p>User ' . $user_data['username'] . ' was created.</p>';
					
						$this->session->set_flashdata('msg',$msg);
					}
				}
				else
				{
					$msg = '<h1>User Creation Error(s)</h1>' . validation_errors();
					$this->session->set_flashdata('msg',$msg);
				}
				/*
				if($this->db->insert($this->table, $arr_ins)) {
					$this->session->set_flashdata('msg','Data tersimpan!');
					redirect($this->controller.'/create');
				}*/
			}
			
			$this->load->view('admin/template/home',$data);
		}
		else {
			redirect('logout');
		}
	}
	
	// -----------------------------------------------------------------------
	
	/**
	* Edit user
	**/
	
	function edit($id=0){
		$this->is_logged_in();
		$this->load->model('model_user','mu');
		$this->load->model('examples_model');
		$this->load->model('validation_callables');
		$this->load->library('form_validation');
		$def_auth = '1'; // Default auth_level = 1 (Regular User)
		
		if( ! empty( $this->auth_role ) ) {
			$data = array(
					'site_title' => $this->site_title,
					'page_title' => 'Ubah User',
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
			$q = $this->db->get_where('users',array('user_id'=>$id));
			$res = $q->row_array();
			
			$data['id'] = $id;
			$data['username'] = $res['username'];
			$data['full_name'] = $res['full_name'];
			$data['email'] = $res['email'];
			
			if($_POST) {
				$post = $this->input->post();
				
				if($post['passwd'] == '') {
					$user_data = array(
						'username' => $post['username'],
						'full_name' => $post['full_name'],
						'email' => $post['email'],
						'auth_level' => $post['auth_level'],
						'created_at' => date('Y-m-d H:i:s')
					);
				}
				else {
					$user_data = array(
						'username' => $post['username'],
						'passwd' => $post['passwd'],
						'full_name' => $post['full_name'],
						'email' => $post['email'],
						'auth_level' => $post['auth_level'],
						'created_at' => date('Y-m-d H:i:s')
					);
				}
				
				$this->form_validation->set_data( $user_data );
				
				if($post['passwd'] != '') {
					$validation_rules = [
						[
							'field' => 'username',
							'label' => 'username',
							'rules' => 'max_length[12]',
							'errors' => [
								
							]
						],
						[
							'field' => 'passwd',
							'label' => 'passwd',
							'rules' => [
								'trim',
								'required',
								[ 
									'_check_password_strength', 
									[ $this->validation_callables, '_check_password_strength' ] 
								]
							],
							'errors' => [
								'required' => 'The password field is required.'
							]
						],
						[
							'field'  => 'email',
							'label'  => 'email',
							'rules'  => 'trim|required|valid_email',
							'errors' => [

							]
						],
						[
							'field' => 'auth_level',
							'label' => 'auth_level',
							'rules' => 'required|integer|in_list[1,6,9]'
						]
					];
				}
				else {
					$validation_rules = [
						[
							'field' => 'username',
							'label' => 'username',
							'rules' => 'max_length[12]',
							'errors' => [
								
							]
						],
						[
							'field'  => 'email',
							'label'  => 'email',
							'rules'  => 'trim|required|valid_email',
							'errors' => [
								
							]
						],
						[
							'field' => 'auth_level',
							'label' => 'auth_level',
							'rules' => 'required|integer|in_list[1,6,9]'
						]
					];
				}

				$this->form_validation->set_rules( $validation_rules );

				if( $this->form_validation->run() )
				{
					if($post['passwd'] != '') {
						$user_data['passwd']     = $this->authentication->hash_passwd($user_data['passwd']);
					}
					$user_data['created_at'] = date('Y-m-d H:i:s');

					// If username is not used, it must be entered into the record as NULL
					if( empty( $user_data['username'] ) )
					{
						$user_data['username'] = NULL;
					}

					//$this->db->set($user_data)
					//	->insert(config_item('user_table'));
					$this->db->where('user_id',$id);
					$this->db->update($this->table,$user_data);

					if( $this->db->affected_rows() == 1 ) {
						$msg = '<h1>Congratulations</h1>' . '<p>User has been updated!</p>';
						$this->session->set_flashdata('msg',$msg);
					}
				}
				else
				{
					$msg = '<h1>User Update Error(s)</h1>' . validation_errors();
					$this->session->set_flashdata('msg',$msg);
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
			$this->db->where('user_id',$this->input->post('id'));
			$this->db->delete('users');
			$res['status'] = 'TRUE';
		}
		else {
			$res['status'] = 'FALSE';
		}
		
		echo json_encode($res);
	}
    
    // -----------------------------------------------------------------------

    /**
     * A basic page that shows verification that the user is logged in or not.
     * If the user is logged in, a link to "Logout" will be in the menu.
     * If they are not logged in, a link to "Login" will be in the menu.
     */
    public function home()
    {
        $this->is_logged_in();
        
        echo $this->load->view('examples/page_header', '', TRUE);

        echo '<p>Welcome Home</p>';

        echo $this->load->view('examples/page_footer', '', TRUE);
    }
    
    // -----------------------------------------------------------------------
    
	public function login()
    {
        // Method should not be directly accessible
        if( $this->uri->uri_string() == 'users/login')
            show_404();

        if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )
            $this->require_min_level(1);

        $this->setup_login_form();
		
		$data = array(
					'title' => $this->site_name.' :: Login Form'
				);

        $this->load->view('admin/login', $data);
    }
	
	// -----------------------------------------------------------------------
	
	/**
     * Log out
     */
    public function logout()
    {
        $this->authentication->logout();

        // Set redirect protocol
        $redirect_protocol = USE_SSL ? 'https' : NULL;

        redirect( site_url( LOGIN_PAGE . '?logout=1', $redirect_protocol ) );
    }

    // --------------------------------------------------------------
}