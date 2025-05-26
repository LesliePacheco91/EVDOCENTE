<?php 
    $maxEv = evaluacionCotroller::maxEvController($_SESSION['idPersonal']);
    $listaEv =  evaluacionCotroller::listaEvController($_SESSION['idPersonal']);
    $admin = MCVlogin::carerasController($_SESSION['idPersonal']); // puedo ver la id del admin segun el inicio de sesión del personal y las carreras que administra "es un arreglo"
    $idadmin = MCVlogin::personalController($_SESSION['idPersonal']); //id del admin que inicio sesión "no es un arreglo"
    $tipoEv =   evaluacionCotroller::listaEncuaestasController(4); //4 pertenece al departamento
    $listaCuatri = cuatrimestresController::listaCuatriController("CUATRIMESTRES");
    $agendaEv = evaluacionCotroller::nuevaEvController();
    $actualizaAgenda = evaluacionCotroller::actualizaAgendaController();
    $maxCuatri = cuatrimestresController::maxCuatriController();
    $totalAlumnos = alumnosController::totalAlumnosController($maxEv['maxCuatri'],$_SESSION['idPersonal']);
    $totalProfesor = profesorController::totalProfesorController($maxEv['maxCuatri'],$_SESSION['idPersonal']);
    $totalGrupos = gruposController::totalGruposController($maxEv['maxCuatri'],$_SESSION['idPersonal']);   
    $totalEvaluadores = evaluacionCotroller::TotalEvaluadorController($maxEv['maxCuatri'],$_SESSION['idPersonal']);
    $totalEvaluaciones = evaluacionCotroller::totalEvaluacionesController($maxEv['maxCuatri'],$_SESSION['idPersonal']);
    $carreras = MCVlogin::carerasController($_SESSION['idPersonal']);

    if(isset($_GET['id'])){

        $eliminaFecha = evaluacionCotroller::elininaEvController($_GET['id']);

    }

    $fecha_actual = date('Y-m-d');
?>

<script src="VISTA/fullcalendar/dist/index.global.js"></script>
<script src='VISTA/fullcalendar/packages/core/locales/es.global.js'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      locale: 'es',
      initialDate: '<?php echo date('Y-m-d');?>',
      navLinks: true, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: false,
      selectable: true,
      events: [<?php 
                
                foreach($listaEv as $itemEv){
                    $fecha = MVCcontrolador::addDate('1 day', $itemEv['FIN']);

                        echo "{
                        title: '".$itemEv['TITULO_ENCUESTA']." - ".$itemEv['carrera']." - ".$itemEv['cuatri']."',
                        start: '".$itemEv['INICIO']."',
                        end: '". $fecha."',
                        color: '".$itemEv['ETIQUETA']."'
                        
                        },";
                   

                }   
                
            ?> ]
    });

    calendar.render();
  });

</script>
<style>

  #calendar {
    max-width: 100%;
    margin: 0 auto;
  }

</style>
  
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Alumnos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalAlumnos;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Profesores</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalProfesor['TotalProf'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-suitcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Grupos</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto"><div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $totalGrupos['totalGrupos'];?></div></div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Evaluadores</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php  echo $totalEvaluadores['TotalEvaluador'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Evaluaciones</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalEvaluaciones['Evaluaciones'];?></div>
                        </div>
                        <div class="col-auto">
                           <i class="fa fa-chart-bar fa-2x text-gray-300 "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-6 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Calendario de evaluaciones</h6>
                    <div class="dropdown no-arrow">
                      
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    
                    <!---------inicio de calendario------->

                    <div id='calendar'></div>
                    
                    <!----------Fin de calendario!-------->
                </div>
            </div>
        </div>

          <!--- lista de eventos-->
          <div class="col-xl-6 col-lg-7 col-mb-5">
            <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Evaluaciones</h6>
                    <button  type="button" class="btn btn-primary btn-icon-split" data-bs-toggle="modal" data-bs-target="#eva">
                        <span class="icon text-white-50"><i class="fas fa-fw fa-calendar"></i></span>
                        <span class="text">Agendar nueva evaluación</span>
                    </button>
                    
                </div>
            <!-- Card Body -->
            <div class="card-body">
                            
                            <div class="table-responsive" >
                                <table class="table " id="dataTable" width="100%" cellspacing="0"  data-page-length='5'>
                                    <thead>
                                        <tr>
                                            <th>Cuatrimestre</th>
                                            <th>Tipo</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php 
                                                foreach($listaEv as $itemEv){

                                                    evaluacionCotroller::actualizaEstatusEvController($itemEv['ID_EVALUACION'], $itemEv['INICIO'],$itemEv['FIN'],$fecha_actual);

                                                    echo '<tr>
                                                            <td>'.$itemEv['cuatri'].'</td>
                                                            <td>'.$itemEv['TITULO_ENCUESTA'].' <strong>'.$itemEv['carrera'].'</strong> <br><small>de '.$itemEv['INICIO'].'al '.$itemEv['FIN'].'</small></td>
                                                            <td>
                                                                
                                                                <!-- Button trigger modal -->
                                                                <button type="button"  class="btn btn-info btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#modiEva'.$itemEv['ID_EVALUACION'].'">
                                                                <i class="fas fa-pencil-alt"></i>
                                                                </button>
                                                               
                                                                <a href="index.php?url=inicio&id='.$itemEv['ID_EVALUACION'].'" class="btn btn-danger btn-circle btn-sm">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="modiEva'.$itemEv['ID_EVALUACION'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                  <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Modificar Evaluación</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                      </div>
                                                                      <form method = "post">
                                                                      <div class="modal-body">
                                                                        
                                                                          <div class="col-md-12 mb-2"> 
                                                                             
                                                                          <div class="mb-3">
                                                                              <label for="exampleInputPassword1" class="form-label">Tipo de evaluación</label>
                                                                              <select class="form-control" name = "tipoen" required>
                                                                                  <option value = "'.$itemEv['CVE_ENCUESTAS'].'">'.$itemEv['TITULO_ENCUESTA'].'</option>';
                                                              
                                                                                   
                                                                                      foreach($tipoEv  as $itemTipo){
                                                              
                                                                                        echo '<option value="'.$itemTipo['CVE_ENCUESTAS'].'">'.$itemTipo['TITULO_ENCUESTA'].'</option>';
                                                                                      }
                                                                                      

                                                                            echo'  </select>

                                                                            <input type ="hidden" name = "ideva" value = "'.$itemEv['ID_EVALUACION'].'">
                                                              
                                                                          </div>
                                                              
                                                                          <div class="mb-3">
                                                                              <label class="form-label">Fecha de inicio</label>
                                                                              <input type="date"  name = "fechaIn" class="form-control" value ="'.$itemEv['INICIO'].'"  aria-describedby="emailHelp" required>
                                                                          </div>
                                                                          <div class="mb-3">
                                                                              <label class="form-label">fecha de finalización</label>
                                                                              <input type="date" class="form-control" name = "fechaFin" value = "'.$itemEv['FIN'].'" required>
                                                                          </div>
                                                              
                                                                          <div class="mb-3">
                                                                              <label  class="form-label">Cuatrimestre</label>
                                                                              <select class="form-control" name = "cuatri" required>
                                                                                  <option value = "'.$itemEv['CVE_CUATRIMESTRE'].'">'.$itemEv['cuatri'].'</option>';
                                                                                  
                                                                                      foreach($listaCuatri as $itemCuatri){
                                                              
                                                                                          echo '<option value = "'.$itemCuatri['CVE_CAUTRIMESTRES'].'">'.$itemCuatri['DESCRIPCION'].'</option>';
                                                                                      }
                                                                              echo'  
                                                                              </select>
                                                                          </div>
                                                              
                                                                          <div class="mb-3">
                                                                              <label for="exampleInputPassword1" class="form-label">Carrera</label>
                                                                              <select class="form-control" name = "admin" required>
                                                                                  <option value = "'.$itemEv['CVE_CARRERA_PERSONAL'].'">'.$itemEv['carrera'].'</option>';
                                                                                
                                                                                      foreach($admin as $itemCa){
                                                                                          echo '<option value = "'.$itemCa['CVE_CARRERA_PERSONAL'].'">'.$itemCa['ABREVIATURA'].'</option>';
                                                                                      }
                                                                            
                                                                            echo'  </select>
                                                                          </div>
                                                              
                                                                          <div class="mb-3">
                                                                              <label for="exampleInputPassword1" class="form-label">etiqueta</label>
                                                                              <input type="color" class="form-control form-control-color" name = "etiqueta" value="'.$itemEv['ETIQUETA'].'" title="Choose your color">
                                                                          </div>  	
                                                                          </div> 	
                                                                     
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                        <button type="submit"  class="btn btn-primary" name = "actualizaAgenda">Actualizar Registro</button>
                                                                      </div>
                                                                    </form>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <!-- Modal -->
                                                           </td>
                                                        </tr>';
                                                }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                
            </div>
        </div>

    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-5">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Avance de Evaluación por grupo</h6>
                </div>
                <div class="card-body">

                <?php 
                
                        foreach($carreras as $itemCar ){


                            $ListaFiltroGrupos = gruposController::filtrolistaGruposController($itemCar['CVE_CARRERAS'],$maxEv['maxCuatri']);

                            foreach($ListaFiltroGrupos as $itemGrupos){

                                $totalAlumnos = alumnosController::totalAlumnosGrupoController($itemGrupos['CVE_GRUPOS']);
                                $totalProfes = profesorController::totalProfesGrupoController($itemGrupos['CVE_GRUPOS']);
                                $totalEvaluaAlumnos = evaluacionCotroller::totalEevaluacionesAlumnosController($itemGrupos['CVE_GRUPOS'], $maxEv['maxCuatri']);



                                $datos = array('totalAlumnos' =>$totalAlumnos['totalAlumnos'],
                                                'totalProfes'=>$totalProfes['cademicos'],
                                                'totalAlumnosEvaluaron'=> $totalEvaluaAlumnos['alumnosEvaluaron'],
                                                'GRADO'=>$itemGrupos['GRADO'],
                                                'SECCION'=>$itemGrupos['SECCION'],
                                                'ABREVIATURA'=>$itemGrupos['ABREVIATURA'],
                                                'idgrupo'=>$itemGrupos['CVE_GRUPOS']

                                            );

                                $porcentaje = evaluacionCotroller::porcentajesController($datos);

                                }
                            }

                ?>

                </div>
            </div>

        </div>

    </div>




    <!-- Modal para agregar nueva fecha de evaluación-->
<div class="modal fade" id="eva" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="exampleModalLabel">Agendar fechas para evaluación</h3>
        <button type="button" class="btn-close btn-info" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
     
        <form method = "post">
        <div class="modal-body">
          
            <div class="col-md-12 mb-2"> 
               
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tipo de evaluación</label>
                <select class="form-control" name = "tipoen" required>
                    <option value = "">Seleeciona uno</option>

                    <?php 
                        foreach($tipoEv  as $itemTipo){

                            echo '<option value="'.$itemTipo['CVE_ENCUESTAS'].'">'.$itemTipo['TITULO_ENCUESTA'].'</option>';
                        }
                        
                    ?>
                </select>

            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha de inicio</label>
                <input type="date"  name = "fechaIn" class="form-control"  aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">fecha de finalización</label>
                <input type="date" class="form-control" name = "fechaFin" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Cuatrimestre</label>
                <select class="form-control" name = "cuatri" required>
                    <option value = "">Seleeciona uno</option>
                    <?php 
                        foreach($listaCuatri as $itemCuatri){

                            echo '<option value = "'.$itemCuatri['CVE_CAUTRIMESTRES'].'">'.$itemCuatri['DESCRIPCION'].'</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Carrera</label>
                <select class="form-control" name = "admin" required>
                    <option value = "">Seleeciona uno</option>
                    <?php 
                        foreach($admin as $itemCa){
                            echo '<option value = "'.$itemCa['CVE_CARRERA_PERSONAL'].'">'.$itemCa['ABREVIATURA'].'</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">etiqueta</label>
                <input type="color" class="form-control form-control-color" name = "etiqueta" value="#2420db" title="Choose your color">
            </div>  	
            </div> 	
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit"  class="btn btn-primary" name = "registroEv">Agendar Evaluación</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
</div>
