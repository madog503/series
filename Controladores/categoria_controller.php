<?php 

require_once 'super_controller.php';

class categoria_controller extends super_controller{

	public $id;
	public $categoria;


	public function __construct(){
		parent::__construct();

		$this->modelo = new categoria_model();
	}

	public function crear(){
		$x = 'hola';
		require_once 'Vistas/categorias/crear.php';
	}

	public function actualizar(){
		if ($id = intval($_GET['parametro'])) {
			$update = true;
			$categoria = $this->modelo->getOne($id);
		}
		require_once 'Vistas/categorias/crear.php';
	}

	public function save(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($this->modelo->isAdmin()){
				$categoria = validate_text($this->modelo->getConn(), $_POST['categoria']);


				$sql = "null,'$categoria'";

				$check = $this->modelo->save($sql);

				if($check){
					$_SESSION['message'] = 'Categoria creada';
					// var_dump($this->modelo->getConn()->insert_id());
				}else{
					$_SESSION['error'] = 'Categoria no fue creada';
				}

			}else{
					$_SESSION['error'] = 'Categoria no fue creada no tienes autorizacion para realizar esta accion';
			}
		}	
		header('location: '.config::HOME);	
	}

	public function update(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			if($this->modelo->isAdmin()){
				$categoria = validate_text($this->modelo->getConn(), $_POST['categoria']);

				$id = preg_match('/^[0-9]+$/',intval($_GET['parametro']))? intval($_GET['parametro']) : false;

				if($categoria && $id){
					$sql = "SET categoria = '$categoria' WHERE id = $id";

					$update = $this->modelo->update($sql);

					if ($update) {
						$_SESSION['message'] = 'categoria actualizada';
					}else{
						$_SESSION['error'] = 'categoria no actualizada';
					}
				}
			}else{
				$_SESSION['error'] = 'categoria no actualizada no tienes autoricaion para realizar esta accion';
			}
		}
		header('location: '.config::HOME);
	}
}

 ?>