<?php 
require_once "conexion.php";

    class restriccionHorarioMdl extends Conexion{

        static public function listaRestriccionesMdl($admin, $cuatri){


            $stmt = Conexion::conectar()->prepare("SELECT * FROM RESTRICCION_HORAS JOIN PERSONAL on RESTRICCION_HORAS.CVE_PERSONAL = PERSONAL.CVE_PERSONAL WHERE CVE_CARRERA_PERSONAL = :admin   and CVE_CUATRIMESTRE = :cuatri ");

            $stmt->bindParam(":admin",$admin, PDO::PARAM_INT);
            $stmt->bindParam(":cuatri",$cuatri, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetchAll();



        }

        static public function VerHorasMdl(){

            $stmt = Conexion::conectar()->prepare("SELECT * from HORAS");

            
            $stmt -> execute();
            return $stmt->fetchAll();
            
        }

        static public function VerRestriccionMdl($idrestricion,$dia,$idhora){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM RESTRICCION_DETALLE  where CVE_DIA = :dia AND CVE_HORA  = :hora  AND CVE_RESTRICCION = :idres");

            $stmt->bindParam(":idres",$idrestricion, PDO::PARAM_INT);
            $stmt->bindParam(":dia",$dia, PDO::PARAM_INT);
            $stmt->bindParam(":hora",$idhora, PDO::PARAM_INT);
            
            $stmt -> execute();
            return $stmt->fetch();

        }

        static public function ActualizaEstatusMdl($idrestric ,$estatus) {

            $stmt = Conexion::conectar()->prepare("UPDATE RESTRICCION_HORAS SET ESTADO = :estat WHERE CVE_RESTRICCION = :idres ");

            $stmt->bindParam(":idres",$idrestric, PDO::PARAM_INT);
            $stmt->bindParam(":estat",$estatus, PDO::PARAM_INT);
            
            if($stmt -> execute()){

                echo "<script>  window.location.href = 'restricH';</script>";
            }

        }

    }
?>