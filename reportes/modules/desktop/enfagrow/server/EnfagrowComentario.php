<?php
/**
 * PHPExcel
 *
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2012 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.7, 2012-05-19
 */

/** Error reporting */
error_reporting(E_ALL);

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

require_once '../../../../server/os.php';

$os = new os();
if(!$os->session_exists()){
    die('No existe sesión!');
}

$today = date("Y-n-j");
include "exportarEnfagrowComentario.inc.php";

header('Content-Type: application/pdf');
//header('Content-Disposition: attachment;filename="enfagrow_ganadores_'. $today .'.pdf"');
header('Content-Disposition: attachment;filename="enfagrow_comentario_'. $today .'.xlsx"');
header('Cache-Control: max-age=0');

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;