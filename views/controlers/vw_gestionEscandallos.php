<?php 


error_reporting(E_ALL);
ini_set('display_errors', 1);



if( isset($_POST['accion']))
{
	require_once("../../class/pdo_db.php");
  $db_conn = new ConectPDO();
}



if( $_POST['accion']=='setIngrediente')
{
	setIngrediente($_POST, $db_conn );
}else if( $_POST['accion']=='getTable_escandallo' )
{
	getTable_escandallo($_POST);
}else if( $_POST['accion']=='setTable_escandallo' )
{

  setTable_escandallo($_POST,$db_conn);
}
?>

















<?php 

function setTable_escandallo($_P, $db_conn )
{


/*  require_once("../class/class_EntidadBase.php");
  $EntidadEscandallos = new EntidadBase("t_user");
  var_dump($EntidadEscandallos->getAll("id_user"));*/
require_once("../class/class_controller_escandallos.php");
$Controller_escadallos = new Controller_escadallos();

// array('pagination' => $pagination, 'update_form' => $updateFrom->createView() ) 
$Controller_escadallos->set_newEscanallo(array(
    'escandallo_id' => '', 
    'escandallo_nombre' => $_P['escandallo_nombre'], 
    'num_row' => $_P['num_row'], 
    'data' => $_P['data'], 
    ));



 die();
  require_once("../class/class_e_escandallos.php");
  $escandallos = new Escandallos();
  $escandallos->setEscandallo_nombre($_P['escandallo_nombre']);
  $escandallos->saveEscandallo();




  die();

  var_dump($_POST);


  $data = json_decode($_POST['data']);
  foreach( $data as $key=>$var)
  {
    echo "------> ".substr($key, 2)." | ".$var."\n";
   // echo "------> ".$key." | ".$var."\n";
    //setEscandallo_nombre($escandallo_nombre);
  }	


 
  
  
}











function getTable_escandallo($_P)
{
	?>
	
<!-- 	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">

			<nav class="navbar navbar-default">
				<div class="container-fluid"> -->
					<!-- Brand and toggle get grouped for better mobile display -->
				<!-- 	<div class="navbar-header">
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
 -->
					<!-- Collect the nav links, forms, and other content for toggling -->
<!-- 					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav"> -->
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

       <!--      </ul> -->
         <!--    <form class="navbar-form navbar-left">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form> -->
         <!--    <ul class="nav navbar-nav navbar-right">
             <li>
              <form class="navbar-form navbar-right">
               <button type="button" class="btn btn-default" style="margin-right:  10px"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>

               <button type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
             </form>

           </li>  -->
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
           <!--  </ul> -->
          <!-- </div> --><!-- /.navbar-collapse -->
        <!-- </div> --><!-- /.container-fluid -->
  <!--     </nav>

    </div> -->
    <!-- */ col -->
<!--   </div> -->
  <!-- */ row -->

  <style>
  #table_escandallo input { width: 80px; }
</style>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">

    <div class="modal-header" style="line-height: 1;padding: 0;border: 0;">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_add_ingredites"style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i> Ingrediete</button>

      <h4 class="modal-title">Plato.: <span id="nombre_escandallo"><?php echo $_POST['nombre_escandallo'] ?></span></h4>
    </div>
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
					<th>Cantidad usada</th>
					<th>Cantidad comprado</th>
					<th>Coste comprado <i class="fa fa-eur" aria-hidden="true"></i></th>
					<th>Merma <i class="fa fa-percent" aria-hidden="true"></i></th>
					<th>Peso neto</th>
          <th>Total <i class="fa fa-eur" aria-hidden="true"></i></th>
          <th></th>
        </tr>
      </thead>
      <tfoot>
      <tr>
        <th rowspan="1" colspan="1" class="text-center">Suma</th>
        <td rowspan="1" colspan="1" style="color:blue;" name="sum_cantidadPesada">0,000</td>
        <th rowspan="1" colspan="1"></th>
        <td class="dt-body-right" rowspan="1" colspan="1" style="color:blue;"></td>
        <td rowspan="1" colspan="1"></td>
        <td rowspan="1" colspan="1" style="color:blue;" name="sum_pesoNeto">0,000</td>
        <td rowspan="1" colspan="1" style="color:blue;" name="sum_total">0,000</td>
        <td rowspan="1" colspan="1"></td>
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
   // Inicialización del DataTable()
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
      .append('<td><div class="input-group"><input id="i_cantidadPesada" name="i_cantidadPesada"  type="text" class="form-control"><span class="input-group-addon" onclick="modifica_medida(this)" style=" cursor: pointer; cursor: hand; color:blue;">KG</span></div></td>')
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
        .row.add( [ '<span  name="ingrediente" id="ingrediente" value="'+ingrediente+'">'+ingrediente+'</span>', '<div class="input-group"><input id="i_cantidadPesada" name="i_cantidadPesada" type="text" class="form-control" maxlength="5" value="0,000"><span class="input-group-addon" onclick="modifica_medida(this)" style=" cursor: pointer; cursor: hand; color:blue;">KG</span></div>', '<input id="i_cantidad_comprado" name="i_cantidad_comprado" type="text" class="form-control" value="00,000">','<input id="i_coste_unitario" name="i_coste_unitario" type="text" class="form-control" value="00,00">', '<input name="i_merma" id="i_merma" type="text" class="form-control" value="000">', '<input readonly  name="i_pesoNeto" id="i_pesoNeto" type="text" class="form-control" value="0,000">', '<input readonly id="i_total" name="i_total" type="text" class="form-control" value="00,00">', '<button name="b_del_ingrediente" id="b_del_ingrediente" type="button" class="btn btn-danger pull-right"><i class="fa fa-trash-o" aria-hidden="true" ></i></button>' ] )
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
   // Inicializacion de las mascaras
  $('input[id^=i_cantidadPesada]').inputmask("9,999",{placeholder:" "});
  $('input[name^=i_merma]').inputmask("99,9",{placeholder:" "});
  $('input[id^=i_coste_unitario]').inputmask("99,99",{placeholder:" "});
  $('input[id^=i_cantidad_comprado]').inputmask("99,999",{placeholder:" "});
  


// Selecciona todo el texto del input para poder escribir
$("input[name^=i_]").off('focus').focus(function() {
    var $this = $(this);
    $this.select();
    // Work around Chrome's little problem
    $this.mouseup(function() {
        // Prevent further mouseup intervention
        $this.unbind("mouseup");
        return false;
    });
});
  



$("input[name^=i_]").off('keyup').keyup(function()
{
  // Calulo del peso neto y suma total
   calculos_comunes(this);
});





// Métodos para rectificar los números al perder el foco
$("input[name^=i_cantidadPesada]").off('focusout').focusout(function(){  
 // Arregla el campo numérico
 var str = parseFloat( remplace_comma_to_point($(this).val())).toFixed(3);
 $(this).val(str);
});



$("input[name^=i_cantidad_comprado]").off('focusout').focusout(function(){  
 // Arregla el campo numérico
 var str = $(this).val().trim();
 var newPath= remplace_comma_to_point( str.replace(' ','') );
 var log_str = newPath.length;


 if( newPath > 0 )
{
  if( newPath > 9 ){
    $(this).val( parseFloat( newPath ).toFixed(3) );
  }else{
    $(this).val( "0"+parseFloat( newPath ).toFixed(3) );
  }
} 

});


$("input[name^=i_merma]").off('focusout').focusout(function(){
 // Arregla el campo numérico
 var str = $(this).val().trim();
 var newPath= remplace_comma_to_point( str.replace(' ','') );
 var log_str = newPath.length;

  if( log_str < 3){
    $(this).val("0"+newPath+"00" );
  }else if(log_str == 3){
   $(this).val(parseFloat( newPath ).toFixed(1) );
  }
}); 



$("input[name^=i_coste_unitario]").off('focusout').focusout(function(){
 // Arregla el campo numérico
 var str = $(this).val().trim();
 var newPath= remplace_comma_to_point( str.replace(' ','') );
 var log_str = newPath.length;

  if( log_str < 3){
    $(this).val("0"+newPath+"00" );
  }else if( log_str >= 3 && log_str < 5 ){
   $(this).val(parseFloat( newPath ).toFixed(2) );
  }
}); 
 
  
  // Borrado de la fila
  $('#table_escandallo tbody button[name^=b_del_ingredie]').off('click').on( 'click', function (){
     t.row( $(this).closest('tr') ).remove().draw();
      calculos_comunes('null');
  } );




}  // Fin function bindeo_b_del_ingredie()





function calculos_comunes(objeto)
{

// Calculo de las filas
if(objeto !='null')
{
 calculo_pesoNeto(objeto);
 calculo_total(objeto);
}


// Suma de las filas
  calculo_sumaTotal_table('cantidadPesada');
  calculo_sumaTotal_table('pesoNeto');
  calculo_sumaTotal_table('total');
}



function calculo_total(objeto)
{

  var coste_unitario = remplace_comma_to_point( $(objeto).closest('tr').find('td input[name=i_coste_unitario]').val().replace(' ','') );
  var cantidad_pesada = remplace_comma_to_point( $(objeto).closest('tr').find('td input[name=i_cantidadPesada]').val().replace(' ','') );
  var cantidad_comprada = remplace_comma_to_point( $(objeto).closest('tr').find('td input[name=i_cantidad_comprado]').val().replace(' ','') );

  console.log("coste_unitario.>"+coste_unitario);
  console.log("cantidad_pesada.>"+cantidad_pesada);
  console.log("cantidad_comprada.>"+cantidad_comprada);

  var total = (cantidad_pesada*coste_unitario)/cantidad_comprada;

  console.log("total.>"+total);

  if(cantidad_comprada > 0)
  {
  $(objeto).closest('tr').find('td input[name=i_total]').val(total.toFixed(3));
  }else{
  $(objeto).closest('tr').find('td input[name=i_total]').val('0,000');   
  }


}


function calculo_sumaTotal_table(campo)
{

/* Parametros pasados 
* i_cantidadPesada
* i_pesoNeto
* 
*/

var dato = 0;
// Sumatorio cantidad pesada 
var total_cantodadPesada ='0.000';
$('#table_escandallo tbody input[name^=i_'+campo+']').each(function(index,value){
    console.log( value.value );
    dato = remplace_comma_to_point(value.value); 
    total_cantodadPesada = ( parseFloat(total_cantodadPesada) + parseFloat(dato) ).toFixed(3);
  });
  $('#table_escandallo tfoot>tr>td[name=sum_'+campo+']').html(remplace_point_to_comma(total_cantodadPesada));

}





function calculo_pesoNeto(objeto)
{

  var str = remplace_comma_to_point( $(objeto).closest("tr").find('td').eq(1).find("input[name=i_cantidadPesada]").val().replace(' ','') );
  var cantPesada = parseFloat( str ).toFixed(3);

  var str = remplace_comma_to_point( $(objeto).closest("tr").find('td').eq(4).find("input[name=i_merma]").val().replace(' ','') );
  var merma = parseFloat( str ).toFixed(1);


 if(isNaN(merma)) {
   $(this).closest("tr").find('td').eq(4).find("input[name=i_merma]").val("00,0");
   var merma = "00.0";
 }
  if(isNaN(cantPesada)) {
   $(this).closest("tr").find('td').eq(1).find("input[name=i_cantidadPesada]").val("0,000");
   var cantPesada = "0.000";
 }

  var pneto = (merma*cantPesada)/100;


  if(pneto==0)
  {
     $(objeto).closest("tr").find('td').eq(5).find("input[name=i_pesoNeto]").val("0,000");
  }
  else
  {
   
     $(objeto).closest("tr").find('td').eq(5).find("input[name=i_pesoNeto]").val( remplace_point_to_comma(pneto.toFixed(3)) );
  }

}






function initDT(){
    //Construct the measurement table
    t = $('#table_escandallo').DataTable({
    /*  "dom": '<"pull-left"f><"pull-right"l>tip',
      "language": { search: "Buscar" },*/
      "searching": false,
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
