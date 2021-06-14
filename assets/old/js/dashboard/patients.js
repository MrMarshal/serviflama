function getPatients(succ,debug=false) {
	$.ajax({
		type:"get",
		url:"../bridge/get.php",
		data:{
			action:"patients"
		},
		success:function(res) {
			if (debug==true)
				console.log(res)
			succ(JSON.parse(res));
		}
	})
}

function getPatientsSearch(search,succ,debug=false) {
	$.ajax({
		type:"get",
		url:"../bridge/get.php",
		data:{
			action:"patients_search",
			search:search
		},
		success:function(res) {
			if (debug==true)
				console.log(res)
			succ(JSON.parse(res))
		}
	})
}