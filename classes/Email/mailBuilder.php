<?php

	class MailBuilder
	{

		public $img_logo = "http://hazclink.com/assets/img/logo_big.png";
		public $img_welcome_header = "http://tomacurso.com/img/mailing/title_register_confirm.png";
		public $img_change_pass_header = "http://tomacurso.com/img/mailing/title_password_forgot.png";

		public $url_to_confirm = "http://tomacurso.com/system/confirmEmail.php";

		public $url_to_change_password = "http://tomacurso.com/system/changePassword.php";
		
		public $url_to_read_confirm = "";

		public function Header($header_img="")
		{
			$header = 
				'<html>
					<head>
						<meta charset="utf-8">
						<title>Toma Curso</title>
					</head>
					<body>
					<table style="width:350px; font-size: 10px; border: none;font-family: Helvetica, sans-serif;" cellpadding="14"  cellspacing="0" cellpadding="0">
	  					<tr>
	    					<td colspan="3" style="background-color:#314059;border-bottom:10px solid #1a9a9a;">
								<img src="'.$this->img_logo.'" style="width:80px">
							</td>
	  					</tr>
	  					'.($header_img==""?"":'
	  					<tr style="background-color:#F9EF60 !important">
							<td></td>
							<td style="font-size: 16px;text-align:center;font-weight:bold;">
									<img src="'.$header_img.'" width="200px">
							</td>
							<td></td>
						</tr>
						<tr><td colspan="3"><hr></td></tr>').'
						<tr>
							<td colspan="3" style="color: white;">';
	  		return $header;
		}

		public function Footer($user_id="",$action_url="",$action_img="")
		{
			$footer = '		</td>
    					</tr>';
    		if ($action_url!="")
    		$footer .=	'<tr>
							<td colspan="3">
								<br><br>
								<center>
									<a href="'.$action_url.'">
										<img src="'.$action_img.'" width="200px">
									</a>
								</center>
							</td>
						</tr>';
			$footer .= 	(false?"":'<tr>
							<td colspan="3" style="text-align:justify;color:rgba(0,0,0,0.6)">
					        	Este mensaje se envío automáticamente desde el sistema interno de Clink!.
					        	No responda a este mensaje. Si tiene alguna duda respecto a la información recibida, envié un correo electrónico a <a style="text-shadow: none !important; color: #314059;" href="mailto:info@hazclink.com">info@hazclink.com</a>
					    	</td>
					    </tr>');
			$footer .=	'<tr>
	    					<td colspan="3" style="background-color:#1a9a9a;border-top:10px solid #314059;">
								<p style="color:white;opacity:0.5">Copyright &copy; 2019 Clink!.</p>
								<p style="color:white">Para solicitar más información</p>  <a style="text-shadow: none !important; color: #314059;">55 1479-0052</a> 
							</td>
	  					</tr>
					</table>
					<img src="'.$this->url_to_read_confirm.'?id='.$user_id.'"; onerror="this.style.display=\'none\'" alt=""/>
					</body>
				</html>';

			return $footer;
		}

		public function getPromoMail($client,$code)
		{
			$text = $this->Header().
				'<span style="font-size:14px;font-weight:bold;color:#314059">¡Hola! ¿Ya encargaste algo para cenar?</span><br><br>
    			<span style="color:black">¡Tenemos un descuento para ti!</span>
    			<br><br><br>
				<span style="font-size:17px;font-weight:bold;color:rgba(0,0,0,0.8);">Utiliza el código: <strong style="color:#009b96">'.$code['code'].'</strong> en la aplicación  <br> ¡y recibe un increíble descuento!</span>'.
				'<br><br><br><span style="color:black">O sólo da <a href="http://hazclink.com/getPromo.php?token='.$client['token'].'&code='.$code['code'].'">Click aquí</a> para ir directamente a hacer tu pedido.</span>'.
				$this->Footer();
			
			return $text;
		}

		public function getConfirmationMail($name,$code,$user_id)
		{
			$text = $this->Header($this->img_welcome_header).
				'<span style="font-size:14px;font-weight:bold;color:#314059">¡Hola, '.$name.'!</span><br><br>
    			<span style="color:black">Estás a punto de ser parte de nuestros Curseros, sólo te falta confirmar tu email con el link que está debajo.</span>
    			<br><br><br>
				<span style="font-size:17px;font-weight:bold;color:rgba(0,0,0,0.8);"><center>¿Estás listo?</center></span>'.
				'<br><span style="color:black">Sólo da <a href="'.$this->url_to_confirm."?c=".$code.'">Click aquí</a> para empezar</span>'.
				$this->Footer($user_id);
			
			return $text;
		}

		public function getPasswordForgotMail($code,$user_id){
			$text = $this->Header($this->img_change_pass_header).
				'<center>
				<span style="font-size:14px;font-weight:bold;color:#314059">¿Olvidaste tu contraseña?</span>
    			<br>
    			<span style="color:black;font-size:12px;">No te preocupes</span>
    			</center>
    			<br>
    			<br>
    			<span style="color:black;font-size:12px;">Recuperarla es muy fácil, entra al link que te enviamos, completa con tu info y listo.'.
    			'<br><br>Para hacerlo sólo da</span> <a href="'.$this->url_to_change_password."?c=".$code.'">Click aquí</a>.<br><br><br>'.
				$this->Footer($user_id);
			
			return $text;
		}

		public function getReferenceNumberMail($userId,$total,$expires,$reference)
		{
			$text = $this->Header().
				'<span style="font-size:14px;font-weight:bold;color:#314059">
    				Completa tu pago en Oxxo
    			</span>
    			<br>
    			<br>
    			<p style="font-size:13px;"><span style="color:#314059;font-weight:bold">1.</span> Acude a la tienda OXXO más cercana, antes del <span style="color:#314059;font-size:15;>"'.$expires.'.</span></p>
    			<p style="font-size:13px;"><span style="color:#314059;font-weight:bold">2.</span> Indica en caja que quieres ralizar un pago de OXXOPay.</p>
    			<p style="font-size:13px;"><span style="color:#314059;font-weight:bold">3.</span> Dicta al cajero el número de referencia: <span style="font-size:24px;color:#314059;font-weight:bold;"><br>'.$reference.'</span></p>
    			<p style="font-size:13px;"><span style="color:#314059;font-weight:bold">4.</span> Realiza el pago por la cantidad de <span style="color:#314059;font-size:20px;">'.$total.'</span></p>
    			<p style="font-size:13px;"><span style="color:#314059;font-weight:bold">5.</span> Al confirmar tu pago, el cajero te entregará un comprobante impreso. En él podrás verificar que se haya realizado correctamente. Conserva dicho comprobante de pago.</p>
    			<br />
    			<center>
    				<p style="color:#314059;width:100%;font-size:12px">Al completar estos pasos recibirás un correo de "noreply@tomacurso.com" confirmando tu pago.</p>
    			</center>'.
				$this->Footer($userId);
			
			return $text;
		}

		public function getPaymentCompleteMail($user,$amount){
			$text = $this->Header().
				'<span style="font-size:14px;font-weight:bold;color:#314059">
    				Se ha registrado tu pago con éxito por la cantidad de $'.$amount.
    			'</span>
    			<br>
    			<br>
    			Presenta este correo en la recepción del gimnasio y empieza a disfrutar de tu inscripción.'.
				$this->Footer($user['id'],"","");
			
			return $text;
		}


		public function getShippingDataOrderMail($invoice_id,$orders){
			$total = 0;
			$promo = 0;
			$envio = 0;
			$text = $this->Header("").
				'<span style="font-size:16px;font-weight:bold;color:white">
					Nueva orden registrada
    			</span>
    			<br>
    			<br>
    			<span style="color:#314059">Referencia: ghref_'.($invoice_id+1000).'</span>
    			<br>
    				</td>
    			</tr>
    			
    						<tr>
    							<td colspan="1" style="color:white;text-align:left">Producto</td>
    							<td colspan="1" style="color:white;text-align:center">Cantidad</td>
    							<td colspan="1" style="color:white;text-align:right;">Precio</td>
    						</tr>';
    		foreach ($orders as $order) {
    			$total = $order['total'];
    			$promo = $order['promo'];
    			$envio = $order['envio'];
    			$nombre = $order['user_name'];
    			$telefono = $order['phone'];
    			$estado = $order['estado'];
    			$codigo_postal = $order['postal_code'];
    			$direccion = $order['address'];
				$text .='
					<tr>
    					<td colspan="1" style="color:white;margin-left:40px;">'.$order['product_name'].'</td>
    					<td colspan="1" style="color:white;text-align:center">'.$order['cantidad'].'</td>
    					<td colspan="1" style="color:white;text-align:right;">$'.number_format($order['precio'],2).'</td>
    				</tr>';    						
    		}

    		$text .=		'
    						<tr>
    							<td colspan="1" style="color:white;text-align:left">'.($promo==0?"":("Descuento: $".number_format($promo,2))).'</td>
    							<td colspan="1" style="text-align:center;color:#314059">'.($envio==0?"":("Envío: $".number_format($envio,2))).'</td>
    							<td colspan="1" style="color:white;text-align:right;">Total: $'.number_format(($total+$envio), 2).'</td>
    						</tr>
    			<tr>
    				<td colspan="3">
					<span style="font-size:14px;font-weight:bold;color:#314059;">Detalles del envío:</span>
					<br>
					<span style="font-size:11px;color:white;">Nombre: '.$nombre.'</span>
					<br>
					<span style="font-size:11px;color:white;">Teléfono: '.$telefono.'</span>
					<br>
					<span style="font-size:11px;color:white;">Estado: '.$estado.'</span>
					<br>
					<span style="font-size:11px;color:white;">Código Postal: '.$codigo_postal.'</span>
					<br>
					<span style="font-size:11px;color:white;">Dirección: '.$direccion.'</span>
					</td>
				</tr>
				<tr>
					<td>'.
				$this->Footer();
			
			return $text;
		}

	}

?>