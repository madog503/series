<?php 

function app_autoloader($class){
	$controlador = 'controladores/';
	$modelo = 'modelos/';
	
	$ext = '.php';
	try{

		if(strstr($class, '_controller')){
			$file = $controlador.$class.$ext;
			
			if(file_exists($file)){
				require_once $file;
			}else{
				throw new Exception('Error: 404 pagina no encontrada ');
			}

		}

		if(strstr($class, '_model')){
			
			$file = $modelo.$class.$ext;
			
			if(file_exists($file)){
				require_once $file;
			}else{
				throw new Exception('Error: 404 hay problemas con el servidor ');
			}
		}




	}catch(Exception $e){
		$error =  $e->getMessage();
		require_once 'Vistas/errores/error_load.php';
		die();
	}


}

spl_autoload_register('app_autoloader');


session_start();
if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
}

 ?>