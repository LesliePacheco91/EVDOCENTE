<?php

    class profesoresMdl extends Conexion{

        static public function registroMatMdl($datosMat){
           
           $stmt = Conexion::conectar()->prepare("INSERT INTO MATERIAS VALUES (null,:car,:nom,:gra,:obje,:ti,:stat)");
        
            $stmt->bindParam(":nom", $datosMat["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":car", $datosMat["car"], PDO::PARAM_INT);
            $stmt->bindParam(":gra", $datosMat["grado"], PDO::PARAM_INT);
            $stmt->bindParam(":obje", $datosMat["obje"], PDO::PARAM_STR);
            $stmt->bindParam(":ti", $datosMat["tipo"], PDO::PARAM_INT);
            $stmt->bindParam(":stat", $datosMat["estatus"], PDO::PARAM_INT);
            
            if($stmt->execute()){
                echo "<script>  window.location.href = 'profesores';</script>";
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            }
        }

        static public function listaCargaA(){

            $stmt = Conexion::conectar()->prepare("SELECT DISTINCT(DOSIFICACION.CVE_CAUTRIMESTRES),DOSIFICACION.CVE_PERSONAL, PERSONAL.NOMBRE, PERSONAL.APELLIDOMATERNO, PERSONAL.APELLIDOPATERNO, CUATRIMESTRES.ABREVIATURA from DOSIFICACION inner JOIN PERSONAL on DOSIFICACION.CVE_PERSONAL = PERSONAL.CVE_PERSONAL INNER JOIN CUATRIMESTRES on CUATRIMESTRES.CVE_CAUTRIMESTRES  = DOSIFICACION.CVE_CAUTRIMESTRES");

            
            $stmt -> execute();
             return $stmt->fetchAll();

        }

        static public function filtroProfesorMdl($datosProf){

           $stmt = Conexion::conectar()->prepare("SELECT * FROM PERSONAL WHERE NOMBRE = :nom AND APELLIDOPATERNO = :apeP AND APELLIDOMATERNO =:apeM ");

            $stmt->bindParam(":nom",$datosProf['nombre'], PDO::PARAM_STR); 
            $stmt->bindParam(":apeP",$datosProf['apeP'], PDO::PARAM_STR);
            $stmt->bindParam(":apeM",$datosProf['apeM'], PDO::PARAM_STR);
            
            $stmt -> execute();
            return $stmt->fetch();
            
        }

        static public function registroProfesorMdl($datosP){

            $stmt = Conexion::conectar()->prepare("INSERT INTO PERSONAL VALUES(null,:puesto,:dep,:nom,:aM,:aP,:rfc,:curp,:tel,:dir,:titu,:feNac,:contra,:img, :tipo,:gene,:email,:abrev,:priv)");
        
            $stmt->bindParam(":tipo", $datosP["tipo"], PDO::PARAM_STR);
            $stmt->bindParam(":nom", $datosP["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":dep", $datosP["depart"], PDO::PARAM_INT);
            $stmt->bindParam(":aP", $datosP["apeP"], PDO::PARAM_STR);
            $stmt->bindParam(":aM", $datosP["apeM"], PDO::PARAM_STR);
            $stmt->bindParam(":rfc", $datosP["rfc"], PDO::PARAM_STR);
            $stmt->bindParam(":curp", $datosP["curp"], PDO::PARAM_STR);
            $stmt->bindParam(":tel", $datosP["tel"], PDO::PARAM_STR);
            $stmt->bindParam(":gene", $datosP["gene"], PDO::PARAM_STR);
            $stmt->bindParam(":titu", $datosP["titu"], PDO::PARAM_STR);
            $stmt->bindParam(":abrev", $datosP["abrevia"], PDO::PARAM_STR);
            $stmt->bindParam(":feNac", $datosP["fechaN"], PDO::PARAM_STR);
            $stmt->bindParam(":dir", $datosP["dir"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datosP["email"], PDO::PARAM_STR);
            $stmt->bindParam(":contra", $datosP["contra"], PDO::PARAM_STR);
            $stmt->bindParam(":img", $datosP["img"], PDO::PARAM_STR);
            $stmt->bindParam(":priv", $datosP["privilegio"], PDO::PARAM_INT);
            $stmt->bindParam(":puesto", $datosP["puesto"], PDO::PARAM_INT);
            
            if($stmt->execute()){
                echo "<script>  window.location.href = 'profesores';</script>";
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            }
            

        }


        static public function detalleDecoMdl($idpersonal,$cuatri){

            $stmt = Conexion::conectar()->prepare("SELECT  CVE_DOSIFICACION, DOSIFICACION.CVE_CARRERAS, DOSIFICACION.CVE_MATERIAS, DOSIFICACION.CVE_GRUPOS, GRUPOS.GRADO, SECCION, MATERIAS.NOMBRE AS MATERIA, CARRERAS.ABREVIATURA from DOSIFICACION inner JOIN MATERIAS on DOSIFICACION.CVE_MATERIAS = MATERIAS.CVE_MATERIAS inner JOIN GRUPOS on DOSIFICACION.CVE_GRUPOS = GRUPOS.CVE_GRUPOS inner JOIN CARRERAS on CARRERAS.CVE_CARRERAS = DOSIFICACION.CVE_CARRERAS WHERE CVE_PERSONAL =:idpro  and DOSIFICACION.CVE_CAUTRIMESTRES = :idcua");

            $stmt->bindParam(":idpro",$idpersonal, PDO::PARAM_INT); 
            $stmt->bindParam(":idcua",$cuatri, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetchAll();
        }

        static public function listaProfesorMdl(){

            $stmt = Conexion::conectar()->prepare("SELECT * from PERSONAL WHERE CVE_PUESTOS = 1 or CVE_PUESTOS = 5  ORDER by APELLIDOPATERNO");
            $stmt -> execute();
             return $stmt->fetchAll();
        }

        static public function registroCargaController($dato){

                $stmt = Conexion::conectar()->prepare("INSERT INTO DOSIFICACION VALUES (NULL,:cuat,:carr,:profe,:mate,:grup)");
        
                $stmt->bindParam(":profe", $dato["profe"], PDO::PARAM_INT);
                $stmt->bindParam(":cuat", $dato["cuatri"], PDO::PARAM_INT);
                $stmt->bindParam(":carr", $dato["carrera"], PDO::PARAM_INT);
                $stmt->bindParam(":mate", $dato["materia"], PDO::PARAM_INT);
                $stmt->bindParam(":grup", $dato["grupo"], PDO::PARAM_INT);
                
                if($stmt->execute()){
                    echo "<script>  window.location.href = 'profesores';</script>";
                }else{
                    echo "ERROR DE REGISTRO INTENTA DE NUEVO";
                }
                
        }

        static public function eliminaDosificacionMdl($iddosifi){

            $stmt = Conexion::conectar()->prepare("DELETE FROM DOSIFICACION WHERE CVE_DOSIFICACION = :iddosi");
    
            $stmt->bindParam(":iddosi", $iddosifi, PDO::PARAM_INT);
            
            if($stmt->execute()){

                echo "<script>  window.location.href = 'profesores';</script>";
                
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            }

        }

        static public function eliminaProfesorDosifiMdl($idprof, $idcuatri){

            $stmt = Conexion::conectar()->prepare("DELETE FROM DOSIFICACION WHERE  CVE_PERSONAL =:idpro  and CVE_CAUTRIMESTRES=:idcua ");
    
            $stmt->bindParam(":idpro", $idprof, PDO::PARAM_INT);
            $stmt->bindParam(":idcua", $idcuatri, PDO::PARAM_INT);
            
            if($stmt->execute()){

                echo "<script>  window.location.href = 'profesores';</script>";
                
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            } 


        }

        public static function totalProfesorMdl($maxCuatri,$idamin){


            $stmt = Conexion::conectar()->prepare("SELECT COUNT(DISTINCT(DOSIFICACION.CVE_PERSONAL)) as TotalProf from DOSIFICACION inner JOIN EN_CARRERA_PERSONAL on DOSIFICACION.CVE_CARRERAS = EN_CARRERA_PERSONAL.CVE_CARRERA WHERE EN_CARRERA_PERSONAL.CVE_PERSONAL = :idadd and DOSIFICACION.CVE_CAUTRIMESTRES = :idcua");

             $stmt->bindParam(":idcua",$maxCuatri, PDO::PARAM_INT); 
              $stmt->bindParam(":idadd",$idamin, PDO::PARAM_INT); 

            
            $stmt -> execute();
            return $stmt->fetch();

        }

        public static function totalProfesGrupoMdl($idgrupo){

            $stmt = Conexion::conectar()->prepare("SELECT COUNT( DISTINCT(CVE_PERSONAL)) as cademicos from DOSIFICACION WHERE CVE_GRUPOS = :idgru");

             $stmt->bindParam(":idgru",$idgrupo, PDO::PARAM_INT); 
           
           $stmt -> execute();
           return $stmt->fetch();

        }
    }
?>