<?php 

$listagruposDerLLe = gruposController::listaAlumnosGruposController($_GET['idgrupo']);
$filtroGrupo = gruposController::filtroGruposController($_GET['idgrupo']);
$elminaLista = gruposController::elminaListaController($_GET['idcuatri'],$filtroGrupo['GRADO'] );
$addAlumno = gruposController::addAlumnoController($_GET['idgrupo'],$_GET['idcuatri'],$filtroGrupo['GRADO']);
$registroAlumno = alumnosController::registroAlumnoBdController();
$modificarDatosAlumno = alumnosController::modificarDatosAlController();

if(isset($_GET['mat'])){

  $eliminaAlumno = alumnosController::eliminaAlumnoController($_GET['mat'],$_GET['idgrupo'], $_GET['idcuatri'], $filtroGrupo['GRADO']);
}

$alumnosSingrupo = alumnosController::alumnosSinGrupoController($filtroGrupo['CVE_CARRERAS'],$filtroGrupo['GRADO']);

?>


<!-- Button trigger modal -->


<!-- Modal para subir lista de asistencia -->
<div class="modal fade" id="lista" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="exampleModalLabel">Adjuntar lista de asistencia</h3>
        <button type="button" class="btn-close btn-ligth" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
     
        <form method = "post" enctype="multipart/form-data" >
        <div class="modal-body">
          <small>Asegurate de haver vaciado la lista de alumnos existente</small>
          <div class="col-md-12 mb-2"> 
            	<div class="input-group input-group-joined">
                   <input type="file" id="txt_archivo" name="archivoExcel"  accept=".csc, .xlsx, .xls" class="form-control-file mb-3" placeholder="Ingresa lista del grupo" required>
                   
            	</div>
        	</div> 	

          <div class="col-md-12 mb-2"> 
            	<div class="input-group input-group-joined">
                	<input type="number"   name="hoja" min ="1" class="form-control ps-1" placeholder="Ingrese el numero de hoja" required>
            	</div>
        	</div>
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button class="btn btn-success" type = "submit" name = "cargarAchivo">Cargar Excel</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-----Modal para registrar a un alumno en la base de datos---->

<div class="modal fade" id="NuevoAlumno" tabindex="-1" aria-labelledby="alumno" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="exampleModalLabel">Agregar alumno a la base de datos</h3>
        <button type="button" class="btn-close btn-ligth" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
     
      <form method="POST">

        <div class="modal-body">

                <div class="col py-2">    
                    <div class="input-group input-group-joined">
                        
                        <input type="text" name="nomre" onkeyup="mayus(this);" class="form-control ps-1" placeholder="Ingresa el nombre completo" required>
                        <input type = "hidden" name = "grado" value = "<?php echo  $filtroGrupo['GRADO']; ?>">
                        <input type = "hidden" name = "grupo" value = "<?php echo  $_GET['idgrupo']; ?>">
                        <input type = "hidden" name = "carrera" value = "<?php echo  $filtroGrupo['CVE_CARRERAS']; ?>">
                        <input type = "hidden" name = "cuatri" value = "<?php echo   $_GET['idcuatri']; ?>">
                    </div>
                </div>
                <div class="col py-2"> 
                    <div class="input-group input-group-joined">
                        <input type="text" name="apeP" onkeyup="mayus(this);" class="form-control ps-1" placeholder="Ingresa el apellido paterno" required>
                        
                    </div>
                </div>

                <div class="col py-2">  
                  <div class="input-group input-group-joined">
                      <input type="text" name="apeM" onkeyup="mayus(this);" class="form-control ps-1" placeholder="Ingresa el apellido Materno" required>
                  </div>
                </div>
                <div class="col py-2">  
                    <div class="input-group input-group-joined">
                        <input type="text" name="matricula" onkeyup="mayus(this);" class="form-control ps-1" maxlength="13" placeholder=" Ingresa la matricula" required>
                    </div>
                </div>  

              <div class="col py-2"> 
                <div class="input-group input-group-joined">
                  <select name = "genero" class="form-control ps-1">
                    <option>Genero</option>
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                  </select> 
                </div>     
              </div>    
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary btn-icon-split" name = "AgregarAlBD" type="submit">
                    <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                    <span class="text">Guardar registro</span>
                </button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- Modal para agregar varios alumnos a la lista -->

<div class="modal fade" id="alumno" tabindex="-1" aria-labelledby="alumno" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="exampleModalLabel">Agregar un alumno</h3>
        <button type="button" class="btn-close btn-ligth" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
     
      <form method="POST">

        <div class="modal-body">

        <div class="table-responsive" >
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <td width= "5%">No.</td>
                        <th width= "85%">Alumno</th>
                        <th width= "10%"></th>
                    </tr>
                </thead>
              
                <tbody>

                
                  <?php 
                      $cont = 1;
                      foreach($alumnosSingrupo as $itemAls){

                        //var_dump($itemAls);

                       echo "<tr>

                            <td>".$cont."</td>
                            <td>".$itemAls['APELLIDOPATERNO']." ".$itemAls['APELLIDOMATERNO']." ".$itemAls['NOMBRE']."<BR><small>".$itemAls['MATRICULA']."<BR>".$itemAls['CARRERA']."</small></td>
                            <td>
                                    <div class='form-check'>
                                    <input class='form-check-input' type='checkbox' name = 'matricula[]' value='".$itemAls['MATRICULA']."' id='defaultCheck1'>
                                    
                                  </div>
                            </td>
                        </tr>";

                        $cont ++;

                      }
                  
                  ?>
                </tbody>
            </table>
        </div>
        
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Cancelar</button>
        <input type="submit" name="agregarAlumno" value="Agregar al alumno" class="btn btn-primary btn-lg">
      </div>
      </form>
    </div>
  </div>
</div>


<div class="container-fluid">

                    <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalle del grupo</h1>
        <a href="grupos" class="btn btn-info btn-icon-split">
          <span class="icon text-white-50"><i class="far fa-hand-point-left"></i></span>
          <span class="text">Volver</span>
        </a>


        <button  type="button" class="btn btn-primary btn-icon-split" data-bs-toggle="modal" data-bs-target="#lista">
            <span class="icon text-white-50"><i class="fas fa-download fa-sm text-white-50"></i></span>
            <span class="text">Adjuntar lista</span>
        </button>


        <button  type="button" class="btn btn-secondary btn-icon-split" data-bs-toggle="modal" data-bs-target="#alumno">
            <span class="icon text-white-50"><i class="fas fa-fw fa-user-plus fa-sm text-white-50"></i></span>
            <span class="text">Agregar un alumno</span>
        </button>

        <button  type="button" class="btn btn-warning btn-icon-split" data-bs-toggle="modal" data-bs-target="#NuevoAlumno">
            <span class="icon text-white-50"><i class="fas fa-fw fa-user-plus fa-sm text-white-50"></i></span>
            <span class="text">Registrar alumno</span>
        </button>

        
        <form method="POST">
          <input type="hidden" name="idg" value="<?php echo $_GET['idgrupo'];?>">
            <button  type="submit" class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50"><i class="fas fa-trash fa-sm text-white-50"></i></span>
                <span class="text">Vaciar lista de alumnos</span>
            </button>
        </form>
        
      
    </div>


    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de alumnos</h6>
    </div>
    
    <div class="card-body">
     

        <div class="table-responsive" >
            <table class="table table-bordered" width="100%" cellspacing="0">
              <tr>
                <th width="15%">Carrera</th>
                <td><?php echo $filtroGrupo['NOMBRE']; ?></td>
              </tr>
              <tr>
                <th>Grado y grupo</th>
                <td><?php echo $filtroGrupo['GRADO']." ° ".$filtroGrupo['SECCION']; ?></td>
              </tr>
              <tr>
                <th>Cuatrimestre</th>
                <td><?php echo $filtroGrupo['DESCRIPCION'];?></td>
              </tr>
            </table>
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nombre</th>
                        <th width="20%"></th>
                    </tr>
                </thead>
                <tbody>

                  <?php 
                   require 'VISTA/excel/vendor/autoload.php';
                   use PhpOffice\PhpSpreadsheet\IOFactory;
                   use PhpOffice\PhpSpreadsheet\cell\Coordinate;

                   if($listagruposDerLLe != null ){

                    $cont = 1;

                    foreach($listagruposDerLLe as $alumno){

                      echo '<tr>

                      <td>'.$cont.'</td>

                        <td>
                    
                        
                          '.$alumno['APELLIDOPATERNO'].' '.$alumno['APELLIDOMATERNO'].' '.$alumno['NOMBRE'].'<br><small>'.$alumno['MATRICULA'].'</small>
                        
                        
                       
                        </td>
                        
                        <td>

                          <button  type="button" class="btn btn-warning btn-circle" data-bs-toggle="modal" data-bs-target="#ModificaAlumno'.$alumno['MATRICULA'].'">
                            <i class="fas fa-pen"></i>
                          </button>

                          <a href="index.php?url=gruposDetalle&idgrupo='.$_GET['idgrupo'].'&idcuatri='.$_GET['idcuatri'].'&mat='.$alumno['MATRICULA'].'" class="btn btn-danger btn-circle">
                            <i class="fas fa-trash"></i>
                          </a>


                            
                        </td>
                      </tr>

                      <div class="modal fade" id="ModificaAlumno'.$alumno['MATRICULA'].'" tabindex="-1" aria-labelledby="alumno" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title fs-5" id="exampleModalLabel">Modificar datos del alumno</h3>
                            <button type="button" class="btn-close btn-ligth" data-bs-dismiss="modal" aria-label="Close">x</button>
                          </div>
                        
                          <form method="POST">

                            <div class="modal-body">

                                    <div class="col py-2">  
                                    <label>Nombre</label>  
                                        <div class="input-group input-group-joined">
                                            <input type="text" name="nomre" onkeyup="mayus(this);" value ="'.$alumno['NOMBRE'].'" class="form-control ps-1" placeholder="Ingresa el nombre completo" required>
                                        </div>
                                    </div>
                                    <div class="col py-2"> 
                                        <label>Apellido paterno</label>
                                        <div class="input-group input-group-joined">
                                            <input type="text" name="apeP" onkeyup="mayus(this);" value = "'.$alumno['APELLIDOPATERNO'].'"  class="form-control ps-1" placeholder="Ingresa el apellido paterno" required>
                                            
                                        </div>
                                    </div>

                                    <div class="col py-2"> 
                                      <label>Apellido materno</label> 
                                      <div class="input-group input-group-joined">
                                          <input type="text" name="apeM" onkeyup="mayus(this);" value = "'.$alumno['APELLIDOMATERNO'].'" class="form-control ps-1" placeholder="Ingresa el apellido Materno" required>
                                      </div>
                                    </div>
                                    <div class="col py-2">  
                                        <label>Matricula</label> 
                                        <div class="input-group input-group-joined">
                                            <input type="text" name="matricula" onkeyup="mayus(this);" value = "'.$alumno['MATRICULA'].'" class="form-control ps-1" maxlength="13" placeholder=" Ingresa la matricula"  readonly>
                                        </div>
                                    </div>  
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary btn-icon-split" name = "modificarDatosAlumno" type="submit">
                                        <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                                        <span class="text">Actualizar registro</span>
                                    </button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                      
                    ';

                      $cont++;
                    }

                   }else if(isset($_POST['cargarAchivo'])){

                      $numhoja = $_POST['hoja']-1;
                                  
                      $tmpFname = $_FILES['archivoExcel']['tmp_name'];

                      $documento = IOFactory::load($tmpFname);

                      $hojaActual = $documento->getSheet($numhoja);

                      $numeroFilas = $hojaActual->getHighestRow();

                      $numeroColumnas = $hojaActual->getHighestColumn();

                      $datosExcel = array(
                          'hojaActual'=>$hojaActual,
                          'NoFilas'=>$numeroFilas,
                          'NoColumnas'=>$numeroColumnas,
                          'idGrupo'=>$_GET['idgrupo'],
                          'grado'=>$filtroGrupo['GRADO']
                      );
                      
                      $cargarExcel = gruposController::cargaExcel($datosExcel);
                     return $cargarExcel;                    
                  }

                  ?>
                  
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->


