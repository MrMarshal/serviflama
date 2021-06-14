<?php
	include "../routes.php";
	include "../classes/LoadModels.php";
	$admin = new Model;
	$view = new Front("admin/views");
	$view->Header(["title"=>"Clientes"]);
	if (isset($_GET['a'])){
		if ($_GET['a']=='view'){
			$client = $admin->clients->Read($_GET['id']);
			$apartment = $admin->apartments->Read($client['apartment_id']);
			$building = $admin->buildings->Read($apartment['building_id']);
			$address = $admin->addresses->Read($building['address_id']);
			$consumptions = $admin->consumptions->GetByApartment($apartment['id']);
			$view->View("clients/view",["client"=>$client,"apartment"=>$apartment,"building"=>$building,"address"=>$address,"consumptions"=>$consumptions])->Footer();
			$view->Modal("payments");		
			$view->Modal("ticket");		
		}
	}else{
		$clients = $admin->clients->List();
		$view->View("clients",["clients"=>$clients])->Footer();
		$view->Modal("clients");		
		$view->Modal("ticket");		
		$view->Modal("payments");		
		$view->Modal("buildings");
	}
?>