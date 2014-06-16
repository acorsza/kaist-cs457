<?php
	//Home Page Model
    class topic_m extends CI_Model {

	    function __construct() {

	        // Call the Model constructor
	        parent::__construct();
	    }

	    function get_categories() {
	        $query = $this->db->get('categories');
	        return $query->result();
	    }

	    function get_topics() {
	        $query = $this->db->get('topics');
	        return $query->result();
	    }

	    function get_topic($data) {
	    	$this -> db -> select('*');
			$this -> db -> from('topics');
			$this -> db -> join('user', 'user.iduser = topics.fk_user');
			$this -> db -> where('idtopics', $data);
			$this -> db -> limit(1);

			$query = $this -> db -> get();

			if($query -> num_rows() == 1)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
	    }

	    function get_replies($data) {
	    	$this -> db -> select('replies.*, user.*');
			$this -> db -> from('replies');
			$this -> db -> join('user', 'user.iduser = replies.fk_user');
			$this -> db -> where('replies.fk_topic', $data);
			$this -> db -> order_by("replies.up_point", "DESC"); 
			$query = $this -> db -> get();
			if($query -> num_rows() != 0)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
	    }

	    function insert($data) {
	        $this->db->insert('topics', $data);
	        return $this->db->insert_id();
	    }


		//Ruan @ 20/05/2014 - Creates answer in the topic.
	    function insertAnswer($data) {

	    	//$valResult = 
	    	
	        if($this->db->insert('replies', $data))
	        {
			$valFromInsert = $this->db->insert_id();
	        	//print_r("UPDATE topics SET no_replies=no_replies+1 WHERE idtopics = (select fk_topic from replies where id_reply =". $data['fk_topic'] .") ");
	        	$query = $this->db->query("UPDATE topics t JOIN replies r ON t.idtopics = r.fk_topic SET t.no_replies = t.no_replies+1 WHERE r.fk_topic = ".$data['fk_topic']);
                        
	        }
                
	        return $valFromInsert; 
	        
	    }

	    //TODO
	    //Ruan @ 20/05/2014 - Rate the answer. Get the currently pontuation then increment +1.
	    function rateAnswer($answer){

	    	$this -> db  -> select('up_point');
	    	$this -> db  -> from('replies');
	    	$this -> db  -> where('id_reply', $answer);
	    	$this -> db  -> limit(1);
	    	
	    	$query = $this -> db -> get();

	    	$currentPoints = $query -> result()[0] -> up_point;
	    	$currentPoints += 1;

			$data = array(
	    			'up_point' => $currentPoints
	    	);

	    	$this->db->where('id_reply', $answer);
	    	$this->db->update('replies', $data); 
	    }


	    //Ruan @ 27/05/2014 - When the user create a topic calls this function to get this topics and redirect the user to its page.
	    function getCreatedTopic($idUser){

	    	$this -> db  -> select_max('created_at');
	    	$this -> db  -> from('topics');
	    	$this -> db  -> where('fk_user', $idUser);
	    	$query = $this -> db -> get();
	    	$maxCreatedAt = $query -> result()[0] -> created_at;

	    	$this -> db  -> select_max('idtopics');
	    	$this -> db  -> from('topics');
	    	$this -> db  -> where('created_at', $maxCreatedAt);
	    	$this -> db  -> where('fk_user', $idUser);
	    	$query = $this -> db -> get();
	    	$idTopic = $query -> result()[0] -> idtopics;

	    	return $idTopic;
	    }


	    function get_topics_by_user($idUser){

	    	$this -> db  -> select('t.*, count(r.id_reply) AS replies_not_seen');
	    	$this -> db  -> from('user u');
	    	$this -> db  -> join('topics t', 'u.iduser = t.fk_user');
	    	$this -> db  -> where('u.iduser', $idUser);
	    	$this -> db  -> join('replies r', 't.idtopics = r.fk_topic AND r.registered_at > t.seen_owner_in', 'left');
	    	$this -> db  -> group_by('r.fk_topic, t.idtopics');
	    
	    	$query = $this -> db -> get();
	    	//echo $this->db->last_query();
	    	
	    	if($query -> num_rows() != 0)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
	    }

	    function get_topics_by_category($idCategory){
	    	$this -> db  -> select('*');
	    	$this -> db  -> from('topics');
	    	$this -> db  -> where('fk_category', $idCategory);
	    	$query = $this -> db -> get();
	    	
	    	if($query -> num_rows() != 0)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
	    }


	    //Ruan @ 04/06/2014 - Return the topics related to the selected categories and the text typed in the filter.
	    function get_topics_filter_category($listCategories, $content){

			$this -> db -> select('idtopics, title, description');
			$this -> db -> from('topics');
			$this -> db -> like('title', $content);
			$this -> db -> or_like('description', $content);
			$this -> db -> where_in('fk_category', $listCategories);
			$this -> db -> order_by("created_at", "DESC"); 
			$query = $this -> db -> get();

			//shows executed query
			//echo $this->db->last_query();

			if($query -> num_rows() != 0)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
	    }



	    //Ruan @ 28/05/2013 - Return topics which contain the filter text used in the search
	    function get_topics_search($content){

			$this -> db -> select('idtopics, title, description');
			$this -> db -> from('topics');
			$this -> db -> like('title', $content);
			$this -> db -> or_like('description', $content);
			$this -> db -> order_by("created_at", "DESC"); 
			$query = $this -> db -> get();

			if($query -> num_rows() != 0)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
	    }

	    function update_topic($topic){
	    	$this->db->where('idtopics', $topic['idtopics']);
      		$this->db->update('topics', $topic); 

	    }


	    //Ruan @ 07/06/2014 - Just get the number of answers the user hasn't seen yet.
	    function total_answers_not_seen($idUser){

			/*SELECT SUM(a.total) FROM (select count(r.id_reply) AS total
			FROM user u
			INNER JOIN topics t ON u.iduser = t.fk_user AND u.iduser = 12
			LEFT JOIN replies r ON t.idtopics = r.fk_topic AND r.registered_at > t.seen_owner_in
			GROUP BY  r.fk_topic, t.idtopics) AS a */
			$query = $this->db->query("SELECT SUM(a.total) AS total FROM (select count(r.id_reply) AS total FROM user u  INNER JOIN topics t ON u.iduser = t.fk_user AND u.iduser = ". $idUser.
									  " LEFT JOIN replies r ON t.idtopics = r.fk_topic AND r.registered_at > t.seen_owner_in GROUP BY  r.fk_topic, t.idtopics) AS a ");

	    	//echo $this->db->last_query();
	    	
	    	if($query -> num_rows() != 0)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
	    }


	    //Ruan @ 10/06/2014 - Insert in database the artifact that was attached to the repply of a topic.
     	function insert_artifact($data){
     		$this->db->insert('artifacts', $data);
     	}

     	//Ruan @ 10/06/2014 - Return  from database the artifact that was attached to the repply of a topic.
     	function get_reply_artifacts($idtopic){
     		$this -> db -> select('id_artifact, id_topic, id_reply, path');
			$this -> db -> from('artifacts');
			$this -> db -> where('id_topic', $idtopic);
			$this -> db -> order_by("id_artifact", "ASC"); 
			$query = $this -> db -> get();

			if($query -> num_rows() != 0)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
     	}

     	//Ruan @ 12/06/2014 - When user vote in a reply register it at database
     	//Today begins the brazil world cup, go Brasil!
     	function register_answered_reply($data){
     		$this->db->insert('answereds', $data);
     	}

     	function verify_answered($data){
     		$this -> db -> select('id_reply');
			$this -> db -> from('answereds');
			$this -> db -> where('id_user',  $data['id_user']);
			$this -> db -> where('id_topic', $data['id_topic']);
			$this -> db -> where('id_reply', $data['id_reply']);

			$query = $this -> db -> get();

			if($query -> num_rows() != 0)
			{
				return 1;
			}
			else
			{
				return 0;
			}
     	}

     	function get_most_answered_topics(){

			//select t.* from topics t inner join (select id_topic,count(*) as amount from answereds group by id_topic order by amount) k on t.idtopics = k.id_topic  order by t.created_at

     		$query = $this->db->query("select t.* from topics t inner join (select id_topic,count(*) as amount from answereds group by id_topic order by amount) k on t.idtopics = k.id_topic  order by t.created_at");

     		if($query -> num_rows() != 0)
     		{
     			return $query->result();
     		}
     		else
     		{
     			return false;
     		}
     		
     	}
	}
?>
