<!-- Modal -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="newBuildingModal" class="modal fade" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="addClientModalLabel">Agregar un edificio</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-material">
					<div class="form-group">
						<div class="col-md-12 mb-20">
							<input type="text" class="form-control" placeholder="Nombre del edificio" id="building_name">
						</div>
						<div class="col-md-4 mb-20">
							<input type="text" class="form-control" placeholder="Nota extra" id="building_note">
						</div>
						<div class="col-md-2 mb-20 pt-10">
							Costos:
						</div>
						<div class="col-md-6 mb-20">
							<div class="col-md-6 mb-20">
								<input type="number" class="form-control" placeholder="$/L" id="building_price">
							</div>
							<div class="col-md-6 mb-20">
								<input type="number" class="form-control" placeholder="Costo de administración" id="building_admin_cost">
							</div>
						</div>
						<div class="col-md-12 mb-20">
							<label>
								Dirección
							</label>
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Calle" id="address_street">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Número" id="address_number">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Estado" id="address_country">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Colonia" id="address_suburb">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Alcaldía" id="address_townhall">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Código postal" id="address_zipcode">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Referencia" id="address_reference">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Nota extra" id="address_note">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-orange" id="add_building_modal_save_btn">Guardar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<script type="text/javascript">
	let _on_end = null;
	function add_building_modal(on_end) {
		_on_end = on_end;
		$("#newBuildingModal").modal("show");
	}

	$("#add_building_modal_save_btn").on("click",function() {
		post("newAddress",{
			data:{
				street:$("#address_street").val(),
				number:$("#address_number").val(),
				country:$("#address_country").val(),
				suburb:$("#address_suburb").val(),
				townhall:$("#address_townhall").val(),
				zipcode:$("#address_zipcode").val(),
				reference:$("#address_reference").val(),
				note:$("#address_note").val()
			},
			success: function(address){
				post("newBuilding",{
					data:{
						address_id:address.id,
						name:$("#building_name").val(),
						note:$("#building_note").val(),
						price:$("#building_price").val(),
						admin_cost:$("#building_admin_cost").val()
					},
					success:function(building){
						console.log(building)
						if (_on_end!=null){
							_on_end(building.data)
						}
						$("#newBuildingModal").modal("hide");
					}
				})
			}
		});
	});
</script>