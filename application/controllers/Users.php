<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
	private $site_name = '@swCMS';
	
    public function __construct()
    {
        parent::__construct();

        // Force SSL
        //$this->force_ssl();

        // Form and URL helpers always loaded (just for convenience)
        $this->load->helper('url');
        $this->load->helper('form');
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
        if( $this->require_role('admin') )
        {
            echo $this->load->view('examples/page_header', '', TRUE);

            echo '<p>You are logged in!</p>';

            echo $this->load->view('examples/page_footer', '', TRUE);
        }
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