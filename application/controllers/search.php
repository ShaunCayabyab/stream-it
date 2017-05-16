<?php
	/**
	* =================
	* SEARCH CONTROLLER
	* =================
	* Controller for handling the search function on the home page.
	*
	* @function __construct - Main constructor
	* @function redirect - Used to redirect to home if now search was made
	* @function post_proxy - Used to add search query as part of URL
	* @function allSearch - Main search function for the controller
	*/
	class Search extends CI_Controller{
		/**
		* __construct()
		* =============
		* Main constructor function.
		*/
		public function __construct(){
			parent::__construct();
			$this->load->model('actor_model');
			$this->load->model('show_model');
		}

		/**
		* redirect
		* ========
		* Redirecting function for when there's no query to search.
		* Used to prevent routing errors.
		*/
		public function redirect(){
			redirect('/', 'refresh');
		}

		/**
		* post_proxy
		* ==========
		* Function primarily used to create dynamic routing and to add query to URL.
		*/
		public function post_proxy(){
			// Some formatting for query presentation on URL
			$search = $this->security->xss_clean($this->input->post('search_query'));
			$search = str_replace(" ", "_", $search);

			// creates the new URL and executes search
			redirect('search/' . $search);
		}


		/**
		* alSearch
		* ========
		* Main search function for Search controller.
		* Gathers actors and shows that matcch the queries and loads the search view with data.
		*
		* @param {String} search - the posted search query by user
		*/
		public function allSearch($search){

			// Gather all shows and actors that match query
			$actors = $this->actor_model->getSearchActors($search);
			$shows = $this->show_model->getSearchTitles($search);

			// Bind data to view
			$data['shows'] = $shows;
			$data['actors'] = $actors;
			$data['search'] = str_replace("_", " ", $search);

			// Load view
			$this->load->view('search_view', $data);
		}
	}
?>