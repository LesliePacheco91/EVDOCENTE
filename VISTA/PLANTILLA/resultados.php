
<?php 
    
    $listaProfesor = profesorController::listaProfesorController();
    $listaCuatrimestres = cuatrimestresController::listaCuatriMaxController('CUATRIMESTRES',5);
    $maxCuatri = cuatrimestresController::maxCuatriController();
    $admin = MCVlogin::personalController($_SESSION['idPersonal']);
    $encuesta = evaluacionCotroller::consultaEncuestaController(3);
    $detalleEncuesta = evaluacionCotroller::consultaPreguntasController($encuesta['CVE_ENCUESTAS']);
    $registroEvaluacion = evaluacionCotroller::registroEvDAController();
    evaluacionCotroller::registroConsentradoController();
    
    if(isset($_GET['id'])){
        
        
        $eliminaPRofesor = evaluacionCotroller::eliminaProfesorDeListaController($_GET['id']);
    }

  /* descargar documento <a href="DOCUMENTOS/planEvalacion.php?id=<?php echo $itemcua['CVE_CAUTRIMESTRES']?>&perso=<?php echo $_SESSION['idPersonal'];?> "  type="button" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50"> <i class="fas fa-file-alt fa-sm "></i></span>
                                <span class="text">Descargar consentrado</span>
                        </a>*/

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

            <button  type="button" class="btn btn-primary btn-icon-split" data-bs-toggle="modal" data-bs-target="#evaluacion">
                <span class="icon text-white-50"> <i class="fa fa-book fa-sm text-white-50"></i></span>
                <span class="text">Agregar profesor</span>
            </button>

            <button  type="button" class="btn btn-info btn-icon-split" data-bs-toggle="modal" data-bs-target="#modalcuatri">
                <span class="icon text-white-50"> <i class="fa fa-book fa-sm text-white-50"></i></span>
                <span class="text">Cambiar Cuatrimestre</span>
            </button>

        </div>
        <div class="card-body">
                       
            <div class="table-responsive">
                <table class="table">
                    
                    <thead class="text-center">
                        <tr>
                            <th with="45%">Docente</th>
                            <th with="5%">Observador</th>
                            <th with="5%">Estudiante</th>
                            <th with="5%">Dirección Académica</th>
                            <th with="5%">Resultado Global</th>
                            <th with="5%">Ponderación Final</th>
                            <th with="5%">Calificación Final</th>
                            <th with="15%">Calificación Alfabetica</th>
                            <th width="10%"></th>
                            
                        </tr>
                    </thead>
                    <tbody class = "text-center">
                        <?php 

                            if(isset($_POST['cambiarCuatri'])){

                                $lista = evaluacionCotroller::listaConsentradoController($_POST['cuatri'], $admin['CVE_CARRERA_PERSONAL']);

                            }else{
                                $lista = evaluacionCotroller::listaConsentradoController($maxCuatri['CVE_CAUTRIMESTRES'], $admin['CVE_CARRERA_PERSONAL']);
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
            <form  method="POST">
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <select class="form-select form-control" name = "profe" required>
                                        <option selected>Selecciona un profesor</option>
                                        <?php 
                                        foreach($listaProfesor as $itemp){

                                                echo '<option value ="'.$itemp['CVE_PERSONAL'].'">'.$itemp['APELLIDOPATERNO'].' '.$itemp['APELLIDOMATERNO'].' '.$itemp['NOMBRE'].'</option>';
                                            }

                                        ?>
                                    </select>
                                    
                                    <input type="hidden" name="admin" value="<?php echo $admin['CVE_CARRERA_PERSONAL'];?>">
                                </div>

                                <div class="col-12 mb-4">
                                    <select class="form-select form-control" name = "cuatri" required>
                                        <?php 
                                        foreach($listaCuatrimestres as $itemCua){

                                                echo '<option value ="'.$itemCua['CVE_CAUTRIMESTRES'].'">'.$itemCua['ABREVIATURA'].'</option>';
                                            }

                                        ?>
                                    </select>
                                </div>
                        
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-icon-split" name = "guardaEva" type="submit">
                            <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar evaluación</span>
                        </button>
                        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
            </form>
            </div>
        </div>
        </div>
    <!-- End Modal -->
    <!--------Modal Cuatrimestre-------->
    <div class="modal fade" id="modalcuatri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        foreach($listaCuatrimestres as $itemCua){

                                                echo '<option value ="'.$itemCua['CVE_CAUTRIMESTRES'].'">'.$itemCua['ABREVIATURA'].'</option>';
                                            }

                                        ?>
                                    </select>
                                </div>
                        
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-icon-split" name = "cambiarCuatri" type="submit">
                            <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                            <span class="text">Cambiar cuatrimestre</span>
                        </button>
                        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
            </form>
            </div>
        </div>
        </div>
    <!-------en modal cuatrimestre------->
    </div>
</div>
                <!-- /.container-fluid -->
