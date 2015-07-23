<?php
/**
 * MISIVA
 *
 * Copyright (C)  2015
 *
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.0.0, 2015-07-08
 */


$sql = "SELECT doky_registro.id,
                doky_registro.nombre,
                doky_registro.cedula,
                doky_registro.telefono,
                doky_registro.direccion,

                doky_registro.creado,
                doky_registro.mail,
                doky_registro.ciudad,
                doky_registro.consumidor,
                doky_registro.`consumidor-donde`,
                doky_registro.donde
            FROM doky_registro   ORDER BY creado desc ";

$result = $os->db->conn->query($sql);
$data = array();


$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);

$filaInicio = 2;


$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'nombre');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'cedula');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'telefono');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Direccion');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Creado');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'mail');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ciudad');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Consumidor');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Consumidor-donde');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Donde');

while ($rowdetalle = $result->fetch(PDO::FETCH_ASSOC)) {
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $filaInicio, $rowdetalle['id']);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $filaInicio, $rowdetalle['nombre']);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $filaInicio, $rowdetalle['cedula']);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $filaInicio, $rowdetalle['telefono']);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $filaInicio, $rowdetalle['direccion']);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $filaInicio, $rowdetalle['creado']);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $filaInicio, $rowdetalle['mail']);
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $filaInicio, $rowdetalle['ciudad']);
    $objPHPExcel->getActiveSheet()->setCellValue('I' . $filaInicio, $rowdetalle['consumidor']);
    $objPHPExcel->getActiveSheet()->setCellValue('J' . $filaInicio, $rowdetalle['consumidor-donde']);
    $objPHPExcel->getActiveSheet()->setCellValue('K' . $filaInicio, $rowdetalle['donde']);
    $filaInicio++;
}


// Create new PHPExcel object

// Set document properties
//echo date('H:i:s') , " Set document properties" , PHP_EOL;
$objPHPExcel->getProperties()->setCreator("Byron Herrera")
    ->setLastModifiedBy("Byron Herrera")
    ->setTitle("Enfagrow Registro 1 año")
    ->setSubject("")
    ->setDescription("Enfagrow registro 1 año, generated using PHP classes.")
    ->setKeywords("enfagrow ganadores openxml php")
    ->setCategory("Archivo");


//$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Cantidad');
//$objPHPExcel->getActiveSheet()->setCellValue('B7', 'Detalle');
//$objPHPExcel->getActiveSheet()->setCellValue('C7', 'Valor Unitario');
//$objPHPExcel->getActiveSheet()->setCellValue('D7', 'Valor Total');


$styleThinBlackBorderOutline = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('argb' => 'FF000000'),
        ),
    ),
);


$objPHPExcel->getActiveSheet()->getStyle('A1:L300')->applyFromArray(
    array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        )
    )
);

//$objPHPExcel->getActiveSheet()->getStyle('A8:D36')->applyFromArray($styleThinBlackBorderOutline);

/*

$objPHPExcel->getActiveSheet()->getStyle('A3:D3')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('A8:D8')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('A7:D7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('A37:D37')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$objPHPExcel->getActiveSheet()->getStyle('A7:A36')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('B7:B36')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('C7:C36')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
*/
// Set page orientation and size
//echo date('H:i:s') , " Set page orientation and size" , PHP_EOL;
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);


$objPHPExcel->getActiveSheet()->getStyle('A1:L3000')->getFont()->setSize(12);
//$objPHPExcel->getActiveSheet()->getStyle('A3:D40')->getFont()->setSize(10);


$pageMargins = $objPHPExcel->getActiveSheet()->getPageMargins();


// margin is set in inches (0.5cm)
$margin = 0.5 / 2.54;

$pageMargins->setTop($margin);
$pageMargins->setBottom($margin);
$pageMargins->setLeft($margin);
$pageMargins->setRight($margin);


$objPHPExcel->getActiveSheet()->setShowGridLines(false);

//echo date('H:i:s') , " Set orientation to landscape" , PHP_EOL;
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
