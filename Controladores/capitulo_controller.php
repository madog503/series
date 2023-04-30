<?php 
require_once 'super_controller.php';

class capitulo_controller extends super_controller{



	public function __construct(){
		parent::__construct();
		$this->modelo = new capitulo_model();
	}

	public function crear(){
		if($this->modelo->isAdmin()){
			$serie_id = $_GET['parametro'];
			$season_id = $_GET['parametro2'];
			
			$token = $this->token;

			$_SESSION['csrf'] = $token;

			require_once 'Vistas/capitulos/crear.php';
		}else{
			header('location:'.config::HOME);
		}
	}

	public function actualizar(){
		if ($this->modelo->isAdmin()) {
			$serie_id = intval($_GET['parametro']);
			$id = intval($_GET['parametro2']);

			$token = $this->token;
			$_SESSION['csrf'] = $this->token;

			// $update = true;

			$update = $this->modelo->getOne_by_id($id);

			require_once 'Vistas/capitulos/actualizar.php';
		}
	}

	public function bulkSave(){
		if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->modelo->isAdmin()){
			$capitulos = $_POST;


			foreach ($capitulos as $capitulo) {
				foreach ($capitulo as $value) {
					if ($value['token'] == $_SESSION['csrf']) {
						$serie_id = $this->int_val($value['serie_id']);
						$season_id = $this->int_val($value['season_id']);
						$titulo = $this->escape($value['titulo']);
						$chapter_num = $this->int_val($value['chapter_num']);
						
						$path = $this->escape($value['link']);

						$link = str_replace('https://mixdrop.co/f','//mixdrop.gl/e', $path);
					 	

					 	$sql = "null, $serie_id,$season_id,'$titulo',$chapter_num,'$link'";
					 	$save = $this->modelo->save($sql);
					 	if($save){
					 		$_SESSION['message'] = 'capitulo creado';
					 		header('location: /serie/ver/'.$serie_id);
					 	}else{
					 		exit();
					 	}
					}
				}
			}
		}
	}

	public function delete(){
		if (isset($_GET['parametro2']) && $this->modelo->isAdmin()) {
		
			$serie_id = $_GET['parametro'];
			$id = intval($_GET['parametro2']);
			
			if ($id) {
				$this->modelo->delete($id);
			}
		}
		header('location: /serie/ver/'.$serie_id);	
	}

	public function update(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && $this->modelo->isAdmin() && $_POST['token'] == $_SESSION['csrf']) {
			
			$parametros = [];

			$id = $_POST['id'];
			$serie_id = $_POST['serie_id'];

			$pp_link = $this->escape($_POST['link']);
			$link = str_replace('https://mixdrop.co/e','//mixdrop.gl/e', $pp_link);
			
			$parametros[] = $this->int_val($_POST['serie_id']);
			$parametros[] = $this->int_val($_POST['season_id']);
			$parametros[] = $this->escape($_POST['titulo']);
			$parametros[] = $this->int_val($_POST['chapter_num']);
			$parametros[] = $link;
			$parametros[] = $this->int_val($_POST['id']);


			$update = $this->modelo->capitulo_update($parametros);

			if($update){
				header('location: /serie/ver/'.$serie_id);	
			}
		}
	}

	public function ver(){
		$id = $this->int_val($_GET['parametro']);
	
		$player = $this->modelo->getOne_by_id($id);
		$links = $this->modelo->anterior_siguiente_($player['chapter_num'], $player['serie_id']);
	
		require_once 'Vistas/capitulos/ver.php';
	}

}

 ?>



