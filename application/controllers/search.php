<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Search extends CI_Controller {
		
		// Index function

		public function index(){
			$this->all();
		}

		/*
		 *	Function topic/session_check
		 *	Check if there is a user logged in the system and return data or redirect to main page
		 */

		private function session_check() {

			// Check if user is logged in

			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				return $session_data; // Return array of user's data
			} else {
				redirect('home','refresh');
			}
		}

		public function result(){

			// Check session
			$session_data = $this->session_check();
			$data['username'] = $session_data['username'];

			//get the typed text to search
			$text =  $this->input->post('filter');

			//load the model to get data from database
			$this->load->model('topic_m');

			//get the selected categories to make the search
			$selectedCategories = $this->input->post('selectedCategories'); 
			$listCategories = explode("*", $selectedCategories); //array with selected categories
			//echo (sizeof($listCategories));

			//if user has selected categories to search in so do it else search just for the filter of text.
			//higher than 1 because the first elements is comming empty(yes it has to be fixed my friend).
			if(sizeof($listCategories) > 1){
				$data['list'] = $this->topic_m->get_topics_filter_category($listCategories, $text); 
			}
			else{
				$data['list'] = $this->topic_m->get_topics_search($text);
			}
	
			$data['filter']       = $text; 
			$data['categorylist'] = $this->topic_m->get_categories();
       		$data['videos'] = $this->load_videos($text,"3","355","255","relevance","video","true","any");
			$data['totalAnswersNotSeen']    = $this->topic_m->total_answers_not_seen($session_data['iduser']);

       		
			// Load view
			$this->load->view('main_header', $data);
			$this->load->view('logged_nav');
			$this->load->view('search_show', $data);
			$this->load->view('main_footer');		
		}


		public function load_videos($_query,$_maxResults,$_width,$_height,$_order,$_type,$_videoEmbeddable,$_videoDefinition){
		      $DEVELOPER_KEY = "AIzaSyDGxd2smhgFKMdCYUEPxAw-rdiJtietAaI";
		      $query = $_query;
		      $maxResults = $_maxResults;
		      $width = $_width ;
		      $height = $_height ;
		      $order = $_order;//date,rating,relevance,title,videoCount,viewCount
		      $type = $_type;//video,channel,playlist
		      $videoEmbeddable = $_videoEmbeddable;//any,true
		      $videoDefinition = $_videoDefinition;//any,standard,high
		      set_include_path("././assets/google-api-php-client/src/" . PATH_SEPARATOR);
		      require_once '././assets/google-api-php-client/src/Google/Client.php';
		      require_once '././assets/google-api-php-client/src/Google/Service/YouTube.php';
		      $client = new Google_Client();
		      $client->setDeveloperKey($DEVELOPER_KEY);
		      $youtube = new Google_Service_YouTube($client);
		        try {
		          $searchResponse = $youtube->search->listSearch('id,snippet', array('q' => $query,'maxResults' => $maxResults,'order' => $order,'type' => $type,'videoEmbeddable' => $videoEmbeddable, 'videoDefinition' => $videoDefinition));
		          $videos = '';
		          $counter = 1;
		          foreach ($searchResponse['items'] as $searchResult) {
		            if($searchResult['id']['kind'] == 'youtube#video') {        
		                  $videos .= sprintf('%s',
		                //$videos .= sprintf('<li>%s (%s) <br/> %s',$searchResult['snippet']['title'], $searchResult['id']['videoId'],
		                  "<object id='youtubevideo_".$counter."' width='".$width."' height='".$height."'>             
		                   <param name='allowFullScreen' value='true'></param>
		                   <embed src='https://www.youtube.com/v/".$searchResult['id']['videoId']."?rel=1&border=1&fs=1'
		                    type='application/x-shockwave-flash'
		                    width='".$width."' height='".$height."' 
		                    allowfullscreen='true'>
		                   </embed>
		                   </object>"); 
		                   $counter++;    
		            }
		          }
		          return $videos;

		        } catch (Google_ServiceException $e) {
		          $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
		            htmlspecialchars($e->getMessage()));
		        } catch (Google_Exception $e) {
		          $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
		            htmlspecialchars($e->getMessage()));
		        }
    }    
  }
	
?>