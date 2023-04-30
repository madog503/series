<?php 
require_once 'config/config.php';

class Super_model{

  public $table;
  public $retorno = false;

	protected $conn;

  public $admin = false;

  protected $login = false;


	protected function __construct(){
		$this->Coneccion();
    $this->login();
    $this->isAdmin();
	}

	// hacer un metodo de conceccion privado que sea llamado por el constructor
    private function Coneccion(){
      $coneccion = new mysqli(config::HOST_URL,config::USER,config::PASSWORD,config::DATA_BASE);
      $coneccion->set_charset(config::CHARSET_NAME);

      $this->conn = $coneccion;
    }

    public function login(){
      if(!empty($_SESSION['user'])){
        $this->login = $_SESSION['user'];
      }
    }

    public function isAdmin(){
      if($this->login &&!empty($this->login) && $this->login['role'] == 3){
        $this->admin = true;
      }
      return $this->admin;
    }


    public function getLogin(){
      return $this->login;
    }

  	public function getConn(){
  		return $this->conn;
  	}

    public function getAll(){
      $sql = "SELECT * FROM $this->table ORDER BY id DESC";

      $result = $this->conn->query($sql);

      $all_result = [];
      $i = 0;

      while($all = $result->fetch_assoc()){
        $all_result[$i] = $all;
        $i++;
      }

      return $all_result;
    }

    // mostrar un registro
  	public function getOne($id){
  		$sql = "SELECT * FROM $this->table WHERE id = ".$id;

  		$selec_one = $this->conn->query($sql);

      // $selec = $selec_one->fetch_assoc();
  		return $selec_one->fetch_assoc();
  	}

    // guardar nuevo registro
    public function save($sql){
      $sql = "INSERT INTO $this->table VALUES($sql)";

      $save = $this->conn->query($sql);

      if($save){
        $this->retorno = true;
      }

      return $this->retorno;
    }


    // borrar registro
    public function delete($id){
      $sql = "DELETE FROM $this->table WHERE id = $id";
    }

    // update registro
    public function update($sql){
      $sql = "UPDATE $this->table $sql";

      $update = $this->conn->query($sql);

      if($update){
        $this->retorno = true;
      }

      return $this->retorno;
    }

}

 ?>