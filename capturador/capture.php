<?php
	include "../routes.php";
	$view = new Front("capturador/views");
	$view->Header(["title"=>"Realizar captura"]);
	if (isset($_GET['id'])){
		$view->View("capture/take");
	}else{
		$view->View("capture");
	}
	$view->Footer();
?>