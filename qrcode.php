<?php
	header('Content-Type: image/png');
		
	require_once 'vendor\autoload.php';
	
	if(isset($_GET['text'])){
	
		//DEFAULT VALUES
		$size = isset($_GET['size']) ? $_GET['size'] : 200;
		$padding = isset($_GET['padding']) ? $_GET['padding'] : 10;
	
		//create object
		$qr = new Endroid\QrCode\QrCode();
	
		$qr->setText($_GET['text']);
		$qr->setSize($size);
		$qr->setPadding($padding);
		$qr->setForegroundColor(array( 'r' => 31, 'g' => 21, 'b' => 232 , 'a' => 0 ));
		$qr -> setLabel('Scan me');		
		
		//OUTPUT IMAGE
		$qr->render();
	}
	
?>