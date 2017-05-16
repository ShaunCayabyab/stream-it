 <?php
 	/**
 	* ==========
 	* SHOW MODEL
 	* ==========
 	* Model for getting the appropriate information of a show from the database
 	*
 	* @function getSearchTitles - Get shows that match query from user search
 	* @function getShowTitle - Main getter for a show title
 	* @function getShowInfo - Get show information to display on show's info page
 	* @function getEpisodes - Generate the list of episodes for a given show
 	* @function getEpisodeInfo - Obtain the information for a certain episode of show
 	* @function getMainActors - Get the main actors to a given show
 	* @function getRecurringActors - Get the recurring actors in a given show
 	*/
	class Show_model extends CI_Model{

		public function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->model('show_model', '', TRUE);
		}

		/**
		* getSearchTitles:
		* ===============
		* Function used for header search query.
		* Obtains show titles that match said query.
		*
		* @param {String} search_param - The entered user search query
		*/
		public function getSearchTitles($search_param){

			//Cosmetic replacements of underscores to spaces for proper processing.
			$search_param = str_replace("_", " ", $search_param);

			//"SELECT title,showID FROM shows WHERE title LIKE '$search' ORDER BY title"
			if($search_param !== ""){
				$list = $this->db->select('showID, title')
								 ->from('shows')
								 ->like('title', $search_param)
								 ->get()
								 ->result();
			}
			else{
				$list = $this->db->select('showID, title')
								 ->from('shows')
								 ->where("title LIKE '$search_param'")
								 ->order_by('title')
								 ->get()
								 ->result();
			}

			//Return results
			return $list;

		}

		/**
		* getShowTitle
		* ============
		* Just gets the show title
		*
		* @param {String} show_param - Given show ID
		*/
		public function getShowTitle($show_param){
			return $this->db->select('title')
							->from('shows')
							->where('showID', $show_param)
							->limit(0, 1)
							->get()
							->result();
		}


		/**
		* getShowInfo
		* ===========
		* Used to display all the information for a given show to display on the show page
		*
		* @param {String} search_param - Given show ID
		*/
		public function getShowInfo($search_param){	
			// SELECT title, premiere_year, network, creator, category
			// FROM shows
			// WHERE showID = '$showID'
			// LIMIT 0, 1
			return  $this->db->select('title, premiere_year, network, creator, category')
							 ->from('shows')
							 ->where('showID', $search_param)
							 ->limit(0, 1)
							 ->get()
							 ->result();
		}


		/**
		* getEpisodes
		* ===========
		* Gather all the episodes of a given show to be listed on the episodes page
		*
		* @param {String} show_param - Given show ID
		*/
		public function getEpisodes($show_param){
			// SELECT * FROM episode 
			// WHERE showID = '$show' 
			// ORDER BY episodeID"
			$list = $this->db->select('episodeID, airdate, title')
							 ->from('episode')
							 ->where('showID', $show_param)
							 ->order_by('episodeID')
							 ->get()
							 ->result();


			//Obtain the season number from episodeID
			foreach($list as $episode){
				$episode->season = str_split($episode->episodeID)[0];
			}

			return $list;
		}


		/**
		* getEpisodeInfo
		* ==============
		* Used to gather the information of a given pisode of a show
		*
		* @param {String} show_param - Given show ID
		* @param {String} episode_param - Gven episode ID
		*/
		public function getEpisodeInfo($show_param, $episode_param){
			// SELECT shows.title AS 'show', episode.title AS 'episode', episode.airdate
			// FROM shows, episode
			// WHERE shows.showID = '$showid'
			// AND episode.showID = '$showid'
			// AND episode.episodeID = '$epid'
			// LIMIT 0,1"
			return $this->db->select("shows.title AS 'show', episode.title AS 'title', episode.airdate")
							->from('shows, episode')
							->where("shows.showID = '$show_param' AND episode.showID = '$show_param' AND episode.episodeID = '$episode_param'")
							->limit(0, 1)
							->get()
							->result();
		}


		/**
		* getMainActors
		* =============
		* Used to get the main cast of a given show
		*
		* @param {String} show_id - Given show ID
		*/
		public function getMainActors($show_id){
			// SELECT DISTINCT actor.actID, actor.fname, actor.lname, main_cast.role
			// FROM shows, actor, main_cast
			// WHERE main_cast.showID = '$showID'
			// AND main_cast.actID = actor.actID
			// ORDER BY actor.lname
			return $this->db->select('actor.actID, actor.fname, actor.lname, main_cast.role')
							->from('shows, actor, main_cast')
							->where("main_cast.showID = '$show_id' AND main_cast.actID = actor.actID")
							->order_by('actor.lname')
							->distinct('actID')
							->get()
							->result();
		}


		/**
		* getRecurringActors
		* ==================
		* Used to get the recurring cast of a given show
		*
		* @param {String} show_id - Given show ID
		*/	
		public function getRecurringActors($show_id){
			// SELECT DISTINCT actor.actID, actor.fname, actor.lname, COUNT(recurring_cast.episodeID) AS 'episodes', recurring_cast.role
			// FROM actor, recurring_cast
			// WHERE recurring_cast.showID = '$showID'
			// AND recurring_cast.actID = actor.actID
			// GROUP BY actor.lname
			// ORDER BY actor.lname
			return $this->db->select("actor.actID, actor.fname, actor.lname, COUNT(recurring_cast.episodeID) AS 'episodes', recurring_cast.role")
							->from('actor, recurring_cast')
							->where("recurring_cast.showID = '$show_id' AND recurring_cast.actID = actor.actID")
							->group_by('actor.lname')
							->order_by('actor.lname')
							->distinct('actor.actID')
							->get()
							->result();
		}
	}
?>