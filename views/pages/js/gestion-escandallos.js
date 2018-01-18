var url = 'views/controlers/vw_gestionEscandallos.php';
$(function() {
     console.log( "ready!" );
    
    

     $('#Modal_add_ingredites').on('shown.bs.modal', function() {
     	$("#i_ingrediente").val('');
        $("#i_ingrediente").focus();
    })




		$( "#b_new_escandallo" ).click(function() {
			 var datos = { accion: "getTable_escandallo"};
			 getTableIngredientes(datos);
		});






});// */ Document ready



function setIngrediente(datos){
	$.ajax({
		type: 'POST',
		url: url,
		data: datos,
		beforeSend: function(response){ 	
			$('#container_table_escandallo').html('<i class="fa fa-spin fa-circle-o-notch"></i>');		
		},
		success: function(response){ 	
			$('#container_table_escandallo').html(response);
			 $('#Modal_add_ingredites').modal('toggle');
		}
	});
}

function getTableIngredientes(datos){
			$.ajax({
			type: 'POST',
			url: url,
			data: datos,
			beforeSend: function(response){ 	
				$('#container_table_escandallo').html('<i class="fa fa-spin fa-circle-o-notch"></i>');	
				desvindeo_botonera();	
			},
			success: function(response){ 	
				
				$('#container_table_escandallo').html(response);
			}
		});
}


function desvindeo_botonera()
{
	$('#bm_add_ingrediente').off();
}