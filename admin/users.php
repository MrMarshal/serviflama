<?php
	include "../routes.php";
	include "../classes/LoadModels.php";
	$admin = new Model;
	$view = new Front("admin/views");
	$view->Header(["title"=>"Usuarios"]);
	if (isset($_GET['a'])){
		if ($_GET['a']=='view'){
			$user = $admin->users->Read($_GET['id']);
			$view->View("users/view",["user"=>$user])->Footer();
		}
	}else{
		$users = $admin->users->List();
		$view->View("users",['users'=>$users])->Footer();
	}
?>