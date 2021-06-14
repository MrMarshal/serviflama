<!-- Modal -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="newPaymentModal" class="modal fade" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="addClientModalLabel">Registrar un pago</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-material">
					<div class="form-group">
						<div class="col-md-12 mb-20">
							<input type="hidden" id="payment_total">
							<input type="hidden" id="consumption_id">
							<input type="hidden" id="apartment_id">
							Adeudo total: $<span id="payment_balance">00</span>
						</div>
						<div class="col-md-6 mb-20">
							<input type="number" class="form-control" placeholder="Monto del pago" id="payment_amount">
						</div>
						<div class="col-md-6 mb-20">
							<input type="text" class="form-control" placeholder="Nota de referencia" id="payment_note">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-orange" id="add_payment_modal_save_btn">Guardar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div id="printables">
	<div aria-hidden="true" role="dialog" tabindex="-1" id="paymentDetailModals" class="modal fade" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close not-print" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="addClientModalLabel" style="text-decoration: none !important;">Detalles del consumo</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal form-material">
						<div class="form-group">
							<div class="col-md-12 mb-20">
								<table class="table table-responsive table-striped table-bordered">
								  <thead class="thead-bg">
								    <tr>
								    	<td colspan="8" class="text-center text-white">
								    		MEDICIÓN DE CONSUMO
								    		<br>
								    		<a href="#detail_consumption_consumption" id="show_consumption_detail_btn" class="not-print" data-toggle="collapse" style="color: #fba30d;">(Desplegar)</a>
								    	</td>
								    </tr>
								  </thead>
								  <tbody class="collapse text-center" id="detail_consumption_consumption">
								  	<tr>
								  		<th scope="col">Lec. Actual</th>
								  		<th scope="col">Lec. Anterior</th>
								  		<th scope="col">Consumo (m<sup>3</sup>)</th>
								  		<th scope="col">Litros</th>
									</tr>
									<tr>
									    <td id="details_current_lecture">2614.312</td>
									    <td id="details_previous_lecture">2608.142</td>
									    <td id="details_consumption_m3">5.886</td>
									    <td id="details_liters">22.96</td>
									</tr>
									<tr>
								  		<th scope="col">Costo/Litro</th>
								  		<th scope="col">Promedio Diario</th>
								  		<th scope="col">Días</th>
								  		<th scope="col">Periodo de consumo</th>
									</tr>    
									    <td id="details_price">12.24</td>
									    <td id="details_average">0.24</td>
									    <td id="details_days">25</td>
									    <td id="details_period">05 DIC 2020 al 30 DIC 2020</td>
								  	</tr>
								  </tbody>
								</table>

								<table class="table table-responsive table-striped">
								  <thead class="thead-bg">
								    <tr>
								    	<td colspan="8" class="text-center text-white">
								    		Conceptos
								    	</td>
								    </tr>
								  </thead>
								  <tbody class="text-center">
								  	<tr>
								  		<td colspan="2">GAS</td>
									    <td colspan="2">ADMINISTRACIÓN</td>
								  		<td colspan="2">ADEUDO ANTERIOR</td>
									    <td colspan="2">SALDO A FAVOR</td>
									</tr>
									<tr>
								  		<td colspan="2" id="details_total">$281</td>
									    <td colspan="2" id="details_admin_cost">$10</td>
								  		<td colspan="2" id="details_balance">$0</td>
									    <td colspan="2" id="details_favor">$0</td>
									</tr>
								  </tbody>
								</table>

								<table class="table table-responsive table-striped">
								  <thead class="thead-bg text-white">
								    <tr>
										<td colspan="4">Fecha límite de pago</td>
										<td colspan="4">Suspensión de servicio</td>
								    </tr>
								  </thead>
								  <tbody>
									<tr>
								  		<td colspan="4" class="text-center" id="details_payment_date">09 de enero 2021</td>
									    <td colspan="4" class="text-center" id="details_suspension_date">10 de enero 2021</td>
									</tr>    
								  	<tr>
								  		<td colspan="8" class="text-center" style="font-size: 20px;color: #022199;font-weight: bold;">
								  			TOTAL A PAGAR: $<span id="details_total_final">291</span>
								  		</td>
								  	</tr>
								  </tbody>
								</table>

							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-orange not-print" onclick="_print()">Imprimir</button>
					<button type="button" class="btn btn-default not-print" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>
<!-- /.modal -->

<script type="text/javascript">
	$('#detail_consumption_consumption').on('shown.bs.collapse', function () {
		$("#show_consumption_detail_btn").html("(Ocultar)");  
	});
	$('#detail_consumption_consumption').on('hidden.bs.collapse', function () {
		$("#show_consumption_detail_btn").html("(Desplegar)");  
	});
</script>

<script type="text/javascript">
	function addDays(date, days) {
	  var result = new Date(date);
	  result.setDate(result.getDate() + days);
	  return result;
	}

	function getDate(date) {
	    return date.getDate() + " " + meses[date.getMonth()] + " " + date.getFullYear();
	}
</script>

<script type="text/javascript">
	function show_payment_detail_modal(id) {
		get("getConsumption",{
			data:{
				id:id,
			},
			success: function(res){
				console.log(res)
				let consumption = res.lecture-res.previous.lecture;
				let date1 = new Date(res.date); let date2 = new Date(res.previous.date);
				let days = Math.ceil(Math.abs(date2 - date1) / (1000 * 60 * 60 * 24))-1; 
				let avg = days>0?consumption/days:consumption;
				var date1_s = getDate(date2);
				var date2_s = getDate(date1);
				let payment_date = getDate(addDays(date1,10));
				let suspension_date = getDate(addDays(date1,11));
				let cost = res.price*res.liters;
				let payment = res.previous.payment;
				$("#details_current_lecture").html(res.lecture);
				$("#details_previous_lecture").html(res.previous.lecture);
				$("#details_consumption_m3").html(consumption);
				$("#details_liters").html(res.liters);
				$("#details_price").html("$"+res.price);
				$("#details_average").html(( Math.round(avg * 100) / 100 ));
				$("#details_days").html(days);
				$("#details_period").html(date1_s+" al "+date2_s);
				$("#details_total").html("$"+cost.toFixed(2));
				$("#details_admin_cost").html("$"+res.admin);
				$("#details_balance").html("$"+((payment&&payment.balance>0)?payment.balance:0));
				$("#details_favor").html("$"+((payment&&payment.balance<0)?(payment.balance*-1):0));
				$("#details_payment_date").html(payment_date);
				$("#details_suspension_date").html(suspension_date);
				$("#details_total_final").html((Number(cost)+Number(res.admin)+(payment?Number(res.previous.payment.balance):0)).toFixed(2));
				$("#paymentDetailModal").modal("show");
			}
		});
	}
</script>


<script type="text/javascript">
	let _on_payment_end = null;

	$("#add_payment_modal_save_btn").on("click",function() {
		if (_on_payment_end!=null){
			post("newPayment",{
				data:{
					apartment_id: $("#apartment_id").val(),
					consumption_id: $("#consumption_id").val(),
					amount: $("#payment_amount").val(),
					balance: Number($("#payment_total").val())-Number($("#payment_amount").val()),
					note: $("#payment_note").val()
				},
				success:function(data){
					if (_on_payment_end!=null)
						_on_payment_end(data)
				}
			});
		}
	});

	function add_payment_modal(consumption_id,on_end) {
		_on_payment_end = on_end;
		$("#newPaymentModal").modal("show");
		get("getConsumption",{
			data:{
				id:consumption_id
			},
			success:function(con) {
				$("#consumption_id").val(con.id);
				$("#apartment_id").val(con.apartment_id);
				console.log(con);
				get("getLastPayment",{
					data:{
						apartment_id:con.apartment_id
					},
					success:function(pay) {
						console.log("Pago: ");
						console.log(pay)
						let price = Math.round(con.price * 10) / 10;
						let total = (Number(con.liters)*price)+Number(con.admin)+Number(pay!=null?pay.balance:0);
						total = Math.round(total*1)/1;
						$("#payment_total").val(total);
						$("#payment_balance").html(total);
					}
				})
			}
		},true)
	}
</script>