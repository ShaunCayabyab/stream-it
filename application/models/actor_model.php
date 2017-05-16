<?php
	/**
	* ===========
	* ACTOR MODEL
	* ===========
	* Model for gathering necessary information about the actors in the database
	*
	* @function getSearchActors - Getting the actors that match a given user search query
	* @function getActorName - Get the name of an actor
	* @function getMainRoles - Get the main roles that a given actor has in the database
	* @function getRecurringRoles - Get the recurring roles that a given actor may have in the database
	* @function getMainEpisodeActors - Get the main cast starring in a certain episode of a show
	* @function getRecurringEpisodeActors - Get the recurring cast that appear in a certain episode of a show
	*/
	class Actor_model extends CI_Model{

		public function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->model('actor_model', '', TRUE);
		}


		/**
		* getSearchActors:
		* =================
		* Function for search page.
		* Obtains actors that match search page query.
		*
		* @param {String} search_query - The given user search query
		*/
		public function getSearchActors($search_query){

			//Cosmetic replacements from underscores to spaces
			//for proper query processing.
			$query = explode("_", $search_query . "_");
			if($query[1] == null){ $query[1] = ""; }

			//DB query to obtain actors.
			$list = $this->db->select('actID, fname, lname')
							 ->from('actor')
							 ->where("fname LIKE '$query[0]'")
							 ->or_where("lname LIKE '$query[1]'")
							 ->or_where("fname LIKE '$query[1]'")
							 ->or_where("lname LIKE '$query[0]'")
							 ->order_by('lname')
							 ->get()
							 ->result();

			//Return actor list.
			return $list;
		}


		/**
		* getActorName
		* ============
		* Just gets the name of an actor...
		*
		* @param {String} actor_id - Given actor ID
		*/
		public function getActorName($actor_id){
			// SELECT fname,lname
			// FROM actor
			// WHERE actID = '$actorID'
			// LIMIT 0,1"
			return $this->db->select('fname, lname')
							->from('actor')
							->where('actID', $actor_id)
							->limit(0, 1)
							->get()
							->result();

		}


		/**
		* getMainRoles
		* ============
		* Gather any main roles that an actor may have
		*
		* @param {String} actor_id - Given actor ID
		*/
		public function getMainRoles($actor_id){
			// SELECT DISTINCT shows.title, main_cast.role, shows.showID
			// FROM actor,shows,main_cast
			// WHERE main_cast.actID = '$actorID'
			// AND main_cast.showID = shows.showID
			return $this->db->select('shows.title, main_cast.role, shows.showID')
							->from('actor, shows, main_cast')
							->where("main_cast.actID = '$actor_id' AND main_cast.showID = shows.showID")
							->distinct('main_cast.role')
							->get()
							->result();
		}


		/**
		* getRecurringRoles
		* =================
		* Get the recurring roles that a given actor may have
		*
		* @param {String} actor_id - Given actor ID
		*/
		public function getRecurringRoles($actor_id){
			// SELECT DISTINCT shows.title, recurring_cast.role, shows.showID
			// FROM actor,shows,recurring_cast
			// WHERE recurring_cast.actID = '$actorID'
			// AND recurring_cast.showID = shows.showID
			return $this->db->select('shows.title, recurring_cast.role, shows.showID')
							->from('actor, shows, recurring_cast')
							->where("recurring_cast.actID = '$actor_id' AND recurring_cast.showID = shows.showID")
							->distinct('recurring_cast.role')
							->get()
							->result();
		}


		/**
		* getMainEpisodeActors
		* ====================
		* Gets the main cast that appear on a given episode of a show
		*
		* @param {String} show_id - Given show ID
		* @param {String} episode_id - Given episode ID
		*/
		public function getMainEpisodeActors($show_id, $episode_id){
			// SELECT DISTINCT actor.actID, actor.fname, actor.lname, main_cast.role
			// FROM shows, episode, actor, main_cast
			// WHERE main_cast.showID = '$showid'
			// AND main_cast.actID = actor.actID
			// ORDER BY actor.lname
			return $this->db->select("actor.actID, actor.fname, actor.lname, main_cast.role")
							->from('shows, episode, actor, main_cast')
							->where("main_cast.showID = '$show_id' AND main_cast.actID = actor.actID")
							->distinct('actor.actID')
							->order_by('actor.lname')
							->get()
							->result();
		}


		/**
		* getRecurringEpisodeActors
		* =========================
		* Gets the list of the recurring cast that appear on a given episode of a show
		*
		* @param {String} show_id - Given show ID
		* @param {String} episode_id - Given episode ID
		*/
		public function getRecurringEpisodeActors($show_id, $episode_id){
			// SELECT DISTINCT actor.actID, actor.fname, actor.lname, recurring_cast.role
			// FROM actor, recurring_cast
			// WHERE recurring_cast.showID = '$showid'
			// AND recurring_cast.episodeID = '$epid'
			// AND actor.actID = recurring_cast.actID
			// ORDER BY actor.lname
			return $this->db->select("actor.actID, actor.fname, actor.lname, recurring_cast.role")
							->from('actor, recurring_cast')
							->where("recurring_cast.showID = '$show_id' AND recurring_cast.episodeID = '$episode_id' AND actor.actID = recurring_cast.actID")
							->distinct('actor.actID')
							->order_by('actor.lname')
							->get()
							->result();
		}
	}
?>