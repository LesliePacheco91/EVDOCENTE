<?php 
    require_once "../CONTROLADOR/loginController.php";
	require_once "../MODELO/loginModelo.php";
	
    $listamaterias = MCVlogin::materiasController($_POST['idcarrera']);
    $conta = $_POST['contador'];

	// $consultaMunicipio =  aspirantesController::ConsultaMunicipioCont($_POST['id_estado'], "MUNICIPIOS"); 
?>      <select class = "form-control" name ="materia<?php echo $conta;?>" required>
            <option  value ="">Ninguno</option>
            
                <?php       
                    foreach($listamaterias as $mate):
                            echo '<option value = "'.$mate['CVE_MATERIAS'].'">'.$mate['NOMBRE'].'</option>'; 
                    endforeach                   
?>      </select>