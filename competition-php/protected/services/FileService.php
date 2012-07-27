<?php 
class FileService{

	public static function upload($temp,$dir,$file){
		FileService::mkdir($dir);
		move_uploaded_file($temp,$dir.$file);
	}

	public static function write($file,$data){
		$f = fopen($file, 'w');
		fwrite($f, $data);
		fclose($f);
	}

	public static function mkdir($dir){
		if(!file_exists($dir)){
			mkdir($dir, 0755);
		}
	}

}
?>