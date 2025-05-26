<?php 

    class gruposController{

        static public function listagruposController($tbl,$iduser){

            

            if(isset($tbl)){

               $lista = gruposModel::listagruposMdl($tbl,$iduser);
                return $lista;
                
            }

        }

        static public function listagrupos1Controller(){

            $lista = gruposModel::listagrupos1Mdl();
            return $lista;

        }

        static public function listaAlumnosGruposController($idgrupo){


            if(isset($idgrupo)){

              
                $lista = gruposModel::listaAlumnosGrupoMdl($idgrupo);
                return $lista;

            }
        }

        static public function filtroGruposController($idgrupo){

            if(isset($idgrupo)){

                $lista = gruposModel::filtroGruposMdl($idgrupo);
                return $lista;

            }
        }

        static public function registroGrupoController(){


            if(isset($_POST['registroGrupos'])){

              

                $datos = array(
                    'grado' =>$_POST['grado'], 
                    'seccion' => $_POST['seccion'], 
                    'idCarrera' => $_POST['carrera'],
                    'idCuatri' => $_POST['cuatrimestre']
                );


                $verifica = gruposModel::verificaGrupo($datos);
                
                if($verifica != null){
                    echo '<div class="alert alert-warning" role="alert">Ya existe este grupo </div>';
                }else{
                    
                    $registro  = gruposModel::registroGrupoMdl($datos);
                   return $registro;
                }

                   
                }
        }

        static public function actualizarGrupController(){


            if(isset($_POST['actualizar'])){

              
                        
                    $datos = array(
                        'idg'=>$_POST['idgrupo'],
                        'grado' =>$_POST['grado'], 
                        'seccion' => $_POST['seccion'], 
                        'idCarrera' => $_POST['carrera'],
                        'idCuatri' => $_POST['cuatrimestre']
                    );

                    $registro  = gruposModel::actualizarGrupMdl($datos);
                    return $registro;
                    
            }
        }

        static public function eliminaGrupoController($idg){


            if(isset($idg)){
                
                $eliminar =  gruposModel::eliminaGrupoMdl($idg);
                $eliminaDosifi = gruposModel::EliminaGruposDosifiMdl($idg);
                $eliminaAlumnosGrupos = gruposModel::eliminaAlumnosGrupos($idg);

            }
        }


        static public function cargaExcel($datosExcel){


            $hojaActual = $datosExcel['hojaActual'];
            $numeroFilas = $datosExcel['NoFilas'];
            $numeroColumnas = $datosExcel['NoColumnas'];
            $idgrupo = $datosExcel['idGrupo'];
            $grado = $datosExcel['grado'];


            $verificaGrupo = gruposModel::verificaDatosgruposMdl($idgrupo);

            if($verificaGrupo!= null){

                echo "Ya existen registros en este grupo";
            }else{

                for($fila = 1; $fila<= $numeroFilas; $fila++){

                    $valorNo = $hojaActual ->getCellByColumnAndRow( 1,$fila);
                    $valorNombre = $hojaActual ->getCellByColumnAndRow(2,$fila);
    
                    if($valorNo == null  ){
    
                        echo " No tiene numero de lista";
    
                    }else{
    
                        $alum=explode(" ",$valorNombre);

                        $validaAlumno = gruposModel::validaAlumnos($alum);


                        if($validaAlumno !=null){
    
                           $alumnoGrupos = gruposModel::registroAlumnoGruposMdl($validaAlumno['MATRICULA'],$idgrupo);
                          
                          echo '<tr>
  
                          <td>'.$valorNo.'</td>
  
                            <td>'. $validaAlumno['APELLIDOPATERNO'].' '. $validaAlumno['APELLIDOMATERNO'].' '. $validaAlumno['NOMBRE'].'<br><small>'. $validaAlumno['MATRICULA'].'</small></td>
                            <td>                          
                                <a href="#" class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                          </tr>';
                      }else{
  
  
                          echo '<tr>
  
                          <td>'.$valorNo.'</td>
  
                            <td class="table-danger">'.$alum[0].' '.$alum[1].' '.$alum[2].'<br><small>No existe en la base de datos, solicitar su registro para enlistarlo en el grupo</small></td>
                            <td>
                            
                                <a href="#" class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                          </tr>';
                      }
                    }
                }
               
            }
                                 
        }
        
        static public function elminaListaController($idcuatri, $grado){

            $datogrado = $grado-1;

            if(isset($_POST['idg'])){
                

                $verAlumnos = gruposModel::listaAlumnosGrupoMdl($_POST['idg']);

                foreach($verAlumnos as $alumno){

                    alumnosMdl::ActualizaGradoAlumnoMdl($alumno['MATRICULA'],$datogrado);
                }


                $vaciar = gruposModel::elminaListaMdl($_POST['idg'],$idcuatri);
                return $vaciar;

            }
        }

        static public function addAlumnoController($idgrupo,$idcuatri,$grado){

            if(isset($_POST['agregarAlumno'])){

                foreach($_POST['matricula'] as $mat){

                    gruposModel::addAlumnoMdl($mat,$idgrupo);

                   alumnosMdl::ActualizaGradoAlumnoMdl($mat,$grado);
                    
                }

            
                echo "<script>  window.location.href = index.php?url=gruposDetalle&idgrupo=".$idgrupo."&idcuatri=".$idcuatri."';</script>";

                   
                
            }
        }

        static public function filtrolistaGruposController($idcar,$idcuatri){

           
            $verlista = gruposModel::filtrolistaGruposMdl($idcar,$idcuatri);
            return $verlista;
        }

        static public function totalGruposController($maxCuatri, $idperso){

            $totalGrupo = gruposModel::totalGruposMdl($maxCuatri, $idperso);
            return $totalGrupo;
        }



    }

?>