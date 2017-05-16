<?php
	/**
	* ================
	* ACTOR CONTROLLER
	* ================
	* Main Controller for retrieving individual actor information
	*
	* @function __construct - Main constructor
	* @function getActorInfo - Used to get the actor information
	*/
	class Actor extends CI_Controller{
		/**
		* __construct()
		* =============
		* Main constructor function.
		*/
		public function __construct(){
			parent::__construct();
			$this->load->model('actor_model');
		}

		/**
		* getActorInfo
		* ============
		* Gathers the information about the individual actor.
		*
		* @param {String} actor_id - Given ID for actor
		*/
		public function getActorInfo($actor_id){

			// Format checker for actor_id
			if(!$this->idValidation($actor_id)) show_404();

			// Grab the actor information from database
			$name = $this->actor_model->getActorName($actor_id);

			// Did we get the actor?
			if(isset($name)) $name = $name[0];
			else show_404();

			// Get the roles that this actor played
			$main_roles = $this->actor_model->getMainRoles($actor_id);
			$recurring_roles = $this->actor_model->getRecurringRoles($actor_id);

			// Data binding
			$data['name'] = $name->fname . " " . $name->lname;
			$data['main_roles'] = $main_roles;
			$data['recurring_roles'] = $recurring_roles;

			// Load view
			$this->load->view('actor_view', $data);
		}

		/**
		* idValidation
		* ============
		* Private function to check if given actor ID is in right format.
		* 404 redirect if not
		* @param {String} some_id - Given actor ID
		*/
		private function idValidation($some_id){
			$some_id = str_split($some_id, 3);
			if($some_id[0] == "act") return true;
			else return false;
		}
	}
?>