function getDrugs(succ,debug=false) {
	$.ajax({
		type:"get",
		url:"../bridge/get.php",
		data:{
			action:"drugs"
		},
		success:function(res) {
			if (debug==true)
				console.log(res)
			succ(JSON.parse(res))
		}
	})
}