<?php 
require_once 'super_controller.php';

class temporada_controller extends super_controller{


	public function __construct(){
		parent::__construct();
		$this->modelo = new temporada_model();
	}

	public function crear(){
		if ($this->modelo->isAdmin() && isset($_GET['parametro'])) {
			$serie_id = $_GET['parametro'];
			$token = $this->token;
			$_SESSION['csrf'] = $token;
			require_once 'Vistas/temporadas/crear.php';
		}else{
			header('location:'.config::HOME);
		}
	}


	public function save(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && $this->modelo->isAdmin() && $_POST['token'] = $_SESSION['csrf']) {
			$season_num = $this->int_val($_POST['season_num']);		
			$serie_id = $this->int_val($_POST['serie_id']);	

			if($season_num && $serie_id){
				$sql = "null, '$serie_id', '$season_num'";

				$save = $this->modelo->save($sql);

				if($save){
					$_SESSION['message'] = 'temporada creada';
					header('location: /serie/ver/'.$serie_id);
				}else{
					$_SESSION['error'] = 'temporada no creada';
				}
			}else{
				$_SESSION['error'] = 'temporada no creada';
			}	
		}else{
			$_SESSION['error'] = 'temporada no creada';
		}	
		header('location: /serie/ver/'.$serie_id);	
	}

	public function delete(){
		$id = intval($_GET['parametro']);		
		if ($this->modelo->isAdmin() && $id) {
			try {
				$delete = $this->modelo->delete_season($id);
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}	
		die();	
		header('location: /serie/ver/'.$serie_id);
	}

}




 ?>