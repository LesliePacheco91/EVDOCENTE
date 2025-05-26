<?php 
require_once "conexion.php";
    class gruposModel extends Conexion {

        static public function listagruposMdl($tbl,$idusuario){


           $stmt = Conexion::conectar()->prepare("SELECT  GRUPOS.CVE_CARRERAS, CARRERAS.ABREVIATURA as carrera, GRUPOS.GRADO, GRUPOS.SECCION, GRUPOS.CVE_GRUPOS, CUATRIMESTRES.ABREVIATURA AS cuatri, CUATRIMESTRES.CVE_CAUTRIMESTRES  from GRUPOS inner JOIN CUATRIMESTRES on GRUPOS.CVE_CAUTRIMESTRES = CUATRIMESTRES.CVE_CAUTRIMESTRES inner JOIN CARRERAS on GRUPOS.CVE_CARRERAS = CARRERAS.CVE_CARRERAS inner JOIN EN_CARRERA_PERSONAL on CARRERAS.CVE_CARRERAS = EN_CARRERA_PERSONAL.CVE_CARRERA  WHERE EN_CARRERA_PERSONAL.CVE_PERSONAL =  :iduser ");

           $stmt->bindParam(":iduser",$idusuario, PDO::PARAM_INT); 
           $stmt -> execute();
            return $stmt->fetchAll();
        }

        static public function listagrupos1Mdl(){

            $stmt = Conexion::conectar()->prepare("SELECT CVE_GRUPOS, GRADO,SECCION, CVE_CAUTRIMESTRES from GRUPOS ORDER BY CVE_CARRERAS DESC LIMIT 1;");

           $stmt -> execute();
            return $stmt->fetchAll();


        }

        static public function listaAlumnosGrupoMdl($idgrupo){


            $stmt = Conexion::conectar()->prepare("SELECT * FROM ALUMNO_GRUPOS inner JOIN GRUPOS  on ALUMNO_GRUPOS.CVE_GRUPO = GRUPOS.CVE_GRUPOS INNER JOIN ALUMNOS on ALUMNOS.MATRICULA = ALUMNO_GRUPOS.MATRICULA WHERE CVE_GRUPO = :idgrupo ORDER by ALUMNOS.APELLIDOPATERNO ASC");
            
            $stmt->bindParam(":idgrupo", $idgrupo, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetchAll();

        }

        static public function filtroGruposMdl($idgrupo){


            $stmt = Conexion::conectar()->prepare("SELECT * from GRUPOS inner JOIN CUATRIMESTRES on GRUPOS.CVE_CAUTRIMESTRES = CUATRIMESTRES.CVE_CAUTRIMESTRES INNER JOIN CARRERAS on GRUPOS.CVE_CARRERAS = CARRERAS.CVE_CARRERAS WHERE GRUPOS.CVE_GRUPOS = :idgrupo");

            $stmt->bindParam(":idgrupo", $idgrupo, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetch();
            
        }

        static public function verificaGrupo($datos){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM GRUPOS WHERE GRADO = :grado and SECCION = :seccion and CVE_CARRERAS = :idCa and CVE_CAUTRIMESTRES = :idCu");
    
            $stmt->bindParam(":grado", $datos["grado"], PDO::PARAM_INT);
            $stmt->bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);
            $stmt->bindParam(":idCa", $datos["idCarrera"], PDO::PARAM_INT);
            $stmt->bindParam(":idCu", $datos["idCuatri"], PDO::PARAM_INT);
              
            $stmt -> execute();
            return $stmt->fetch();
        }

        static public function registroGrupoMdl($datos){


            $stmt = Conexion::conectar()->prepare("INSERT INTO GRUPOS VALUES(null,:idCa,:idCu,:grado,:seccion)");
    
            $stmt->bindParam(":grado", $datos["grado"], PDO::PARAM_INT);
            $stmt->bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);
            $stmt->bindParam(":idCa", $datos["idCarrera"], PDO::PARAM_INT);
            $stmt->bindParam(":idCu", $datos["idCuatri"], PDO::PARAM_INT);
              
    
            if($stmt->execute()){

               echo "<script>  window.location.href = 'grupos';</script>";
            }
            
        }

        public static function actualizarGrupMdl($datos){


            $stmt = Conexion::conectar()->prepare("UPDATE GRUPOS SET CVE_CARRERAS=:idCa, CVE_CAUTRIMESTRES=:idCu, GRADO=:grado, SECCION=:seccion WHERE CVE_GRUPOS=:idg ");
    
            $stmt->bindParam(":idg", $datos["idg"], PDO::PARAM_INT);
            $stmt->bindParam(":grado", $datos["grado"], PDO::PARAM_INT);
            $stmt->bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);
            $stmt->bindParam(":idCa", $datos["idCarrera"], PDO::PARAM_INT);
            $stmt->bindParam(":idCu", $datos["idCuatri"], PDO::PARAM_INT);
              
    
            if($stmt->execute()){

                echo "<script>  window.location.href = 'grupos';</script>";
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            }
        }

        static public function eliminaGrupoMdl($idg){

            $stmt = Conexion::conectar()->prepare("DELETE FROM GRUPOS  WHERE CVE_GRUPOS = :idg");
    
            $stmt->bindParam(":idg", $idg, PDO::PARAM_INT);
            
            if($stmt->execute()){

                echo "<script>  window.location.href = 'grupos';</script>";
                
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            }


        }

        static public function EliminaGruposDosifiMdl($idGrupo){

            
            $stmt = Conexion::conectar()->prepare("DELETE FROM DOSIFICACION WHERE CVE_GRUPOS = :idg");
    
            $stmt->bindParam(":idg", $idGrupo, PDO::PARAM_INT);
            
            if($stmt->execute()){

                echo "<script>  window.location.href = 'grupos';</script>";
                
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            }

        }

        static public function verificaDatosgruposMdl($idgrupo){


            $stmt = Conexion::conectar()->prepare("SELECT * FROM ALUMNO_GRUPOS WHERE CVE_GRUPO = :idgrupo");

            $stmt->bindParam(":idgrupo", $idgrupo, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetch();
        }

        static public function validaAlumnos($alumno){

           
            $nombre = '%'.$alumno[2].'%';

            $stmt = Conexion::conectar()->prepare("SELECT * from ALUMNOS WHERE APELLIDOPATERNO = :app and APELLIDOMATERNO =:apm and NOMBRE like :nom ");

            $stmt->bindParam(":app", $alumno[0], PDO::PARAM_STR);
            $stmt->bindParam(":apm", $alumno[1], PDO::PARAM_STR);
            $stmt->bindParam(":nom", $nombre, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt->fetch();
            

        }

        // REGISTRO DEL ALUMNO AL GRUPO
        static public function registroAlumnoGruposMdl($alumno,$grupo){

            $stmt = Conexion::conectar()->prepare("INSERT INTO ALUMNO_GRUPOS VALUES(:matri,:idg)");
    
            $stmt->bindParam(":idg", $grupo, PDO::PARAM_INT);
            $stmt->bindParam(":matri", $alumno, PDO::PARAM_STR);
            if($stmt->execute()){

                return true;
            }else{
                return false ;
            }

        }
        
        static public function addAlumnoMdl($matricula,$idg){

            $stmt = Conexion::conectar()->prepare("INSERT INTO ALUMNO_GRUPOS VALUES(:mat,:idg)");
    
            $stmt->bindParam(":mat", $matricula, PDO::PARAM_STR);
            $stmt->bindParam(":idg", $idg, PDO::PARAM_INT);

            $stmt->execute();
        }
       
        static public function elminaListaMdl($idgrupo,$idcuatri){

            $stmt = Conexion::conectar()->prepare("DELETE FROM ALUMNO_GRUPOS WHERE CVE_GRUPO =:idg ");
    
            $stmt->bindParam(":idg", $idgrupo, PDO::PARAM_INT);
            
            if($stmt->execute()){

                echo "<script>  window.location.href = 'https://utdelmayab.edu.mx/EVDOCENTE/index.php?url=gruposDetalle&idgrupo=".$idgrupo."&idcuatri=".$idcuatri."';</script>";
                
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            }

        }

        


        static public function filtrolistaGruposMdl($idcar,$idcuatri){

            $stmt = Conexion::conectar()->prepare("SELECT * from GRUPOS inner JOIN CARRERAS on GRUPOS.CVE_CARRERAS = CARRERAS.CVE_CARRERAS WHERE GRUPOS.CVE_CAUTRIMESTRES = :idcu and CARRERAS.CVE_CARRERAS = :idca");

           
            
            $stmt->bindParam(":idca", $idcar, PDO::PARAM_INT);
            $stmt->bindParam(":idcu", $idcuatri, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetchAll();
        }

        static public function totalGruposMdl($maxCuatri, $idperso){


            $stmt = Conexion::conectar()->prepare("SELECT COUNT(CVE_GRUPOS) as totalGrupos FROM GRUPOS inner JOIN EN_CARRERA_PERSONAL on GRUPOS.CVE_CARRERAS = EN_CARRERA_PERSONAL.CVE_CARRERA WHERE CVE_PERSONAL = :idperso and CVE_CAUTRIMESTRES = :idcua");
            
            $stmt->bindParam(":idcua", $maxCuatri, PDO::PARAM_INT);
            $stmt->bindParam(":idperso", $idperso, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetch();

        }


        static public function eliminaAlumnosGrupos($idgrupo){

            $stmt = Conexion::conectar()->prepare("DELETE FROM ALUMNO_GRUPOS WHERE CVE_GRUPO  =:idg ");
    
            $stmt->bindParam(":idg", $idgrupo, PDO::PARAM_INT);
            
            if($stmt->execute()){

                echo "<script>  window.location.href = 'grupos';</script>";
                
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            }

        }

    }
?>