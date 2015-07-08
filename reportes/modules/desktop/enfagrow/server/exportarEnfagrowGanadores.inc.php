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
                doky_premios.nombre AS nombrepremio,
                doky_registro.creado,
                doky_registro.mail,
                doky_registro.ciudad,
                doky_registro.consumidor,
                doky_registro.`consumidor-donde`,
                doky_registro.donde
            FROM doky_registro INNER JOIN doky_premios ON doky_registro.id_premio = doky_premios.id ORDER BY creado desc";

$result = $os->db->conn->query($sql);
$data = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}
$data  = $data[0];

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);

$sqldetalle = "SELECT egresodebodegadetalle.cantidad,
egresodebodegadetalle.valorunitario,
egresodebodegadetalle.valortotal,
producto.nombre
FROM
egresodebodegadetalle
INNER JOIN producto ON egresodebodegadetalle.idproducto = producto.idproducto
WHERE idegresodebodega = '$idegresodebodega'";

$filaInicio = 8;
$resultdetalle = $os->db->conn->query($sqldetalle);

while ($rowdetalle = $resultdetalle->fetch(PDO::FETCH_ASSOC)) {

    $objPHPExcel->getActiveSheet()->setCellValue('A'.$filaInicio , $rowdetalle['cantidad']);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$filaInicio , $rowdetalle['nombre'] );
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$filaInicio , $rowdetalle['valorunitario']);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$filaInicio , $rowdetalle['valortotal'] );
    $filaInicio ++;
}

// Create new PHPExcel object

// Set document properties
//echo date('H:i:s') , " Set document properties" , PHP_EOL;
$objPHPExcel->getProperties()->setCreator("Byron Herrera")
    ->setLastModifiedBy("Byron Herrera")
    ->setTitle("Egreso de bodega")
    ->setSubject("Impresion de egresodebodega")
    ->setDescription("Orden Compra, generated using PHP classes.")
    ->setKeywords("orden compra openxml php")
    ->setCategory("Archivo");


// Create a first sheet, representing sales data
//echo date('H:i:s') , " Add some data" , PHP_EOL;

//$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Egreso de bodega');

//$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Fecha:');
//$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Cliente:');
//$objPHPExcel->getActiveSheet()->setCellValue('A5', 'Dirección');

$objPHPExcel->getActiveSheet()->setCellValue('B3', $data['fecha']);
$objPHPExcel->getActiveSheet()->setCellValue('B4', $data['nombre']);
$objPHPExcel->getActiveSheet()->setCellValue('B5', $data['direccion']);

$objPHPExcel->getActiveSheet()->setCellValue('C3', $data['ruc']);
//$objPHPExcel->getActiveSheet()->setCellValue('C5', $data['telfijo']);


//$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Cantidad');
//$objPHPExcel->getActiveSheet()->setCellValue('B7', 'Detalle');
//$objPHPExcel->getActiveSheet()->setCellValue('C7', 'Valor Unitario');
//$objPHPExcel->getActiveSheet()->setCellValue('D7', 'Valor Total');



//$objPHPExcel->getActiveSheet()->setCellValue('C37', 'Subtotal:');
$objPHPExcel->getActiveSheet()->setCellValue('D37', '=SUM(D8:D36)');

//$objPHPExcel->getActiveSheet()->setCellValue('C38', 'Iva 0%:');
$objPHPExcel->getActiveSheet()->setCellValue('D38', '0');

$objPHPExcel->getActiveSheet()->setCellValue('C39', 'Iva 12%:');
$objPHPExcel->getActiveSheet()->setCellValue('D39', '=D37*0.12');

$objPHPExcel->getActiveSheet()->setCellValue('C40', 'Total:');
$objPHPExcel->getActiveSheet()->setCellValue('D40', '=D37+D38+D39');

$valorcelda = $objPHPExcel->getActiveSheet()->getCell ('D40')->getCalculatedValue();
$totalcedena = numtoletras($valorcelda );

$objPHPExcel->getActiveSheet()->setCellValue('A37', 'Son:');
$objPHPExcel->getActiveSheet()->setCellValue('B37', $totalcedena);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22);


$styleThinBlackBorderOutline = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('argb' => 'FF000000'),
        ),
    ),
);


$objPHPExcel->getActiveSheet()->getStyle('A1:D7')->applyFromArray(
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


$objPHPExcel->getActiveSheet()->getStyle('A1:D2')->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('A3:D40')->getFont()->setSize(10);

$objPHPExcel->getActiveSheet()->getComment('A37')->setHeight('22pt');



$pageMargins = $objPHPExcel->getActiveSheet()->getPageMargins();



// margin is set in inches (0.5cm)
$margin = 0.5 / 2.54;

$pageMargins->setTop($margin);
$pageMargins->setBottom($margin);
$pageMargins->setLeft($margin);
$pageMargins->setRight($margin);


for ($i=37;$i<41;$i++) {
    $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(9 );

}

$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(9 );
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(9 );

$objPHPExcel->getActiveSheet()->setShowGridLines(false);

//echo date('H:i:s') , " Set orientation to landscape" , PHP_EOL;
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
