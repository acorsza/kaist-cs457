<?php 
    class user_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insertUser($data)
    {
        $this->date = time();
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

    function login($email, $password)
	 {
	   $this -> db -> select('iduser, username, email, password,img_name');
	   $this -> db -> from('user');
	   $this -> db -> where('email', $email);
	   $this -> db -> where('password', MD5($password));
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


     function get_user_info($iduser){

        $this -> db -> select('iduser, username, email, id_country, img_name');
        $this -> db -> from('user');
        $this -> db -> where('iduser', $iduser);

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


     function alter_info($data){
        $this->db->where('iduser', $data['iduser']);
        $this->db->update('user', $data); 
     }

     function upload_picture($iduser, $data){

        $this->db->where('iduser', $iduser);
        $this->db->update('user', $data); 
     }
     
     function get_user_id($email){

        $this -> db -> select('iduser, username, email, id_country, img_name');
        $this -> db -> from('user');
        $this -> db -> where('email', $email);

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

}
?>