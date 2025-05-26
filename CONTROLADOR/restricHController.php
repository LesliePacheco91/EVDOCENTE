<?php 

class restriccionHorarioCtrl{

    static public function listaRestriccionesController($admin,$cuatri){

        $listaHorarios = restriccionHorarioMdl::listaRestriccionesMdl($admin,$cuatri);
        return $listaHorarios;
    }

    static public function ActualizaEstatusController(){

        if(isset($_POST['actualizaEstatus'])){


           $actualiza = restriccionHorarioMdl::ActualizaEstatusMdl($_POST['idrestric'] , $_POST['estatus']);
            return $actualiza;
        

        }


    }


    static public function horario($idrestriccion,$causa){

        $verHoras = restriccionHorarioMdl::VerHorasMdl();

        echo '<table class = "table table-bordered">
                <thead>
                    <tr>
                        <td colspan = "6"><h5>Causa de la solicitud de restricción <br></h5>'.$causa.'</td>
                        
                    </tr>
                    <tr class = "text-center">
                        <th width="15%">Hora</th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                    </tr>
                </thead>
                <tbody class = "text-center">';

                  foreach($verHoras as $horas){

                    $verREstriccionDia1 = restriccionHorarioMdl::VerRestriccionMdl($idrestriccion,1,$horas['CVE_HORA']);

                    $verREstriccionDia2 = restriccionHorarioMdl::VerRestriccionMdl($idrestriccion,2,$horas['CVE_HORA']);

                    $verREstriccionDia3 = restriccionHorarioMdl::VerRestriccionMdl($idrestriccion,3,$horas['CVE_HORA']);

                    $verREstriccionDia4 = restriccionHorarioMdl::VerRestriccionMdl($idrestriccion,4,$horas['CVE_HORA']);

                    $verREstriccionDia5 = restriccionHorarioMdl::VerRestriccionMdl($idrestriccion,5,$horas['CVE_HORA']);


                    if($horas['TIPO'] == 'Receso'){
                        echo '<tr class="p-3 bg-gray-200">
                                <td >'.$horas['HORAI'].' '.$horas['HORAF'].'</td>
                                <td colspan = "5">Reseso</td>
                            </tr>';
                    }else{

                        echo '<tr>
                                <td >'.$horas['HORAI'].' '.$horas['HORAF'].'</td>';

                                if(isset($verREstriccionDia1['CVE_DETALLER'])){
                                    echo '<td>Restricción</td>';
                                }else{
                                    echo '<td></td>';
                                }


                                if(isset($verREstriccionDia2['CVE_DETALLER'])){
                                    echo '<td>Restricción</td>';
                                }else{
                                    echo '<td></td>';
                                }


                                if(isset($verREstriccionDia3['CVE_DETALLER'])){
                                    echo '<td>Restricción</td>';
                                }else{
                                    echo '<td></td>';
                                }

                                if(isset($verREstriccionDia4['CVE_DETALLER'])){
                                    echo '<td>Restricción</td>';
                                }else{
                                    echo '<td></td>';
                                }

                                if(isset($verREstriccionDia5['CVE_DETALLER'])){
                                    echo '<td>Restricción</td>';
                                }else{
                                    echo '<td></td>';
                                }

                       echo'</tr>';
                    }
                }
               
       echo    '</tbody>
            </table>';

    }





}

?>