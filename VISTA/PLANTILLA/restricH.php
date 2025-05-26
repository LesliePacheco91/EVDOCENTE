<?php 
    $idadmin = MCVlogin::personalController($_SESSION['idPersonal']); 

    $cuatri = cuatrimestresController::listaCuatriMaxController('CUATRIMESTRES',3);
    $actualizaEstatus = restriccionHorarioCtrl::ActualizaEstatusController();

?>

<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800">Restricción de horario</h1>
                    <!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de retricciones</h6>
    </div>
    
    <div class="card-body">
                            
        <div class="accordion" id="accordionExample">
            <div class="card">

                <?php 

                        foreach($cuatri as $cuat){

                            $lista =  restriccionHorarioCtrl::listaRestriccionesController($idadmin['CVE_CARRERA_PERSONAL'], $cuat['CVE_CAUTRIMESTRES']);

                            echo ' <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse'.$cuat['CVE_CAUTRIMESTRES'].'" aria-expanded="true" aria-controls="collapseOne">
                                            Restriccciones del cuatrimestre '.$cuat['DESCRIPCION'].'
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapse'.$cuat['CVE_CAUTRIMESTRES'].'" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                        <table class = "table">
                                        <thead>
                                        <tr>
                                            <th>Profesor</th>
                                            <th>Fecha de solicitud</th>
                                            <th>Detalle de restriccion</th>
                                            <th>Estatus</th>
                                            <th></th>
                                        </tr>
                                        </head>
                                        <tbody>';

                                        foreach($lista as $key){

                                            $profesor = $key['APELLIDOPATERNO'].' '.$key['APELLIDOMATERNO'].' '.$key['NOMBRE'];

                                            echo '
                                            <tr>
                                            <td>'.$profesor.'</td>
                                            <td>'.$key['FECHA'].'</td>
                                            <td>
                                                <a href="" data-toggle="modal" data-target="#Modal'.$key['CVE_PERSONAL'].'">Ver restricción</a>
                                            </td>
                                            <td width="10%">';
                
                                            switch($key['ESTADO']){
                
                                                case 0 : echo '<span class="badge bg-warning text-white">Sin validar</span>'; break;
                                                case 1: echo '<span class="badge bg-danger text-white">Rechazado</span>'; break;
                                                case 2: echo '<span class="badge bg-primary text-white">Aprobado</span>'; break;
                                            }
                                    echo' </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-circle" data-bs-toggle="modal" data-bs-target="#modalEstatus'.$key['CVE_PERSONAL'].'">
                                                <i class="fa fa-check"></i>
                                                </button>


                                                <!-- Modal -->
                                                <div class="modal fade" id="modalEstatus'.$key['CVE_PERSONAL'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Validad Solicitud</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    
                                                    <form method = "POST">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <input type="hidden" class="form-control" name = "idrestric" value = "'.$key['CVE_RESTRICCION'].'">
                                                                <select name = "estatus" class="form-control"  required>';

                                                                switch($key['ESTADO']){
                
                                                                    case 0 : echo '<option value ="0">Sin validar</option>
                                                                                    <option value ="1">Rechazado</option>
                                                                                    <option value ="2">Aceptado</option>';
                                                                    break;
                                                                    
                                                                    case 1: echo '
                                                                                    <option value ="1">Rechazado</option>
                                                                                    <option value ="0">Sin validar</option>
                                                                                    <option value ="2">Aceptado</option>';
                                                                    break;
                                                                    case 2: echo '
                                                                                    <option value ="2">Aceptado</option>
                                                                                    <option value ="1">Rechazado</option>
                                                                                    <option value ="0">Sin validar</option>';
                                                                                      
                                                                    break;
                                                                }
                                                                    

                                                        echo '</select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" name = "actualizaEstatus" class="btn btn-primary">Validar solicitud</button>
                                                        </div>
                                                    
                                                    </form>
                                                    
                                                    </div>
                                                </div>
                                                </div>

                                            
                                            
                                                <!-- Modal -->
                                                <div class="modal fade" id="Modal'.$key['CVE_PERSONAL'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="exampleModalLabel">Restriccion solicitada por: '.$profesor.'</h6>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">';

                                                           $horario = restriccionHorarioCtrl::horario($key['CVE_RESTRICCION'],$key['DESCRIPCION']);
                                                            
                                                echo    '</div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                            </td>
                                        </tr> ';

                                       
                                        }
                                       
                                echo '</tbody>
                                    </table>

                             </div>
                        </div>';

                        }
                
                ?>
               
            </div>
        </div>


    </div>
</div>

</div>         

<script type="text/javascript">

    function mayus(e) {
        e.value = e.value.toUpperCase();
    }
</script>
                <!-- /.container-fluid -->