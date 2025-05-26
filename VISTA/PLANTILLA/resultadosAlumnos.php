<?php 

    $maxEv = evaluacionCotroller::maxEvController($_SESSION['idPersonal']);
    $listaProfesor = profesorController::listaProfesorController();
    $cuatri = cuatrimestresController::listaCuatriMaxController('CUATRIMESTRES',5);
    $listaCuatrimestres = cuatrimestresController::listaCuatriController("CUATRIMESTRES");
    $admin = MCVlogin::personalController($_SESSION['idPersonal']);
    $maxCuatri = cuatrimestresController::maxCuatriController();
    evaluacionCotroller::registroConsentradoController();
?>

<div class="container-fluid">
    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Concentrado de resultados de evaluación docente</h1>
    </div> 

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
       <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Lista de resultados</h6>

            <button  type="button" class="btn btn-info btn-icon-split" data-bs-toggle="modal" data-bs-target="#evaluacion">
                <span class="icon text-white-50"> <i class="fa fa-book fa-sm text-white-50"></i></span>
                <span class="text">Cambiar Cuatrimestre</span>
            </button>

        </div>
        
        <div class="card-body">

        <div class="table-responsive">
            <table class="table" data-order='[[ 0, "DESC" ]]' id="dataTable" cellspacing="0">
                
                <thead class="text-center">
                    <tr>
                        <th>Personal académico</th>
                        <th><small>Asistencia</small></th>
                        <th><small>Puntualidad</small></th>
                        <th><small>Planificación de Actividades</small></th>
                        <th><small>Uso de recursos didacticos</small></th>
                        <th><small>Comunicación verbal</small></th>
                        <th><small>Utilidades de los contenidos</small></th>
                        <th><small>Entendimiento de los contenidos</small></th>
                        <th><small>Claridad de esposición</small></th>
                        <th><small>Ejemplificación de los contenidos</small></th>
                        <th><small>Dominio de la asignatura</small></th>
                        <th><small>Aprendizaje efectivo</small></th>
                        <th><small>Aplicación del ambiente laboral</small></th>
                        <th><small>Seguimiento a Tareas y Proyectos Escolares</small></th>
                        <th><small>Seguimiento a Trabajos de Investigación</small></th>
                        <th><small>Evaluacion del Parcial</small></th>
                        <th><small>Seguimiento del Proceso de Evaluación</small></th>
                        <th><small>Ambiente y Disciplina</small></th>
                        <th><small>Confianza en el Docente</small></th>
                        <th><small>Continuidad del Docente</small></th>
                        <th><small>Total</small></th>
                       
                        
                        
                    </tr>
                </thead>
                <tbody class="text-center">

                    <?php 

                    if(isset($_POST['cuatri'])){
 
                            $listaProd = evaluacionCotroller::listaConsentradoAlController($_POST['cuatri'], $admin['CVE_CARRERA_PERSONAL']);
                        
                    }else{
                    
                            $listaProd = evaluacionCotroller::listaConsentradoAlController($maxEv['maxCuatri'], $admin['CVE_CARRERA_PERSONAL']);
                        
                    }
                        
                    ?>
                    
                </tbody>
                
                
            </table>
       
        </div>
    </div>
        <!-- Modal -->
        <div class="modal fade" id="evaluacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Agregar profesor al concentrado</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                    <div class="modal-body">
                            <div class="row">

                                <div class="col-12 mb-4">
                                    <select class="form-select form-control" name = "cuatri" required>
                                        <?php 
                                        foreach($cuatri as $itemCua){

                                                echo '<option value ="'.$itemCua['CVE_CAUTRIMESTRES'].'">'.$itemCua['ABREVIATURA'].'</option>';
                                            }

                                        ?>
                                    </select>
                                </div>
                        
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-icon-split" name = "dato" value = "ver" type="submit">
                            <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                            <span class="text">Cambiar cuatrimestre</span>
                        </button>
                        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
            </form>
            </div>
        </div>
        </div>
    <!-- End Modal -->
    </div>
</div>