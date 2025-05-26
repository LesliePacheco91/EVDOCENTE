<?php
	require_once "../CONTROLADOR/aspirantesController.php";
	require_once "../MODELO/aspirantesModel.php";
	
	
	 $consultCurp =  aspirantesController::ConsultaCurpCont($_POST['idcurp'], "ASPIRANTES"); 
	
	 if(isset($consultCurp['NOMBRE'])>0){

	    echo "El alumno ".$consultCurp['NOMBRE']." ".$consultCurp['APELLIDOPATERNO']." ".$consultCurp['APELLIDOMATERNO']." Ya Existe";
	 }

?>