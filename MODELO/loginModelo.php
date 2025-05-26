<?php 
require_once "conexion.php";

class MCVloginMdl extends Conexion {


	static public function loginAlumnoModel($matricula){
	   
		$stmt = Conexion::conectar()->prepare("SELECT * FROM ALUMNOS WHERE MATRICULA = :mat ");

		$stmt->bindParam(":mat",$matricula, PDO::PARAM_STR);
		
		$stmt->execute();
		return $stmt->fetch();
		#$stmt->close();
		
	}

	static public function loginModel($datosModel,$tblusuario){
	   
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tblusuario WHERE CVE_PERSONAL = :usu AND CONTRASENA = :pass");

		$stmt->bindParam(":usu",$datosModel['usuario'], PDO::PARAM_INT);
		$stmt->bindParam(":pass",$datosModel['contra'], PDO::PARAM_STR);
		
		$stmt->execute();
		return $stmt->fetch();
		#$stmt->close();
		
	}
	
	static public function permisosMenuModelo($tbl){

	    
	    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tbl WHERE NIVEL_PRESENTACION = 3 ");

		$stmt -> execute();

		return $stmt->fetchAll();
		//$stmt->close();
		
	}

	static public function carerasMdl($iduser){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM CARRERAS INNER JOIN EN_CARRERA_PERSONAL ON CARRERAS.CVE_CARRERAS = EN_CARRERA_PERSONAL.CVE_CARRERA WHERE CVE_PERSONAL = :usu");

		$stmt->bindParam(":usu",$iduser, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt->fetchAll();
		
	}

	static public function careras1Mdl(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM CARRERAS");
		$stmt -> execute();

		return $stmt->fetchAll();
	}

	static public function materiasMdl($idmat){

		$stmt = Conexion::conectar()->prepare("SELECT NOMBRE, CVE_MATERIAS from MATERIAS where CVE_CARRERAS =:mat ORDER by NOMBRE ASC ");

		$stmt->bindParam(":mat",$idmat, PDO::PARAM_INT);
		$stmt -> execute();

		return $stmt->fetchAll();

	}

	static public function ListmateriasMdl(){

		$stmt = Conexion::conectar()->prepare("SELECT NOMBRE, CVE_MATERIAS from MATERIAS ORDER by NOMBRE ASC ");

		$stmt -> execute();

		return $stmt->fetchAll();
	}

	static public function personalMdl($idpersonal){

		$stmt = Conexion::conectar()->prepare("SELECT * from EN_CARRERA_PERSONAL WHERE CVE_PERSONAL = :usu");

		$stmt->bindParam(":usu",$idpersonal, PDO::PARAM_INT);
		
		$stmt->execute();
		return $stmt->fetch();
		
	}

	static public function DatosAdminMdl($idpersonal){

		$stmt = Conexion::conectar()->prepare("SELECT * from PERSONAL WHERE CVE_PERSONAL = :usu");

		$stmt->bindParam(":usu",$idpersonal, PDO::PARAM_INT);
		
		$stmt->execute();
		return $stmt->fetch();

	}

	static public function ModificarDatosAdminMdl($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE PERSONAL SET NOMBRE=:nom, APELLIDOMATERNO=:am, APELLIDOPATERNO=:ap, CONTRASENA=:pas, MAIL=:ema WHERE CVE_PERSONAL=:id");

		$stmt->bindParam(":nom",$datos['nom'], PDO::PARAM_STR);
		$stmt->bindParam(":ap",$datos['ap'], PDO::PARAM_STR);
		$stmt->bindParam(":am",$datos['am'], PDO::PARAM_STR);
		$stmt->bindParam(":pas",$datos['con'], PDO::PARAM_STR);
		$stmt->bindParam(":ema",$datos['email'], PDO::PARAM_STR);
		$stmt->bindParam(":id",$datos['idp'], PDO::PARAM_INT);
		
		$stmt->execute();
		return $stmt->fetch();
	}

	static public function ModificarDatosAdmin1Mdl($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE PERSONAL SET NOMBRE=:nom,APELLIDOMATERNO=:am,APELLIDOPATERNO=:ap, MAIL=:ema WHERE CVE_PERSONAL=:id");

		$stmt->bindParam(":nom",$datos['nom'], PDO::PARAM_STR);
		$stmt->bindParam(":ap",$datos['ap'], PDO::PARAM_STR);
		$stmt->bindParam(":am",$datos['am'], PDO::PARAM_STR);
		$stmt->bindParam(":ema",$datos['email'], PDO::PARAM_STR);
		$stmt->bindParam(":id",$datos['idp'], PDO::PARAM_INT);
		
		$stmt->execute();
		return $stmt->fetch();
	
	}

	static public function ActualizaFotoAdminMdl($idpersonal,$imagen){

		$stmt = Conexion::conectar()->prepare("UPDATE PERSONAL SET IMAGEN =:img  WHERE CVE_PERSONAL=:id");

		$stmt->bindParam(":img",$imagen, PDO::PARAM_STR);
		$stmt->bindParam(":id",$idpersonal, PDO::PARAM_INT);
		
		$stmt->execute();
		return $stmt->fetch();

	}

}