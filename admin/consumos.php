<?php
include "../routes.php";
include "../classes/LoadModels.php";
$admin = new Model;
$view = new Front("admin/views");
$view->Header(["title" => "Consumos"]);

if (isset($_GET['a'])) {
    if ($_GET['a'] == 'view') {
        $consumptions = $admin->consumptions->List();
        $view->View("clients/view2", ["client" => $client, "apartment" => $apartment, "building" => $building, "address" => $address, "consumptions" => $consumptions])->Footer();
        $view->Modal("ticket");
        $view->Modal("payments");
    }
} else {
    $client = $admin->clients->Read($_SESSION['user']['id']);
    $apartment = $admin->apartments->Read($client['apartment_id']);
    $building = $admin->buildings->Read($apartment['building_id']);
    $address = $admin->addresses->Read($building['address_id']);
    $consumptions = $admin->consumptions->GetByUserId($_SESSION['user']['id']);
    $view->View("clients/view2", ["client" => $client, "apartment" => $apartment, "building" => $building, "address" => $address, "consumptions" => $consumptions])->Footer();
    $view->Modal("ticket");
    $view->Modal("payments");
}
