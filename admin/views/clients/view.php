<?php  
	$client = $data['client'];
	$apartment = $data['apartment'];
	$building = $data['building'];
	$address = $data['address'];
	$consumptions = $data['consumptions'];
?>

<section class="container" style="padding-top: 50px;">
	<!-- Title -->
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		  <a href="clients.php" class="btn btn-success btn-icon-anim btn-circle" style="padding-top: 11px;font-weight: bold;"><i class="icon-arrow-left"></i></a>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		  <ol class="breadcrumb">
			<li><a class="text-white" href="index.php">Menú</a></li>
			<li>></li>
			<li><a href="clients.php"><span class="text-white">clientes</span></a></li>
			<li>></li>
			<li><a href="#"><span class="text-white">ver</span></a></li>
		  </ol>
		</div>
		<!-- /Breadcrumb -->
	</div>
	<!-- /Title -->
	<!-- Row -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default border-panel card-view">
				<div class="panel-heading">
					<div class="pull-left">
						<h4 class="txt-dark"><?php echo $client['name']." ".$client['lastname']; ?></h4>
						<h6><?php echo $client['email']; ?></h6>
						<h6><?php echo $client['phone']; ?></h6>
					</div>
					<div class="pull-right">
						<h6 class="txt-dark"></h6>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-6 col-md-4">
								<address>
									<span class="txt-dark head-font capitalize-font mb-5">Dirección</span>
									<br>
									<?php  
										$dir = $address['street']." ".$address['number'];
										$dir.=($address['country']!=""?"<br>":"");
										$dir.=" ".$address['country'];
										$dir.=($address['suburb']!=""?("<br>Col. ".$address['suburb']):"");
										$dir.=($address['townhall']!=""?("<br>Alc. ".$address['townhall']):"");
										$dir.=" ".$address['zipcode'];
										$dir.=($address['reference']!=""?("<br>(".$address['reference'].")"):"");
										echo $dir;
									?>
								</address>
							</div>
							<div class="col-xs-6 col-md-4">
								<address>
									<span class="txt-dark head-font capitalize-font mb-5">Edificio</span>
									<br>
									<?php echo $building['name']; ?>
									<br>
									Costo por litro: $<?php echo $building['price']; ?>
									<br>
									<?php if ($building['admin_cost']){ ?>
										Gastos administrativos: $<?php echo $building['admin_cost']; ?>
									<?php } ?>
								</address>
							</div>
							<div class="col-xs-6 col-offset-xs-6 col-md-4">
								<span class="txt-dark head-font inline-block capitalize-font mb-5">Departamento</span>
								<address class="mb-15">
									<span class="address-head mb-5">Número: <?php echo $apartment['name']; ?></span>
									Medidor: <?php echo $apartment['mesurer']; ?><br>
									<?php if ($apartment['note']){ ?>
										<abbr title="Nota extra">N:</abbr><?php echo $apartment['note']; ?>
									<?php } ?>
								</address>
							</div>
							<div class="col-md-12 mt-15">
								<h5>Adeudo total: $<span id="total_balance">00.00</span></h5>
							</div>
						</div>

						<div class="seprator-block"></div>
						
						<?php //foreach ($consumptions as $con) { var_dump($con); echo "<br><br>"; } ?>
						<div class="invoice-bill-table">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Fecha</th>
											<th>Consumo</th>
											<th>Total de consumo</th>
											<th>Total con adeudo</th>
											<th>Pago</th>
											<th>Saldo</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$final = 0;
										foreach ($consumptions as $con) { 
											$total = round((float)$con['liters']*$con['price'],0,PHP_ROUND_HALF_UP)+$con['admin'];
											$pay = isset($con['payment']['amount'])?$con['payment']['amount']:0;
											$balance = isset($con['payment']['balance'])?$con['payment']['balance']:0;
											if ($con['payment']==null){
												$final += $total+$con['balance'];
											}
											?>
											<tr>
												<th><?php echo explode(" ",$con['date'])[0]; ?></th>
												<th><?php echo round((float)$con['liters'],2,PHP_ROUND_HALF_UP); ?>lts</th>
												<th>$<?php echo $total; ?></th>
												<th>$<?php echo $total+$con['balance']; ?></th>
												<th><?php echo ($con['payment']!=null?("$".$pay):"Pendiente");?></th>
												<th><?php echo ($con['payment']!=null?("$".$balance):"-"); ?></th>
												<th>
													<?php if (empty($con['payment'])){ ?>
														<a href="" onclick="registerPayment(<?php echo $con['id']; ?>);return false;">
															Registrar pago
														</a>
													<?php }else{ ?>
														<a href="" onclick="viewDetails(<?php echo $con['id']; ?>);return false;">
															Ver detalles o algo
														</a>
													<?php } ?>
												</th>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="button-list pull-right">
								<button type="button" class="btn btn-default btn-outline btn-icon left-icon" onclick="javascript:window.print();"> 
									<i class="fa fa-print"></i><span> Imprimir</span> 
								</button>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Row -->	
</section>


<script type="text/javascript">
	function viewDetails(id) {
		show_payment_detail_modal(id);
	}
</script>

<script type="text/javascript">
	function registerPayment(id) {
		add_payment_modal(id,function(res) {
			location.reload();
		})
		return false;
	}

	$("#total_balance").html("<?php echo $final; ?>");
</script>