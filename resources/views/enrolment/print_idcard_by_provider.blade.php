<?php

require 'dompdf/vendor/autoload.php';
	// reference the Dompdf namespace
	use Dompdf\Dompdf;

	//Reference the option namespace
	use Dompdf\Options;
	
	use Dompdf\FontMetrics;
	
	$options = new Options();
    
   $returnHTML = session('returnHTML');
    $options->set('isPhpEnabled',true);
    $options->set('isRemoteEnabled', TRUE);
    $options->set('isLocalEnabled', TRUE);
	// instantiate and use the dompdf class
	$dompdf = new Dompdf($options);
	$dompdf->setPaper(array(0,0,243.6499,153.67375));
	$dompdf->loadHtml($returnHTML);

	// (Optional) Setup the paper size and orientation
	//$dompdf->setPaper('A4', 'portrait');
	//$dompdf->setPaper(array(100,100,0,0));
	// Render the HTML as PDF
	$dompdf->render();
	$canvas = $dompdf->getCanvas();
	$canvas->page_script('');
	$dompdf->stream('IDCARD.pdf',array('Attachment'=>false));
?>