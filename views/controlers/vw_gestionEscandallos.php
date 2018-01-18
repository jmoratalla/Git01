<?php 

if( isset($_POST['accion']))
{
	require_once("../../class/pdo_db.php");
  $db_conn = new ConectPDO();
}



if( $_POST['accion']=='setIngrediente')
{
	setIngrediente($_POST, $db_conn );
}else if(  $_POST['accion']=='getTable_escandallo' )
{
	getTable_escandallo($_POST);
}
?>







<?php 

function setIngrediente($_P, $db_conn )
{
	echo "dato guardado";
	var_dump($_P);
}

function getTable_escandallo($_P)
{
	?>
	
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">

			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<button type="button"  class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#Modal_add_ingredites">
							Nuevo ingrediente
						</button>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<!--   <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
							<!--  <li><a href="#">Link</a></li> -->
          <!--     <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li> -->

            </ul>
         <!--    <form class="navbar-form navbar-left">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form> -->
            <ul class="nav navbar-nav navbar-right">
             <li>
              <form class="navbar-form navbar-right">
               <button type="button" class="btn btn-default" style="margin-right:  10px"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>

               <button type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
             </form>

           </li> 
           <!-- <li><a href="#">Link</a></li> -->
       <!--        <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </li> -->
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

    </div>
    <!-- */ col -->
  </div>
  <!-- */ row -->

  <style>
  #table_escandallo input { width: 80px; }
</style>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		Escandallo. Nº <span id="num_escandallo">1</span>
	</div>
	<!-- */ col -->
</div>
<!-- */ row -->

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<table id="table_escandallo" class="table table-hover dataTable" cellspacing="0" width="100%" id_escanallo="1">
			<thead>
				<tr>
					<th>Ingredientes</th>
					<th>Cantidad Pesada</th>
					<th>Peso unidad?</th>
					<th>Coste Unitario <i class="fa fa-eur" aria-hidden="true"></i></th>
					<th>Merma <i class="fa fa-percent" aria-hidden="true"></i></th>
					<th>Peso neto</th>
          <th>Subtotal <i class="fa fa-eur" aria-hidden="true"></i></th>
          <th></th>
        </tr>
      </thead>
      <tfoot>
      <tr>
        <th rowspan="1" colspan="1" class="text-center">Suma</th>
        <td rowspan="1" colspan="1" style="color:blue;" name="sum_cantidadPesada">0,000</td>
        <th rowspan="1" colspan="1" style="color:blue;"></th>
        <td class="dt-body-right" rowspan="1" colspan="1" style="color:blue;">00,00</td>
        <td rowspan="1" colspan="1" style="color:blue;" name="sum_merma">00,00</td>
        <td rowspan="1" colspan="1" style="color:blue;" name="sum_pesoNeto">0,000</td>
        <td rowspan="1" colspan="1" style="color:blue;" name="sum_subtotal">0,000</td>
        <td rowspan="1" colspan="1" style="color:blue;"></td>
      </tr>
      </tfoot>
      <tbody> </tbody>

    </table>



  </div>
  <!-- */ col -->
</div>
<!-- */ row -->

<script>
	$(document).ready(function() {
   

/*   $('#i_merma').mouseout(function() {

  });
*/

   initDT();

   $('#i_ingrediente').on('keyup', function (e) {
     if (e.keyCode == 13) {
       $('#bm_add_ingrediente').click();
     }
   });


   $('#bm_add_ingrediente').on( 'click', function () {
     
     var ingrediente = $('#i_ingrediente').val().trim();
     if( $('#i_ingrediente').val() ) {
      
   /* Metodo antiguo de insertar una fila, pero no es con funciones dataTables. Se ha actualizado.  
     var row = $('<tr>');
      row.append('<td>'+ingrediente+'</td>')
      .append('<td><div class="input-group"><input id="i_cantidad" name="i_cantidad"  type="text" class="form-control"><span class="input-group-addon" onclick="modifica_medida(this)" style=" cursor: pointer; cursor: hand; color:blue;">KG</span></div></td>')
      .append('<td>#</td>')
      .append('<td><input id="i_coste_unitario" type="text" class="form-control"></td>')
      .append('<td><input name="i_merma" id="i_merma" type="text" class="form-control" value="000"></td>')
      .append('<td id="td_peso_neto">0,000</td>')
      .append('<td id="td_subtotal">000,00</td>')
      .append('<td><button name="b_del_ingrediente" id="b_del_ingrediente" type="button" class="btn btn-danger pull-right"><i class="fa fa-trash-o" aria-hidden="true" ></i></button></td>')
        t.row.add(row);
    		$('#table_escandallo tbody').prepend(row); */// agrega en el 1 row



        // agrega en el 1 row
        var rowNode = t
        .row.add( [ ingrediente, '<div class="input-group"><input id="i_cantidad" name="i_cantidad" type="text" class="form-control" maxlength="5" value="0,000"><span class="input-group-addon" onclick="modifica_medida(this)" style=" cursor: pointer; cursor: hand; color:blue;">KG</span></div>', '#','<input id="i_coste_unitario" type="text" class="form-control" value="00,00">', '<input name="i_merma" id="i_merma" type="text" class="form-control" value="000">', '<input disabled name="i_pneto" id="i_pneto" type="text" class="form-control" value="0,000">', '0,000', '<button name="b_del_ingrediente" id="b_del_ingrediente" type="button" class="btn btn-danger pull-right"><i class="fa fa-trash-o" aria-hidden="true" ></i></button>' ] )
        .draw().node();


        $("#i_ingrediente").val('');
        $("#i_ingrediente").focus();
        bindeo_b_del_ingredie();

      }




      
    });






	}); // document ready



  function modifica_medida(objeto)
  {
   if($(objeto).html()=='KG')
   {
    $(objeto).html('L')
  }else
  {
    $(objeto).html('KG')
  }	
  
}


function bindeo_b_del_ingredie()
{


$("input[name^=i_cantidad]").off('focusout').focusout(function(){
    var str = parseFloat( remplace_comma_to_point($(this).val())).toFixed(3);
    $(this).val(str);
    calcu_pesoNeto(this);
    calculo_sumaTotal_table();
  });


$("input[name^=i_merma]").off('focusout').focusout(function()
{

  var str = $(this).val().trim();
  var newPath= str.replace(' ','');
  var log_str = newPath.length;

  if( log_str < 3){
    $(this).val("0"+newPath+"00" );
  }else if(log_str == 3){
     $(this).val(parseFloat( newPath ).toFixed(1) );
  }
  calcu_pesoNeto(this);
}); 




  $('input[id^=i_cantidad]').inputmask("9,999",{placeholder:" "});

  $('input[name^=i_merma]').inputmask("99,9",{placeholder:" "});
  $('input[id^=i_coste_unitario]').inputmask("99,99",{placeholder:" "});


  
  //$('#table_escandallo tbody button[name^=b_del_ingredie]').off();
  $('#table_escandallo tbody button[name^=b_del_ingredie]').off('click').on( 'click', function (){
    t.row( $(this).closest('tr') ).remove().draw();
  } );

  $("#table_escandallo tbody input[name^=i_merma]").focus(function() {
   $(this).select();
 });



}




function calculo_sumaTotal_table()
{


var total_cantodadPesada ='0.000';
var dato = 0;
/*var arr = [];*/
$('#table_escandallo tbody input[name^=i_cantida]').each(function(index,value){
    console.log( value.value );
    dato = remplace_comma_to_point(value.value); 
    total_cantodadPesada = ( parseFloat(total_cantodadPesada) + parseFloat(dato) ).toFixed(3);


   /*  arr.push(value.value);*/ //put elements into array
  });

 console.log("calculo.: "+total_cantodadPesada);
  $('#table_escandallo tfoot>tr>td[name=sum_cantidadPesada]').html(remplace_comma_to_point(total_cantodadPesada));

}





function calcu_pesoNeto(objeto)
{

  var str = remplace_comma_to_point($(objeto).closest("tr").find('td').eq(1).find("input[name=i_cantidad]").val());
  var cantPesada = parseFloat( str ).toFixed(3);

  var str = remplace_comma_to_point($(objeto).closest("tr").find('td').eq(4).find("input[name=i_merma]").val());
  var merma = parseFloat( str ).toFixed(1);


 if(isNaN(merma)) {
   $(this).closest("tr").find('td').eq(4).find("input[name=i_merma]").val("00,0");
   var merma = "00.0";
 }
  if(isNaN(cantPesada)) {
   $(this).closest("tr").find('td').eq(1).find("input[name=i_cantidad]").val("0,000");
   var cantPesada = "0.000";
 }

  var pneto = (merma*cantPesada)/100;


  if(pneto==0)
  {
     $(objeto).closest("tr").find('td').eq(5).find("input[name=i_pneto]").val("0,000");
  }
  else
  {
   
     $(objeto).closest("tr").find('td').eq(5).find("input[name=i_pneto]").val( remplace_point_to_comma(pneto.toFixed(3)) );
  }
 


}






function initDT(){
    //Construct the measurement table
    t = $('#table_escandallo').DataTable({
      "paging":   false,
      "ordering": false,
      "info":     false,
      "columns": [
      { "width": "40%", "targets": 0 },
      { "width": "8%", "targets": 1 },
      { "width": "8%", "targets": 2 },
      { "width": "8%", "targets": 3 },
      { "width": "8%", "targets": 4 },
      { "width": "8%", "targets": 5 },
      { "width": "8%", "targets": 6 },
      { "width": "10%", "targets": 7 }
      ]
    });

  }

</script>

<?php 
}
?>
