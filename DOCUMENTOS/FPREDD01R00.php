<?php
/*header('Content-type: application/vnd.ms-word');
header("Content-Disposition: attachment; filename=millonarios_fc.doc");
header("Pragma: no-cache");
header("Expires: 0");*/
?>
<!doctype html>
<html>
  <head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100&display=swap" rel="stylesheet"> 

    <title>Formato Plan de evaluación</title>
  </head>
  <style>
      .fontType {
        font-family: 'Barlow', sans-serif; 
        font-size:11px;
      }

      .fontTytle {
        font-weight: bold;
      }

       .datos{
        padding-top:10% ;
      }
  </style>
  <body class="fontType">

<div class="datos">
  <table width="100%" border ="1px" cellspacing="0" cellpadding="0">
        <tr>
            <td width="20%"><img src="DOCUMENTOS/img/logoGob1.jpg" width="50%"></td>
            <td width="60%"><center><span class="fontTytle">UNIVERSIDAD TECNOLÓGICA DEL MAYAB</span><br>Dirección Académica</center></td>
            <td width="20%">
                <img src="DOCUMENTOS/img/logo2021.png" width="40%">
                <img src="DOCUMENTOS/img/logoAzul.png" width="30%">
            </td>
        </tr>
        <tr>
            <td colspan = "3"><center>Plan de Observación Docente</center></td>
        </tr>
    </table>
</div>
<div class="datos">    
    <table width="100%" border ="1px" cellspacing="0" cellpadding="0">
        <tr>
            <td>Año</td>
            <td></td>
            <td>Cuatrimestre</td>
            <td>Ene-Abr</td>
            <td></td>
            <td>May-Ago</td>
            <td></td>
            <td>Sep-Dic</td>
            <td></td>
        </tr>
        <tr>
            <td colspan = "2">Programa Educativ</td>
            <td></td>
            <td colspan = "2">Periodo de evaluación</td>
            <td></td>
            <td colspan="2">Fecha de Emición</td>
            <td></td>
        </tr>
    </table>
</div>
<div class="datos">
    <table width="100%" border ="1px" cellspacing="0" cellpadding="0">
        <tr>
            <td>Docente a Evaluar</td>
            <td>Asignatura</td>
            <td>Observador</td>
            <td>Fecha de entrega de resultados</td>
        </tr>
    </table>
</div>
<div class="datos">
    <table width="60%" cellspacing="0" cellpadding="0">
        <tr>
            <td width="40%">__________________________</td>
            <td></td>
            <td width="40%">__________________________</td>
        </tr>
        <tr>
            <td>Nombre y Firma</td>
            <td></td>
            <td>Nombre y Firma</td>
        </tr>
        <tr>
            <td>Director(a) Acdemico(a)</td>
            <td></td>
            <td>Coordinador de Observación <br> Docente</td>
        </tr>
    </table>
</div>
  </body>
</html>