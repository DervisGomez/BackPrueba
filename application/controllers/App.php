<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("UserModel");
	}

	public function index(){	
		//$this->load->database('default');// para cargar
		//print_r($this->db);//si la cargamos automaticamente
		$this->login();
	}

	public function sreg(){
		echo "para mostrar la pagina de registro (si el usuario está conectado, redirigir a user)";
	}

	public function user(){
		echo "para mostrar la pagina del usuario (si el usuario no está conectado, redirigir a sreg)";
	}

	public function login(){
		if($this->input->post){
			
		}else{
			
		}
		if($this->input->post()){

			$user=$this->db->escape($_POST["user"]);
			$password=$this->db->escape($_POST["password"]);
			$resul=$this->UserModel->login($user,$password);

			if(!is_null($resul)){
				if($resul){
					$data['datos']="Login exitoso";
				}else{
					$data['datos']="Contraseña invalida";
				}
			}else{
				$data['datos']="Usuario no encontrado";
			}

			$this->load->view('app', $data);
			
		}else{
			$data['datos']="Login";
			$this->load->view('app', $data);
		}	
	}

	public function logout(){
		echo "para salir";
	}

	public function register(){
		if($this->input->post()){
			//print_r($_POST);
			$name=$this->db->escape($_POST["name"]);
			$user=$this->db->escape($_POST["user"]);
			$passwordOri=$this->db->escape($_POST["password"]);
			$password = password_hash($passwordOri, PASSWORD_DEFAULT, [array('cost' => 12)]);
			if($this->UserModel->create($name,$user,$password)){
				$data['datos']="Register\nDatos Guardados exitosmente";
			}else{
				$data['datos']="Register\nDatos no Guardados";				
			}
			$this->load->view('register', $data);
			
		}else{
			$data['datos']="Register";
			$this->load->view('register', $data);
		}		
	}

	public function modify()
	{
		echo "para modificar la contraseña de una cuenta";
	}

	public function delete()
	{
		echo "para eliminar una cuenta";
	}

}