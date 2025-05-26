<?php 
    $maxEv = evaluacionCotroller::maxEvController($_SESSION['idPersonal']);
    $listaProfesor = profesorController::listaProfesorController();
    $personal = MCVlogin::personalController($_SESSION['idPersonal']);
    $cuatri = cuatrimestresController::listaCuatriMaxController('CUATRIMESTRES',5);
    $cuatrisEv = evaluacionCotroller::CuatrisEvaluadosController(10, $personal['CVE_CARRERA_PERSONAL']);
    $maxCuatri = cuatrimestresController::maxCuatriController();
    $carrera = MCVlogin::carreras1Controller();
    $gruposLIsta = gruposController::listagrupos1Controller();
    $registroPlan = evaluacionCotroller::registroPlanController();
    $materias = MCVlogin::ListmateriasController();
    $actualizaPlan = evaluacionCotroller::ActualizaPlanController();

    if(isset($_GET['idevaluado'])){

        $eliminaEvaluado = evaluacionCotroller::EliminaEvaluadoController($_GET['idevaluado'],$_GET['idevaluador']);

    } 
?>

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Plán de observación docente</h1>
    </div>            
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary">Lista de registros</h5>
            
            <button  type="button" class="btn btn-primary btn-icon-split" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span class="icon text-white-50"> <i class="fas fa-user fa-sm text-white-50"></i></span>
                <span class="text">Nuevo plan de observación</span>
            </button>
            <button  type="button" class="btn btn-info btn-icon-split" data-bs-toggle="modal" data-bs-target="#mdlCuatri">
                <span class="icon text-white-50"> <i class="fas fa-user fa-sm text-white-50"></i></span>
                <span class="text">cambiar cuatrimestre</span>
            </button>
            
        </div>
        <div class="card-body">

            <table class="table table-bordered">
            <thead>
            <tr>
            <th>Observador</th>
            <th>Docente a evaluar</th>
            <th>Asignatura a evaluar</th>
            <th>Fecha de entrega de resultados</th>
            <th></th>
            </tr>
            </thead>
                <tbody>
                    <?php 

                    if(isset($_POST['nuevoCuatri'])){

                        $valuador  = evaluacionCotroller::listaPlanController($_POST['cuatri'],$personal['CVE_CARRERA_PERSONAL'] );
                                        
                    }else{
                        
                        $valuador  = evaluacionCotroller::listaPlanController($maxEv['maxCuatri'],$personal['CVE_CARRERA_PERSONAL'] );
                    }
                    ?>
                </tbody>
            </table>
        </div>
       
    </div>
</div>

<!------modal nuevo plan------>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Nuevo plán de observación</h4>
                <button type="button" class="btn-close btn btn-outline-light" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <select class="form-select form-control" name = "observador" aria-label="Default select example" required>
                                <option selected>Selecciona un observador</option>
                                <?php 
                                    foreach($listaProfesor as $itemp){

                                    echo '<option value ="'.$itemp['CVE_PERSONAL'].'">'.$itemp['APELLIDOPATERNO'].' '.$itemp['APELLIDOMATERNO'].' '.$itemp['NOMBRE'].'</option>';
                                    }
                                ?>
                            </select>
                            <input type="hidden" name="personal" value="<?php echo $personal['CVE_CARRERA_PERSONAL'];?>">
                        </div>
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
                        <div class="col">
                            <button type="button" onclick="contarElementos();" class="btn btn-info btn-small" id="btnMore">Agregar profesor</button>
                        </div>
                    </div>
                    <hr>
                    <div id="incrementa"> 
                        <p id = "cuenta"><input type = "hidden" id = "cuentaCarga" name = "cuentaCarga" value = "1"></p>
                        <div id = "fila" class="fila-1">
                            <div class="row mb-3">
                                
                                <div class="col">
                                    <select class="form-select form-control" id="profesor1" name = "profesor1"  aria-label="Default select example" required>
                                        <option selected>Selecciona un profesor</option>
                                        <?php 
                                                foreach($listaProfesor as $itemp){

                                                echo '<option value ="'.$itemp['CVE_PERSONAL'].'">'.$itemp['APELLIDOPATERNO'].' '.$itemp['APELLIDOMATERNO'].' '.$itemp['NOMBRE'].'</option>';
                                                }
                                            ?>

                                    </select>
                                </div>
                            
                                <div class="col">
                                    <select class="form-select form-control" id="carreras1" name = "carrera1" onchange="vermateria(1);" required>
                                    <option selected>Selecciona una carrera</option>
                                        <?php foreach($carrera as $data): 
                                        echo '<option value = "'.$data['CVE_CARRERAS'].'">'.$data['ABREVIATURA'].'</option>'; 
                                        endforeach 
                                        ?>
                                    </select>
                                </div>
                                <div class="col" id = "materia1">
                                    <select class="form-select form-control" id="materia1" name = "materia1"  aria-label="Default select example" required>
                                        <option selected>Selecciona una materia</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="date" id="fechaEv1" name ="fechaEv1" class = "form-control ps-1" required>
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn btn-danger btn-circle btn_remove" id="1"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit"  name = "registroPLan" class="btn btn-primary">Registrar plan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!----Modal cuatrimestre----->
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
                    <button type="submit"  name = "nuevoCuatri" class="btn btn-primary">Ver plan</button>
                </div>
            </form>
        </div>
    </div>
</div>


                <!-- /.container-fluid -->
                <script>
$(function(){
var i=2;
    $('#btnMore').click(function(){


    var inputCode1 =' <div class="col"><select class="form-select form-control" id="profesor'+i+'" name = "profesor'+i+'" aria-label="Default select example" required><option>Selecciona un profesor</option><?php  foreach($listaProfesor as $itemp):echo '<option value ="'.$itemp['CVE_PERSONAL'].'">'.$itemp['APELLIDOPATERNO'].' '.$itemp['APELLIDOMATERNO'].' '.$itemp['NOMBRE'].'</option>'; endforeach;?></select></div>';

    var inputCode2 =' <div class="col"><select class="form-select form-control" id="carreras'+i+'" name = "carrera'+i+'" onchange="vermateria('+i+');" aria-label="Default select example" required><option>Selecciona una carrera</option><?php foreach($carrera as $data): echo '<option value = "'.$data['CVE_CARRERAS'].'">'.$data['ABREVIATURA'].'</option>'; endforeach   ?></select></div>';

    
    var inputCode3 =' <div class="col" id = "materia'+i+'"><select class="form-select form-control = "materia'+i+'"  aria-label="Default select example" required><option selected>Selecciona una materia</option></select></div>';

    var inputCode4 =' <div class="col"><input type="date" id = "fechaEv'+i+'" name ="fechaEv'+i+'" class = "form-control ps-1" required></div>';

    //Importante esta variable debe ir debajo del autoincrementable
    var btnDelete =' <button type="button" class="btn btn-danger btn-circle btn_remove" id="'+i+'"><i class="fas fa-trash"></i></button>';

    $('#incrementa').append('<div id ="fila" class="fila-'+i+'"><div class="row mb-3">'+ inputCode1 + inputCode2 + inputCode3 +inputCode4+' <div class="col-1">'+ btnDelete +' </div> </div></div>');
    
    
    i++;  
    });


$(document).on('click', '.btn_remove', function(){
  var button_id = $(this).attr("id");
   
  console.log(button_id);
  $('.fila-'+button_id+'').remove();
}); 

$(document).on('click', '#btnMore', function(){
    var countb = $("#incrementa #fila").length;
    
    document.getElementById("cuenta").innerHTML = '<input type = "hidden" id = "cuentaCarga" name = "cuentaCarga" value = "'+countb+'">';
}); 


});


function vermateria(i){
       
var idcar = document.getElementById("carreras"+i).value;
var cont = i;

    $.post("AJAX/materias.ajax.php", { idcarrera:idcar,contador:cont},function(data){
        $("#materia"+i).html(data);
    });

};

</script>