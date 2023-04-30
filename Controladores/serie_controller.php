<?php
require_once 'super_controller.php'; 
class serie_controller extends super_controller{


	public $id;
	public $user_id;
	public $titulo;
	public $sinopsis;
	public $idioma;
	public $imagen;
	public $estreno;

	public function __construct(){
		parent::__construct();
		$this->modelo = new serie_model();
	}

	public function listar(){
		if($this->modelo->isAdmin()){
			$series = $this->modelo->getAll();
			
			require_once 'Vistas/series/listar.php';
		}else{
			header('location: '.config::HOME);
		}
	}

	public function crear(){
		if ($this->modelo->isAdmin()) {
			$user = $this->modelo->getLogin();
			$token = $this->token;
			$_SESSION['csrf'] = $token;
			require_once 'Vistas/series/crear.php';
		}else{
			header('location: '.config::HOME);
		}
	}
	
	public function actualizar(){
		if(!empty($_GET['parametro']) && $this->modelo->isAdmin() ){
			$user = $this->modelo->getLogin();
			$token = $this->token;
			$_SESSION['csrf'] = $token;

			$id = $_GET['parametro'];
		    $serie = $this->modelo->getOne($id);
			$update = true;
			require_once 'Vistas/series/crear.php';
		}
	}

	public function ver(){
		if(!empty($_GET['parametro'])){
			$id = $_GET['parametro'];
		    $serie = $this->modelo->getOne($id);

		    $temporada_controler = new temporada_controller();
		    $seasons = $temporada_controler->modelo->getAllSerie($id);
		    $capitulo = new capitulo_controller(); 
		    $capitulos = array();


		    foreach ($seasons as $season) {
		    	if (is_array($result = $capitulo->modelo->getAll_by_season($season['id']))) {
		    		$capitulos = array_merge($capitulos, $result);
		    	}else{
		    		$result_arr['result'] = $result;
	    			$result_arr['status'] = 'error';
	    			$result_arr['season_id'] = $season['id'];

		    			array_push($capitulos, $result_arr);
		    	}
		    }
		    
			// condicion que permite que muestre el panel de administrador o la vista de usuario
			if($this->modelo->isAdmin()){
				require_once 'Vistas/series/ver-admin.php';
			}elseif(!($this->modelo->isAdmin()) || $_GET['parametro2'] === 'admin') {
				require_once 'Vistas/series/ver-user.php';
			}

		}else{
			header('location'.config::HOME);
		}
	}

	public function delete(){
		if ($this->modelo->isAdmin() && isset($_GET['parametro'])){
			$id = intval($_GET['parametro']);
			$this->modelo->delete_serie($id);
		}
		header('location: /serie/listar');
	}

	public function save(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && $this->modelo->isAdmin() && $_POST['token'] == $_SESSION['csrf']) {
			// var_dump($_POST);
			$user_id = $this->int_val($_POST['user_id'])?: 'hay un error';
			$titulo = $this->escape($_POST['titulo'])?: 'hay un error';
			$sinopsis = $this->escape($_POST['sinopsis'])?:'hay un error';
			$idioma = $this->escape($_POST['idioma'])?:'hay un error';
			$estreno = $this->escape($_POST['estreno'])?:'hay un error';

			$imagen_preload = $this->validate_image($_FILES['imagen']);
			$imagen = $this->upload_image($imagen_preload, $titulo);
			

			try{
				if($user_id && $titulo && $sinopsis && $idioma && $estreno && $imagen){
					
					$sql = "null, $user_id,'$titulo','$sinopsis','$idioma','$imagen','$estreno'";

					$save =  $this->modelo->save($sql);

					if($save){

						$serie_id = $this->modelo->getConn()->insert_id;

						$categorias = $_POST['categorias'];

						$this->modelo->table = 'series_categorias';

						foreach ($categorias as $categoria) {
							$sql = "null, $serie_id, $categoria";
							$save =  $this->modelo->save($sql);

						}
					}
				}else{
					throw new Exception('error: faltan datos para agregar la nueva serie');
				}
			}catch(exception $e){
				echo $e->getMessage();
			}
		}
		header('location: /serie/listar');
	}

	public function update(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($this->modelo->isAdmin()) {
				if($_POST['token'] == $_SESSION['csrf']){

					$serie_id = $this->int_val($_POST['serie_id']);
					$user_id = $this->int_val($_POST['user_id']);
					$titulo = $this->escape($_POST['titulo']);
					$sinopsis = $this->escape($_POST['sinopsis']);
					$idioma = $this->escape($_POST['idioma']);
					$estreno = $this->escape($_POST['estreno']);

					try{
						if($user_id && $serie_id && $titulo && $sinopsis && $idioma && $estreno){
							
							$sql = "set user_id = '$user_id', titulo = '$titulo', sinopsis = '$sinopsis',idioma =  '$idioma',estreno = '$estreno' WHERE id = $serie_id";

							$save =  $this->modelo->update($sql);

						}else{
							throw new Exception('error: faltan datos para agregar la nueva serie');
						}
					}catch(exception $e){
						echo $e->getMessage();
					}
				}			
			}
		}
		header('location: /serie/listar');
	}

}

 ?>