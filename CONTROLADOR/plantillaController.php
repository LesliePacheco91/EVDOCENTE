<?php 

/**
 * 
 */
class MVCcontrolador
{
	
	#metodos

	public function plantilla(){

		include "VISTA/plantilla.php";


	}

	public function enlasePaginaController(){

		if(isset($_GET['url'])){
			
			$enlase = $_GET['url'];
			
		}else{

			$enlase = "index";
		}

		$respuesta = MVCmodelo::enlasePaginaModelo($enlase);

		include $respuesta;
		
	}

	public static function addDate($add,$startdate = false){

		$date = !empty($startdate) ? $startdate : date('Y-m-d');
		$newDate = strtotime ($add , strtotime ( $date ) ) ;
		$newDate = date ( 'Y-m-d' , $newDate );
		return $newDate;
	}

}

