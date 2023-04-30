<?php 
require_once 'Super_model.php';
class capitulo_model extends Super_model
{



	public function __construct(){
		parent::__construct();
		$this->table = 'capitulos';
	}

	function anterior_siguiente_($num_chapter, $serie_id){
		$sql = "SELECT (SELECT MAX(id) from capitulos where chapter_num < ? and serie_id = ?  limit 1) as anterior,
				(SELECT MIN(id) from capitulos where chapter_num > ? and serie_id = ?  limit 1) as siguiente FROM capitulos limit 1";

		$stmt= $this->conn->prepare($sql);

		$stmt->bind_param('iiii',$num_chapter,$serie_id,$num_chapter,$serie_id);
		$stmt->execute();

		$links = $stmt->get_result();

		$result = $links->fetch_assoc();
		return $result;
	}

	public function getAll_by_season($season_id){
		$sql = "SELECT * FROM $this->table WHERE season_id = ? order BY chapter_num ASC";
		$stmt = $this->getConn()->prepare($sql);
		$stmt->bind_param('i', $season_id);
		$stmt->execute();

		$result = $stmt->get_result();

		$temporadas = [];

		try{
			if ($result && $result->num_rows > 0) {
			 	while ($results = $result->fetch_assoc()) {
			 		$temporadas[] = $results;
	 			}

	 			return $temporadas;	

			}else{
				throw new Exception('No hay Capitulos disponibles');
			}		

		}catch(exception $e){
			return $e->getMessage();
		}
	}

	public function delete($id){
		if (intval($id)) {
			$sql = "DELETE FROM $this->table WHERE id = ?";
			$stmt = $this->getConn()->prepare($sql);
			$stmt->bind_param('i', $id);
			$delete = $stmt->execute();

			return $delete;
		}else{
			throw new Exception('informacion no valida');
		}		
	}

	public function getOne_by_id($id){
		if(intval($id)){
			$sql = "select * from capitulos where id = ?";
			$stmt = $this->getConn()->prepare($sql);
			$stmt->bind_param('i', $id);
			$stmt->execute();

			$result_main = $stmt->get_result();

			while ($result = $result_main->fetch_assoc()) {
			    return $result;
			}
		}else{
			throw new Exception('error para conseguir capitulo');
		}
	}

	public function capitulo_update($arr){
		// validacion de datos
		$sql = "UPDATE $this->table SET serie_id = ?, season_id = ?, titulo=?, chapter_num=?, link=? WHERE id = ?";
		$stmt = $this->getConn()->prepare($sql);
		$stmt->bind_param('iisisi', ...$arr);
     	
     	$result = $stmt->execute();
	    
	    return $result;
	}



}

 ?>
