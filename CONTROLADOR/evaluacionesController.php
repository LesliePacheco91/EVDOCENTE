<?php     class evaluacionCotroller{
    
        
        static public function maxEvController($personal){
            if($personal){
                
                $verMax = evaluacionMdl::maxEvMdl($personal);
                return $verMax;
                
            }
        }

        static public function listaEvController($idperson){


            $listaEv = evaluacionMdl::listaEvMdl($idperson);
            return $listaEv;
        }

        static public function listaEncuaestasController($dep){

            if(isset($dep)){


                $listaEncu = evaluacionMdl::listaEncuaestasMdl($dep);
                return $listaEncu;
            }
        }



        static public function nuevaEvController(){

        
            if(isset($_POST['registroEv'])){

                $valida = evaluacionMdl::validaRegistroEvaluacionModl($_POST['tipoen'],$_POST['cuatri'],$_POST['admin']);
                

                if($valida==true){

                        echo "ya existe esta evaluación";
                }else{

                    $datos = array(
                        'tipo'=>$_POST['tipoen'],
                        'fechaI'=>$_POST['fechaIn'],
                        'fechaF'=>$_POST['fechaFin'],
                        'cuatri'=>$_POST['cuatri'],
                        'admin'=>$_POST['admin'],
                        'etiqueta'=>$_POST['etiqueta'],
                        'estatus'=>'1'
                    );

                    $registroEva = evaluacionMdl::nuevaEvController( $datos);
                    return $registroEva;
                }
                

                

            }
        
            
        }

        public static function actualizaAgendaController(){

            if(isset($_POST['actualizaAgenda'])){


                $datos = array(
                    'idev'=>$_POST['ideva'],
                    'tipo'=>$_POST['tipoen'],
                    'fechaI'=>$_POST['fechaIn'],
                    'fechaF'=>$_POST['fechaFin'],
                    'cuatri'=>$_POST['cuatri'],
                    'admin'=>$_POST['admin'],
                    'etiqueta'=>$_POST['etiqueta']
                );

                $registroEva = evaluacionMdl::actualizaAgendaMdl( $datos);
                return $registroEva;
                
            }


        }

        public static function elininaEvController($id){

            if(isset($id)){

                $registroEva = evaluacionMdl::elininaEvMdl($id);
                return $registroEva;

            }
        }


        public static function CuatrisEvaluadosController($max,$idperso){


            $listaCuatro = evaluacionMdl::CuatrisEvaluadosMdl($max,$idperso);
            return  $listaCuatro;

        }


        public static function listaPlanController($cuatri,$idadmin){


                if(isset($cuatri)){


                        $varObservador = evaluacionMdl::listaPlanMdl($cuatri,$idadmin);

                        foreach($varObservador as $itemEv){

                            $detalleEv=evaluacionMdl::listaPlanDetalleMdl($itemEv['CVE_EVALUADOR']);

                            foreach($detalleEv as $itemDet){

                                echo '<tr>
                                <td>'.$itemEv['APELLIDOPATERNO'].' '.$itemEv['APELLIDOMATERNO'].' '.$itemEv['NOMBRE'].'</td>
                                <td>'.$itemDet['PROFESOR'].'</td>
                                <td>'.$itemDet['MATERIA'].'</td>
                                <td>'.$itemDet['FECHA_EVALUAR'].'</td>
                                <td>
        
                                    <button type="button"  class="btn btn-warning btn-circle" data-bs-toggle="modal" data-bs-target="#evaluado'.$itemDet['CVE_EVALUADO'].'">
                                    <i class="fas fa-pencil-alt"></i>
                                    </button>
        
                                    <a href="index.php?url=evaluadores&idevaluado='.$itemDet['CVE_EVALUADO'].'&idevaluador='.$itemEv['CVE_EVALUADOR'].'" class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>';


                            $datos = array(

                                'idevaluado'=>$itemDet['CVE_EVALUADO'],
                                'admin_carrera'=>$idadmin,
                                'cuatri'=>$cuatri,
                                'idevaluador'=>$itemEv['CVE_PERSONAL'],
                                'evaluador'=>$itemEv['APELLIDOPATERNO'].' '.$itemEv['APELLIDOMATERNO'].' '.$itemEv['NOMBRE'],
                                'idevaluado'=>$itemDet['CVE_PERSONAL'],
                                'evaluado'=>$itemDet['PROFESOR'],
                                'idmateria'=>$itemDet['CVE_MATERIAS'],
                                'materia'=>$itemDet['MATERIA'],
                                'fechaEvaluar'=>$itemDet['FECHA_EVALUAR']
                            );
                                

                                  //Modal Modificar

                            echo '<div class="modal fade" id="evaluado'.$itemDet['CVE_EVALUADO'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-5" id="exampleModalLabel">Modificar Plan</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="form" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">';
                                        evaluacionCotroller::modalMOdificarPlanController($datos);
                            echo'       </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button class="btn btn-primary btn-icon-split" type="submit" name = "actualizarPlan">
                                            <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                                            <span class="text">Guardar cambios</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>';
                           

                            }

                        }

                        
                        
                       //return $varObservador;

                }

        }

        public static function modalMOdificarPlanController($datos){

            $listaProfesor = profesorController::listaProfesorController();
            $materias = MCVlogin::ListmateriasController();



            echo ' <div class="form-group">
                        <label for="exampleFormControlInput1">Observador</label>
                        <input type="hidden" name="personal" value="'.$datos['admin_carrera'].'">
                        <input type="hidden" name="cuatri" value="'.$datos['cuatri'].'">
                        <input type="hidden" name="idEvaluado" value="'.$datos['idevaluado'].'">

                        <select class="form-select form-control" name = "observador" aria-label="Default select example" required>
                            <option value ="'.$datos['idevaluador'].'">'.$datos['evaluador'].'</option>
                            ';
                            foreach($listaProfesor as $itemp){
                                echo '<option value ="'.$itemp['CVE_PERSONAL'].'"><stron>'.$itemp['APELLIDOPATERNO'].' '.$itemp['APELLIDOMATERNO'].' '.$itemp['NOMBRE'].'</stron></option>';
                            }
                        echo'
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Profesor evaluado</label>
                        <select class="form-select form-control" name = "evaluado" aria-label="Default select example" required>
                            <option value ="'.$datos['idevaluado'].'">'.$datos['evaluado'].'</option>
                            ';
                            foreach($listaProfesor as $itemp){
                                echo '<option value ="'.$itemp['CVE_PERSONAL'].'"><stron>'.$itemp['APELLIDOPATERNO'].' '.$itemp['APELLIDOMATERNO'].' '.$itemp['NOMBRE'].'</stron></option>';
                            }
                            echo'
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Agisnatura</label>
                        <select class="form-select form-control" name = "Agisnatura" aria-label="Default select example" required>
                            <option value ="'.$datos['idmateria'].'">'.$datos['materia'].'</option>
                            ';
                            foreach($materias as $itemMat){
                                echo '<option value ="'.$itemMat['CVE_MATERIAS'].'">'.$itemMat['NOMBRE'].'</option>';
                            }
                            echo '
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Fecha</label>
                        <input type = "date" value = "'.$datos['fechaEvaluar'].'" name = "fechaEv" class="form-control">
                    </div>';

           

        }

        public static function listaPlanDetalleController($idev){


                if(isset($idev)){

                        $detalleEv=evaluacionMdl::listaPlanDetalleMdl($idev);
                        return $detalleEv;


                }
        }


        public static function registroPlanController(){

                
            if(isset($_POST['registroPLan'])){

                    $datosob = array(
                            'observa'=>$_POST['observador'],
                            'cuatri'=>$_POST['cuatri'],
                            'perso'=>$_POST['personal'],
                            'ecuesta'=>'2'
                    );

                    
                $validaPlan = evaluacionMdl::ValidaPlanMdl($datosob);
                
               if(isset($validaPlan['CVE_PERSONAL'])){

                        for($con = 1; $con<= $_POST['cuentaCarga']; $con++){

                            $dato = array(

                                    'observador'=>$validaPlan['CVE_EVALUADOR'],
                                    'cuatri'=>$_POST['cuatri'],
                                    'materia'=>$_POST['materia'.$con],
                                    'feEv'=>$_POST['fechaEv'.$con],
                                    'profe'=>$_POST['profesor'.$con],
                                    'estatus'=>'0'
                            );
                            
                            //se registro a los profesores a evaluar
                            $registro = evaluacionMdl::registroEvaluadoMdl($dato);
                        }
                        
                }else{

                    $nuevoObservador = evaluacionMdl::registroObservaMdl($datosob);
                    
                    $validaOb = evaluacionMdl::ValidaPlanMdl($datosob);

                    if(isset($validaOb['CVE_PERSONAL'])){

                        for($a = 1; $a<= $_POST['cuentaCarga']; $a++){

                            $dato = array(

                                    'observador'=>$validaOb['CVE_EVALUADOR'],
                                    'cuatri'=>$_POST['cuatri'],
                                    'materia'=>$_POST['materia'.$a],
                                    'feEv'=>$_POST['fechaEv'.$a],
                                    'profe'=>$_POST['profesor'.$a],
                                    'estatus'=>'0'
                            );
                            //se registro a los profesores a evaluar
                            $registro = evaluacionMdl::registroEvaluadoMdl($dato);
                        }

                    }

                }
            

            }
        }

        public static function ActualizaPlanController(){

                if(isset($_POST['actualizarPlan'])){

                    $detallePlan = array(
                        'observa'=>$_POST['observador'],
                        'cuatri'=>$_POST['cuatri'],
                        'evaluado'=>$_POST['evaluado'],
                        'perso'=>$_POST['personal'],
                        'fecha'=>$_POST['fechaEv'],
                        'materia'=>$_POST['Agisnatura'],
                        'idEvaluado'=>$_POST['idEvaluado'],
                        'ecuesta'=>'2'
                    );

                    $validaPlan = evaluacionMdl::ValidaPlanMdl($detallePlan);

                    if(isset($validaPlan['CVE_PERSONAL'])){

                       

                        $actualizaEvaluado = evaluacionMdl::ActualizaPlanMdl($detallePlan,$validaPlan['CVE_EVALUADOR']);
                        return  $actualizaEvaluado;
        
                    }else{


                       $nuevoObservador = evaluacionMdl::registroObservaMdl($detallePlan);

                        $validaPlan = evaluacionMdl::ValidaPlanMdl($detallePlan);

                        if(isset($validaPlan['CVE_PERSONAL'])){

                            $actualizaEvaluado = evaluacionMdl::ActualizaPlanMdl($detallePlan,$validaPlan['CVE_EVALUADOR']);
                            return  $actualizaEvaluado;
            
                        }
                        

                    }

                }

        }

        public static function EliminaEvaluadoController($idevaluado,$idevaluador){
                if(isset($idevaluado)){


                    //verifica cuandos profesores evaluará en caso de que sea 1 y se llegara a eliminar se elimina tambien de la tabla evaluadores
                    $valudaEvaluador = evaluacionMdl::ValidaEvaluadorMdl($idevaluador);

                    if($valudaEvaluador['TotalEvaluados'] >= 2){


                        $eliminaEvalua = evaluacionMdl::EliminaEvaluadoMdl($idevaluado);
                        return $eliminaEvalua;
                    

                    }else{


                        $eliminaEvaluador = evaluacionMdl::EliminaEvaluadorMdl($idevaluador);
                        
                        $eliminaEvalua = evaluacionMdl::EliminaEvaluadoMdl($idevaluado);
                        return $eliminaEvalua;

                          
                    }

                }

        }

        public static function consultaEncuestaController($id){

            if(isset($id)){

                $verEncuesta= evaluacionMdl::consultaEncuestaMdl($id);
                return $verEncuesta;
            }
        }

        static public function consultaPreguntasController($idencuesta){

            if(isset($idencuesta)){

                $verPreguntas = evaluacionMdl::consultaPreguntasMdl($idencuesta);
                return $verPreguntas;

            }
        }

        static public function opcionesController($idpregunta){

            if(isset($idpregunta)){

                $verOpciones = evaluacionMdl::opcionesMdl($idpregunta);
                return $verOpciones;
            }
            
        }

        static public function profesEvaluadosController($cuatri, $admin){

            if(isset($cuatri)){

                $verLista = evaluacionMdl::profesEvaluadosMdl($cuatri, $admin);
                return $verLista;

            }
        }

        static public function TotalEvaluadorController($maxCuatri,$idperson){


            $totalEvaluadores = evaluacionMdl::TotalEvaluadorMdl($maxCuatri,$idperson);
            return $totalEvaluadores;

        }

        static public function totalEvaluacionesController($maxCuatri,$idPersonal){

            #TOTAL DE EVALUACIONES REGISTRADAS EN EL CALENDARIO

            $totalEvaluaciones = evaluacionMdl::totalEvaluacionesMdl($maxCuatri,$idPersonal);
            return $totalEvaluaciones;
        }

        static public function totalEevaluacionesAlumnosController($idgrupo, $idcuatri){



            $totalEvlAlumnoGrupos = evaluacionMdl::totalEevaluacionesAlumnosMdl($idgrupo, $idcuatri);
            return $totalEvlAlumnoGrupos;
        }

        static public  function porcentajesController($datos){

            $cantidad =  $datos['totalAlumnos'] * $datos['totalProfes'];

            if($datos['totalAlumnosEvaluaron'] != 0){
                $porcentaje = (100 * $datos['totalAlumnosEvaluaron']) / $cantidad;
            }else{
                $porcentaje = 0;
            }
            
            $porcentaje = round($porcentaje, 0);

            if($porcentaje<=20){

                 echo ' 
                 <div class = "col-md">
                       <a href = ""  data-bs-toggle="modal" data-bs-target="#modal'.$datos['idgrupo'].'"><h4 class="small font-weight-bold">'.$datos['GRADO'].'°'.$datos['SECCION'].' '.$datos['ABREVIATURA'].'
                             <span class="float-right">'.$porcentaje.'%</span>
                         </h4></a>
                    <div class="progress mb-4"> 
                        <div class="progress-bar bg-danger" role="progressbar" style="width: '.$porcentaje.'%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>';

            }else if($porcentaje>20 && $porcentaje<40){

                echo '<div class = "col-md">

               
                         <a href = ""  data-bs-toggle="modal" data-bs-target="#modal'.$datos['idgrupo'].'"><h4 class="small font-weight-bold">'.$datos['GRADO'].'°'.$datos['SECCION'].' '.$datos['ABREVIATURA'].'
                             <span class="float-right">'.$porcentaje.'%</span>
                         </h4></a>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: '.$porcentaje.'%"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>';

            }else if($porcentaje>=40 && $porcentaje<60){



                echo '<div class = "col-md">

                      <a href = ""  data-bs-toggle="modal" data-bs-target="#modal'.$datos['idgrupo'].'"><h4 class="small font-weight-bold">'.$datos['GRADO'].'°'.$datos['SECCION'].' '.$datos['ABREVIATURA'].'<span
                        class="float-right">'.$porcentaje.'%</span></h4></a>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: '.$porcentaje.'%"
                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>';


            }else if($porcentaje>=60 && $porcentaje<80){

                    echo '<div class = "col-md">
                            <a href = ""  data-bs-toggle="modal" data-bs-target="#modal'.$datos['idgrupo'].'"><h4 class="small font-weight-bold">'.$datos['GRADO'].'°'.$datos['SECCION'].' '.$datos['ABREVIATURA'].' <span
                                    class="float-right">'.$porcentaje.'%</span></h4></a>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: '.$porcentaje.'%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                        </div>';

            }else if($porcentaje>=80 && $porcentaje<=100){

                 echo '<div class = "col-md">
                         <a href = ""  data-bs-toggle="modal" data-bs-target="#modal'.$datos['idgrupo'].'"><h4 class="small font-weight-bold">'.$datos['GRADO'].'°'.$datos['SECCION'].' '.$datos['ABREVIATURA'].'
                             <span class="float-right">'.$porcentaje.'%</span>
                         </h4></a>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: '.$porcentaje.'%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>';
            }



            $lista = gruposModel::listaAlumnosGrupoMdl($datos['idgrupo']);

                echo '<!-- Button trigger modal -->
                       

                        <!-- Modal -->
                        <div class="modal fade" id="modal'.$datos['idgrupo'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Consentrado de alumnos en evaluación '.$datos['GRADO'].'°'.$datos['SECCION'].'</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body"> 

                                  <table class = "table">

                                  <thead>
                                    <tr>
                                        <th>Alumnos</th>
                                        <th>lista de profesores a evaluar</th>
                                    </tr>
                                  </thead>
                                  <tbody>';
                                   
                                foreach($lista as $itemAlumno):


                                    $profesores = evaluacionMdl::listaProfesoresEvaMdl($itemAlumno['MATRICULA'],$datos['idgrupo']);

                                        echo '<tr>

                                            <td>'.$itemAlumno['APELLIDOPATERNO'].' '.$itemAlumno['APELLIDOMATERNO'].' '.$itemAlumno['NOMBRE'].'<br><small>'.$itemAlumno['MATRICULA'].'</small></td>
                                            <td><ul>';

                                                foreach( $profesores as $profes):

                                                    echo '<li>'.$profes['APELLIDOPATERNO'].' '.$profes['APELLIDOMATERNO'].' '.$profes['NOMBRE'].'</li>';

                                                endforeach;

                                       echo '</ul></td>
                                        </tr>';


                                endforeach;

                             echo '</tbody>
                                    </table>
                            </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        ';

        }


        static public function registroEvDAController(){
            

            if(isset($_POST['guardaEvaDr'])){
    

                   

                $datos = array('idprofe'=>$_POST['profe'],
                                'idadmin'=>$_POST['admin'],
                                'idcuatri'=>$_POST['cuatri'],
                                'obse'=>$_POST['ob'],
                                'tipoEncu'=>3
                            );

                $registroEvaluacion = evaluacionMdl::registroEvDAMdl($datos);

                if($registroEvaluacion == true){


                        $obtenID = evaluacionMdl::ideregistroDCMdl($datos);

                        for( $n = 42; $n <=64; $n++){

                           $registroDetalle = evaluacionMdl::registroDetalleDCMdl($_POST[$n],$obtenID['CVE_RESULTADO_DDC']);
                        }


                    
                }ELSE{

                    ECHO "ERROR DE REGISTRO";
                }
            }
        }


        //resultados Direccion académica
        static public function resultadosDCController($cuatri, $admin){

            $lista = evaluacionMdl::resultadosDCMdl($cuatri, $admin);

            foreach($lista as $itemResult):

                $detalleResultados = evaluacionCotroller::detalleResultDCController($itemResult['CVE_RESULTADO_DDC']);

            ?>
                    <tr>
                    <td><?php echo $itemResult['APELLIDOPATERNO'].' '.$itemResult['APELLIDOMATERNO'].' '.$itemResult['NOMBRE']; ?></td>
                    <td><?php echo $detalleResultados['r1'];?></td>
                    <td><?php echo $detalleResultados['r2'];?></td>
                    <td><?php echo $detalleResultados['r3'];?></td>
                    <td><?php echo $detalleResultados['r4'];?></td>
                    <td><?php echo $detalleResultados['r5'];?></td>
                    <td><?php echo $detalleResultados['r6'];?></td>
                    <td><?php echo $detalleResultados['r7'];?></td>
                    <td><?php echo $detalleResultados['total']?></th>
                    <td>
                        <a type="button" class="btn btn-danger btn-circle btn-sm" href = "index.php?url=evaluacionDA&idev=<?php echo $itemResult['CVE_RESULTADO_DDC'];?>">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php 

                evaluacionMdl::ActualizaresultObMdl($detalleResultados['total'], $cuatri , $itemResult['CVE_PERSONAL'] ,"RESULT_ADMIN");

            endforeach;

        }

        //resultados de direccion académica
        static public function detalleResultDCController($idregistro){

            $t1 = 0;
            $t2 = 0;
            $t3 = 0;
            $t4 = 0;
            $t5 = 0;
            $t6 = 0;
            $t7 = 0;
            $total = 0;

            $detalle = evaluacionMdl::detalleResultDCController($idregistro);

            foreach($detalle as $item){


                $pregunta = evaluacionMdl::preguntasMdl($item['CVE_PREGUNTA_OPCION']);

                  if($pregunta['CVE_PREGUNTA'] == 61 OR $pregunta['CVE_PREGUNTA'] == 62 ){

                        $t1 += $pregunta['VALOR'];
                

        
                } if($pregunta['CVE_PREGUNTA'] == 47 OR $pregunta['CVE_PREGUNTA'] == 53 or $pregunta['CVE_PREGUNTA'] == 55 ){

                        $t2 +=$pregunta['VALOR'];

                } if($pregunta['CVE_PREGUNTA'] == 42 OR $pregunta['CVE_PREGUNTA'] == 47 or $pregunta['CVE_PREGUNTA'] == 53 or $pregunta['CVE_PREGUNTA'] == 54 or $pregunta['CVE_PREGUNTA'] == 55 or $pregunta['CVE_PREGUNTA'] == 63 ){

                        $t3 +=$pregunta['VALOR'];

                } if($pregunta['CVE_PREGUNTA'] == 50 OR $pregunta['CVE_PREGUNTA'] == 51 or $pregunta['CVE_PREGUNTA'] == 54 or $pregunta['CVE_PREGUNTA'] == 56 or $pregunta['CVE_PREGUNTA'] == 57){

                        $t4 +=$pregunta['VALOR'];

                } if($pregunta['CVE_PREGUNTA'] == 58 OR $pregunta['CVE_PREGUNTA'] == 59 or $pregunta['CVE_PREGUNTA'] == 60 or $pregunta['CVE_PREGUNTA'] == 61 or $pregunta['CVE_PREGUNTA'] == 63 or $pregunta['CVE_PREGUNTA'] == 64){

                        $t5 +=$pregunta['VALOR'];

                } if($pregunta['CVE_PREGUNTA'] == 42 OR $pregunta['CVE_PREGUNTA'] == 43 or $pregunta['CVE_PREGUNTA'] == 48 or $pregunta['CVE_PREGUNTA'] == 52){

                        $t6 +=$pregunta['VALOR'];

                }if($pregunta['CVE_PREGUNTA'] == 44 OR $pregunta['CVE_PREGUNTA'] == 45 or $pregunta['CVE_PREGUNTA'] == 46 or $pregunta['CVE_PREGUNTA'] == 49 or $pregunta['CVE_PREGUNTA'] == 54){

                        $t7 +=$pregunta['VALOR'];
                }
              

            }


            $ddc = $t1+$t2+$t3+$t4+$t5+$t6+$t7;

            $result = array('r1'=>$t1,'r2'=>$t2,'r3'=>$t3,'r4'=>$t4,'r5'=>$t5,'r6'=>$t5,'r7'=>$t7,'total'=>$ddc);

            return $result;
        }


        static public function eliminaEvaluacionDCController($idEv){

            //funcion pendiente
            if(isset($idEv)){
                
                    $eliminarEv = evaluacionMdl::eliminaEvDcMdl($idEv);
                    return $eliminarEv;
                    //$eliminarDet = evaluacionMdl::eliminaEvDcDetMdl($idEv); aGREGARLO EN EL MODELO

            }
            
        }

        static public function registroConsentradoController()
        {
            
            if(isset($_POST['guardaEva'])){

                $datos = array('idprof'=>$_POST['profe'],'idadmin'=>$_POST['admin'],'idcuat'=>$_POST['cuatri']);

                $regiatro = evaluacionMdl::registroConsentradoMdl($datos);
                //return $regiatro;

                if($regiatro == true){

                    $obse = evaluacionCotroller::actualizaResultadosConcentradoController($_POST['cuatri'], $_POST['profe']);
                    $alum = evaluacionCotroller::actualizaResAlumnoCtl($_POST['cuatri'], $_POST['profe']);

                }

                

            }
        }
        //consentrado de resultados
        static public function listaConsentradoController($idcuatri,$admin){

            if(isset($idcuatri)){

                $lista = evaluacionMdl::listaConsentradoMdl($idcuatri,$admin);
               
                foreach($lista as $iteml){


                    $al = (($iteml['RESULTADO_ALUM'] *100)/72)*.4;
                    $pro = $iteml['RESULT_PROF']*.35;
                    $dir = $iteml['RESULT_ADMIN'] * .25;

                    $total_eval = $al + $pro + $dir;
                    $total_global = $iteml['RESULTADO_ALUM']+$iteml['RESULT_PROF']+$iteml['RESULT_ADMIN'];
                    $ponde = ($total_global*100)/272;

                    echo '<tr>
                        <td>'.$iteml['APELLIDOPATERNO']." ".$iteml['APELLIDOMATERNO']." ".$iteml['NOMBRE'].'</td>
                        <td>'.$iteml['RESULT_PROF'].'</td>
                        <td>'.$iteml['RESULTADO_ALUM'].'</td>
                        <td>'.$iteml['RESULT_ADMIN'].'</td>
                        <td>'.number_format($total_global).'</td>
                        <td>'.number_format($ponde).'</td>
                        <td>'.number_format($total_eval).'</td>
                        <td>';
                        
                            if(number_format($total_eval)>95){
                                echo '<p class ="text-xs font-weight-bold text-success text-uppercase">COMPETENTE DESTACADO</p>';
                            }else if(number_format($total_eval)>85 and number_format($total_eval)<=95){

                                echo '<p class ="text-xs font-weight-bold text-warning text-uppercase">SATISFACTORIO COMPETENTE</p>';

                            }else if(number_format($total_eval)<=85  and number_format($total_eval)>80 ){

                                echo '<p style = "color: #fe701a;" class ="text-xs font-weight-bold text-uppercase">SATISFACTORIO CONDICIONADO</p>';

                            }else if(number_format($total_eval)<=80){

                                echo '<p class ="text-xs font-weight-bold text-danger text-uppercase">NO SATISFACTORIO</p>';

                            }
                        
                        
                        echo '</td>
                        <td>
                        
                            <a href="index.php?url=resultados&id='.$iteml['CVE_PERSONAL'].'&id2='.$iteml['CVE_CUATRIMESTRE'].'" class="btn btn-primary btn-circle"><i class="fas fa-file-alt fa-sm"></i></a>
                            
                            <a href="index.php?url=resultados&id='.$iteml['CVE_RESULTADOEV'].'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>
                        
                        

                        </td>
                    </tr>';
                }
            }
        }

        //resultado de consentrado alumno
        static public function listaConsentradoAlController($idcuatri,$admin){

            if(isset($idcuatri)){
                
                $lista = evaluacionMdl::listaConsentradoMdl($idcuatri,$admin);

                foreach($lista as $iteml){
                    
               
                   $suma = 0;

                    $totalAlumnos = evaluacionMdl::totalAlumnosEvaMdl($idcuatri,$iteml['CVE_PERSONAL']);

                    $preguntas = evaluacionMdl::verpregunrasAlumnoMdl();

                    echo '<tr>
                            <td>'.$iteml['APELLIDOPATERNO']." ".$iteml['APELLIDOMATERNO']." ".$iteml['NOMBRE'].'</td>';

                            foreach($preguntas as $itemp){
                                

                              /* $result = evaluacionMdl::ResultadosAlumnoMdl($idcuatri,$iteml['CVE_PERSONAL'],$itemp['CVE_PREGUNTAS']);
                                
                                echo '<td>0</td>';

                               /* if($result['TOTALDet']!=0){
                                    $resultado = $result['TOTALDet']/$totalAlumnos['TOTAL'];

                                echo "<td>".number_format($resultado)."</td>";
                                
                                $suma += number_format($resultado);
                               
                                }else{
                                    echo "<td>0</td>";
                                }*/
                                

                                

                                
                            }
                            echo '<td>'.$suma.'</td>
                        </tr>';

                        //evaluacionMdl::ActualizaresultObMdl($suma, $idcuatri , $iteml['CVE_PERSONAL'] ,"RESULTADO_ALUM");
                        

                }
                
            }
            
        
        }


        //resultados observador
        static public function actualizaResultadosConcentradoController($idCuatri, $idpersonal){

            $v1= 0;
            $v2= 0;
            $v3= 0;
            $v4= 0;
            $v5= 0;
            $v6= 0;
            $v7= 0;
            $vt = 0;

            if(isset($idpersonal)){

               $verEva = evaluacionMdl::evaluadoMdl($idCuatri, $idpersonal);

               if(isset($verEva['CVE_EVALUADO'])){

                    $resulOb = evaluacionMdl::resultObMdl($verEva['CVE_EVALUADO']);

                   if(isset($resulOb['CVE_RESULTADO'])){
                       
                        $resultadoOb = evaluacionMdl::resultDetObMdl($resulOb['CVE_RESULTADO']);

                        foreach($resultadoOb as $res1){

                            if($res1['CVE_PREGUNTA']==30 or $res1['CVE_PREGUNTA']==32 or $res1['CVE_PREGUNTA']==33 or $res1['CVE_PREGUNTA']==34 or $res1['CVE_PREGUNTA']==35 or $res1['CVE_PREGUNTA']==36){
                                    $v1 += $res1['VALOR_OPCION'];
                
                            }if($res1['CVE_PREGUNTA']==22 or $res1['CVE_PREGUNTA']==23 or $res1['CVE_PREGUNTA']==39 or $res1['CVE_PREGUNTA']==40){
                
                                $v2 += $res1['VALOR_OPCION'];
                
                            }if($res1['CVE_PREGUNTA']==25 or $res1['CVE_PREGUNTA']==26 or $res1['CVE_PREGUNTA']==27){
                
                                $v3 += $res1['VALOR_OPCION'];
                
                            }if($res1['CVE_PREGUNTA']==24 or $res1['CVE_PREGUNTA']==29 or $res1['CVE_PREGUNTA']==30 or $res1['CVE_PREGUNTA']==31){
                
                                $v4 += $res1['VALOR_OPCION'];
                
                            }if($res1['CVE_PREGUNTA']==28 or $res1['CVE_PREGUNTA']==34 or $res1['CVE_PREGUNTA']==37 or $res1['CVE_PREGUNTA']==38){
                
                            $v5 += $res1['VALOR_OPCION'];
                
                            }if($res1['CVE_PREGUNTA']==20 or $res1['CVE_PREGUNTA']==21 or $res1['CVE_PREGUNTA']==22 or $res1['CVE_PREGUNTA']==39){
                
                                $v6 += $res1['VALOR_OPCION'];
                
                            }if($res1['CVE_PREGUNTA']==24 or $res1['CVE_PREGUNTA']==30 or $res1['CVE_PREGUNTA']==31 or $res1['CVE_PREGUNTA']==38 or $res1['CVE_PREGUNTA']==41){
                
                             $v7 += $res1['VALOR_OPCION'];
               
                            }
                        }

                        $total = $v1+$v2+$v3+$v4+$v5+$v6+$v7; 

                        evaluacionMdl::ActualizaresultObMdl($total,$idCuatri, $idpersonal,"RESULT_PROF");

                    }

                }  

            }
                
        }

        public static function actualizaResAlumnoCtl($cuatri, $idpersonal){

            if(isset($cuatri)){

                $sumaEva =  evaluacionMdl::actualizaResAlumnoMdl($cuatri, $idpersonal);

                $totalAlumnosEvaluaron = evaluacionMdl::cantidadAlumnosEvalMdl($cuatri, $idpersonal);

                if($sumaEva['TOTAL'] !=null && $totalAlumnosEvaluaron['totalAl'] !=null ){

                    $result = $sumaEva['TOTAL']/$totalAlumnosEvaluaron['totalAl'];
                    evaluacionMdl::ActualizaresultObMdl($result,$cuatri, $idpersonal, "RESULTADO_ALUM");

                }
            }
        }

        static public function actualizaEstatusEvController($ideva, $inicio,$fin,$fechaActual){

            $fechaIni = strtotime($inicio);
            $fechaFin = strtotime($fin);
            $fechaAct = strtotime($fechaActual);

            if($fechaAct<$fechaIni & $fechaAct<$fechaFin){

                $estatus = 2;
                evaluacionMdl::actualizaEstatusEVMdl($estatus,$ideva);

            }else if($fechaIni < $fechaAct &&  $fechaFin>$fechaAct){

                $estatus = 1;
                evaluacionMdl::actualizaEstatusEVMdl($estatus,$ideva);

            }else if($fechaAct> $fechaIni && $fechaAct> $fechaFin){

                $estatus = 0;
                evaluacionMdl::actualizaEstatusEVMdl($estatus,$ideva);
            }
        }
        
        public static function eliminaProfesorDeListaController($id1){
            
            $elimina =  evaluacionMdl::eliminaProfesorDeListaMdl($id1);
            return $elimina;
            
        }
    }

?>