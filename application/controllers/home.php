<?php
	/**
	* ===============
	* HOME CONTROLLER
	* ===============
	* Controller for the homepage.
	* Not much here really...
	*
	* @function __construct - Main constructor
	* @function index - produces the index page for Home
	* @function logout - Takes care of executing user logout
	*/
	class Home extends CI_Controller{
		/**
		* __construct()
		* =============
		* Main constructor function.
		*/
		function __construct(){
			parent::__construct();
			//$this->isValidated();
		}

		/**
		* index
		* =====
		* Generates the index page for Home
		*/
		public function index(){
			$this->load->view('home_view');
		}

		/**
		* Logout Function:
		* ===============
		* Obviously, used to logout and 
		* destroy session data.
		*/
		public function logout(){
			$this->session->sess_destroy();
			redirect('/', 'refresh');
		}
	}
?>