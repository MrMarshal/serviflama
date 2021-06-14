/*DataTable Init*/

"use strict"; 

$(document).ready(function() {
	"use strict";
	
	$('#datable_1').DataTable({
		"lengthMenu": [[20, 50, -1], [20, 50, "Todos"]],
		"language": {
			"search": "Buscar:",
			"info": "Mostrando del _START_ al _END_ de _TOTAL_ resultados",
			"lengthMenu": 'Mostrar _MENU_ resultados',
			"paginate": {
				"previous": "Anterior",
				"next": "Siguiente"
			}
			
		}
	});
    $('#datable_2').DataTable({ 
    	"lengthChange": false
    });
} );