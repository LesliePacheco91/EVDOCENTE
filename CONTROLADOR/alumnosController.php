<?php 

class alumnosController{

    static public function eliminaAlumnoController($mat,$idg, $idcua,$grado){

        if(isset($mat)){

            $nuevoGrado = $grado-1;

            alumnosMdl::eliminaAlumnoMdl($mat, $idg, $idcua);
            alumnosMdl::ActualizaGradoAlumnoMdl($mat,$nuevoGrado);
        
        }
     
    }
    
    static public function alumnosSinGrupoController($idcarrera,$grado){
        
        

        if(isset($idcarrera)){
            
            
            $alumnosSingrupo = alumnosMdl::alumnosSinGrupoMdl($idcarrera,$grado);
            return $alumnosSingrupo;

        }
        
    }

    
       static public function totalAlumnosController($maxCuatri, $idadmin){

            if(isset($maxCuatri)){

                $suma = 0;

               $carreras = MCVloginMdl::carerasMdl($idadmin);
               foreach($carreras as $car){

                $verAlumnos = alumnosMdl::totalAlumnosMdl($maxCuatri, $car['CVE_CARRERAS']);

                $suma = $suma +$verAlumnos['TOTALALUMNOS'];

               }

               return $suma;


               
            }
        }

        static public function totalAlumnosGrupoController($idgrupo){

            $totalAlumnos = alumnosMdl::totalAlumnosGrupoMdl($idgrupo);
            return $totalAlumnos;
        }

        static public function registroAlumnoBdController(){
            

                if(isset($_POST['AgregarAlBD'])){
                    
                    $fecha = date('Y-m-d');

                    $datos = array(

                        'apeP'=>$_POST['apeP'],
                        'apeM'=>$_POST['apeM'],
                        'nom'=>$_POST['nomre'],
                        'matric'=>$_POST['matricula'],
                        'genero'=>$_POST['genero'],
                        'grado'=>$_POST['grado'],
                        'idgrupo'=>$_POST['grupo'],
                        'idcarrera'=>$_POST['carrera'],
                        'idcuat'=>$_POST['cuatri'],
                        'fecha'=>$fecha
                        
                    );
                    
                    $validaRegistro = alumnosMdl::validaAlumnoDBMdl($_POST['matricula']);
                    
                    if($validaRegistro != 0){
                        
                        echo '<div class="alert alert-warning">ya existe este usuario en la base de datos</div>';
                        
                    }else{
                        $registro = alumnosMdl::registroAlumnoBdMdl($datos);
                        
                        if($registro == true){
                            
                             $agregarGrupo = gruposModel::addAlumnoMdl($_POST['matricula'],$_POST['grupo']);
                             
                             if($agregarGrupo == true){
                                
                                return "se ha registrado el alumno";
                             }
                        }
                    }

                        
                }

        }

        public static function modificarDatosAlController(){

            if(isset($_POST['modificarDatosAlumno'])){

                $datosAl = array(

                    'nombre'=>$_POST['nomre'],
                    'app'=>$_POST['apeP'],
                    'apm'=>$_POST['apeM'],
                    'matri'=>$_POST['matricula'],
                );
                alumnosMdl::modificarDatosAlMdl($datosAl);

            }

        }


}

?>