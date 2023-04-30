<?php 
require_once 'Super_model.php';

class User_model extends Super_model{

	public $id;
	public $username;
	public $password;


	public function __construct(){
		parent::__construct();
		$this->table = 'users';
	}

	public function verify_login($username, $password){
		$sql = "SELECT * FROM $this->table WHERE username = '$username' ";

		$usuario = $this->conn->query($sql);
		$comprobar = $usuario->fetch_assoc();


		if (password_verify($password, $comprobar['password'])) {
			$user['id'] = $comprobar['id'];
			$user['username'] = $comprobar['username'];
			$user['role'] = $comprobar['role'];
		}else{
			$user = false;
		}

		return $user;
	}
}

 ?>