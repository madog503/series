<?php 
require_once 'Super_model.php';

class categoria_model extends Super_model{

	public $id;
	public $categoria;

	public function __construct(){
		parent::__construct();
		$this->table = 'categorias';
	}

	
}


 ?>