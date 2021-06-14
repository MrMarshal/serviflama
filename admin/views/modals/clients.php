<!-- Modal -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="newClientModal" class="modal fade" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="addClientModalLabel">Agregar un cliente</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-material">
					<div class="form-group">
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Nombre" id="client_name">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Apellidos" id="client_lastname">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Teléfono" id="client_phone">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Email" id="client_email">
						</div>
						<div class="col-md-12 mb-20">
							<label class="control-label mb-10">Edificio</label>
							<select class="form-control" id="building" onchange="buildingSelected()"></select>
						</div>
						<div class="col-md-12 mb-20">
							<label>
								Departamento
							</label>
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Nombre del depto" id="apartment_name">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Medidor" id="apartment_mesurer">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Referencia" id="apartment_reference">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Nota extra" id="apartment_note">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-orange" id="add_client_modal_save_btn">Guardar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
	get("getAllBuildings",{
		success:function(bs) {
			$("#building").html(getOptions(bs,{select:"Selecciona un edificio"}));
			$("#building").append("<option value='-1'>Agregar nuevo</option>");
		}
	})

	$("#add_client_modal_save_btn").on("click",function() {
		post("newApartment",{
			data:{
				name:$("#apartment_name").val(),
				mesurer:$("#apartment_mesurer").val(),
				building_id: $("#building").val(),
				reference:$("#apartment_reference").val(),
				note:$("#apartment_note").val()
			},
			success:function(apartment) {
				post("newClient",{
					data:{
						apartment_id:apartment.id,
						name:$("#client_name").val(),
						lastname:$("#client_lastname").val(),
						phone:$("#client_phone").val(),
						email:$("#client_email").val()
					},
					success:function(client) {
						location.reload();
					}
				})
			}
		})
	});

	function buildingSelected() {
		let v = $("#building").val();
		if (v == -1){
			add_building_modal(function(building) {
				$("#building option:last").before("<option value='"+building.id+"'>"+building.name+"</option>");
				$("#building").val(building.id);
			})
		}
	}
</script>