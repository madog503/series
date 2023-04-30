<?php 
require_once 'super_controller.php';

class home_controller extends super_controller{

	public function __construct(){
		parent::__construct();
		$this->modelo = new serie_model();
	}

	public function index(){
		$series = $this->modelo->getAll();
		require_once 'Vistas/home/home.php';

	}

	

}

 ?>