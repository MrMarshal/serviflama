<?php

	class Mail
	{
		
		public $email;
		public $mailBuilder;
		public $admin;
		public $client;
		public $code;

		function __construct($email)
		{
			require_once 'phpmailer/PHPMailerAutoload.php';
			require_once 'mailBuilder.php';
			require_once 'admin.php';
			require_once 'ModelClient.php';
			require_once 'ModelCode.php';
			require_once 'data.php';
			$data = new Data;
			$this->email = $email;
			$this->admin = new Admin;
			$this->client = new Client;
			$this->code = new Code;
			$this->mailBuilder = new MailBuilder;
			$this->mail = new PHPMailer;
			
			$this->mail->isSMTP();                                      // Set mailer to use SMTP
			$this->mail->Host = $data->mail['host'];  // Specify main and backup SMTP servers
			$this->mail->Username = $data->mail['username'];                 // SMTP username
			$this->mail->Password = $data->mail['password'];                           // SMTP password
			$this->mail->From = $data->mail['from'];
			$this->mail->FromName = $data->mail['from_name'];
			
			$this->mail->SMTPAuth = true;                               // Enable SMTP authentication
			$this->mail->Smtp_port =465;
			//$this->mail->Port =465;

			$this->mail->SMTPOptions = array(
			'ssl' => array(
			    'verify_peer' => false,
			    'verify_peer_name' => false,
			    'allow_self_signed' => true
			));
			$this->mail->isHTML(true);                                  
			$this->mail->CharSet = "UTF-8"; 

			
		}

		public function Send($name,$subject,$body,$debug = "")
		{
			$this->mail->addAddress($this->email,$name);
			$this->mail->Subject = $subject;
			$this->mail->Body = $body;
			
			if ($debug!="")
				return $this->mail->Body;

			if(!$this->mail->send()) {
			    return 'Error: ' . $this->mail->ErrorInfo;
			} else {
			    return 'Correo enviado a '.$this->email;
			}
		}

		public function SendPromo($user_mail,$code_id,$debug = "")
		{
			$client = $this->client->GetByEmail($this->email);;
			$code = $this->code->getById($code_id);
			return $this->Send($client['name'],'¡Aprovecha la promoción!',$this->mailBuilder->getPromoMail($client,$code),$debug);
		}

		public function SendRegisterConfirmation($name,$code,$user_id,$debug = "")
		{
			return $this->Send($name,'¡Tu registro fue existoso!',$this->mailBuilder->getConfirmationMail($name,$code,$user_id),$debug);
		}

		public function SendPasswordForgot($debug = "")
		{
			$user = $this->admin->GetUserByEmail($this->email);
			$this->mail->addAddress($this->email,$user['nombre']);
			$this->mail->Subject = 'Cambia tu contraseña aquí';
			$this->mail->Body = $this->mailBuilder->getPasswordForgotMail($user['codigo'],$user['id']);
			
			if ($debug!="")
				return $this->mail->Body;

			if(!$this->mail->send()) {
			    return 'Error: ' . $this->mail->ErrorInfo;
			} else {
			    return 'Correo enviado a '.$this->email;
			}
		}
	}

?>