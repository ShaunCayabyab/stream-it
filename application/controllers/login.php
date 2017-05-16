<?php
	/**
	* LOGIN CONTROLLER
	* ================
	* Controller for handling login information
	*
	* @function __construct - Main constructor
	* @function index - Generates index page for the login
	* @function process - Main login processing function
	*/
	class Login extends CI_Controller{
		/**
		* __construct()
		* =============
		* Main constructor function.
		*/
		function __construct(){
			parent::__construct();
		}
		
		/**
		* index
		* =====
		* Produces the login page for the index
		*/
		public function index(){
			$this->load->view('login_view');
		}


		/** 
		* process
		* =======
		* Cleans and prepares login form inputs to be broughts to customer_model
		* for login verification. Once processed, function will redirect according
		* to processing result.
		*/
		public function process(){
			// Model load inside this function instead of constructor
			// to ensure model is only loaded during login processing
			$this->load->model('customer_model');

			// Cleaning up input
			$username = $this->security->xss_clean($this->input->post('username'));
			$password = $this->security->xss_clean($this->input->post('password'));

			// Perform login check
			$result = $this->customer_model->login($username, $password);

			// Login success? If not, redirect back to login page
			if(!$result){
				$this->index();
			}
			else{
				redirect('/', 'refresh');
			}
		}
	}



?>