<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Topic extends CI_Controller {
		
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



		//Display the form for insertion of a new topic
		public function new_form() {

			// Check session
			$this->load->model('topic_m');
			$session_data = $this->session_check();
			$data['username'] = $session_data['username'];
			$data['totalAnswersNotSeen']    = $this->topic_m->total_answers_not_seen($session_data['iduser']);

			// Load model

			
			$data['categorylist'] = $this->topic_m->get_categories();
			$data['title'] = "Create a new Topic DaejeonHub";
				
			// Load views

			$this->load->view('main_header', $data);
			$this->load->view('logged_nav');
			$this->load->view('topic_create', $data);
			$this->load->view('main_footer');
		}



		//Display a specific topic
		public function show($idtopic = null, $answered = null) {			

			// Check session
			$session_data 	  = $this->session_check();
			$data['username'] = $session_data['username'];
			$data['iduser']   = $session_data['iduser'];
                        if(substr($session_data['img_url'],0,4) == "http"){
                            $data['img_facebook'] = $session_data['img_url'];
                        } else {
                            $data['img_facebook'] = "";
                        }

			// Load topic and user  model
			$this->load->model('topic_m');
			$this->load->model('user_m');

			$single_topic = $this->topic_m->get_topic($idtopic);
			
			//IF the user that has created the topic views the topic then update the date that the user is accessing the topic
			if($single_topic[0]->iduser == $data['iduser']){
				$topic['seen_owner_in'] = date('Y-m-d H:i:s');
				$topic['idtopics'] = $idtopic;
				$this->topic_m->update_topic($topic);
			}



			//get related topics
			$data['relatedTopics'] = $this->showRelatedTopics($single_topic[0]->title);


			$data['idTopic']       = $idtopic;
			$data['single_topic']  = $single_topic;
			$data['topic_replies'] = $this->topic_m->get_replies($idtopic);
			$data['answer_artifacts'] = $this->topic_m->get_reply_artifacts($idtopic);
			$data['categorylist']  = $this->topic_m->get_categories();
			$data['userinfo']      = $this->user_m->get_user_info($data['iduser']);
			$data['totalAnswersNotSeen']    = $this->topic_m->total_answers_not_seen($session_data['iduser']);
	
			// Load view
			$this->load->view('main_header', $data);
			$this->load->view('logged_nav');
			$this->load->view('topic_show', $data);
			$this->load->view('main_footer');

			//Ruan @ 21/05/2014 - After creating an answer to the topic redirects to the topic page.
			if($answered != null && $answered == true){
				//used specially when creating a new answer
				$redirect = '/topic/show/'.$idtopic;
				redirect($redirect, 'refresh');
			}
			
			
		}



		//Creates a new topic
		public function create() {

			$data['title'] = "DaejeonHub";

			//Model to insert topic in the database
			$this->load->model('topic_m');
			$session_data = $this->session->userdata('logged_in');
			$data['iduser'] = $session_data['iduser'];
			$topic['title'] = $this->input->post('title');
	        $topic['description'] = $this->input->post('description');
	        $topic['created_at'] = date('Y-m-d H:i:s');
	        $topic['fk_category'] = $this->input->post('category');
	        $topic['fk_user'] = $session_data['iduser'];
			$this->topic_m->insert($topic);

			$idTopic = $this->topic_m->getCreatedTopic($data['iduser']);

			$this->show($idTopic, true);
		}



		//Ruan @ 20/05/2014 - Insert in database the answer to the topic.
		public function createAnswer($idtopic){
			//$fullUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			//$data['fullUrl'] = $fullUrl;

			// Check session
			$session_data = $this->session_check();
			$data['username'] = $session_data['username'];

			//Model to insert answer related to the topic in the database
			$this->load->model('topic_m');

			$answer['fk_topic'] = $idtopic;
			$answer['fk_user'] = $session_data['iduser'];
			$answer['description'] = $this->input->post('areaTransferContent');

			//print_r($answer['description']);

			
			$answer['up_point'] = 0;
			$answer['registered_at'] = date('Y-m-d H:i:s');

			//return id of the inserted answer.
			$idReply = $this->topic_m->insertAnswer($answer);			

			if($this->input->post('enviaFiles') == 'true'){
				$pathsArtifacts = $this->uploadArtifact();

				$artifact['id_topic'] = $idtopic;
				$artifact['id_reply'] = $idReply;

				for($i = 0; $i < sizeof($pathsArtifacts); $i++){
					$artifact['path']    = $pathsArtifacts[$i];
					$this->topic_m->insert_artifact($artifact);
				} 
			}
			$this->show($idtopic, true);
			
		}



		//Ruan @ 31/05/2014 - Called by ajax call so doesn't need any action in the end of this method
		public function rateAnswer(){
			$return = $_POST['scrollPos'].'#';

			// Check session
			$session_data = $this->session_check();

			$idAnswer  = $_POST['idAnswer'];

			$data['id_topic'] =  $this->input->post('idTopic');
			$data['id_reply'] =  $idAnswer;
			$data['id_user'] = $session_data['iduser'];

			$this->load->model('topic_m');
			
			$alreadyAnswered = $this->topic_m->verify_answered($data);

			/*if is the first vote from a user in a answere so register in database and returns 0
			else the user has already answered returns 1 and do not allow to vote again this answer.*/
			if($alreadyAnswered == 0){
				$this->topic_m->register_answered_reply($data);
				$this->topic_m->rateAnswer($idAnswer);
				$return = $return.'0';
			}
			else{
				$return = $return.'1';
			}	

			echo $return;
		}
		


		//Returns all created topics from anyone.
		public function all(){

			// This load the home_m Model
			$this->load->model('home_m');

			$data['categorylist'] = $this->home_m->getCategories();
			$data['countrylist'] = $this->home_m->getCountries();
			$data['topicList'] = $this->home_m->getTopics();
			$data['title'] = "DaejeonHub";


			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$this->load->model('topic_m');
				$data['topicList'] = $this->topic_m->get_topics();
				$data['mytopics'] = "false";
				$data['category'] = "false";
				$data['totalAnswersNotSeen'] = $this->topic_m->total_answers_not_seen($session_data['iduser']);

				$this->load->view('main_header',$data);
				$this->load->view('logged_nav');
				$this->load->view('topic_all',$data);
				$this->load->view('main_footer');
			} else {
			     //If no session, redirect to login page
			     //redirect('login', 'refresh');
				$this->load->view('main_header',$data);
				$this->load->view('main_nav');
				$this->load->view('topic_all',$data);
				$this->load->view('main_footer');
			}
			
		}


		//Returns all created topics from logged user.
		public function mytopics(){

			// This load the home_m Model
			$this->load->model('home_m');

			$data['categorylist'] = $this->home_m->getCategories();
			$data['countrylist'] = $this->home_m->getCountries();
			$data['topicList'] = $this->home_m->getTopics();
			$data['title'] = "DaejeonHub";



			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$this->load->model('topic_m');
				$data['topicList'] = $this->topic_m->get_topics_by_user($session_data['iduser']);
				$data['mytopics'] = "true";
				$data['category'] = "false";
				$data['totalAnswersNotSeen'] = $this->topic_m->total_answers_not_seen($session_data['iduser']);

				$this->load->view('main_header',$data);
				$this->load->view('logged_nav');
				$this->load->view('topic_all',$data);
				$this->load->view('main_footer');
			} else {
			     //If no session, redirect to login page
			     //redirect('login', 'refresh');
				$this->load->view('main_header',$data);
				$this->load->view('main_nav');
				$this->load->view('topic_all',$data);
				$this->load->view('main_footer');
			}
			
		}


		public function showbyCategory($idcategory = null, $category = null) {

			// This load the home_m Model
			$this->load->model('home_m');

			$data['categorylist'] = $this->home_m->getCategories();
			$data['countrylist'] = $this->home_m->getCountries();
			$data['topicList'] = $this->home_m->getTopics();
			$data['title'] = "DaejeonHub";


			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$this->load->model('topic_m');
				$this->load->model('home_m');
				$data['topicList'] = $this->topic_m->get_topics_by_category($idcategory);
				$data['mytopics'] = "false";
				$data['category'] = $this->home_m->getCategory($idcategory)[0]->category;
				$data['totalAnswersNotSeen'] = $this->topic_m->total_answers_not_seen($session_data['iduser']);

				$this->load->view('main_header',$data);
				$this->load->view('logged_nav');
				$this->load->view('topic_all',$data);
				$this->load->view('main_footer');
			} else {
			     //If no session, redirect to login page
			     //redirect('login', 'refresh');
				$this->load->view('main_header',$data);
				$this->load->view('main_nav');
				$this->load->view('topic_all',$data);
				$this->load->view('main_footer');
			}
		}


		//Ruan @ 07/06/2014 - store in the server images uploaded to a topic.
		public function uploadArtifact(){
			// Check session
			$session_data = $this->session_check();
			$iduser = $session_data['iduser'];
			$paths  = array();

			$pasta = "./assets/media/artifacts/"; // allowed formats
			$permitidos = array(
				".jpg",
				".jpeg",
				".gif",
				".png",
				".bmp"
			);

			if (isset($_POST))
			{
				//set limit of at most 5 files to send to the server
				for($i = 0; $i < count($_FILES['artifact']['name']) && $i < 5; $i++){
					
						$nome_imagem = $_FILES['artifact']['name'][$i];
						$tamanho_imagem = $_FILES['artifact']['size'][$i]; 
						$ext = strtolower(strrchr($nome_imagem, ".")); // get the file extension 
						if (in_array($ext, $permitidos))// verifica se a extensão está entre as extensões permitidas //
						{ 	// converte o tamanho para KB
							$tamanho = round($tamanho_imagem / 1024);
							if ($tamanho < 1024)
							{ 	//se imagem for até 1MB envia
								$nome_atual = md5(uniqid(time())).$ext;
				  				//nome que dará a imagem
								$tmp = $_FILES['artifact']['tmp_name'][$i];
				 				//caminho temporário da imagem 
				 				// se enviar a foto, insere o nome da foto no banco de dados 
								if(move_uploaded_file($tmp,$pasta.$nome_atual)){ 

									array_push($paths, $nome_atual);
								}
								else{ 
									echo "Falha ao enviar";
								} 
							}
							else{ 
								echo "A imagem deve ser de no máximo 1MB";
							} 
						}
						else{ 
							echo "Somente são aceitos arquivos do tipo Imagem"; 
						}

					
				}	
			}
			else{
			 echo "Selecione uma imagem";
			}

			//return array with the name / path of the images.
			return $paths;
		}



		//Ruan @ [06/06/2014] - Show related topics based on the topics wich has
		public function showRelatedTopics($title){

			$val = '';
			$similar = 0;
			$mostRelated = Array();

			$this->load->model('topic_m');
			$topics = $this->topic_m->get_most_answered_topics();
                        
                        if($topics){
                            for($i = 0; $i < sizeof($topics); $i++){
				$val = $topics[$i]->title;
				similar_text($val, $title, $similar);
				if($similar > 75.00){
					array_push($mostRelated, $topics[$i]);
				}
                            }
                        }
			

			return $mostRelated;
		}


		public function report_t($id) {
			$this->load->model('topic_m');
            $session = $this->session_check();
            $topic = $this->topic_m->get_topic($id);
            $title = $topic[0]->title;
            $iduser = $session['iduser'];
            $username = $session['username'];
            $email_from = "daejeonhub@daejeonhub.com";
            
            $email_to  = 'aderleifilho@gmail.com' . ', ';
            $email_to  .= 'marques.ruan@gmail.com' . ', ';
            $email_to  .= 'thalesbrante@gmail.com';
            
            $email_subject = "Report made at Daejeon Hub";

            $email_message = "This is a report made by the user id: " . $iduser . "name: " . $username . " about the topic number: " . $id . " Title: ". $title . ". Please check if it is necessary any intervention in this topic!";
            
            $headers = 'From: '.$email_from."\r\n".
 
            'Reply-To: '.$email_from."\r\n" .

            'X-Mailer: PHP/' . phpversion();

            @mail($email_to, $email_subject, $email_message, $headers); 
            redirect('home','refresh');
            
        }

	}
?>
			
