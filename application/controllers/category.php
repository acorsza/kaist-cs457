<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Category extends CI_Controller {
		
		// Index function
		public function index(){
			$this->all();
		}

		//Check if there is a user logged in the system and return data or redirect to main page
		private function session_check() {

			// Check if user is logged in

			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				return $session_data; // Return array of user's data
			} else {
				redirect('home','refresh');
			}
		}		

		//Returns all created categories from anyone.
		public function all(){

			$data['title'] = "DaejeonHub";
			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$this->load->model('home_m');
				$this->load->model('topic_m');
				$data['categories'] = $this->home_m->getCategories();
				$data['totalAnswersNotSeen']    = $this->topic_m->total_answers_not_seen($session_data['iduser']);
				
				$this->load->view('main_header',$data);
				$this->load->view('logged_nav');
				$this->load->view('category_all',$data);
				$this->load->view('main_footer');
			} else {
			     //If no session, redirect to login page
			     //redirect('login', 'refresh');
				$this->load->view('main_header',$data);
				$this->load->view('main_nav');
				$this->load->view('category_all',$data);
				$this->load->view('main_footer');
			}
			
		}		

		public function get_category_by_id($idcategory){

			$data['title'] = "DaejeonHub";
			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$this->load->model('home_m');
				$data['category'] = $this->home_m->getCategory($idcategory);
				return $data;					
			} 
			
		}	
	}
?>