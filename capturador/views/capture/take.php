<section class="container">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 text-left">
		  <a href="index.php" class="btn btn-success btn-icon-anim btn-circle" style="padding-top: 11px;margin-top: 20px;font-weight: bold;"><i class="icon-arrow-left"></i></a>
		</div>
	</div>
	<div class="row text-center" style="margin-top: 20px;">
		<h4 class="text-white">Registrar consumo</h4>
	</div>
	<div class="panel-wrapper">
		<div class="panel-body">
			<div class="form-wrap">
				<div class="form-group mt-30">
					<input type="number" class="form-control" placeholder="Lectura" id="lecture">
				</div>
				<div class="form-group mt-30">
					<input type="file" class="form-control" id="image">
				</div>
				<div class="form-group mt-30">
					<input type="text" class="form-control" placeholder="Nota extra" id="extra_note">
				</div>
			</div>
		</div>
	</div>
	<div class="row text-center">
		<a  class="btn btn-orange btn-rounded" onclick="registerConsumption();">Listo</a>
	</div>
</section>

<script type="text/javascript">

	function uploadImage(fn) {
		console.log("HIY");
		let files = new FormData();
		files.append('image',$('#image')[0].files[0])
		$.ajax({
		    url:"../bridge/routes.php?action=uploadImage",
		    type:"post",
		    data: files,
			contentType: false,
			processData: false,
		    success:function(res){
		    	console.log(res)
		    	res = JSON.parse(res);
		    	if(res.success==true){
		        	fn(res.name);
		    	}else{
		    		alert(res.message);
		    	}
		    }
		});
		return false;
	}

	function registerConsumption() {
		if ($("#lecture").val()){
			uploadImage(function(url) {
				post("newConsumption",{
					data:{
						apartment_id: <?php echo $_GET['id']; ?>,
						lecture: $("#lecture").val(),
						photo: url,
						note: $("#extra_note").val()
					},
					success:function(res) {
						alert("Consumo registrado correctamente");
						location.href="index.php";
					}
				});
			})
		}else{
			alert("Ingresa una lectura válida");
		}
		return false;
	}
</script>