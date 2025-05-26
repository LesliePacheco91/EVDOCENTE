<?php 

    class alumnosMdl extends Conexion{

        static public function eliminaAlumnoMdl($mat,$idg, $idcua){

            $stmt = Conexion::conectar()->prepare("DELETE FROM ALUMNO_GRUPOS WHERE MATRICULA =:mat ");
    
            $stmt->bindParam(":mat", $mat, PDO::PARAM_STR);
            
            if($stmt->execute()){

                echo "<script>  window.location.href = 'index.php?url=gruposDetalle&idgrupo=".$idg."&idcuatri=".$idcua."';</script>";
                
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            }
        }
        
        // verifica si existe el alumno en la base de datos
        static public function validaAlumnoDBMdl($matricula){
            
            $stmt = Conexion::conectar()->prepare("SELECT * from ALUMNOS WHERE MATricula = :mat");

            $stmt->bindParam(":mat", $matricula, PDO::PARAM_STR);
            
            $stmt -> execute();
            return $stmt->fetch();
        }
        
        static public function validaAlumnoGrupoMdl($matricula){
            $stmt = Conexion::conectar()->prepare("SELECT * from ALUMNO_GRUPOS WHERE MATRICULA = :mat");

            $stmt->bindParam(":mat", $matricula, PDO::PARAM_STR);
            
            $stmt -> execute();
            return $stmt->fetch();
        }

        static public function alumnosSinGrupoMdl($idca,$grado){


            $stmt = Conexion::conectar()->prepare("SELECT APELLIDOPATERNO, APELLIDOMATERNO, ALUMNOS.NOMBRE, CARRERAS.NOMBRE as CARRERA, MATRICULA from ALUMNOS INNER JOIN CARRERAS on CARRERAS.CVE_CARRERAS = ALUMNOS.CVE_CARRERAS WHERE GRADO < :grado and CARRERAS.CVE_CARRERAS = :idca  ORDER by APELLIDOPATERNO ASC");

            $stmt->bindParam(":idca", $idca, PDO::PARAM_INT);
            $stmt->bindParam(":grado", $grado, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetchAll();
        }

        static public function totalAlumnosMdl($maxCuatri, $idcar){


            $stmt = Conexion::conectar()->prepare("SELECT COUNT(MATRICULA) as TOTALALUMNOS from ALUMNO_GRUPOS INNER JOIN GRUPOS on ALUMNO_GRUPOS.CVE_GRUPO = GRUPOS.CVE_GRUPOS WHERE GRUPOS.CVE_CAUTRIMESTRES = :idcu and GRUPOS.CVE_CARRERAS =:idca ");

            $stmt->bindParam(":idca", $idcar, PDO::PARAM_INT);
            $stmt->bindParam(":idcu", $maxCuatri, PDO::PARAM_INT);

            $stmt -> execute();
            return $stmt->fetch();
        

        }

        static public function totalAlumnosGrupoMdl($idgrupo){

            $stmt = Conexion::conectar()->prepare("SELECT COUNT(MATRICULA) as totalAlumnos FROM ALUMNO_GRUPOS WHERE CVE_GRUPO = :idgru");

            $stmt->bindParam(":idgru", $idgrupo, PDO::PARAM_INT);

            $stmt -> execute();
            return $stmt->fetch();

        }

        static public function ActualizaGradoAlumnoMdl($matricula,$grado) {

            $stmt = Conexion::conectar()->prepare("UPDATE ALUMNOS SET GRADO = :grado  WHERE MATRICULA = :mat ");

            $stmt->bindParam(":mat", $matricula, PDO::PARAM_STR);
            $stmt->bindParam(":grado", $grado, PDO::PARAM_INT);

            $stmt -> execute();
            return $stmt->fetch();
            
        }

        static public function registroAlumnoBdMdl($datos){


            $stmt = Conexion::conectar()->prepare("INSERT INTO ALUMNOS VALUES(null, :nom, :app, :apm, :mat, :fecha, :idcar, '0', :gen, '0', '0', '0', 0, 0,'0', '0', 0, '0', 0,'0', 0, 0, 0, 0, 0, '0', '0', 0, '0', '0', '0', '0', '0', '0', '0', '0',0, :grado, '0', '0', 0, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0',:fecha, '0', '0') ");
    
            $stmt->bindParam(":app", $datos["apeP"], PDO::PARAM_STR);
            $stmt->bindParam(":apm", $datos["apeM"], PDO::PARAM_STR);
            $stmt->bindParam(":nom", $datos["nom"], PDO::PARAM_STR);
            $stmt->bindParam(":mat", $datos["matric"], PDO::PARAM_STR);
            $stmt->bindParam(":gen", $datos["genero"], PDO::PARAM_STR);
            $stmt->bindParam(":grado", $datos["grado"], PDO::PARAM_INT);
            $stmt->bindParam(":idcar", $datos["idcarrera"], PDO::PARAM_INT);
            $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
              
            if($stmt->execute()){
                
                return true;

            }else{
                return false;
            }
        }

        static public function modificarDatosAlMdl($datos){

            $stmt = Conexion::conectar()->prepare("UPDATE ALUMNOS SET NOMBRE=:nom, APELLIDOPATERNO=:app, APELLIDOMATERNO=:apm WHERE MATRICULA=:mat");

            $stmt->bindParam(":nom", $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(":app", $datos['app'], PDO::PARAM_STR);
            $stmt->bindParam(":apm", $datos['apm'], PDO::PARAM_STR);
            $stmt->bindParam(":mat", $datos['matri'], PDO::PARAM_STR);

            $stmt -> execute();
            return $stmt->fetch();

            
        }

    }

?>