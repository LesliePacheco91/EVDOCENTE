<?php 
    class evaluacionMdl extends Conexion {
        
        static public function maxEvMdl($idpersonal){
            
            $stmt = Conexion::conectar()->prepare("SELECT max(CVE_CUATRIMESTRE) as maxCuatri fROM EN_REGISTRO_EVALUACIONES inner JOIN EN_CARRERA_PERSONAL on EN_CARRERA_PERSONAL.CVE_CARRERA_PERSONAL = EN_REGISTRO_EVALUACIONES.CVE_CARRERA_PERSONAL WHERE EN_CARRERA_PERSONAL.CVE_PERSONAL = :id");

            $stmt->bindParam(":id", $idpersonal, PDO::PARAM_INT);

            $stmt -> execute();
            return $stmt->fetch();
        }


        static public function listaEvMdl($idpersonal){

            $stmt = Conexion::conectar()->prepare("SELECT ID_EVALUACION, EN_TIPO_ENCUESTAS.CVE_ENCUESTAS, EN_TIPO_ENCUESTAS.TITULO_ENCUESTA, EN_REGISTRO_EVALUACIONES.INICIO, ETIQUETA, EN_REGISTRO_EVALUACIONES.FIN,EN_REGISTRO_EVALUACIONES.CVE_CUATRIMESTRE, CUATRIMESTRES.ABREVIATURA as cuatri, CARRERAS.ABREVIATURA as carrera, EN_CARRERA_PERSONAL.CVE_CARRERA_PERSONAL FROM EN_REGISTRO_EVALUACIONES INNER JOIN EN_CARRERA_PERSONAL ON EN_REGISTRO_EVALUACIONES.CVE_CARRERA_PERSONAL = EN_CARRERA_PERSONAL.CVE_CARRERA_PERSONAL INNER JOIN CARRERAS ON EN_CARRERA_PERSONAL.CVE_CARRERA = CARRERAS.CVE_CARRERAs INNER JOIN CUATRIMESTRES ON EN_REGISTRO_EVALUACIONES.CVE_CUATRIMESTRE = CUATRIMESTRES.CVE_CAUTRIMESTRES INNER JOIN EN_TIPO_ENCUESTAS ON EN_REGISTRO_EVALUACIONES.CVE_ENCUESTAS = EN_TIPO_ENCUESTAS.CVE_ENCUESTAS WHERE CVE_PERSONAL = :id");

            $stmt->bindParam(":id", $idpersonal, PDO::PARAM_INT);

            $stmt -> execute();
            return $stmt->fetchAll();

        }

        static public function listaEncuaestasMdl($dep){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM EN_TIPO_ENCUESTAS WHERE CVE_DEPARTAMENTOS = :dep ");

            $stmt->bindParam(":dep", $dep, PDO::PARAM_INT);

            $stmt -> execute();
            return $stmt->fetchAll();
        }


        static public function validaRegistroEvaluacionModl($tipo,$cuatri,$admin){

            
            $stmt = Conexion::conectar()->prepare("SELECT * from EN_REGISTRO_EVALUACIONES WHERE CVE_ENCUESTAS = :tipo and CVE_CUATRIMESTRE = :cuatri and CVE_CARRERA_PERSONAL = :adm");

            $stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
            $stmt->bindParam(":cuatri", $cuatri, PDO::PARAM_INT);
            $stmt->bindParam(":adm", $admin, PDO::PARAM_INT);

            $stmt -> execute();
            return $stmt->fetch();
            
        }

        static public function nuevaEvController($dato){
           
           $stmt = Conexion::conectar()->prepare("INSERT INTO EN_REGISTRO_EVALUACIONES VALUES(null, :tipo, :cua, :admi, :feI, :feF, :eti,:estatus)"); 
    
            $stmt->bindParam(":tipo", $dato["tipo"], PDO::PARAM_INT);
            $stmt->bindParam(":feI", $dato["fechaI"], PDO::PARAM_STR);
            $stmt->bindParam(":feF", $dato["fechaF"], PDO::PARAM_STR);
            $stmt->bindParam(":cua", $dato["cuatri"], PDO::PARAM_INT);
            $stmt->bindParam(":admi", $dato["admin"], PDO::PARAM_INT);
            $stmt->bindParam(":eti", $dato["etiqueta"], PDO::PARAM_STR);
            $stmt->bindParam(":estatus",$dato['estatus'], PDO::PARAM_INT);
              
    
            if($stmt->execute()){

                echo "<script>  window.location.href = 'inicio';</script>";
            }

        }

        public static function actualizaAgendaMdl($dato){

            $stmt = Conexion::conectar()->prepare("UPDATE EN_REGISTRO_EVALUACIONES SET CVE_ENCUESTAS=:tipo, CVE_CUATRIMESTRE=:cua,CVE_CARRERA_PERSONAL=:admi,INICIO=:feI, FIN=:feF, ETIQUETA=:eti WHERE ID_EVALUACION=:id"); 
    
            $stmt->bindParam(":id", $dato['idev'], PDO::PARAM_INT);
            $stmt->bindParam(":tipo", $dato["tipo"], PDO::PARAM_INT);
            $stmt->bindParam(":feI", $dato["fechaI"], PDO::PARAM_STR);
            $stmt->bindParam(":feF", $dato["fechaF"], PDO::PARAM_STR);
            $stmt->bindParam(":cua", $dato["cuatri"], PDO::PARAM_INT);
            $stmt->bindParam(":admi", $dato["admin"], PDO::PARAM_INT);
            $stmt->bindParam(":eti", $dato["etiqueta"], PDO::PARAM_STR);
           
            if($stmt->execute()){
                echo "<script>  window.location.href = 'inicio';</script>";
            }

        }

        public static function elininaEvMdl($id){

            $stmt = Conexion::conectar()->prepare("DELETE FROM EN_REGISTRO_EVALUACIONES WHERE ID_EVALUACION = :id"); 
    
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);      
    
            if($stmt->execute()){
                echo "<script>  window.location.href = 'inicio';</script>";
            }

        }

        static public function CuatrisEvaluadosMdl($max,$idperson){

            $stmt = Conexion::conectar()->prepare("SELECT DISTINCT(CUATRIMESTRES.DESCRIPCION), CUATRIMESTRES.CVE_CAUTRIMESTRES from EN_EVALUADOR inner JOIN CUATRIMESTRES on EN_EVALUADOR.CVE_CUATRIMESTRE = CUATRIMESTRES.CVE_CAUTRIMESTRES WHERE CVE_CARRERA_PERSONAL =:per ORDER BY CUATRIMESTRES.CVE_CAUTRIMESTRES DESC LIMIT :max");
            
            $stmt->bindParam(":max",$max, PDO::PARAM_INT); 
            $stmt->bindParam(":per",$idperson, PDO::PARAM_INT); 
            
            $stmt -> execute();
             return $stmt->fetchAll();

        }

        static public function listaPlanMdl($cua,$car){

            $stmt = Conexion::conectar()->prepare("SELECT * from EN_EVALUADOR INNER JOIN PERSONAL on EN_EVALUADOR.CVE_PERSONAL = PERSONAL.CVE_PERSONAL WHERE CVE_CARRERA_PERSONAL = :ca and CVE_CUATRIMESTRE = :cu");
            
            $stmt->bindParam(":cu",$cua, PDO::PARAM_INT); 
            $stmt->bindParam(":ca",$car, PDO::PARAM_INT);
            
            $stmt -> execute();
             return $stmt->fetchAll();

        }

        static public function listaPlanDetalleMdl($idev){

            $stmt = Conexion::conectar()->prepare("SELECT concat(PERSONAL.APELLIDOPATERNO,' ',PERSONAL.APELLIDOMATERNO,' ',PERSONAL.NOMBRE) as PROFESOR, MATERIAS.NOMBRE as MATERIA, MATERIAS.CVE_MATERIAS, EN_DETALLE_EVALUADOR.FECHA_EVALUAR,CVE_EVALUADO ,PERSONAL.CVE_PERSONAL from EN_DETALLE_EVALUADOR INNER JOIN PERSONAL on EN_DETALLE_EVALUADOR.CVE_PERSONAL = PERSONAL.CVE_PERSONAL LEFT JOIN MATERIAS on EN_DETALLE_EVALUADOR.CVE_MATERIA = MATERIAS.CVE_MATERIAS WHERE CVE_EVALUADOR = :ev");
            
            $stmt->bindParam(":ev",$idev, PDO::PARAM_INT); 
            
            $stmt -> execute();
             return $stmt->fetchAll();
        }

        static public function registroPlanMdl($dato){

            $stmt = Conexion::conectar()->prepare("DELETE FROM DOSIFICACION WHERE  CVE_PERSONAL =:idpro  and CVE_CAUTRIMESTRES=:idcua ");
    
            $stmt->bindParam(":idpro", $dato['observa'], PDO::PARAM_INT);
            $stmt->bindParam(":idcua", $dato['cuatri'], PDO::PARAM_INT);
            $stmt->bindParam(":idpro", $dato['profe'], PDO::PARAM_INT);
            $stmt->bindParam(":idpro", $dato[''], PDO::PARAM_INT);
            $stmt->bindParam(":idpro", $dato[''], PDO::PARAM_INT);
            
            if($stmt->execute()){

                echo "<script>  window.location.href = 'profesores';</script>";
                
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            } 
            
        }


        static public function ValidaPlanMdl($datos){


            $stmt = Conexion::conectar()->prepare("SELECT * FROM EN_EVALUADOR WHERE CVE_PERSONAL= :ob AND CVE_CUATRIMESTRE = :cua");
            
            $stmt->bindParam(":ob",$datos['observa'], PDO::PARAM_INT);
            $stmt->bindParam(":cua",$datos['cuatri'], PDO::PARAM_INT); 
            
            $stmt -> execute();
             return $stmt->fetch();

        }

        static public function registroObservaMdl($dob){

            $stmt = Conexion::conectar()->prepare("INSERT INTO EN_EVALUADOR  VALUES(null, :en, :ob, :per, :cuat)");
        
            $stmt->bindParam(":ob", $dob["observa"], PDO::PARAM_INT);
            $stmt->bindParam(":cuat", $dob["cuatri"], PDO::PARAM_INT);
            $stmt->bindParam(":per", $dob["perso"], PDO::PARAM_INT);
            $stmt->bindParam(":en", $dob["ecuesta"], PDO::PARAM_INT);
            
    
            if($stmt->execute()){
                    
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            }

        }


        static public function registroEvaluadoMdl($datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO EN_DETALLE_EVALUADOR VALUES (null, :pro, :cuat, :ob, :fev, :mat, :est)");
        
            $stmt->bindParam(":pro", $datos["profe"], PDO::PARAM_INT);
            $stmt->bindParam(":cuat",$datos["cuatri"], PDO::PARAM_INT);
            $stmt->bindParam(":ob", $datos["observador"], PDO::PARAM_INT);
            $stmt->bindParam(":fev", $datos["feEv"], PDO::PARAM_STR);
            $stmt->bindParam(":mat", $datos["materia"], PDO::PARAM_INT);
            $stmt->bindParam(":est", $datos["estatus"], PDO::PARAM_INT);
           
    
            if($stmt->execute()){
                echo "<script>  window.location.href = 'evaluadores';</script>";
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            }

            
        }

        public static function ActualizaPlanMdl($dato,$idevaluador){

            $stmt = Conexion::conectar()->prepare("UPDATE EN_DETALLE_EVALUADOR SET  CVE_PERSONAL =:per, CVE_CUATRIMESTRE =:cua,CVE_EVALUADOR=:ob,FECHA_EVALUAR=:fe,CVE_MATERIA=:mat  WHERE CVE_EVALUADO =:idev"); 
    
            $stmt->bindParam(":ob", $idevaluador, PDO::PARAM_INT);
            $stmt->bindParam(":per", $dato["evaluado"], PDO::PARAM_INT);
            $stmt->bindParam(":cua", $dato["cuatri"], PDO::PARAM_STR);
            $stmt->bindParam(":fe", $dato["fecha"], PDO::PARAM_STR);
            $stmt->bindParam(":mat", $dato["materia"], PDO::PARAM_INT);
            $stmt->bindParam(":idev", $dato["idEvaluado"], PDO::PARAM_INT);
           
            if($stmt->execute()){
                echo "<script>  window.location.href = 'evaluadores';</script>";
            }

        }

        public static function EliminaEvaluadoMdl($idEv){

            $stmt = Conexion::conectar()->prepare("DELETE FROM EN_DETALLE_EVALUADOR WHERE CVE_EVALUADO =:id"); 
    
            $stmt->bindParam(":id", $idEv, PDO::PARAM_INT);      
    
            if($stmt->execute()){
                echo "<script>  window.location.href = 'evaluadores';</script>";
            }

        }

        public static function consultaEncuestaMdl($id){

            $stmt = Conexion::conectar()->prepare("SELECT * from EN_TIPO_ENCUESTAS WHERE CVE_ENCUESTAS = :id");
            
            $stmt->bindParam(":id",$id, PDO::PARAM_INT);
            
            $stmt -> execute();
             return $stmt->fetch();

        }

        public static function consultaPreguntasMdl($id){

            $stmt = Conexion::conectar()->prepare("SELECT * from EN_DETALLE_ENCUESTA inner JOIN EN_PREGUNTAS on EN_DETALLE_ENCUESTA.CVE_PREGUNTA = EN_PREGUNTAS.CVE_PREGUNTAS WHERE CVE_ENCUESTA = :id ORDER by CVE_LISTA ASC");
            
            $stmt->bindParam(":id",$id, PDO::PARAM_INT);
            
            $stmt -> execute();
             return $stmt->fetchAll();
        }

        public static function opcionesMdl($idpre){

            $stmt = Conexion::conectar()->prepare(" SELECT * FROM EN_DETALLE_PREGUNTAS WHERE CVE_PREGUNTA = :id ORDER BY VALOR ASC");
            
            $stmt->bindParam(":id",$idpre, PDO::PARAM_INT);
            
            $stmt -> execute();
             return $stmt->fetchAll();
        }

        public static function profesEvaluadosMdl($cuatri, $admin){


            $stmt = Conexion::conectar()->prepare("SELECT * FROM EN_RESULTADO_DDC inner JOIN PERSONAL on EN_RESULTADO_DDC.CVE_PERSONAL = PERSONAL.CVE_PERSONAL WHERE CVE_CUATRIMESTRE = :cua and CVE_CARRERA_PERSONAL = :admin");
            
            $stmt->bindParam(":cua",$cuatri, PDO::PARAM_INT);
            $stmt->bindParam(":admin",$admin, PDO::PARAM_INT);
            
            $stmt -> execute();
             return $stmt->fetchAll();
        }


        public static function ValidaEvaluadorMdl($idevaluador){

            $stmt = Conexion::conectar()->prepare("SELECT COUNT(CVE_EVALUADO) as TotalEvaluados from EN_DETALLE_EVALUADOR WHERE CVE_EVALUADOR = :idevaluador");
            
            $stmt->bindParam(":idevaluador", $idevaluador, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetch();

        }

        public static function EliminaEvaluadorMdl($idevaluador){


            $stmt = Conexion::conectar()->prepare("DELETE FROM EN_EVALUADOR WHERE CVE_EVALUADOR = :id"); 
    
            $stmt->bindParam(":id", $idevaluador, PDO::PARAM_INT);      
    
            if($stmt->execute()){
               echo "eliminado";
            }

        }

        public static function TotalEvaluadorMdl($maxCuatri,$idperson) {
            

            $stmt = Conexion::conectar()->prepare("SELECT COUNT(CVE_EVALUADOR) as TotalEvaluador from EN_EVALUADOR inner JOIN EN_CARRERA_PERSONAL on EN_EVALUADOR.CVE_CARRERA_PERSONAL = EN_CARRERA_PERSONAL.CVE_CARRERA_PERSONAL WHERE EN_CARRERA_PERSONAL.CVE_PERSONAL = :idadmin and EN_EVALUADOR.CVE_CUATRIMESTRE = :idcuatri");
            
            $stmt->bindParam(":idcuatri", $maxCuatri, PDO::PARAM_INT);
            $stmt->bindParam(":idadmin", $idperson, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetch();

        }

        public static function totalEvaluacionesMdl($maxCuatri,$idperson){

            $stmt = Conexion::conectar()->prepare("SELECT COUNT(ID_EVALUACION) as Evaluaciones from EN_REGISTRO_EVALUACIONES inner JOIN EN_CARRERA_PERSONAL on EN_REGISTRO_EVALUACIONES.CVE_CARRERA_PERSONAL = EN_CARRERA_PERSONAL.CVE_CARRERA_PERSONAL WHERE EN_CARRERA_PERSONAL.CVE_PERSONAL = :idadmin and CVE_CUATRIMESTRE = :idcuatri");
            
            $stmt->bindParam(":idcuatri", $maxCuatri, PDO::PARAM_INT);
            $stmt->bindParam(":idadmin", $idperson, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetch();

        }

        public static function totalEevaluacionesAlumnosMdl($idgrupo, $idcuatri){


            $stmt = Conexion::conectar()->prepare("SELECT COUNT(MATRICULA) as alumnosEvaluaron FROM EN_RESULT_ALUMNO WHERE CVE_CUATRIMESTRE = :idcua  AND CVE_GRUPO = :idgru");
            
            $stmt->bindParam(":idgru", $idgrupo, PDO::PARAM_INT);
            $stmt->bindParam(":idcua", $idcuatri, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetch();


        }

        public static function listaProfesoresEvaMdl($matricula,$grupo){

            $stmt = Conexion::conectar()->prepare("SELECT DISTINCT (PERSONAL.CVE_PERSONAL), PERSONAL.APELLIDOPATERNO, PERSONAL.APELLIDOMATERNO, PERSONAL.NOMBRE from DOSIFICACION inner JOIN ALUMNO_GRUPOS on DOSIFICACION.CVE_GRUPOS = ALUMNO_GRUPOS.CVE_GRUPO inner JOIN PERSONAL on DOSIFICACION.CVE_PERSONAL = PERSONAL.CVE_PERSONAL where DOSIFICACION.CVE_GRUPOS = :idgru and ALUMNO_GRUPOS.MATRICULA = :mat and DOSIFICACION.CVE_PERSONAL not in (SELECT CVE_PERSONAL from EN_RESULT_ALUMNO WHERE MATRICULA = :mat AND CVE_GRUPO =:idgru )");
            
            $stmt->bindParam(":mat",$matricula, PDO::PARAM_STR);
            $stmt->bindParam(":idgru",$grupo, PDO::PARAM_INT);
            
            $stmt -> execute();
             return $stmt->fetchAll();  


        }

        static public function registroEvDAMdl($datos){


            $stmt = Conexion::conectar()->prepare("INSERT INTO EN_RESULTADO_DDC VALUES(NULL, :tipo, :pro, :admin, :cuat, :ob)");
        
            $stmt->bindParam(":pro", $datos["idprofe"], PDO::PARAM_INT);
            $stmt->bindParam(":admin",$datos["idadmin"], PDO::PARAM_INT);
            $stmt->bindParam(":cuat", $datos["idcuatri"], PDO::PARAM_INT);
            $stmt->bindParam(":ob", $datos["obse"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo", $datos["tipoEncu"], PDO::PARAM_INT);
        
    
            if($stmt->execute()){
                    return true;
            }else{
                
                return false;
            }

            
        }

        static public  function ideregistroDCMdl($datos){

            $stmt = Conexion::conectar()->prepare("SELECT CVE_RESULTADO_DDC FROM EN_RESULTADO_DDC WHERE CVE_PERSONAL = :idprof AND CVE_CARRERA_PERSONAL = :idadm AND CVE_CUATRIMESTRE = :idcua");
            
            $stmt->bindParam(":idprof", $datos['idprofe'], PDO::PARAM_INT);
            $stmt->bindParam(":idadm", $datos['idadmin'], PDO::PARAM_INT);
            $stmt->bindParam(":idcua", $datos['idcuatri'], PDO::PARAM_INT);

            $stmt -> execute();
            return $stmt->fetch();

        }

        static public function registroDetalleDCMdl($resp,$ideva){

             $stmt = Conexion::conectar()->prepare("INSERT INTO EN_DETALLE_RESULTADO_DDC VALUES(NULL, :idev, :res)");
        
            $stmt->bindParam(":res", $resp, PDO::PARAM_INT);
            $stmt->bindParam(":idev",$ideva, PDO::PARAM_INT);
            $stmt->execute();


        }

        static public function resultadosDCMdl($cuatri, $admin){

             $stmt = Conexion::conectar()->prepare("SELECT * FROM EN_RESULTADO_DDC inner JOIN PERSONAL on EN_RESULTADO_DDC.CVE_PERSONAL = PERSONAL.CVE_PERSONAL WHERE CVE_CARRERA_PERSONAL = :idadmi and CVE_CUATRIMESTRE = :cuat  ORDER BY PERSONAL.APELLIDOPATERNO");
            
            $stmt->bindParam(":cuat",$cuatri, PDO::PARAM_STR);
            $stmt->bindParam(":idadmi",$admin, PDO::PARAM_INT);
            
            $stmt -> execute();
             return $stmt->fetchAll();
        }


        static public function detalleResultDCController($idregistro){


            $stmt = Conexion::conectar()->prepare("SELECT * from EN_DETALLE_RESULTADO_DDC WHERE CVE_RESULTADO_DDC = :id");
            
            $stmt->bindParam(":id",$idregistro, PDO::PARAM_STR);
            
            $stmt -> execute();
             return $stmt->fetchAll();


        }

        static public function preguntasMdl($idpregunta){


            $stmt = Conexion::conectar()->prepare("SELECT * FROM EN_DETALLE_PREGUNTAS where CVE_PREGUNTA_OPCION = :id");
            
            $stmt->bindParam(":id",$idpregunta, PDO::PARAM_INT);
            
            $stmt -> execute();
             return $stmt->fetch();

        }

        static public function eliminaEvDcMdl($idEv){

             $stmt = Conexion::conectar()->prepare("DELETE FROM EN_RESULTADO_DDC WHERE CVE_RESULTADO_DDC = :id"); 
    
            $stmt->bindParam(":id", $idEv, PDO::PARAM_INT);      
    
            if($stmt->execute()){
                echo "<script>  window.location.href = 'evaluacionDA';</script>";
            }
        }

        static public function registroConsentradoMdl($datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO EN_RESULTADO_EVALUACION VALUES(null, :pro, :cuat, :admin, 0, 0, 0)");
        
            $stmt->bindParam(":pro", $datos["idprof"], PDO::PARAM_INT);
            $stmt->bindParam(":admin",$datos["idadmin"], PDO::PARAM_INT);
            $stmt->bindParam(":cuat", $datos["idcuat"], PDO::PARAM_INT);
        
            if($stmt->execute()){
                   return true;
            }else{
                
                return false;
            }
            

        }

        static public function listaConsentradoMdl($idcuatri, $admin){

            $stmt = Conexion::conectar()->prepare("SELECT * from EN_RESULTADO_EVALUACION inner JOIN PERSONAL on EN_RESULTADO_EVALUACION.CVE_PERSONAL = PERSONAL.CVE_PERSONAL WHERE CVE_CUATRIMESTRE = :id and CVE_CARRERA_PERSONAL = :idadmin ORDER BY PERSONAL.APELLIDOPATERNO ASC");
            
            $stmt->bindParam(":id",$idcuatri, PDO::PARAM_INT);
            $stmt->bindParam(":idadmin",$admin, PDO::PARAM_INT);
            
            $stmt -> execute();
            return $stmt->fetchAll();
        }

        static public function evaluadoMdl($idCuatri, $evaluado){

            $stmt = Conexion::conectar()->prepare("SELECT * from EN_DETALLE_EVALUADOR WHERE CVE_PERSONAL = :ideva and CVE_CUATRIMESTRE = :id ");
            
            $stmt->bindParam(":id",$idCuatri, PDO::PARAM_INT);
            $stmt->bindParam(":ideva",$evaluado, PDO::PARAM_INT);
            
            $stmt -> execute();
            return $stmt->fetch();

        }

        static public function resultObMdl($idevaluado){

            $stmt = Conexion::conectar()->prepare("SELECT CVE_RESULTADO, OBSERVACION FROM EN_RESULTADO_EVALUADOR WHERE CVE_EVALUADO =:id");
            
            $stmt->bindParam(":id",$idevaluado, PDO::PARAM_INT);

            
            $stmt -> execute();
            return $stmt->fetch();

        }

        static public function resultDetObMdl($resul){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM EN_DETALLE_RESULTADO_EVALUADOR where CVE_RESULTADO =:id");
            
            $stmt->bindParam(":id",$resul, PDO::PARAM_INT);

            
            $stmt -> execute();
            return $stmt->fetchAll();

        }

        static public function ActualizaresultObMdl($total,$idCuatri, $idpersonal,$campo){

            $stmt = Conexion::conectar()->prepare("UPDATE EN_RESULTADO_EVALUACION SET $campo =:total WHERE CVE_PERSONAL =:per and CVE_CUATRIMESTRE =:cua "); 
    
            $stmt->bindParam(":total", $total, PDO::PARAM_INT);
            $stmt->bindParam(":cua", $idCuatri, PDO::PARAM_INT);
            $stmt->bindParam(":per", $idpersonal, PDO::PARAM_INT);

            if($stmt->execute()){

                return true;

            }
            
            
        }

        static public function actualizaResAlumnoMdl($cuatri, $idpersonal){

            $stmt = Conexion::conectar()->prepare("SELECT SUM(VALOR) AS TOTAL FROM EN_RESULT_ALUMNO  INNER JOIN EN_DETALLE_RESULTADO_ALUMNO ON EN_RESULT_ALUMNO.CVE_RESUL_ALUMN = EN_DETALLE_RESULTADO_ALUMNO.CVE_REULTADO_ALUMNO INNER JOIN EN_DETALLE_PREGUNTAS ON EN_DETALLE_RESULTADO_ALUMNO.CVE_PREGUNTA_OPCION = EN_DETALLE_PREGUNTAS.CVE_PREGUNTA_OPCION WHERE CVE_CUATRIMESTRE = :idcua AND CVE_PERSONAL = :idper ");
            
            $stmt->bindParam(":idcua",$cuatri, PDO::PARAM_INT);
            $stmt->bindParam(":idper",$idpersonal, PDO::PARAM_INT);

            
            $stmt -> execute();
            return $stmt->fetch();

        }

        static public function cantidadAlumnosEvalMdl($cuatri, $idpersonal){

            $stmt = Conexion::conectar()->prepare("SELECT count(distinct(MATRICULA)) as totalAl FROM EN_RESULT_ALUMNO WHERE CVE_CUATRIMESTRE = :idcua and CVE_PERSONAL = :idper");
            
            $stmt->bindParam(":idcua",$cuatri, PDO::PARAM_INT);
            $stmt->bindParam(":idper",$idpersonal, PDO::PARAM_INT);

            
            $stmt -> execute();
            return $stmt->fetch();
        }


        static public function verpregunrasAlumnoMdl(){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM EN_DETALLE_ENCUESTA as DE INNER JOIN EN_PREGUNTAS AS P ON DE.CVE_PREGUNTA = P.CVE_PREGUNTAS WHERE CVE_ENCUESTA = 1 ORDER by CVE_LISTA");
            
            $stmt -> execute();
            return $stmt->fetchAll();

        }

        static public function totalAlumnosEvaMdl($cuatri,$idpersonal){

            $stmt = Conexion::conectar()->prepare("SELECT count(distinct( MATRICULA)) as TOTAL FROM EN_RESULT_ALUMNO WHERE CVE_CUATRIMESTRE = :idcua AND CVE_PERSONAL = :idper ");
            

            $stmt->bindParam(":idcua",$cuatri, PDO::PARAM_INT);
            $stmt->bindParam(":idper",$idpersonal, PDO::PARAM_INT);


            $stmt -> execute();
            return $stmt->fetch();

        }

        static public function ResultadosAlumnoMdl($cuatri,$idpersonal,$idpregunta){

            $stmt = Conexion::conectar()->prepare("SELECT  SUM(VALOR) AS TOTALDet FROM  EN_RESULT_ALUMNO INNER JOIN EN_DETALLE_RESULTADO_ALUMNO ON EN_RESULT_ALUMNO.CVE_RESUL_ALUMN = EN_DETALLE_RESULTADO_ALUMNO.CVE_REULTADO_ALUMNO INNER JOIN EN_DETALLE_PREGUNTAS ON EN_DETALLE_RESULTADO_ALUMNO.CVE_PREGUNTA_OPCION = EN_DETALLE_PREGUNTAS.CVE_PREGUNTA_OPCION WHERE CVE_CUATRIMESTRE = :idcua AND CVE_PERSONAL = :idper AND CVE_PREGUNTA = :idpre ");
            

            $stmt->bindParam(":idcua",$cuatri, PDO::PARAM_INT);
            $stmt->bindParam(":idper",$idpersonal, PDO::PARAM_INT);
            $stmt->bindParam(":idpre",$idpregunta, PDO::PARAM_INT);


            $stmt -> execute();
            return $stmt->fetch();

        }

        static public function actualizaEstatusEVMdl($estatus,$idev){

            $stmt = Conexion::conectar()->prepare("UPDATE EN_REGISTRO_EVALUACIONES SET ESTATUS=:est WHERE ID_EVALUACION=:idev");
        
            $stmt->bindParam(":est", $estatus, PDO::PARAM_INT);
            $stmt->bindParam(":idev",$idev, PDO::PARAM_INT);
            $stmt->execute();

        }
        
        static public function eliminaProfesorDeListaMdl($id){
            
            echo $id.' desde el modelo';
            
            $stmt = Conexion::conectar()->prepare("DELETE FROM EN_RESULTADO_EVALUACION WHERE CVE_RESULTADOEV =:id "); 
    
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);      
    
            if($stmt->execute()){
                echo "<script>  window.location.href = 'resultados';</script>";
            }
        }
        
    }


    

?>