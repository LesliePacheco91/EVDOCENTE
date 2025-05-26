<?php 

/**
 * 
 */
class Conexion{

	static public function conectar(){
	$con = new PDO("mysql:host=localhost;dbname=utdelmay","admin","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	return $con;
	}
}

?>
