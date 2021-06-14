function getNurses(succ,debug=false) {
	$.ajax({
		type:"get",
		url:"../bridge/get.php",
		data:{
			action:"nurses"
		},
		success:function(res) {
			if (debug==true)
				console.log(res)
			succ(JSON.parse(res))
		}
	})
}

function getNursesSearch(search,succ,debug=false) {
	$.ajax({
		type:"get",
		url:"../bridge/get.php",
		data:{
			action:"nurses_search",
			search:search
		},
		success:function(res) {
			if (debug==true)
				console.log(res)
			succ(JSON.parse(res))
		}
	})
}