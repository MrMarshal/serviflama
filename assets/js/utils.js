var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

function errorHandle( jqXHR, textStatus, errorThrown ) {
    if (jqXHR.status === 0) {
        console.error('Not connect: Verify Network.');
    } else if (jqXHR.status == 404) {
        console.error('Requested page not found [404]');
    } else if (jqXHR.status == 500) {
        console.error('Internal Server Error [500].');
    } else if (textStatus === 'parsererror') {
        console.error('Requested JSON parse failed.');
    } else if (textStatus === 'timeout') {
        console.error('Time out error.');
    } else if (textStatus === 'abort') {
        console.error('Ajax request aborted.');
    } else {
        console.error('Uncaught Error: ' + jqXHR.responseText);
    }
}

function get(action,req,debug=null) {
    $.ajax({
        url:"../bridge/routes.php?action="+action,
        type:"get",
        data: req.data,
        success:function(res){
            if (debug!=null)
                console.log(res)
            req.success(JSON.parse(res));
        },
        error: errorHandle
    });
}
function post(action,req,debug=null) {
    $.ajax({
        url:"../bridge/routes.php?action="+action,
        type:"post",
        data: req.data,
        success:function(res){
            if (debug!=null)
                console.log(res)
            req.success(JSON.parse(res));
        },
        error: errorHandle
    });
}

function getOptions(data,options={}) {
    let res = "";
    if (data!=null){
        res = '<option value="'+(options.select_val||"")+'">'+(options.select||"Selecciona")+'</option>';
        if (data.lenght!=0){
            for (var i = 0; i < data.length; i++) {
                let op = data[i];
                let _index = options.index||"id";
                let _name = options.name||"name";
                let index = op[_index];
                let name = op[_name];
                res += '<option value="'+(index)+'">'+(name)+'</option>';
            }
        }
    }
    return res;
}
