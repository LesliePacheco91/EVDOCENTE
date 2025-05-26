<?php 

    $listadosificacion = profesorController::listaCargaA();
    $listaProfesor = profesorController::listaProfesorController();
    $cuatri = cuatrimestresController::listaCuatriController('CUATRIMESTRES');
    $carrera = MCVlogin::carreras1Controller();
    $gruposLIsta = gruposController::listagrupos1Controller();
    $registroCarga = profesorController::registroCargaController();
    $registroMat = profesorController::registroMatController();
    $registroProf = profesorController::registroProfesorController();
    if(isset($_GET['iddosidi'])){
        $eliminaDosifi = profesorController::eliminaDosificacionController($_GET['iddosidi']);
    }

    if(isset($_GET['id']) && isset($_GET['id2'])){


        $eliminaDosifi = profesorController::eliminaProfesorDosifiController($_GET['id'],$_GET['id2']);
    }

?>
<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cargas académicas</h1>
</div>            
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Lista de cargas académicas</h6>
        
        <button  type="button" class="btn btn-info btn-icon-split" data-bs-toggle="modal" data-bs-target="#materia">
            <span class="icon text-white-50"> <i class="fa fa-book fa-sm text-white-50"></i></span>
            <span class="text">Nueva Materia</span>
        </button>
        
        <button  type="button" class="btn btn-secondary btn-icon-split" data-bs-toggle="modal" data-bs-target="#personal">
            <span class="icon text-white-50"> <i class="fa fa-address-card fa-sm text-white-50"></i></span>
            <span class="text">Nuevo Profesor</span>
        </button>

        <button  type="button" class="btn btn-primary btn-icon-split" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <span class="icon text-white-50"> <i class="fa fa-archive fa-sm text-white-50"></i></span>
            <span class="text">Nueva carga cadémica</span>
        </button>
        
    </div>
    
    <div class="card-body">
                            
        <div class="table-responsive" >
            <table class="table" data-order='[[ 0, "DESC" ]]'  id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                         <th>NO</th>
                        <th width="15%">Cuatrimestre</th>
                        <th width="65%">Profesor</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tfoot>
                   <tr>
                        <th>NO</th>
                        <th>Cuatrimestre</th>
                        <th>Profesor</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
                        $contador = 1;
                        
                        foreach($listadosificacion as $item){

                           
                            $detalleDedo = profesorController::detalleDecoController($item['CVE_PERSONAL'],$item['CVE_CAUTRIMESTRES']);


                                echo '<tr>
                                            <td>'.$item['CVE_CAUTRIMESTRES'].'</td>
                                            <td>'.$item['ABREVIATURA'].'</td>
                                            <td>'.$item['APELLIDOPATERNO'].' '.$item['APELLIDOMATERNO'].' '.$item['NOMBRE'].'
                                                                                       
                                                <div class="accordion" id="accordionExample">
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                        <h2 class="mb-0">
                                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne'.$contador.'" aria-expanded="true" aria-controls="collapseOne">Lista de carga Horaria</button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseOne'.$contador.'" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body">

                                                        <table  class="table table-bordered" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Asignatura</th>
                                                                    <th>Carrera</th>
                                                                    <th>Grupo</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>';

                                                            foreach($detalleDedo as $data):

                                                                echo '<tr>
                                                                        <td>'.$data['MATERIA'].'</td>
                                                                        <td>'.$data['ABREVIATURA'].'</td>
                                                                        <td>'.$data['GRADO']."°".$data['SECCION'].'</td>
                                                                        <td>
                                                                            <a href="index.php?url=profesores&iddosidi='.$data['CVE_DOSIFICACION'].'" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                                                        </td>
                                                                    </tr>'; 
                                                            endforeach;

                                            echo           '</tbody>             
                                                        </table>

                                                    </div>
                                                    </div> 
                                                </div>
                                                </div>
  
                                            
                                            
                                            </td>
                                        
                                            <td>
                                                <a href="index.php?url=profesores&id='.$item['CVE_PERSONAL'].'&id2='.$item['CVE_CAUTRIMESTRES'].'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>';

                                   
                                    
                                    
                                    $contador++;


                        }

                    
                    ?>

                	
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="exampleModalLabel">Nueva carga académica</h4>
        <button type="button" class="btn-close btn btn-outline-light" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <form method="POST">
        <div class="modal-body">
            <div class="row">
                <div class="col">
                    <select class="form-select form-control" name = "profe" aria-label="Default select example">
                        <option selected>Selecciona un profesor</option>
                        <?php 
                           foreach($listaProfesor as $itemp){

                                echo '<option value ="'.$itemp['CVE_PERSONAL'].'">'.$itemp['APELLIDOPATERNO'].' '.$itemp['APELLIDOMATERNO'].' '.$itemp['NOMBRE'].'</option>';
                            }

                        ?>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select form-control" id = "cuatri" name = "cuatri" onchange="vermateria(1);";  aria-label="Default select example">
                        <option selected>Selecciona un cuatrimestre</option>
                        <?php 
                                foreach($cuatri as $itemcua){

                                    echo '<option value="'.$itemcua['CVE_CAUTRIMESTRES'].'">'.$itemcua['DESCRIPCION'].'</option>';
                                }
                        ?>
                    </select>
                </div>

                <div class="col">
                <button type="button" onclick="contarElementos();" class="btn btn-info btn-small" id="btnMore">Agregar carga</button>
                </div>
         
            
        </div>
        <hr>
        <div id="incrementa"> 
            
                <p id = "cuenta"><input type = "hidden" id = "cuentaCarga" name = "cuentaCarga" value = "1"></p>
            
            
            <div id = "fila" class="fila-1">
                <div class="row mb-3">
                        <div class="col">
                            <select class="form-select form-control" id="carreras1" name = "carrera1" onchange="vermateria(1);verGrupo(1);">
                                <?php foreach($carrera as $data): 
                                    echo '<option value = "'.$data['CVE_CARRERAS'].'">'.$data['ABREVIATURA'].'</option>'; 
                                    endforeach 
                                ?>
                            </select>
                        </div>
                        <div class="col" id = "materia1">
                            <select class="form-select form-control" name = "materia1"  aria-label="Default select example">
                                <option selected>Selecciona una materia</option>
                            </select>
                        </div>
                        <div class="col" id = "grupo1">
                            <select class="form-select form-control" name = "grupo1" aria-label="Default select example">
                                <option selected>Selecciona un grupo</option>
                            </select>
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
          <button type="submit"  name = "registro" class="btn btn-primary">Registrar carga</button>
        </div>
      </form>
    
    </div>
  </div>
</div>


<!-------------->

<div class="modal fade" id="materia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="exampleModalLabel">Nueva Materia</h4>
        <button type="button" class="btn-close btn btn-outline-light" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <form method="POST">
        <div class="modal-body">
            <div class="row mb-3">

                <div class="col-5">
                    <input type = "text" name = "nombre" class="form-control" onkeyup="mayus(this);" placeholder = "Nombre de la materia" required>
                </div>
                <div class="col-4">
                    <select class="form-select form-control" id="carrera" name = "carrera" required>
                        <option value = "">Carrera</option>
                        <?php 
                            foreach($carrera as $data): 
                                echo '<option value = "'.$data['CVE_CARRERAS'].'">'.$data['ABREVIATURA'].'</option>'; 
                            endforeach 
                        ?>
                    </select>
                </div>
                <div class="col-3">
                    <input type = "number" name = "grado" class="form-control" placeholder = "Grado" required>
                </div>
            </div>
            <div class = "row">
            <div class="col">
                    <textarea name = "objetivo" class="form-control" placeholder = "Objetivo" required></textarea>
                </div>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit"  name = "registroMat" class="btn btn-primary">Registrar carga</button>
        </div>
      </form>
    
    </div>
  </div>
</div>


<!-------------->

<div class="modal fade" id="personal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="exampleModalLabel">Nueva personal académico</h4>
        <button type="button" class="btn-close btn btn-outline-light" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <form method="POST">
        <div class="modal-body">
            <div class="row mb-3">

                 <div class="col">
                    <select class="form-select form-control" name="tipo" required>
                        <option value = "">Tipo de profesor</option>
                        <option value = "PA">Profesor de Asignatura(PA)</option>
                        <option value = "PTC">Profesor de tiempo completo(PTC)</option>
                    </select>
                </div>    
                <div class="col">
                    <input type = "text" name = "nombre" class="form-control" onkeyup="mayus(this);" placeholder = "Nombres" required>
                    <input type = "hidden" name = "dep" class="form-control"  value = "4">
                </div>

                <div class="col">
                    <input type = "text" name = "apeP" class="form-control" onkeyup="mayus(this);" placeholder = "Apellido paterno" required>
                </div>

                <div class="col">
                    <input type = "text" name = "apeM" class="form-control" onkeyup="mayus(this);" placeholder = "Apellido materno" required>
                </div>
                
            </div>
            <div class = "row mb-3">
                <div class="col">
                    <input type = "text" name = "RFC" class="form-control"  onkeyup="mayus(this);" placeholder = "RFC" required>
                </div>

                <div class="col">
                    <input type = "text" name = "curp" class="form-control" onkeyup="mayus(this);" placeholder = "CURP" required>
                </div>

                <div class="col">
                    <input type = "text" name = "tel" class="form-control" onkeyup="mayus(this);" placeholder = "Telefono" required>
                </div>

                <div class="col">
                    <select class="form-select form-control" id="genero" name = "genero" required>
                        <option value = "">Genero</option>
                        <option value = "F">Femenino</option>
                        <option value = "M">Masculino</option>
                        
                    </select>
                </div>
            </div>
            <div class = "row mb-3">

                <div class="col-6">
                    <input type = "text" name = "titulo" class="form-control" onkeyup="mayus(this);" placeholder = "Titulo profecional" required>
                </div>

                <div class="col">
                    <input type = "text" name = "abreviaTitulo" class="form-control" onkeyup="mayus(this);" placeholder = "Abreviatura del Titulo ejemplo (ING.)" required>
                </div>

                <div class="col">
                   
                <input placeholder="Fecha de nacimiento" name = "fechaNac" class="form-control" type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')" id="fecha" required>
                </div>
            </div>
            <div class = "row">
                <div class="col-6">
                            <input type = "text" name = "direc" class="form-control" placeholder = "Domicilio" required>
                </div>
                <div class="col-6">
                            <input type = "text" name = "email" class="form-control" placeholder = "Correo Electrónico" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit"  name = "registroProfe" class="btn btn-primary">Registrar carga</button>
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


    var inputCode1 =' <div class="col"><select class="form-select form-control" id="carreras'+i+'" name = "carrera'+i+'" onchange="vermateria('+i+');verGrupo('+i+');" aria-label="Default select example"><option>Selecciona una carrera</option><?php foreach($carrera as $data): echo '<option value = "'.$data['CVE_CARRERAS'].'">'.$data['ABREVIATURA'].'</option>'; endforeach   ?></select></div>';
    
    var inputCode2 =' <div class="col" id = "materia'+i+'"><select class="form-select form-control = "materia'+i+'"  aria-label="Default select example"><option selected>Selecciona una materia</option></select></div>';

    var inputCode3 =' <div class="col" id = "grupo'+i+'"><select class="form-select form-control = "grupo'+i+'"  aria-label="Default select example"><option selected>Selecciona un grupo</option></select></div>';

    //Importante esta variable debe ir debajo del autoincrementable
    var btnDelete =' <button type="button" class="btn btn-danger btn-circle btn_remove" id="'+i+'"><i class="fas fa-trash"></i></button>';

    $('#incrementa').append('<div id ="fila" class="fila-'+i+'"><div class="row mb-3">'+ inputCode1 + inputCode2 + inputCode3 +' <div class="col-1">'+ btnDelete +' </div> </div></div>');
    
    
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
var idcuatri = document.getElementById("cuatri").value;
var cont = i;

    $.post("AJAX/materias.ajax.php", { idcarrera:idcar,contador:cont},function(data){
        $("#materia"+i).html(data);
    });


        $.post("AJAX/grupos.ajax.php", { idcarrera:idcar, idcuatri:idcuatri,contador:cont},function(data){
        $("#grupo"+i).html(data);
    });

};



function mayus(e) {
    e.value = e.value.toUpperCase();
};

</script>