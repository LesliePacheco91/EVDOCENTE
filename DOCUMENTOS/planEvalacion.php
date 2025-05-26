<?php 

$idcuatri=$_GET['id'];
$idsesion = $_GET['perso'];

require_once "../CONTROLADOR/cuatrimestresController.php";
require_once "../MODELO/cuatrimestresModel.php";
require_once "../CONTROLADOR/gruposController.php";
require_once "../MODELO/gruposModelo.php";
require_once "../CONTROLADOR/loginController.php";
require_once "../MODELO/loginModelo.php";
require_once "../CONTROLADOR/evaluacionesController.php";
require_once "../MODELO/evaluacionesModelo.php";
require_once "../CONTROLADOR/alumnosController.php";
require_once "../MODELO/alumnosModelo.php";
require_once "../CONTROLADOR/profesoresController.php";
require_once "../MODELO/profesoresModel.php";

$personal = MCVlogin::personalController($idsesion);


require_once 'vendor/autoload.php';

use \PhpOffice\PhpWord\TemplateProcessor;

$template = new \PhpOffice\PhpWord\TemplateProcessor('PlanDeObservacionDocente.docx');



$cuatri = 3;

switch ($cuatri) {
	case 1:
		$template->setValues([

			'anio'=>'2034',
			'programa'=>'T.S.U en Entornos Virtuales y Negocios Digitales',
			'periodo'=>'1',
			'fechaEmicion'=>'18/04/2023',
			'eneAbr'=>'x',
			'mayAgo'=>'',
			'sepDic'=>''

		]);
	break;
	case 2:

		$template->setValues([

			'anio'=>'2034',
			'programa'=>'T.S.U en Entornos Virtuales y Negocios Digitales',
			'periodo'=>'1',
			'fechaEmicion'=>'18/04/2023',
			'eneAbr'=>'',
			'mayAgo'=>'x',
			'sepDic'=>''

		]);

	break;
	case 3:
		$template->setValues([

			'anio'=>'2034',
			'programa'=>'T.S.U en Entornos Virtuales y Negocios Digitales',
			'periodo'=>'1',
			'fechaEmicion'=>'18/04/2023',
			'eneAbr'=>'',
			'mayAgo'=>'',
			'sepDic'=>'x'

		]);

	break;
}


/*$valuador  = evaluacionCotroller::listaPlanController($idcuatri,$personal['CVE_CARRERA_PERSONAL'] );

                                        
    $detalleEv = evaluacionCotroller::listaPlanDetalleController($itemEv['CVE_EVALUADOR']);
    foreach ($detalleEv as $itemDet):
		
	endforeach;
endforeach;

foreach ($valuador as $itemEv):
		$detalleEv = evaluacionCotroller::listaPlanDetalleController($itemEv['CVE_EVALUADOR']);
    	foreach ($detalleEv as $itemDet):
		
			['evaluado'=>'Leslie pacheco','asignatura'=>'BD','observador'=>'Sharai','fecha'=>'1904/2023'],
		endforeach;
	endforeach;

*/

$valuador  = evaluacionCotroller::listaPlanController($idcuatri,$personal['CVE_CARRERA_PERSONAL']);
$values = [
	['evaluado'=>'Leslie pacheco','asignatura'=>'BD','observador'=>'Sharai','fecha'=>'1904/2023'],
	['evaluado'=>'Leslie pacheco','asignatura'=>'BD','observador'=>'Sharai','fecha'=>'1904/2023']
	
];
	
$template->cloneRowAndSetValues('evaluado', $values);

$pathToSave = 'paresEvaluadores'.$idcuatri.'.docx';
$template->saveAs($pathToSave);


header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename="'.$pathToSave.'"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

readfile($pathToSave);

?>