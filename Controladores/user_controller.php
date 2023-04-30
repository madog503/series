<?php 
require_once 'super_controller.php';

class User_controller extends super_controller{

	public $username;
	public $password;

	// private $modelo;

	public function __construct(){
		parent::__construct();

		$this->modelo = new User_model();
	}


	public function crear(){
		require_once 'Vistas/users/register_login.php';
	}

	public function login(){
		$login = true;
		require_once 'Vistas/users/register_login.php';	
	}
	

	public function save (){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$save = $this->modelo;

			$username = validate_text($save->getConn(),$_POST['username']);
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

			if($username && $password){
				$sql = "null,'$username','$password',0";

				$retorno = $save->save($sql);

				if($retorno){
					$_SESSION['message'] = 'usuario creado';
				}else{
					$_SESSION['error'] = 'no pudo ser creado el nuevo usuario';
				}

			}else{
				$_SESSION['error'] = 'hay un problema con los datos del usuario';
			}

		}

		header('location: '.config::HOME);
	}

	public function singin(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$username = validate_text($this->modelo->getConn(), $_POST['username']);
			$password = $this->modelo->getConn()->real_escape_string($_POST['password']);

			$user = $this->modelo->verify_login($username, $password);
			if($user){
				$_SESSION['message'] = 'usuario logeado';
				$_SESSION['user'] = $user;
			}else{
				$_SESSION['error']  = 'no se pudo ingresar';	
			}
		}		
		header('location: '.config::HOME);
	}

	public function singout(){
		if(isset($_SESSION['user'])){
			$_SESSION['user'] = null;

			unset($_SESSION['user']);
		}
		header('location: '.config::HOME);
	}

	
}

 ?>