<section class="container" style="padding-top: 50px;">
	<!-- Title -->
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		  <a href="index.php" class="btn btn-success btn-icon-anim btn-circle" style="padding-top: 11px;font-weight: bold;"><i class="icon-arrow-left"></i></a>
		</div>
		<!-- Breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		  <ol class="breadcrumb">
			<li><a class="text-white" href="index.php">Menú</a></li>
			<li>></li>
			<li><a href="#"><span class="text-white">clientes</span></a></li>
		  </ol>
		</div>
		<!-- /Breadcrumb -->
	</div>
	<!-- /Title -->
	
	<!-- /Row -->

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default card-view pa-0">
				<div class="panel-wrapper collapse in">
					<div class="panel-body pa-0">
						<div class="contact-list">
							<div class="row">
								<aside class="col-lg-2 col-md-4 pr-0">
									<div class="ma-15">
										<a id="newClientBtn" data-target="#newClientModal" data-toggle="modal"  title="Compose" class="btn btn-orange btn-sm btn-block">
										Agregar Cliente
										</a>
									</div>
									<!--<ul class="inbox-nav mb-30">
										<li class="active">
											<a href="#">Work <span class="label label-warning ml-10">12</span></a>
										</li>
										<li>
											<a href="#">design <span class="label label-danger ml-10">20</span></a>
										</li>
										<li>
											<a href="#">family <span class="label label-warning ml-10">2</span></a>
										</li>
										<li>
											<a href="#">friends<span class="label label-info ml-10">30</span></a>
										</li>
										<li>
											<a href="#">office <span class="label label-success ml-10">2</span></a>
										</li>
									</ul>-->
									
								</aside>
								
								<aside class="col-lg-10 col-md-8 pl-0">
									<div class="panel pa-0">
									<div class="panel-wrapper collapse in">
									<div class="panel-body  pa-0">
										<div class="table-responsive mt-15 mb-15">
											<table id="datable_1" class="table  display table-hover mb-30" data-page-size="10">
												<thead>
													<tr>
														<th colspan="4">Datos</th>
														<th colspan="4">Último Consumo</th>
														<th rowspan="2">Acciones</th>
													</tr>
													<tr>
														<th>Edificio</th>
														<th>Depto</th>
														<th>Nombre</th>
														<th>Contacto</th>
														<th>Fecha</th>
														<th>Litros</th>
														<th>$/L</th>
														<th>Adeudo</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>Edificio</th>
														<th>Depto</th>
														<th>Nombre</th>
														<th>Contacto</th>
														<th>Fecha</th>
														<th>Litros</th>
														<th>$/L</th>
														<th>Adeudo</th>
														<th>Acciones</th>
													</tr>
												</tfoot>
												<tbody>
													<?php foreach ($data['clients'] as $cl) { 
														$add = $cl['building']['address'];
														$balance = round($cl['consumption']['liters']*$cl['consumption']['price'],0,PHP_ROUND_HALF_UP)+$cl['consumption']['admin'];
														?>
													<tr>
														<td><?php echo $cl['building']['name']; ?></td>
														<td><?php echo $cl['apartment']['name']; ?></td>
														<td><?php echo $cl['name']; ?></td>
														<td><?php echo $cl['phone'].(!empty($cl['phone'])?"<br>":"").$cl['email']; ?></td>
														<td><?php echo explode(" ", $cl['consumption']['date'])[0]; ?></td>
														<td><?php echo $cl['consumption']['liters']; ?></td>
														<td>$<?php echo $cl['consumption']['price']; ?></td>
														<td>$<?php echo $balance; ?></td>
														<td class="text-center"><a href="clients.php?a=view&id=<?php echo $cl['id']; ?>"><i class="fa fa-eye"></a></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
									</div>
									</div>
								</aside>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>