<?php 
require('fpdf/fpdf.php'); 
require('qrlib.php'); 
//$pdf = new PDF_BARCODE('P','mm','A4');
$pdf = new FPDF();

$pdf->AddPage('L','A4');
QRcode::png('NGSCHS1000005', 'qrcode_image.png'); 
$pdf->Image('qrcode_image.png', 10,20,100,100,'png');
$pdf->output();
?>