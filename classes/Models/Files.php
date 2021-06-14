<?php  

	/**
	 * 
	 */
	class Files extends Admin
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function UploadImage()
		{
			$target_dir = "../assets/data/images/";
			if (!file_exists($target_dir)) {
			    mkdir($target_dir, 0777, true);
			}
			$id_name = uniqid();
			$userfile_extn = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.')+1);
			$name = $id_name.".".$userfile_extn;

			$target_file = $target_dir . $name;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			
			$message ="";

			// Check if file already exists
			if (file_exists($target_file)) {
			  $message .= "Sorry, file already exists.";
			  $uploadOk = 0;
			}

			// Check file size
			if ($_FILES["image"]["size"] > 1500000) {
			  $message .= "Sorry, your file is too large.";
			  $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 1) {
			  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			  	$uploadOk = 1;
			  } else {
			  	$message .= "No se pudo mover";
			  	$uploadOk=0;
			  }
			}
			return Array("success"=>($uploadOk==1),"message"=>$message,"name"=>("assets/data/images/".$name));
		}
	}

?>