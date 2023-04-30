<?php
require_once 'Super_model.php'; 
class serie_model extends super_model{

	public $id;

	public function __construct(){
		parent::__construct();
		$this->table = 'series';
	}


	public function delete_serie($id){		
		$this->conn->begin_transaction();

		try{
			$query = "DELETE FROM series_categorias where serie_id = ?";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param('i', $id);
			$stmt->execute(); 

			$query1 = "DELETE FROM capitulos WHERE serie_id = ?";
			$stmt1 = $this->conn->prepare($query1);
			$stmt1->bind_param('i', $id);
			$stmt1->execute();

			$query2 = "DELETE FROM seasons where serie_id = ?";
			$stmt2 = $this->conn->prepare($query2);
			$stmt2->bind_param('i', $id);
			$stmt2->execute(); 

			$query3 = "DELETE FROM series where id = ?";
			$stmt3 = $this->conn->prepare($query3);
			$stmt3->bind_param('i', $id);
			$stmt3->execute(); 

			return $this->conn->commit();
		}catch(Exception $e){
			$this->conn->rollback();
			return $e->getMessage();
		}

	}
 
}

?>

