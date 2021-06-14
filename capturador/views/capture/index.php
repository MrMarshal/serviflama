<section class="container text-center">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 text-left">
		  <a href="index.php" class="btn btn-success btn-icon-anim btn-circle" style="padding-top: 11px;margin-top: 20px;font-weight: bold;"><i class="icon-arrow-left"></i></a>
		</div>
	</div>
	<div class="row" style="margin-top: 20px;">
		<h4 class="text-white">BUSCAR CLIENTE POR:</h4>
	</div>
	<div class="panel-wrapper collapse in">
		<div class="panel-body">
			<div class="form-wrap">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Medidor" id="mesurer">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Nombre" id="client_name">
				</div>
				<div class="form-group mt-30 mb-30">
					<select class="form-control" id="building" onchange="buildingSelected()"></select>
				</div>
				<div class="form-group mt-30 mb-30">
					<select class="form-control" id="apartment" onchange="apartmentSelected()">
						<option value="-1">Selecciona primero un edificio</option>
					</select>
				</div>
				<div class="form-group mt-30">
					<a href="" class="btn btn-success btn-rounded" onclick="searchClient();javascript:return false;">BUSCAR</a>
				</div>
				<div class="form-group mt-30">
					<a href="" class="btn btn-orange" onclick="registerConsumption();javascript:return false;">Registrar Consumo</a>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	function searchClient() {
		if ($("#mesurer").val()!=""){
			get("getAparmentByMesurer",{
				data:{
					mesurer:$("#mesurer").val()
				},
				success: function(apartment) {
					console.log(apartment)
					if (apartment!=null){
						$("#client_name").val(apartment.client.name+" "+apartment.client.lastname);
						$("#building").val(apartment.building_id);
						let ap = "<option value='"+apartment.id+"' selected'>"+apartment.name+"</option>";
						$("#apartment").html(ap);
					}else{
						alert("Ningún departamento encontrado")
					}
				}
			})
		}else if ($("#client_name").val()!=""){
			alert("Buscando por el nombre del cliente");
		}
	}
</script>

<script type="text/javascript">
	function registerConsumption() {
		let ap = $("#apartment").val();
		if (ap!=-1){
			location.href = "capture.php?id="+ap;
		}else{
			alert("Necesitas seleccionar un departamento");
		}
	}
</script>

<script type="text/javascript">
	let apartments = null;

	get("getAllBuildings",{
		success:function(bs) {
			$("#building").html(getOptions(bs,{select:"Selecciona un edificio"}));
		}
	})

	function buildingSelected() {
		let building = $("#building").val();
		get("getBuildingApartments",{
			data:{
				building: building
			},
			success: function(as) {
				$("#apartment").html(getOptions(as,{select:"Selecciona el departamento"}));
				apartments = as;
			}
		})
	}

	function apartmentSelected() {
		let id = $("#apartment").val();
		$("#mesurer").val(apartments.filter(x => x.id == id)[0].mesurer);
		get("getClientByAparment",{
			data:{
				apartment_id: id
			},
			success: function(client) {
				console.log(client)
				$("#client_name").val(client.name+" "+client.lastname);
			}
		});
	}
</script>