<?php 
class super_controller{

	public $modelo;

	public $token;

	public $serie_id;
	public $season_id;

	
	public function __construct(){
		$this->token();
	}

	public function token(){
		$this->token = md5(uniqid(rand(), true));
	}

	public function escape($bar){
		return !empty($bar)? $this->modelo->getConn()->real_escape_string(trim($bar)) : throw new Exception('hay un fallo');
	}

	public function int_val($bar){
		return intval($bar)? intval($bar) : false;
	}

	public function validate_image($bar){
		$res = false;
	
		if(!empty($bar)){
			$tipo = $bar['type'];
			if($tipo == 'image/jpg' || $tipo == 'image/jpeg' || $tipo == 'image/png' || $tipo == 'image/webp'){
				$res = $bar;
			}		
		}

		return $res;
	}

	public function upload_image ($bar, $serie){
		$res = false;

		$dir= 'storage/'.str_replace(" ", "",$serie).'/images/';
		$file = $serie.time().$bar['name'];
		
		/*creardirectorio si no existe en la ruta*/
		$upload =  is_dir($dir)?: mkdir($dir, 0777, true);
	

		if($upload){
			/*subir archivo si no existe*/
			$upload = file_exists($dir.$file)?: move_uploaded_file($bar['tmp_name'], $dir.$file);

			if($upload){
				$res = $file;
			}else{
				throw new Exception('Imagen no pudo ser subida');
			}

		}else{
			throw new Exception('Folder no pudo ser creado');
		}

		return $res;
	}
	
}


 ?>