<?php
	/**
	* ===================
	* EPISODES CONTROLLER
	* ===================
	* Controller for gathering episode information.
	*
	* @function __construct - Main constructor
	* @function listEpisodes - Lists all episodes for a show
	* @function getEpisode - Gets information of a single selected episode
	* @function idValidation - format checker for episode ID
	*/
	class Episodes extends CI_Controller{

		/**
		* __construct()
		* =============
		* Main constructor function.
		*/
		public function __construct(){
			parent::__construct();
			$this->load->model('show_model');
			$this->load->model('actor_model');
			$this->load->model('customer_model');
		}

		/**
		* listEpisodes
		* ============
		* Function for generating the list of episode for a show
		*
		* @param {String} show_id - Give show ID
		*/
		public function listEpisodes($show_id){

			// Check show ID format
			if(!$this->idValidation($show_id)) show_404();

			// Gather show episodes
			$episodes = $this->show_model->getEpisodes($show_id);

			// Checks if episodes were actually obtained
			// if not, 404.
			if (!isset($episodes)) show_404();

			// Get show title for view
			$title = $this->show_model->getShowTitle($show_id)[0]->title;

			// Data-binding for view
			$data['showID'] = $show_id;
			$data['title'] = $title;
			$data['episodes'] = $episodes;

			// Off to view
			$this->load->view('episodes_view', $data);
		}

		/**
		* getEpisode
		* ==========
		* Gets the information of a given episode of show
		*
		* @param {String} show_id - Given show ID
		* @param {String} episode_id - Given episode ID
		*/
		public function getEpisode($show_id, $episode_id){
			// Check show ID format
			if(!$this->idValidation($show_id)) show_404();


			$info = $this->show_model->getEpisodeInfo($show_id, $episode_id);

			// Did we get the episode?
			if(isset($info)) $info = $info[0];
			else show_404();

			// Gathers the actor information for the episode
			$main = $this->actor_model->getMainEpisodeActors($show_id, $episode_id);
			$recurring = $this->actor_model->getRecurringEpisodeActors($show_id, $episode_id);
			$cast_count = count($recurring);

			// Bind data to view
			$data['show_id'] = $show_id;
			$data['episode_id'] = $episode_id;
			$data['info'] = $info;
			$data['main_cast'] = $main;
			$data['recurring_cast'] = $recurring;
			$data['cast_count'] = $cast_count;
			$data['logged'] = $this->customer_model->isLoggedIn();

			// To view
			$this->load->view('single_episode_view', $data);
		}

		/**
		* idValidation
		* ============
		* Private function to check if given show ID is in right format.
		* 404 redirect if not
		* @param {String} id - Given show ID
		*/
		private function idValidation($id){
			if($id[0] == "s" && $id[1] == "h") return true;
			else return false;
		}
	}
?>