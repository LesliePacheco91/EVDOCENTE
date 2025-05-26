<?php 

/**
 * 
 */
class MVCmodelo
{
	
	static public function enlasePaginaModelo($link){

			if($link == "logout" ||
				$link == "inicio" ||
				$link == "cuatrimestres" ||
				$link == "grupos" ||
				$link == "profesores" ||
				$link == "gruposDetalle" ||
				$link == "evaluadores"||
				$link == "evaluacionDA" ||
				$link == "resultadosAlumnos"||
				$link == "resultados"||
				$link == "restricH"){
			
			  
			  $modulo = "VISTA/PLANTILLA/".$link.".php";
			  	//echo "VISTA/PLANTILLA/".$link.".php";
			  	
			}else if($link == "index"){

				$modulo = "VISTA/PLANTILLA/inicio.php";
				
			}else{
				$modulo = "VISTA/PLANTILLA/inicio.php";
			}

			return $modulo;

	}

	


	
	
}