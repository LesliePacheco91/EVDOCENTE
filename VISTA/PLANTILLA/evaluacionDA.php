
<?php 
    $maxEv = evaluacionCotroller::maxEvController($_SESSION['idPersonal']);
    $listaProfesor = profesorController::listaProfesorController();
    $cuatri = cuatrimestresController::listaCuatriMaxController('CUATRIMESTRES',11);
    $listaCuatrimestres = cuatrimestresController::listaCuatriController("CUATRIMESTRES");
    $admin = MCVlogin::personalController($_SESSION['idPersonal']);
    $encuesta = evaluacionCotroller::consultaEncuestaController(3);
    $detalleEncuesta = evaluacionCotroller::consultaPreguntasController($encuesta['CVE_ENCUESTAS']);
    $registroEvaluacion = evaluacionCotroller::registroEvDAController();
    $maxCuatri = cuatrimestresController::maxCuatriController();

    

    if(isset($_GET["idev"])){

        $eliminarEv = evaluacionCotroller::eliminaEvaluacionDCController($_GET["idev"]);
    }
  




?>
<div class="container-fluid">
    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Evaluaciones Dirección Académica</h1>
    </div> 

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
       <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Lista de evaluaciónes</h6>

            <button  type="button" class="btn btn-primary btn-icon-split" data-bs-toggle="modal" data-bs-target="#evaluacion">
                <span class="icon text-white-50"> <i class="fa fa-book fa-sm text-white-50"></i></span>
                <span class="text">Nueva Evaluación</span>
            </button>
            <button  type="button" class="btn btn-info btn-icon-split" data-bs-toggle="modal" data-bs-target="#mdlCuatri">
                <span class="icon text-white-50"> <i class="fas fa-user fa-sm text-white-50"></i></span>
                <span class="text">cambiar cuatrimestre</span>
            </button>

        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    
                    <thead class="text-center small">
                        <tr>
                            <th rowspan="2" with="50%">Profesor</th>
                            <th with="5%">Ambiente de trabajo</th>
                            <th with="5%">Enseñanza por Competencias</th>
                            <th with="5%">Habilidades Docente</th>
                            <th with="5%">Seguimiento Académico</th>
                            <th with="5%">Continuidad Docente</th>
                            <th with="5%">Administración del Tiempo</th>
                            <th with="5%">Planeación</th>
                            <th with="5%">TOTAL</th>
                            <th rowspan="2"></th>
                        </tr>
                        <tr>
                            <th with="5%">8</th>
                            <th with="5%">9</th>
                            <th with="5%">20</th>
                            <th with="5%">14</th>
                            <th with="5%">18</th>
                            <th with="5%">16</th>
                            <th with="5%">15</th>
                            <th with="5%">100</th> 
                        </tr>
                    </thead>
                    <tbody class="text-center small">
                        <?php 

                        if(isset($_POST['VerNuevoCuatriCuatri'])){
                            
                            $resultados = evaluacionCotroller::resultadosDCController($_POST['cuatri'], $admin['CVE_CARRERA_PERSONAL']);
                        }else{

                            $resultados = evaluacionCotroller::resultadosDCController($maxEv['maxCuatri'], $admin['CVE_CARRERA_PERSONAL']);

                        }

                            

                        ?>
                    </tbody>  
                </table>
            </div>
    </div>
        <!-- Modal -->
        <div class="modal fade" id="evaluacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel"><?php echo $encuesta['TITULO_ENCUESTA'];?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  method="POST">
                    <div class="modal-body">
                            <div class="row mb-4">
                                <div class="col">
                                    <select class="form-select form-control" name = "profe" aria-label="Default select example" required>
                                        <option selected>Selecciona un profesor</option>
                                        <?php 
                                        foreach($listaProfesor as $itemp){

                                                echo '<option value ="'.$itemp['CVE_PERSONAL'].'">'.$itemp['APELLIDOPATERNO'].' '.$itemp['APELLIDOMATERNO'].' '.$itemp['NOMBRE'].'</option>';
                                            }

                                        ?>
                                    </select>
                                    <input type="hidden" name="admin" value="<?php echo $admin['CVE_CARRERA_PERSONAL'];?>">
                                </div>
                                <div class="col">
                                    <select class="form-select form-control" name = "cuatri" aria-label="Default select example" required>
                                        <option selected>Selecciona un cuatrimestre</option>
                                        <?php 
                                        foreach($cuatri as $itemc){

                                                echo '<option value ="'.$itemc['CVE_CAUTRIMESTRES'].'">'.$itemc['DESCRIPCION'].'</option>';
                                            }

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <?php 
                                echo "<p>".$encuesta['ENCABEZADO']."</p>";

                                foreach($detalleEncuesta as $itemPregunta){

                                    $opciones = evaluacionCotroller::opcionesController($itemPregunta['CVE_PREGUNTAS']);

                                    echo '<div class="col">
                                            <h5>'.$itemPregunta['PREGUNTA'].'</h5> 
                                            <div class= "col  mb-3">';

                                                foreach($opciones as $itemopcion){

                                                    echo '<div class="form-check">
                                                            <input class="form-check-input" type="radio" id="mivalor" name="'.$itemopcion['CVE_PREGUNTA'].'" id="flexRadioDefault2" value="'.$itemopcion['CVE_PREGUNTA_OPCION'].'" required>
                                                            <label class="form-check-label" for="flexRadioDefault2">'.$itemopcion['VALOR'].' '.$itemopcion['OPCION'].'</label>
                                                        </div>';
                        
                                                }
                                

                                        echo '</div>
                                                <hr>
                                            </div>';
                                }


                            ?>

                            <br><p>Agregar una observación (Opcional)</p>
                            <textarea name="ob" class="form-control"></textarea>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary btn-icon-split" name = "guardaEvaDr" type="submit">
                            <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar evaluación</span>
                        </button>
                    </div>
            </form>
            </div>
        </div>
        </div>
    <!-- End Modal -->

    <!------Modal cuatri------>
    <div class="modal fade" id="mdlCuatri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Nuevo plán de observación</h4>
                <button type="button" class="btn-close btn btn-outline-light" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="col">
                        <select class="form-select form-control" id = "cuatri" name = "cuatri" aria-label="Default select example" required>
                            <option selected>Selecciona un cuatrimestre</option>
                            <?php 
                            foreach($cuatri as $itemcua){

                            echo '<option value="'.$itemcua['CVE_CAUTRIMESTRES'].'">'.$itemcua['DESCRIPCION'].'</option>';
                            }
                            ?>
                        </select>
                    </div>      
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit"  name = "VerNuevoCuatriCuatri" class="btn btn-primary">Ver plan</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!----end Modal Cuatri------>



    </div>
</div>
                <!-- /.container-fluid -->
<script type="text/javascript">

    function mayus(e) {
        e.value = e.value.toUpperCase();
    }
</script>