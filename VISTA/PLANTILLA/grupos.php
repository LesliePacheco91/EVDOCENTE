<?php 

    $listagrupos = gruposController::listagruposController('grupos', $_SESSION['idPersonal']);
    $carreras = MCVlogin::carerasController($_SESSION['idPersonal']);
    $RegistroGrupos = gruposController::registroGrupoController();
    $listaCuatrimestres = cuatrimestresController::listaCuatriController("CUATRIMESTRES");
    $actualizaGrupo = gruposController::actualizarGrupController();

    if(isset($_GET['id'])){

        $eliminarGrupo = gruposController:: eliminaGrupoController($_GET['id']);
    }

?>

<div class="container-fluid">

                    <!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Grupos</h1>


<div class="card shadow mb-4 ">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nuevo Grupo</h6>
    </div>
   
    <div class="card-body">
        
        <form class="form-inline" method="POST">
        	<div class="form-row col-md-12 col-mb-12">
                <div class="col-md-2 mb-2">  
		            <div class="input-group input-group-joined"> 
		                <select name="grado" class="form-control ps-1" required>
		                	<option value="">Grado</option>
		                	<option value="1">1</option>
		                	<option value="2">2</option>
		                	<option value="3">3</option>
		                	<option value="4">4</option>
		                	<option value="5">5</option>
		                	<option value="6">6</option>
		                	<option value="7">7</option>
		                	<option value="8">8</option>
		                	<option value="9">9</option>
		                	<option value="10">10</option>
		                	<option value="11">11</option>
		                	<option value="12">12</option>
		                </select>
		            </div>
		          </div>

            <div class="col-md-2 mb-2"> 
            	<div class="input-group input-group-joined">
                	<input type="text" name="seccion" onkeyup="mayus(this);"  class="form-control ps-1" placeholder="Ingresa la seccion" required>
            	</div>
        	</div>

        	<div class="col-md-4 mb-2"> 
	            <div class="input-group input-group-joined">    
	                 <select name="carrera" class="form-control ps-1" required>
	                	<option value="">Carrera</option>
                        <?php 
                            foreach ($carreras as $itemc){

                                echo "<option value='".$itemc['CVE_CARRERAS']."'>".$itemc['NOMBRE']."</option>";
                            }
                        ?>
	                </select>

	            </div>
        	</div>
            <div class="col-md-3 mb-2"> 
            <div class="input-group input-group-joined">   
                <select name="cuatrimestre" class="form-control ps-1" required>
                    <?php 

                        foreach($listaCuatrimestres as $itemCuatri){

                            echo "<option value='".$itemCuatri['CVE_CAUTRIMESTRES']."'>".$itemCuatri['ABREVIATURA']."</option>";

                        }
                    
                    ?>
                </select>
            </div>
                            
            </div>
        	<div class="col-md-3 mb-2"> 
               <button name = "registroGrupos" type="submit" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                    <span class="text">Guardar registro</span>
                </button>

        	</div> 
          </div>
        </form>
    </div>
</div>


                    <!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de grupos cuatrimestres</h6>
    </div>
    
    <div class="card-body">
                            
        <div class="table-responsive" >
            <table class="table text-center" data-order='[[ 0, "DESC" ]]'  id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width= "5%">No.</th>
                        <th width="20%">Cuatrimestre</th>
                        <th width="15%">Grupo</th>
                        <th width="20%">Carrera</th>
                        <th width = "20%">Total de alumnos</th>
                        <th width="20%"></th>
                    </tr>
                </thead>
                <tfoot>
                   <tr>
                        <th>No</th>
                        <th>Cuatrimestre</th>
                        <th>Grupo</th>
                        <th>Carrera</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>

                <?php 
                    foreach ($listagrupos as $item){
                        
                        $totalAl = alumnosController::totalAlumnosGrupoController($item['CVE_GRUPOS']);

                        echo '<tr>
                                <td>'.$item['CVE_GRUPOS'].'</td>
                                <td>'.$item['cuatri'].'</td>
                                <td>'.$item['GRADO'].'°'.$item['SECCION'].'</td>
                                <td>'.$item['carrera'].' <span class="legend-circle bg-success"></span></td>
                                <td style = "color:#fff">';
                                
                                if($totalAl['totalAlumnos']>0){
                                    
                                   
                                    echo  '<span class="badge bg-info">'.$totalAl['totalAlumnos'].'</span>';
                                }else{
                                      echo  '<span class="badge bg-danger">'.$totalAl['totalAlumnos'].'</span>';
                                }
                               
                        echo '</td>
                              <td>
                                
                                    <a href="index.php?url=gruposDetalle&idgrupo='.$item['CVE_GRUPOS'].'&idcuatri='.$item['CVE_CAUTRIMESTRES'].'" class="btn btn-info btn-circle">
                                        <i class="fas fa-users"></i>
                                    </a>

                                    
                                    <button type="button"  class="btn btn-warning btn-circle" data-bs-toggle="modal" data-bs-target="#grupo'.$item['CVE_GRUPOS'].'">
                                    <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <a href="index.php?url=grupos&id='.$item['CVE_GRUPOS'].'" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                                        
                                </td>
                            </tr>';?>


                                <div class="modal fade" id="grupo<?php echo $item['CVE_GRUPOS'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-5" id="exampleModalLabel">Modificar Grupo <?php echo $item['GRADO'].'°'.$item['SECCION']; ?></h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="form" method="POST" enctype="multipart/form-data"  >
                                        <div class="modal-body">
                                                <div class="form-row col-md-12 col-mb-12">
                                                    <div class="col-md-6 mb-2">  
                                                        <div class="input-group input-group-joined"> 
                                                            <select name="grado" class="form-control ps-1" require>
                                                                <option value = "<?php echo $item['GRADO'];?>" ><?php echo $item['GRADO'];?></option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                            </select>

                                                            <input type = "hidden" name = "idgrupo" value= "<?php echo $item['CVE_GRUPOS']; ?>">
                                                        </div>
                                                    </div>

                                                <div class="col-md-6 mb-2"> 
                                                    <div class="input-group input-group-joined">
                                                        <input type="text" name="seccion" class="form-control ps-1" onkeyup="mayus(this);"  value = "<?php echo $item['SECCION']; ?>" placeholder="Ingresa la seccion" require>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-2"> 
                                                    <div class="input-group input-group-joined">    
                                                        <select name="carrera" class="form-control ps-1" require>
                                                            <option value = "<?php echo $item['CVE_CARRERAS'];?>"><?php echo $item['carrera'];?></option>

                                                            <?php 
                                                                foreach ($carreras as $itemc){

                                                                    echo "<option value='".$itemc['CVE_CARRERAS']."'>".$itemc['ABREVIATURA']."</option>";
                                                                }
                                                            ?>

                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-2"> 
                                                    <div class="input-group input-group-joined">    
                                                       <select name="cuatrimestre" class="form-control ps-1" required>
                                                        <option value = "<?php echo $item['CVE_CAUTRIMESTRES']?>"><?php echo $item['cuatri'];?></option>
                                                            <?php 

                                                                foreach($listaCuatrimestres as $itemCuatri){

                                                                    echo "<option value='".$itemCuatri['CVE_CAUTRIMESTRES']."'>".$itemCuatri['ABREVIATURA']."</option>";

                                                                }
                                                            
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button class="btn btn-primary btn-icon-split" type="submit" name = "actualizar">
                                                    <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                                                    <span class="text">Modificar registro</span>
                                                </button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>

                 <?php   } ?>
                 
                 

                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<script>
function mayus(e) {
    e.value = e.value.toUpperCase();
};
</script>