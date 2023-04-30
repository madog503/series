<?php 

function router(){
	
	try {

		$controlador = '';
		$accion = '';
		
		// controlador

		if(isset($_GET['c'])){
			$control = $_GET['c'].'_controller';
		}
		else{
			$control = config::MAIN_CONTROLLER;
		}

		// accion 
		if(isset($_GET['a'])){
			$accion = $_GET['a'];
		}else{
			$accion = config::MAIN_ACTION;
		}

		if(class_exists($control)){

			// creando objeto de la clase 
			$controlador = new $control();

			if (method_exists($controlador, $accion)) {
				// utilizando metodo
				$controlador->$accion();
			}else{
				throw new Exception('uuups contenido no encontrado');
			}


		}else{
			throw new Exception('Pagina no encontrada');
		}


	} catch (Exception $e) {
		echo $e->getMessage();				
	}
}

 ?>