<?php
	/**
	* ================
	* WATCH CONTROLLER
	* ================
	* Handles the watch page for the show episode
	*
	* @function __construct - Main constructor
	* @function watchEpisode - Displays episode video and adds episode to customers watched list
	*/
	class Watch extends CI_Controller{
		/**
		* __construct()
		* =============
		* Main constructor function.
		*/
		public function __construct(){
			parent::__construct();
			$this->load->model('customer_model');
			$this->load->model('show_model');

			// Logged in? If not, redirect to home page
			if(!$this->customer_model->isLoggedIn()){
				redirect('/', 'refresh');
			}
		}

		/**
		* watchEpisode
		* ============
		* Used for the user to watch the episode,
		* then add the episode to the user's watched list
		*
		* @param {String} show_id - Given show ID
		* @param {String} episode_id - Given episode ID
		*/
		public function watchEpisode($show_id, $episode_id){

		}
	}
?>