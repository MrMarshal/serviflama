function getDoctors(succ,debug=false) {
	$.ajax({
		type:"get",
		url:"../bridge/get.php",
		data:{
			action:"doctors"
		},
		success:function(res) {
			if (debug==true)
				console.log(res)
			succ(JSON.parse(res))
		}
	})
}

function getDoctorsSearch(search,succ,debug=false) {
	$.ajax({
		type:"get",
		url:"../bridge/get.php",
		data:{
			action:"doctors_search",
			search:search
		},
		success:function(res) {
			if (debug==true)
				console.log(res)
			succ(JSON.parse(res))
		}
	})
}