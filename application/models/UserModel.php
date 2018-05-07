<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function create(string $name,string $user,string $password){
		$resul=$this->show($user);
		if(is_null($resul)){
			return $this->db->query("INSERT INTO user (name,user,password) values ({$name},{$user},'{$password}')");
		}else{
			return false;
		}
		
	}

	public function login(string $user,string $password){
		$user=$this->show($user);
		if(!is_null($user)){
			$comparacion= password_verify($password, $user['password']);
			if($comparacion=="1"){
				return true;
			}else{
				return false;
			}
		}else{
			return null;
		}
	}

	public function show(string $user = null){
		if(!is_null($user)){
			$query = $this->db->query("SELECT * FROM user where user= {$user}");
	        if ($query->num_rows() === 1) {
	        	return $query->row_array();
	        }
	        return null;
		}else{

		}
	}
}