<?php 

class cuatrimestresController{

    static public function registroCuatriCont(){

       if(isset($_POST['registro'])){

        $valida = cuatrimestresModel::valicaCuatriMdl($_POST['inicio'],$_POST['fin'],$_POST['descripcion']);
        
        if($valida != null){

            echo "Ya existe este cuatrimeste";
        }else{

            $dato = array(
                "finicio"=>$_POST['inicio'], 
                "ffin"=>$_POST['fin'],
                "descri"=>$_POST['descripcion'],
                "desco"=>$_POST['desCorto']
            );


           $resultado = cuatrimestresModel::RegistroCuatriMdl($dato);
	

        }

            
       }
    }

    static public function listaCuatriController($tbl){

        if(isset($tbl)){

            $resultado = cuatrimestresModel::listaCuatriMdl($tbl);
			return $resultado;

        }
    }

    static public function listaCuatriMaxController($tbl,$num){

        if(isset($tbl)){

            $resultado = cuatrimestresModel::listaCuatriMaxMdl($tbl,$num);
			return $resultado;

        }
    }

    static public function actualizaCuatriController(){


        if(isset($_POST['actualizarCuatrimestre'])){

            $datosCua = array (
                        "idcua"=>$_POST['idcuatri'],
                        "inicio"=>$_POST['fechaIn'],
                        "fin"=>$_POST['fechaFin'],
                        "descri"=>$_POST['descriLargo'],
                        "abrevia"=>$_POST['descriCorta']
                    );

            $resultado = cuatrimestresModel::actualizaCuatriMdl($datosCua);
           
        }

    }

    static public function eliminaCuatriController($idcuatri){

        if(isset($idcuatri)){

            $resultado = cuatrimestresModel::eliminaCuatriMdl($idcuatri);

        }
    }

    static public function maxCuatriController(){

        $vermax = cuatrimestresModel::maxCuatriMdl();
        return $vermax;
    }
    
    static public function filtroCuatriControll($idCuatri){
        
        if(isset($idCuatri)){
            
            $verCuatri = cuatrimestresModel::filtroCuatriMdl($idCuatri);
            return $verCuatri;
        }
    }

}

?>