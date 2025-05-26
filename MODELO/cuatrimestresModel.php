<?php 
require_once "conexion.php";

    class cuatrimestresModel extends Conexion{

        static public function RegistroCuatriMdl($dato){


            $stmt = Conexion::conectar()->prepare("INSERT INTO CUATRIMESTRES  VALUES(null,:inicio,:fin ,:descri,:descrip)");
    
            $stmt->bindParam(":inicio", $dato["finicio"], PDO::PARAM_STR);
            $stmt->bindParam(":fin", $dato["ffin"], PDO::PARAM_STR);
            $stmt->bindParam(":descri", $dato["descri"], PDO::PARAM_STR);
            $stmt->bindParam(":descrip", $dato["desco"], PDO::PARAM_STR);
              
    
            if($stmt->execute()){

                  echo "<script>  window.location.href = 'cuatrimestres';</script>";
            }else{
                echo "ERROR DE REGISTRO INTENTA DE NUEVO";
            }

        }

        static public function listaCuatriMdl($tbl){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tbl ORDER BY CVE_CAUTRIMESTRES DESC");
            $stmt -> execute();
            return $stmt->fetchAll();
        }

        static public function valicaCuatriMdl($inicio,$fin,$descri){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM CUATRIMESTRES WHERE FECHA_INICIO = :inicio and FECHA_FIN =:fin  or DESCRIPCION = :descri ");
            $stmt->bindParam(":inicio",$inicio, PDO::PARAM_STR);
            $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
            $stmt->bindParam(":descri", $descri, PDO::PARAM_STR);
            
            $stmt -> execute();
            return $stmt->fetch();


        }

        static public function actualizaCuatriMdl($arreglo){

            $stmt = Conexion::conectar()->prepare(" UPDATE CUATRIMESTRES SET FECHA_INICIO = :inicio , FECHA_FIN = :fin , DESCRIPCION = :descri ,ABREVIATURA = :abrev WHERE CVE_CAUTRIMESTRES = :id");

            $stmt->bindParam(":id",$arreglo['idcua'], PDO::PARAM_INT);
            $stmt->bindParam(":inicio", $arreglo['inicio'], PDO::PARAM_STR);
            $stmt->bindParam(":fin", $arreglo['fin'], PDO::PARAM_STR);
            $stmt->bindParam(":descri", $arreglo['descri'], PDO::PARAM_STR);
            $stmt->bindParam(":abrev", $arreglo['abrevia'], PDO::PARAM_STR);
            
            if($stmt->execute()){

                  echo "<script>  window.location.href = 'cuatrimestres';</script>";
            }else{
                echo "ERROR DE ACTIALIZACION INTENTA DE NUEVO";
            }

        }

        static public function eliminaCuatriMdl($idcua){

            $stmt = Conexion::conectar()->prepare("DELETE FROM CUATRIMESTRES WHERE CVE_CAUTRIMESTRES = :id");

            $stmt->bindParam(":id",$idcua, PDO::PARAM_INT);

            if($stmt->execute()){

               echo "<script>  window.location.href = 'cuatrimestres';</script>";
            }else{
                echo "ERROR AL ELIMINAR INTENTA DE NUEVO";
            }
            

        }

        static public function listaCuatriMaxMdl($tbl,$num){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tbl ORDER BY CVE_CAUTRIMESTRES DESC LIMIT :num");

            $stmt->bindParam(":num",$num, PDO::PARAM_INT);

            $stmt -> execute();
            return $stmt->fetchAll();
        }

        static public function maxCuatriMdl(){

            $stmt = Conexion::conectar()->prepare("SELECT * from CUATRIMESTRES ORDER BY CVE_CAUTRIMESTRES DESC LIMIT 1");
            
            $stmt -> execute();
            return $stmt->fetch();
        }
        
        static public function filtroCuatriMdl($idcuatri){
            $stmt = Conexion::conectar()->prepare("SELECT * from CUATRIMESTRES WHERE CVE_CAUTRIMESTRES = :id ");
            
            $stmt->bindParam(":id",$idcuatri, PDO::PARAM_INT);
            
            $stmt -> execute();
            return $stmt->fetch();
        }




    }


?>