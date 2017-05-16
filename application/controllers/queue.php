<?php
	/**
	* ================
	* QUEUE CONTROLLER
	* ================
	* Controller that handles the customer's queue information
	*
	* @function __construct - Main constructor
	* @function queueList - Gather the customer's queue list
	* @function watchedList - Gather the episodes the customer watched
	* @function idValidation - Used to check show ID formatting from URL route
	*/
	class Queue extends CI_Controller{
		/**
		* __construct()
		* =============
		* Main constructor function.
		*/
		public function __construct(){
			parent::__construct();
			$this->load->model('customer_model');
			$this->load->model('show_model');

			// Page for logged-in customers only. Redirect back to home if not logged in.
			if(!$this->customer_model->isLoggedIn()){
				redirect('/', 'refresh');
			}
		}

		/**
		* queueList
		* =========
		* Function gathers the list of shows in the customer's queue
		*/
		public function queueList(){
			$data['queue'] = $this->customer_model->getQueue();

			$this->load->view('queue_view', $data);
		}

		/**
		* watchedList
		* ============
		* Gathers the episodes of a show that the customer has watched already
		*
		* @param {String} show_id = Given show ID from queue
		*/
		public function watchedList($show_id){
			// Need to check show ID formatting
			if(!$this->idValidation($show_id)) show_404();

			// Check if show ID is valid show ID
			$show_title = $this->show_model->getShowTitle($show_id);
			if(!isset ($show_title[0])) show_404();

			// Bind the data
			$data['episodes'] = $this->customer_model->getWatchedEpisodes($show_id);
			$data['title'] = $show_title[0]->title;
			$data['show_id'] = $show_id;

			// Load view
			$this->load->view('watched_view', $data);
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