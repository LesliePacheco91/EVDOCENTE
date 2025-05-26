<?php

    class profesorController{

        public static function registroMatController(){

                if(isset($_POST['registroMat'])){

                        $datosMat = array('nombre'=>$_POST['nombre'],'car'=>$_POST['carrera'],'grado'=>$_POST['grado'],'obje'=>$_POST['objetivo'],'tipo'=>0,'estatus'=>1);

                        $registroMate = profesoresMdl::registroMatMdl($datosMat);
                        
                }
        }

        public static function registroProfesorController(){


                if(isset($_POST['registroProfe'])){

                        if($_POST['tipo']=="PA"){
                                $puesto = 1;
                        }else {
                                $puesto = 5;
                        }

                        $datosProf = array(
                                'tipo'=>$_POST['tipo'],
                                'nombre'=>$_POST['nombre'],
                                'depart'=>$_POST['dep'],
                                'apeP'=>$_POST['apeP'],
                                'apeM'=>$_POST['apeM'],
                                'rfc'=>$_POST['RFC'],
                                'curp'=>$_POST['curp'],
                                'tel'=>$_POST['tel'],
                                'gene'=>$_POST['genero'],
                                'titu'=>$_POST['titulo'],
                                'abrevia'=>$_POST['abreviaTitulo'],
                                'fechaN'=>$_POST['fechaNac'],
                                'dir'=>$_POST['direc'],
                                'email'=>$_POST['email'],
                                'contra'=>0,
                                'img'=>0,
                                'privilegio'=>0,
                                'puesto'=>$puesto
                        );

                        $validaProfe = profesoresMdl::filtroProfesorMdl($datosProf);

                        if(isset($validaProfe['CVE_PERSONAL'])){

                                echo '<div class="alert alert-warning" role="alert">El Profesor '.$validaProfe['NOMBRE'].' ya existe</div> ';
                        }else{
                                $registroProfesor = profesoresMdl::registroProfesorMdl($datosProf);
                        }
                       
                }
        }

        public static function listaCargaA(){


                $verlista =  profesoresMdl::listaCargaA();
                return $verlista;

        }

        public static function detalleDecoController($idpersonal,$cuatri){

                $verDeco = profesoresMdl::detalleDecoMdl($idpersonal,$cuatri);
                return $verDeco;
                
        }

        static public function listaProfesorController(){

                $verlista = profesoresMdl::listaProfesorMdl();
                return $verlista;

        }

        static public function registroCargaController(){

                if(isset($_POST['registro'])){
 
                       
                        for($con = 1; $con<= $_POST['cuentaCarga']; $con++){

                                $dato = array(

                                        'profe'=>$_POST['profe'],
                                        'cuatri'=>$_POST['cuatri'],
                                        'carrera'=>$_POST['carrera'.$con],
                                        'materia'=>$_POST['materia'.$con],
                                        'grupo'=>$_POST['grupo'.$con]
                                );
                        
                               $registro = profesoresMdl::registroCargaController($dato);
                              
                        }


                }

        }
        

        public static function eliminaDosificacionController($iddosifi){


                if(isset($iddosifi)){


                        $elimina = profesoresMdl::eliminaDosificacionMdl($iddosifi);

                }
        }


        public static function eliminaProfesorDosifiController($idprof, $idcuatri){

                $elimina = profesoresMdl::eliminaProfesorDosifiMdl($idprof, $idcuatri);

                
        }

        public static function totalProfesorController($maxCuatri,$idadmin) {


                $totalProfe = profesoresMdl::totalProfesorMdl($maxCuatri,$idadmin);  
                return $totalProfe;

        }

        public static function totalProfesGrupoController($idgrupo){

                if(isset($idgrupo)){


                        $totalProfe = profesoresMdl::totalProfesGrupoMdl($idgrupo);
                        return $totalProfe;
                }

        }

    }

?>