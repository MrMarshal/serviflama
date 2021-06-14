<?php
	class Data
	{
		public $mail = array(
			"host"=>'hazclink.com',  // Specify main and backup SMTP servers
			"username"=>'promociones@hazclink.com',                 // SMTP username
			"password"=>'Shiosaki.0',                           // SMTP password
			"from"=>'promociones@hazclink.com',
			"from_name"=>'Clink!'
		);

		public $database = array(
			"host"=>"127.0.0.1",
			"name"=>"deskmdch_infusiones",
			"user"=>"deskmdch_infusiones",
			"password"=>"marshal.03300",
		);

		public $databaseDev = array(
			"host"=>"127.0.0.1",
			"name"=>"serviflama_db",
			"user"=>"pruebas",
			"password"=>"Shiosaki.0"
		);

		public $costs = array(
			"shipping"=>"0"
		);
	}
?>
