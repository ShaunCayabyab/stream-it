<?php
	/**
	* ================
	* SHOWS CONTROLLER
	* ================
	* Controller for the shows view. Controller resposible for displaying 
	* show information.
	*
	* @function __construct - Main constructor
	* @funtion mainShowsPage - Used to display all shows if route is just "../shows"
	* @function getAllShowInfo - Gather all the information of a chosen show
	* @function IDValidation - Private function to check if if the given showID is an actual showID
	*/
	class Shows extends CI_Controller{
		
		/**
		* __construct()
		* =============
		* Main constructor function.
		*/
		public function __construct(){
			parent::__construct();
			$this->load->model('show_model');
			$this->load->model('customer_model');
		}

		/**
		* mainShowsPage
		* =============
		* If URL route is just "../shows/", display all show information
		* (still not implemented)
		*/
		public function mainShowsPage(){
			//"SELECT * from shows WHERE showID = '$showID' LIMIT 0, 1"

		}

		/**
		* getAllShowInfo
		* ==============
		* Function to obtain the show information from the database.
		* @param {String} show_id - show ID given from the routing
		*/
		public function getAllShowInfo($show_id){

			// First check if given show_id meets the correct format
			if(!$this->idValidation($show_id)) show_404();

			// Call the query to get the show information
			$show_info = $this->show_model->getShowInfo($show_id);

			// Checks if show information was actually obtained
			// if not, 404.
			if (isset($show_info[0])) $show_info = $show_info[0];
			else show_404();

			// Get all the actor information
			$main_cast = $this->show_model->getMainActors($show_id);
			$recurring_cast = $this->show_model->getRecurringActors($show_id);

			// Bind data to view
			$data['show_id'] = $show_id;
			$data['show_info'] = $show_info;
			$data['main_cast'] = $main_cast;
			$data['recurring_cast'] = $recurring_cast;
			$data['logged'] = $this->customer_model->isLoggedIn();

			// All set, load appropriate view
			$this->load->view('show_view', $data);
		}

		/**
		* idValidation
		* ============
		* Private function to check if given show ID is in right format.
		* 404 redirect if not
		* @param {String} id - Given show ID
		*/
		private function idValidation($id){
			// Check if show ID is prefixed with "sh"
			if($id[0] == "s" && $id[1] == "h") return true;
			else return false;
		}
	}
?>