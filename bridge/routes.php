<?php
	require "../classes/utils.php";
	$router = new Router;

	$router->Crud("users","User"); //Genera las rutas: newUser, getUser, saveUser, deleteUser
	$router->Crud("clients","Client"); //Genera las rutas: newClient, getClient, saveClient, deleteClient
	$router->Crud("consumptions","Consumption"); //Genera las rutas: newConsumption, getConsumption, saveConsumption, deleteConsumption
	$router->Crud("apartments","Apartment"); //Genera las rutas: newApartment, getApartment, saveApartment, deleteApartment
	$router->Crud("buildings","Building"); //Genera las rutas: newBuildings, getBuildings, saveBuildings, deleteBuildings
	$router->Crud("addresses","Address"); //Genera las rutas: newAddress, getAddress, saveAddress, deleteAddress
	$router->Crud("payments","Payment"); //Genera las rutas: newPayment, getPayment, savePayment, deletePayment


	$router->Group("buildings",
		[
			["getAllBuildings","List"] //Genera la ruta "getAllBuildings" y ejecuta la función "List" del controlador "buildings" 
		]
	);

	$router->Group("apartments",
		[
			["getBuildingApartments","GetByBuilding"],
			["getAparmentByMesurer","GetByMesurer"]
		]
	);

	$router->Group("clients",
		[
			["getClientByAparment","GetByApartment"],
			["updateClient","UpdateInfo"]
		]
	);

	$router->New("getLastPayment","payments/GetLast");
	$router->New("login","users/Login");

	$router->New("uploadImage","files/UploadImage");

	$router->RUN();
?>