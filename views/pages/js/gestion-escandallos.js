var url = 'views/controlers/vw_gestionEscandallos.php';
$(function() {
     console.log( "ready!" );
    
    

     $('#Modal_add_ingredites').on('shown.bs.modal', function() {
     	$("#i_ingrediente").val('');
     	$("#i_ingrediente").focus();
     })



     $('#Modal_add_escandallo').on('shown.bs.modal', function() {
     	$("#i_nuevo_escandallo").val('');
     	$("#i_nuevo_escandallo").focus();
     })




     $( "#b_save_escandallo" ).click(function() {

     	var data = t.$(':input').serialize();

     	$(t.rows().eq(0)).find('tr').each(function(){
     	
     		data += '&' + this.id + '=' + encodeURIComponent($(this).text());
     	});

     	//console.log(data);

     	var num_row = 0;
     	var obj = {};
     	jsonObj = [];	
     	t.rows().eq(0).each( function ( index ) {
     		/*console.log( $(t.row( index ).node()).find('[name*=ingrediente]').val() );
     		console.log(t.cell(index,0).nodes().to$().find('span').text());*/
     
     		obj[index+'_nom_ingrediente']= t.cell(index,0).nodes().to$().find('span').text();
     		obj[index+'_cantidad_usada']= t.cell(index,1).nodes().to$().find('input').val();
     		obj[index+'_uni_medida_cant_usada']= t.cell(index,1).nodes().to$().find('span').text();
     		obj[index+'_cantidad_comprada']= t.cell(index,2).nodes().to$().find('input').val();
     		obj[index+'_coste_comprado']= t.cell(index,3).nodes().to$().find('input').val();
     		obj[index+'_merma']= t.cell(index,4).nodes().to$().find('input').val();
     		obj[index+'_peso_neto']= t.cell(index,5).nodes().to$().find('input').val();
     		obj[index+'_total']= t.cell(index,6).nodes().to$().find('input').val();
     	});

     	obj['sum_cantidadPesada'] = $('#table_escandallo>tfoot td[name=sum_cantidadPesada]').text();
     	obj['sum_pesoNeto'] = $('#table_escandallo>tfoot td[name=sum_pesoNeto]').text();
     	obj['sum_total'] = $('#table_escandallo>tfoot td[name=sum_total]').text();

     	
     	var data = JSON.stringify(obj);

     	var datos = { accion: "setTable_escandallo", 
                        'num_row': t.rows().count() ,
                        'escandallo_nombre': $('#nombre_escandallo').text().trim(),
                        'data': data, 
                        "rand": parseInt(Math.random() * 999) };

     	setTable_escandallo(datos);
     });










     $('#i_nuevo_escandallo').on('keyup', function (e) {
     	if (e.keyCode == 13) {
     		$('#b_guardar_Modal_add_escandallo').click();
     	}
     });
     $( "#b_guardar_Modal_add_escandallo" ).click(function() {
     	var i_nuevo_escandallo = $('#i_nuevo_escandallo').val().toUpperCase();
     	if( i_nuevo_escandallo ){
     		var datos = { accion: "getTable_escandallo", nombre_escandallo: i_nuevo_escandallo};
     		getTableIngredientes(datos);
     	}
     });


});// */ Document ready





 function setTable_escandallo(datos){
	$.ajax({
		type: 'POST',
		url: url,
		data: datos,
		beforeSend: function(response){ 	
				
		},
		success: function(response){ 	
			console.log(response)
		}
	});
}




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
				$('#b_cerrar_Modal_add_escandallo').click();
				$('#b_new_escandallo').prop("disabled", true);
			}
		});
}


function desvindeo_botonera()
{
	$('#bm_add_ingrediente').off();
}