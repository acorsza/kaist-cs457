<?php
	//Home Page Model
    class home_m extends CI_Model {

	    function __construct()
	    {
	        // Call the Model constructor
	        parent::__construct();
	    }

	    function getCategories() {
	        $query = $this->db->get('categories');
	        return $query->result();
	    }

	     function getCategory($idcategory) {
	        $this -> db -> select('category');
			$this -> db -> from('categories');
			$this -> db -> where('idcategory', $idcategory);
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

	    function getCountries() {
	        $query = $this->db->get('countries');
	        return $query->result();
	    }

	    function getTopics() {
	        $query = $this->db->get('topics');
	        return $query->result();
	    }


	    // Aderlei @ 11/06/2014 - Query para perguntas sem respostas
	    function get_topic_no_answer()
	    {
	    	$this->db->select('*');
	    	$this->db->from('topics');
	    	$this->db->where('no_replies',0);
	    	$query = $this->db->get();
	    	if($query -> num_rows() >= 1)
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