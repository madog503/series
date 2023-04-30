<?php 

function validate_text($db, $bar){
	return preg_match('/^[A-Za-z0-9 ]+$/', $bar)&&!empty($bar) ? mysqli_real_escape_string($db, trim($bar)) : false;
}


function endSession(){	
	$_SESSION['message'] = null;
	$_SESSION['error'] = null;
	unset($_SESSION['message']);
	unset($_SESSION['error']);
}

function coneccion(){
	$coneccion = new mysqli(config::HOST_URL,config::USER,config::PASSWORD,config::DATA_BASE);
    $coneccion->set_charset(config::CHARSET_NAME);

    return $coneccion;
}

function categorias(){
	$res = false;
	$db = coneccion();

	$categorias = [];
	$i = 0;

	$sql = "SELECT * FROM categorias";

	$select = $db->query($sql);

	if($select->num_rows !== 0){

		while($categoria = $select->fetch_assoc()){

			$categorias[$i]['id'] = $categoria['id'];
			$categorias[$i]['categoria'] = $categoria['categoria'];
			$i++;
		}

		$res = $categorias;
	}


	return $res;
}

function categorias_by_serie_id($id){
	$res = false;
	$db = coneccion();

	$categorias = [];
	$i = 0;

	$sql = "select * from categorias c inner join series_categorias sc on sc.categoria_id = c.id and sc.serie_id = $id";

	$select = $db->query($sql);

	if($select->num_rows !== 0){

		while($categoria = $select->fetch_assoc()){

			$categorias[$i]['id'] = $categoria['id'];
			$categorias[$i]['categoria'] = $categoria['categoria'];
			$i++;
		}

		$res = $categorias;
	}


	return $res;
}

function mixdrop($id = ''){
	
	$email = 'floresone98@gmail.com';
	$key = '5aIk9kUnDmBJr1z';

	$url = '';

	$datos = [];

	// array para retornar datos
	$series = [];
	
	$i = 0;

	//  condicional para sacar folder y archivos
	if(!$id){
		$url = "https://api.mixdrop.co/folderlist?email=$email&key=$key";
	}else{
		$url = "https://api.mixdrop.co/folderlist?email=$email&key=$key&id=$id";
	}

	// convertir contenido en JSON
	$json = file_get_contents($url);

	$datos = json_decode($json,true);

	$paginas = isset($datos['pages'])? $datos['pages'] : '' ;


	// funcion para ordenar array
	function sort_arr ($arr){
		$title = array_column($arr, 'title');

		array_multisort($title, SORT_ASC, $arr);
		$res = $arr;

		return $res;
	}

	// condicion para saber si tiene mas de una pagina
	if($paginas > 1){
		
		for($j = 1; $j <= $paginas; $j++){

			$url_page = $url."&page=$j";

			$json = file_get_contents($url_page);

			$pagina[$j] = json_decode($json,true);
			
		}

		foreach ($pagina as $i_key => $result) {
			foreach ($result['result'] as $j_key => $files) {
				foreach ($files as $k_key => $value) {
					$series[$i] = $value;
					$i++;
				}
			}
		}

		$series = sort_arr($series);
	}

	if(count($series) == 0){
		// para sacar los folder 
		if (!empty($datos['result']['folders'])){
			var_dump('folder');
			foreach ($datos['result']['folders'] as $value) {
				$series[$i] = $value;
				$i++;
		}

		// sacar los archivos
		}elseif(!empty($datos['result']['files'])){
			var_dump('files');
			$i = 0;

			foreach ($datos['result']['files'] as $value) {
				$series[$i]['title'] = $value['title'];
				$series[$i]['status'] = $value['status'];
				$series[$i]['url'] = $value['url'];
				$i++;
			}


			// PRUEBAS ****************************************************************************
			$series = sort_arr($series);

			$_SESSION['capitulos'] = true;

		}
	}

	return $series;
}

 ?>