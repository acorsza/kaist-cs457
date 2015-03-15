<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	//Home Page Controller

	// Initial function to be called when this controller is requested
	class Home extends CI_Controller {
		public function index() {
			// This load the home page, using load_home function
			$this->load_home();
		}

		public function load_home() {
			// This load the home_m Model
			$this->load->model('home_m');
			// This load the topic_m Model
			$this->load->model('topic_m');

			$data['categorylist'] = $this->home_m->getCategories();
			$data['countrylist']  = $this->home_m->getCountries();
			$data['topicList']    = $this->home_m->getTopics();
			$data['topic_no_answer'] = $this->home_m->get_topic_no_answer();
			$data['title']        = "DaejeonHub";

			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['iduser']   =  $session_data['iduser'];
				$data['totalAnswersNotSeen']    = $this->topic_m->total_answers_not_seen($session_data['iduser']);

				$this->load->view('main_header',$data);
				$this->load->view('logged_nav', $data);
				$this->load->view('home_page', $data);
				$this->load->view('main_footer');
			} else {
			     //If no session, redirect to login page
			     //redirect('login', 'refresh');
				$data['username'] = null;
				$this->load->view('main_header',$data);
				$this->load->view('main_nav');
				$this->load->view('home_page',$data);
				$this->load->view('main_footer');
			}
			
			// Getting data to the view
			
			

		}

	public function logout()
	{
		session_start(); 
		
		$this->session->unset_userdata('logged_in');

		session_destroy();
	   
	   redirect('home', 'refresh');
	 }

		public function load_about() {

			if($this->session->userdata('logged_in')) {
				// This load the topic_m Model
				$this->load->model('topic_m');

				$session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['iduser']   =  $session_data['iduser'];
				$data['totalAnswersNotSeen']    = $this->topic_m->total_answers_not_seen($session_data['iduser']);		
				$data['title'] = "About DaejeonHub";
				$this->load->view('main_header',$data);
				$this->load->view('logged_nav', $data);
				$this->load->view('about_page');
				$this->load->view('main_footer');
			}
			else{
				$data['title'] = "About DaejeonHub";
				$this->load->view('main_header',$data);
				$this->load->view('main_nav', $data);
				$this->load->view('about_page');
				$this->load->view('main_footer');
			}
		}

		public function load_contact() {
			
			if($this->session->userdata('logged_in')) {
				// This load the topic_m Model
				$this->load->model('topic_m');

				$session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['iduser']   =  $session_data['iduser'];
				$data['totalAnswersNotSeen']    = $this->topic_m->total_answers_not_seen($session_data['iduser']);		
				$data['title'] = "Contact DaejeonHub";
				$this->load->view('main_header',$data);
				$this->load->view('logged_nav', $data);
				$this->load->view('contact_page');
				$this->load->view('main_footer');
			}
			else{
				$data['title'] = "Contact DaejeonHub";
				$this->load->view('main_header',$data);
				$this->load->view('main_nav', $data);
				$this->load->view('contact_page');
				$this->load->view('main_footer');
			}
		}
	};
?>