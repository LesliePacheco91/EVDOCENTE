<?php 

	require_once "../CONTROLADOR/aspirantesController.php";
	require_once "../MODELO/aspirantesModel.php";
	
    $consultaDisca = aspirantesController::ConsultaDiscaCont("DISCAPACIDAD");
    
    

    if($_POST['discapa']=="si"){
    ?>
        <select class = "form-control" id="tipoDisca"  name ="tipoDisca">
    <?php 
                foreach($consultaDisca as $listaDisca){
                    echo '<option  value ="'.$listaDisca['CVE_DISCAPACIDAD'].'">'.$listaDisca['DESCRIPCION'].'</option>';
                }
    ?>
    </select>
    <?php    
    }else if($_POST['discapa'] =="no"){
    ?>
  <select class = "form-control" id="tipoDisca"  name ="tipoDisca" require>
        <option value="1">Ninguno</option>
  </select>
  
<?php    
}
?>    