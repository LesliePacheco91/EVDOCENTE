<?php 

    $registroCuatri = cuatrimestresController::registroCuatriCont();
    $listaCuatri = cuatrimestresController::listaCuatriController('CUATRIMESTRES');
    $actualizaCuatri = cuatrimestresController::actualizaCuatriController();

    if(isset($_GET['id'])){

        $eliminaCuatri = cuatrimestresController::eliminaCuatriController($_GET['id']);

    }

?>

<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800">Cuatrimestres</h1>

<div class="card shadow mb-4 ">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nuevo Cuatrimestre</h6>
    </div>

    <div class="card-body">
        
        <form class="form-inline" method="POST">

            <div class="form-row col-md-12 col-mb-12">
                <div class="col-md-2 mb-2">    
                    <label for="validationCustom01">Fecha de inicio</label>
                    <div class="input-group input-group-joined">
                        <input type="date" name="inicio" class="form-control ps-1" placeholder="Ingresa la fecha de inicio" required>
                    </div>
                </div>
                <div class="col-md-2 mb-2">
                    <label for="validationCustom01">Fecha de finalización</label>  
                    <div class="input-group input-group-joined">
                        <input type="date" name="fin" class="form-control ps-1" placeholder="Ingresa la fecha de finalización" required>
                    </div>
                </div>

                <div class="col-md-4 mb-3">  
                    <label for="validationCustom01">Descripción larga</label>
                    <div class="input-group input-group-joined">
                        <input type="text" name="descripcion" onkeyup="mayus(this);"  class="form-control ps-1" placeholder=" ejemplo SEPTIEMBRE-DICIEMBRE 2022" required>
                    </div>
                </div>

                <div class="col-md-4 mb-4">  
                    <label for="validationCustom01">Descripción corta</label>
                    <div class="input-group input-group-joined">
                        <input type="text" name="desCorto" onkeyup="mayus(this);" class="form-control ps-1" maxlength="11" placeholder=" ejemplo SEP-DIC 22" required>
                    </div>
                </div>

                <button class="btn btn-primary btn-icon-split" name = "registro" type="submit">
                    <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                    <span class="text">Guardar registro</span>
                </button>
            </div>

        </form>
    </div>
</div>

                    <!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de cuatrimestres</h6>
    </div>
    
    <div class="card-body">
                            
        <div class="table-responsive" >
            <table class="table" data-order='[[ 0, "DESC" ]]' id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cuatrimestre</th>
                        <th>Inicio</th>
                        <th>Finalización</th>
                        <th>Abreviatura</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Cuatrimestre</th>
                        <th>Inicio</th>
                        <th>Finalización</th>
                        <th>Abreviatura</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>

                <?php 
                        foreach($listaCuatri as $listaCua){

                            echo '<tr>
                                <td>'.$listaCua['CVE_CAUTRIMESTRES'].'</td>
                                <td>'.$listaCua['DESCRIPCION'].'</td>
                                <td>'.$listaCua['FECHA_INICIO'].'</td>
                                <td>'.$listaCua['FECHA_FIN'].'</td>
                                <td>'.$listaCua['ABREVIATURA'].'</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-circle" data-bs-toggle="modal" data-bs-target="#moda'.$listaCua['CVE_CAUTRIMESTRES'].'">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                            
                                    <a href="index.php?url=cuatrimestres&id='.$listaCua['CVE_CAUTRIMESTRES'].'" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            
                            </tr>';?>
                
                                <!-- Modal -->
                               
                                <div class="modal fade" id="moda<?php echo $listaCua['CVE_CAUTRIMESTRES'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modificar cuatrimestre</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    
                                        <form method="POST">
                                            <div class="modal-body">
                                                
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Fecha de inicio</label>
                                                    <input type="date"  name = "fechaIn" class="form-control" value ="<?php echo $listaCua['FECHA_INICIO'] ?>">

                                                    <input type="hidden" name = "idcuatri" class="form-control" value ="<?php echo $listaCua['CVE_CAUTRIMESTRES']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Fecha de finalización</label>
                                                    <input type="date" name="fechaFin" value ="<?php echo $listaCua['FECHA_FIN'];?>" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Descripción larga</label>
                                                    <input type="text" onkeyup="mayus(this);" name="descriLargo"  value = "<?php echo $listaCua['DESCRIPCION'];?>" class="form-control" placeholder="Ingresa la descripción larga">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Descripción corta</label>
                                                    <input type="text" name="descriCorta" onkeyup="mayus(this);"  value ="<?php echo $listaCua['ABREVIATURA'];?>" class="form-control"  placeholder="Ingresa la descripción corta">
                                                </div> 
                                            </div>
                                    
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button class="btn btn-primary btn-icon-split" name = "actualizarCuatrimestre" type="submit">
                                                    <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                                                    <span class="text">Guardar cambios</span>
                                                </button>
                                            </div>
                                    </form>
                                    
                                    </div>
                                </div>
                                </div>
                            <!-- Modal -->
                            
                        <?php } ?>
                   
                </tbody>
            </table>
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