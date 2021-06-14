<?php
	include "../routes.php";
	include "../classes/LoadModels.php";
	$admin = new Model;
	$view = new Front("admin/views");
	$view->Header(["title"=>"Edificios"]);
	if (isset($_GET['a'])){
		if ($_GET['a']=='view'){
			$building = $admin->buildings->Read($_GET['id']);
			$view->View("buildings/view",["building"=>$building])->Footer();
		}
	}else{
		$buildings = $admin->buildings->List();
		$view->View("buildings",["buildings"=>$buildings])->Footer();
	}
?>