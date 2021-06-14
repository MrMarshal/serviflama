<?php
	include "../routes.php";
	$view = new Front("admin/views");
	$view->Header(["title"=>"Menú"])
	->View("index")
	->Footer();
?>