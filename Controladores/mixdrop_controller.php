<?php 
require_once 'super_controller.php';

class mixdrop_controller extends super_controller{

	private $email = 'floresone98@gmail.com';
	private $key = '5aIk9kUnDmBJr1z';

	// paginas de la consulta 
	public $pages;

	// pagina a la que estoy consultando
	public $page_unique;

	// variables de seri y temporada
	public $serie_id;
	public $season_id;


	public function __construct(){
		parent::__construct();
		$this->modelo = new capitulo_model();
	}

	function api_($url_bar){
		$url = "$url_bar";

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);

		// cerrar session curl
		curl_close($curl);

		// el segundo parametro indica si se decea que el resultado sea un array asociativo
		$response_datos = json_decode($response,true);
		
		$this->pages = $response_datos['pages'];

		// asignando valores de serie y temporada
		$this->season_id = (int)$this->escape(intval($_GET['parametro']));
		$this->serie_id = (int)$this->escape(intval($_GET['parametro2']));
		
		return $response_datos;
	}

	function multiple_($value){
		$series = [];

		foreach ($value as $i_key => $result) {
			foreach ($result['result'] as $j_key => $files) {
				foreach ($files as $k_key => $value) {
					array_push($series, $value);
				}
			}
		}

		return $series;
	}

	function link_($value){
		$season_id = $_GET['parametro'];
		$serie_id = $_GET['parametro2'];

		$path_folder = "/mixdrop/folder/$season_id/$serie_id/";
		$path_file = "/mixdrop/file/$season_id/$serie_id/";

		return isset($value['id'])? $path_folder.$value['id'] : (isset($value['fileref'])? $path_file.$value['fileref'] : '');
	}

	function index_(){
		$url = "https://api.mixdrop.co/folderlist?email=$this->email&key=$this->key";

		// llamdando funcion de coneccion
		$response = $this->api_($url);

		$result = array();

		// guardando los resultados en un array 
		foreach ($response['result'] as $datos) {
			foreach ($datos as $values) {
				array_push($result, $values);
			}
		}

		return $result;
	}

	function folder_(){
		// iniciando numero de paginas en 1
		$this->pages = 1;

		// inicializando arreglo vacio
		$response = array();
		
		// asignando el id del folder a recorrer
		$folderid = $_GET['parametro3'];

		// bucle para recorrer folder y hacer consulta
		for ($i = 1; $i <= $this->pages ; ++$i) {
			// url
			$url = "https://api.mixdrop.co/folderlist?email=$this->email&key=$this->key&id=$folderid}&page=$i";
			// haciendo llamada de la api y agregando la respuesta al final del array
			array_push($response, $this->api_($url));
		}

		// retorno
		return $response;
	}

	function sort_ ($arr){
		$title = array_column($arr, 'title');

		array_multisort($title, SORT_ASC, $arr);
		$res = $arr;

		return $res;
	}

	public function index(){
		if ($this->modelo->isAdmin()) {
			$datos = $this->index_();

			require_once 'Vistas/mixdrop/index.php';
			
		}else{
			header('location: '.config::HOME);
		}
	}

	public function folder(){
		$response = $this->folder_();

		$datos_pre_sort = $this->multiple_($response);

		$datos = $this->sort_($datos_pre_sort);

		$token = $this->token;
		$_SESSION['csrf'] = $this->token;

		require_once 'Vistas/mixdrop/folder.php';
	}



}

 ?>