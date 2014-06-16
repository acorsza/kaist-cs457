<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User extends CI_Controller {
		
		public function index(){
			//$this->home();
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

		public function create(){

			//Model to insert user in the database
			$this->load->model('user_m');

			$user['username'] = $this->input->post('name');
                        $user['email'] = $this->input->post('email');
                        $user['created_at'] = date('Y-m-d H:i:s');
                        $user['password'] = MD5($this->input->post('password'));
                        $user['id_country'] = $this->input->post('country');

			$this->user_m->insertUser($user);
			redirect('home', 'refresh');
		}

		public function show(){

			// Check session
			$session_data = $this->session_check();
			$data['username'] = $session_data['username'];
			$iduser = $session_data['iduser'];

			$this->load->model('user_m');
			$this->load->model('topic_m');
			$data['userinfo'] = $this->user_m->get_user_info($iduser);

			$this->load->model('home_m');
			$data['countrylist'] = $this->home_m->getCountries();
                        if(substr($session_data['img_url'],0,4) == "http"){
                            $data['img_facebook'] = $session_data['img_url'];
                        } else {
                            $data['img_facebook'] = "";
                        }
            
            $data['totalAnswersNotSeen']    = $this->topic_m->total_answers_not_seen($session_data['iduser']);                                        

			// Load view
			$this->load->view('main_header', $data);
			$this->load->view('logged_nav');
			$this->load->view('user_perfil', $data);
			$this->load->view('main_footer');

		}


		public function save(){

			$session_data = $this->session_check();
			$data['iduser'] 	= $session_data['iduser'];
			$data['username'] 	= $this->input->post('username');
			$data['email']    	= $this->input->post('email');
			$data['id_country'] = $this->input->post('country');

			//Model to insert user in the database
			$this->load->model('user_m');
			$this->user_m->alter_info($data);
		}


		public function uploadImage(){
			// Check session
			$session_data = $this->session_check();
			$iduser = $session_data['iduser'];

			$pasta = "./assets/media/users_pictures/"; // formatos de imagem permitidos 
			$permitidos = array(
				".jpg",
				".jpeg",
				".gif",
				".png",
				".bmp"
			);

			if (isset($_POST))
			{
				$nome_imagem = $_FILES['imagem']['name'];
				$tamanho_imagem = $_FILES['imagem']['size']; // pega a extensão do arquivo 
				$ext = strtolower(strrchr($nome_imagem, ".")); // verifica se a extensão está entre as extensões permitidas //
				if (in_array($ext, $permitidos))
				{ 	// converte o tamanho para KB
					$tamanho = round($tamanho_imagem / 1024);
					if ($tamanho < 1024)
					{ 	//se imagem for até 1MB envia
			 			$nome_atual = md5(uniqid(time())).$ext;
			  			//nome que dará a imagem
			 			$tmp = $_FILES['imagem']['tmp_name'];
			 			//caminho temporário da imagem 
			 			// se enviar a foto, insere o nome da foto no banco de dados 
			 			if(move_uploaded_file($tmp,$pasta.$nome_atual)){ 

			 				$data['img_name'] = $nome_atual;
			 				$this->load->model('user_m');
							$this->user_m->upload_picture($iduser, $data);

							echo $nome_atual;
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
			else{
			 echo "Selecione uma imagem";
			}
		}
	}
?>