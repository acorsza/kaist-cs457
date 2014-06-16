<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {
  public $user;
 function __construct()
 {
   parent::__construct();
   
   $this->load->model('user_m','',TRUE);
   
 }

 function index()
 {
   //This method will have the credentials validation
   $this->load->library('form_validation');

   $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');


   if($this->form_validation->run() == FALSE)
   {
      $this->load->model('home_m');
      $this->load->model('topic_m');

			$data['categorylist'] = $this->home_m->getCategories();
			$data['countrylist'] = $this->home_m->getCountries();
			$data['topicList'] = $this->home_m->getTopics();
      $data['topic_no_answer'] = $this->home_m->get_topic_no_answer();
			$data['title'] = "DaejeonHub";
     //Field validation failed.  User redirected to login page
     $this->load->view('main_header',$data);
     $this->load->view('main_nav');
     $this->load->view('home_page',$data);
     $this->load->view('main_footer');
   }
   else
   {
     //Go to private area
     redirect('home', 'refresh');
   }


 }

 function check_database($password)
 {
  
   //Field validation succeeded.  Validate against database
   $email = $this->input->post('email');

   //query the database
   $result = $this->user_m->login($email, $password);

   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'iduser' => $row->iduser,
         'email' => $row->email,
         'username' => $row->username,
         'img_url' => $row->img_name
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }
 public function conn_fb()
  {
    parse_str( $_SERVER['QUERY_STRING'], $_REQUEST );
    $config = array(
        'appId'  => '808693475807369',
        'secret' => '189deff9c553c10953239c038a35369b'
    );
    
    $this->load->model('user_m');
    $this->load->library('facebook', array('appId' => '808693475807369', 'secret' => '189deff9c553c10953239c038a35369b'));
    $this->user = $this->facebook->getUser();
    if($this->user) {
      try {

        
        $user_profile = $this->facebook->api("/me");

        echo "<br />";
        //print_r($user_profile);
        //$data['username'] = $user_profile['first_name'];
        
        $user['username'] = $user_profile['first_name'];
        $user['email'] = $user_profile['email'];
        $user['created_at'] = date('Y-m-d H:i:s');
        $user['password'] = "";
        $user['id_country'] = 31;
        $email = $this->user_m->get_user_id($user_profile['email']);
        $data['id_photo'] = $user_profile['id'];
        $user['img_name'] = "http://graph.facebook.com/" . $data['id_photo'] . "/picture?type=large";
        if(!$email){
            $id = $this->user_m->insertUser($user);
            //echo "<img src=" . $user['img_name'] . ">";
            echo $id;
            //$result = $this->user_m->login($email, $password);
            $sess_array = array(
                'iduser' => $id,
                'email' => $user_profile['email'],
                'username' => $user_profile['first_name'],
                'img_url' => $user['img_name']     
                    
             );
       $this->session->set_userdata('logged_in', $sess_array);
        } else {
            $result = $this->user_m->get_user_id($user_profile['email']);
            //print_r($result);
            //echo $result[0]->iduser;
            //echo $user_profile['email'];
            $sess_array = array(
                'iduser' => $result[0]->iduser,
                'email' => $user_profile['email'],
                'username' => $user_profile['first_name'],
                'img_url' => $user['img_name']  
             );
            $this->session->set_userdata('logged_in', $sess_array);
            //echo "<img src=" . $user['img_name'] . ">";
        }
        
        
	        
       redirect('home', 'refresh');
      } catch (FacebookApiException $e) {
       // print_r($e);
        $user = null;
      }
    } 

    if($this->user) {
      $logout = $this->facebook->getLogoutUrl(array("next" => base_url() . 'login/logout'));
        //echo "<a href='$logout'>Logout</a>";
      } else {
      $params = array(
        'scope' => 'public_profile, email, user_photos'
        //'redirect_uri' => 'http://aderleifilho.com'
        );
      redirect($this->facebook->getLoginUrl($params));
      
      
      
    
      //$login = $this->facebook->getLoginUrl();
      //echo "<a href='$login'>Login</a>";
    }
  }
}
?>
