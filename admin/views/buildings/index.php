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
				<li><a href="#"><span class="text-white">edificios</span></a></li>
			  </ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		
		<!-- /Row -->
		
		<!-- Row -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default border-panel card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Administrar edificios</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="table-wrap">
								<div class="table-responsive">
									<table id="datable_1" class="table table-hover table-bordered display mb-30" >
										<thead>
											<tr>
												<th>Nombre</th>
												<th>Dirección</th>
												<th>Costos</th>
												<th>Notas</th>
												<!--<th>Acciones</th>-->
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>Nombre</th>
												<th>Dirección</th>
												<th>Costos</th>
												<th>Notas</th>
												<!--<th>Acciones</th>-->
											</tr>
										</tfoot>
										<tbody>
											<?php foreach ($data['buildings'] as $b) { 
												$add = $b['address'];
												$dir = $add['street']." ".$add['number'];
												$dir.=($add['country']!=""?"<br>":"");
												$dir.=" ".$add['country'];
												$dir.=($add['suburb']!=""?("<br>Col. ".$add['suburb']):"");
												$dir.=($add['townhall']!=""?("<br>Alc. ".$add['townhall']):"");
												$dir.=$add['zipcode'];
												$dir.=($add['reference']!=""?("<br>(".$add['reference'].")"):"");
												?>
												<tr>
													<td><?php echo $b['name']; ?></td>
													<td><?php echo $dir; ?></td>
													<td>
														$/L: $<?php echo $b['price']; ?>
														<br>
														Admon: $<?php echo $b['admin_cost']; ?>
													</td>
													<td><?php echo $b['note']; ?></td>
													<!--<td class="text-center"><a href="buildings.php?a=view&id=<?php echo $b['id']; ?>"><i class="fa fa-eye"></a></td>-->
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>	
						</div>	
					</div>	
				</div>	
			</div>
		</div>
		<!-- /Row -->
</section>


<!-- jQuery -->
<script src="../assets/vendor/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Data table JavaScript -->
<script src="../assets/vendor/bower_components/datatables/media/js/jquery.dataTables.js"></script>
<script src="../assets/js/dataTables-data.js"></script>