<?php
	include "../routes.php";
	$view = new Front("capturador/views");
	$view->Header(["title"=>"Menú"])
	->View("index")
	->Footer();
?>