<?php
	/**
	* ==============
	* CUSTOMER MODEL
	* ==============
	* Model that handles all customer information and data
	*
	* @function login - Handles the user login
	* @function register - Handles user registration
	* @function delete - Takes care of deleting a user and all their data on the web app
	* @function isLoggedIn - Validates if a user is logged into the web app
	* @function getQueue - Gathers data for the user's queue
	* @funtion getWatchedEpisodes - Gets the list of a user's watched episodes
	* @function addToWatched - Add the episode the user's watching to their watched list
	*/
	class Customer_model extends CI_Model{

		public function __construct(){
				parent::__construct();
				$this->load->database();
				$this->load->model('customer_model', '', TRUE);
			}

		/**
		* login
		* =====
		* Obviously, handles login processing
		*
		* @param {String} username - Entered username from login form
		* @param {String} password - Entered password from login form
		*/
		public function login($username, $password){

			//$pass = hash('sha256', htmlspecialchars($password));

			$this -> db -> select('custID, username');
			$this -> db -> from('customer');
			$this -> db -> where('username', $username);
			$this -> db -> where('password', $password);
			$this -> db -> limit(1);

			$query = $this -> db -> get();

			if($query -> num_rows() == 1){
				
				$row = $query->row();
				$data = array(
					'id' => $row->custID,
					'username' => $row->username,
					'validated' => true
					);

				$this->session->set_userdata($data);
				return true;
			}
			else{
				return false;
			}

		}

		/**
		* register
		* ========
		* Handles user registration
		*
		* [YET TO BE CONVERTED FROM INTIIAL APP]
		*/
		public function register(){

		}

		/**
		* delete
		* ======
		* Removes a user's data from the web app database
		*
		* [YET TO BE CONCERTED FROM INITIAL APP]
		*/
		public function delete(){
			
		}

		/**
		* isLoggedIn
		* ==========
		* Checks to see is a user is logged into the web app
		*/
		public function isLoggedIn(){
			return (isset($this->session->id));
		}


		/**
		* getQueue
		* ========
		* Gets the user queue to display onto the queue page
		*/
		public function getQueue(){

			// Check if a user is even logged in
			if($this->isLoggedIn()){
				$id = $this->session->id;
				// SELECT shows.showID, shows.title, cust_queue.datequeued
				// FROM shows, cust_queue
				// WHERE cust_queue.custID = '$id'
				// AND shows.showID = cust_queue.showID
				return $this->db->select('shows.showID, shows.title, cust_queue.datequeued')
								->from('shows, cust_queue')
								->where("cust_queue.custID = '$id' AND shows.showID = cust_queue.showID")
								->get()
								->result();
			}
		}


		/**
		* getWatchedEpisodes
		* ==================
		* Gets a user's watched episodes of a give show
		*
		* @param {String} show_id - Given show ID
		*/
		public function getWatchedEpisodes($show_id){
			if($this->isLoggedIn()){
				$id = $this->session->id;

				// SELECT DISTINCT episode.episodeID, episode.title, watched.datewatched
				// FROM shows, episode, watched
				// WHERE watched.custID = '$id'
				// AND watched.showID = '$showid'
				// AND episode.showID = '$showid'
				// AND episode.episodeID = watched.episodeID
				// ORDER BY watched.datewatched
				return $this->db->select('episode.episodeID, episode.title, watched.datewatched')
								->from('shows, episode, watched')
								->where("watched.custID = '$id' AND watched.showID = '$show_id' AND episode.showID = '$show_id' AND episode.episodeID = watched.episodeID")
								->distinct('episode.episodeID')
								->order_by('watched.datewatched')
								->get()
								->result();
			}
		}


		/**
		* addToWatched
		* ============
		* Adds the episode the user is watching to their watched list, if it's not already on there
		*
		* [NOT YET FULLY CONVERTED FROM ORIGINAL APP]
		*
		* @param {String} show_id - Given show ID
		* @param {String} episode_id - GIven episode ID
		*/
		public function addToWatched($show_id, $episode_id){
			if($this->isLoggedIn()){
				$id = $this->session->id;
			}
			else{
				redirect('login', 'refresh');
			}

			// SELECT * 
			// FROM watched
			// WHERE custID = '$user'
			// AND showID = '$showid'
			// AND episodeID = '$epid'
			// LIMIT 0, 1
			//
			// INSERT INTO watched (custID, showID, episodeID, datewatched) 
			// VALUES ('$user', '$showid', '$epid', '$today')
			$isWatched = $this->db->select('episodeID')
								  ->from('watched')
								  ->where('custID', $id)
								  ->where('showID', $show_id)
								  ->where('episodeID', $episode_id)
								  ->limit(0, 1)
								  ->get();
		}
	}


?>