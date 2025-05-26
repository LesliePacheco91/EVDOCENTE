<?php
class MCVlogin {
	
	public function loginController(){

		if(isset($_POST['inicioSesion'])){

			if(preg_match('/^[a-zA-Z0-9]+$/',$_POST['usuario']) && preg_match('/^[a-zA-Z0-9]+$/',$_POST['pass'])){

				$pass = sha1(md5($_POST['pass']));

				$datosLogin = array("usuario"=>$_POST['usuario'],"contra"=>$pass);

				$respuesta = MCVloginMdl::loginModel($datosLogin,"PERSONAL");

				if(isset($respuesta['CVE_PERSONAL']) && isset($respuesta['CONTRASENA'])){

					
					if($respuesta['CVE_PERSONAL'] == $_POST['usuario'] && $respuesta['CONTRASENA'] == $pass && $respuesta['CVE_PUESTOS'] == 2 && $respuesta['CVE_DEPARTAMENTOS'] == 4){


						$_SESSION['VALIDA'] = true;
						$_SESSION['idPersonal'] = $respuesta['CVE_PERSONAL'];

						$_SESSION['usuario'] = $respuesta['NOMBRE'].' '.$respuesta['APELLIDOPATERNO'];

						header("location:inicio");
					}else{

						echo "Este usuario no pertenece a este departamento";
					}
					
				}else{
					
					echo "Usuario y/o contraseña no existe en la base de datos";
				}

			}else{
				echo "No se permiten caracteres especiales";
			}

		}
	}

	static public function carerasController($iduser){

		if(isset($iduser)){
			$listacarreras =MCVloginMdl::carerasMdl($iduser);
			return  $listacarreras;

		}
	}

	static public function carreras1Controller(){

		$listacarreras =MCVloginMdl::careras1Mdl();
		return  $listacarreras;
	}

	static public function materiasController($idmat){


		$listaMaterias =MCVloginMdl::materiasMdl($idmat);
		return $listaMaterias;
	}

	static public function ListmateriasController(){


		$listaMaterias =MCVloginMdl::ListmateriasMdl();
		return $listaMaterias;
	}


	static public function personalController($idpersonal){

		if(isset($idpersonal)){

			$idpersonal =MCVloginMdl::personalMdl($idpersonal);
			return $idpersonal;

		}
	}


	static public function DatosAdminController($idpersonal){

		$verDatosAdmin = MCVloginMdl::DatosAdminMdl($idpersonal);
		return $verDatosAdmin;
	}

	static public function ModificarDatosAdminController(){

		if(isset($_POST['modificarPerfil'])){

			if($_POST['pass'] != ""){

				$pass = sha1(md5($_POST['pass'])); 

				$datos = array(
					'nom'=>$_POST['nom'],
					'ap'=>$_POST['ap'],
					'am'=>$_POST['am'],
					'con'=>$pass,
					'email'=>$_POST['email'],
					'idp'=>$_POST['idper']
				);

				$datos = MCVloginMdl::ModificarDatosAdminMdl($datos);

			}else{

				$datos = array(
					'nom'=>$_POST['nom'],
					'ap'=>$_POST['ap'],
					'am'=>$_POST['am'],
					'email'=>$_POST['email'],
					'idp'=>$_POST['idper']
				);

				$datos = MCVloginMdl::ModificarDatosAdmin1Mdl($datos);

			}


			if(isset($_FILES['imagen']['name'])){

				$path = "VISTA/uploats/". basename($_FILES['imagen']['name']); 
	 
					if(move_uploaded_file($_FILES['imagen']['tmp_name'], $path)) {
	
						if(isset($_POST['imagenAnt'])){
	
							unlink("VISTA/uploats/".$_POST['imagenAnt']); 
						}
	
						$nombreImagen = basename( $_FILES['imagen']['name']);
	
						MCVloginMdl::ActualizaFotoAdminMdl($_POST['idper'],$nombreImagen);
	
						 echo "<script>  window.location.href = 'inicio';</script>";
	
					} else{
						echo "El archivo no se ha subido correctamente";
				}
	
	
			}

			session_destroy();
			header("Location:login");
		}
	}
}

?>