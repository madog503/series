<?php 
require_once 'Super_model.php';

class temporada_model extends Super_model{

	public function __construct(){
		parent::__construct();
		$this->table = 'seasons';
	}

	public function getAllSerie($serie_id){
		$sql = "SELECT * FROM seasons WHERE serie_id = $serie_id ORDER BY season_num ASC";
		$result = $this->conn->query($sql);

		$res = false;
		
		$temporadas = [];
		$i = 0;

		try {
			if($result){
				while($seasons = $result->fetch_assoc()){
					$temporadas[$i] = $seasons;
					$i++;
				}
				$res = $temporadas;
			}		
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return $res;
	}

	public function delete_season($id){
		$sql1 = "DELETE FROM capitulos WHERE season_id = ?";
		$stmt1 = $this->conn->prepare($sql1);
		$stmt1->bind_param('i', $id);
		$stmt1->execute();

		$sql2 = "DELETE FROM seasons where id = ?";
		$stmt2 = $this->conn->prepare($sql2);
		$stmt2->bind_param('i', $id);
		$stmt2->execute();

		if($stmt2->affected_rows > 0){
			return true;
		}else{
			throw new Exception('no se ha podido borrar los registros de temporada');
		}
	}
	
}

 ?>