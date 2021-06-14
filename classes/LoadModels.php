<?php  
	class Model
	{
		public $clients;
		public $users;
		public $buildings;
		public $apartments;
		public $addresses;
		public $consumptions;
		public $payments;
		public $files;

		function __construct()
		{
			require "admin.php";
			require "Models/Users.php";
			require "Models/Consumptions.php";
			require "Models/Addresses.php";
			require "Models/Buildings.php";
			require "Models/Apartments.php";
			require "Models/Payments.php";
			require "Models/Clients.php";
			require "Models/Files.php";
			$this->users = new Users;
			$this->consumptions = new Consumptions;
			$this->addresses = new Addresses;
			$this->clients = new Clients;
			$this->buildings = new Buildings;
			$this->apartments = new Apartments;
			$this->payments = new Payments;
			$this->files = new Files;
		}
	}

?>