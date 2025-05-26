<?php 
    require_once "../CONTROLADOR/gruposController.php";
	require_once "../MODELO/gruposModelo.php";
	
    $lisgrupos = gruposController::filtrolistaGruposController($_POST['idcarrera'],$_POST['idcuatri']);
    $conta = $_POST['contador'];


?>      <select class = "form-control" name ="grupo<?php echo $conta;?>" required>
          <option  value ="">Ninguno</option>
          
              <?php       
                  foreach($lisgrupos as $grupo):
                          echo '<option value = "'.$grupo['CVE_GRUPOS'].'">'.$grupo['GRADO'].'°'.$grupo['SECCION'].'</option>'; 
                  endforeach                   
?>      </select>