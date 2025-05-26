<?php 

/**
 * 
 */
class Conexion{

	static public function conectar(){
	$con = new PDO("mysql:host=utdelmayab.edu.mx;dbname=utdelmay_intrautm","utdelmay_intraut","MySQL1ntr4utm",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

	#$con = new PDO("mysql:host=localhost;dbname=utdelmay_intrautm","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

	return $con;
	}
}

?>