function getServices(succ,debug=false) {
	$.ajax({
		type:"get",
		url:"../bridge/get.php",
		data:{
			action:"services",
			date:$("#select_date").val()
		},
		success:function(res) {
			if (debug==true)
				console.log(res)
			succ(JSON.parse(res))
		}
	})
}

function getServicesByDoctor(id,succ,debug=false) {
	$.ajax({
		type:"get",
		url:"../bridge/get.php",
		data:{
			action:"services",
			date:$("#select_date").val(),
			by:"doctor",
			doctor:id
		},
		success:function(res) {
			if (debug==true)
				console.log(res)
			succ(JSON.parse(res))
		}
	})
}

function getServicesByNurse(id,succ, debug=false) {
	$.ajax({
		type:"get",
		url:"../bridge/get.php",
		data:{
			action:"services",
			date:$("#select_date").val(),
			by:"nurse",
			nurse:id
		},
		success:function(res) {
			if (debug==true)
				console.log(res)
			succ(JSON.parse(res))
		}
	})
}

function getService(id,succ,debug=false) {
	$.ajax({
		type:"get",
		url:"../bridge/get.php",
		data:{
			action:"service",
			id:id
		},
		success:function(res) {
			if (debug==true)
				console.log(res)
			succ(JSON.parse(res))
		}
	})
}