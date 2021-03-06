<script type="text/javascript" src="./views/pages/js/functions/functions.js"></script>
<script type="text/javascript" src="./views/pages/js/gestion-escandallos.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header" style="padding-top: 4px ">
    <h1 >
      Gestión
      <small>Escandallos</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Gestión</a></li>
      <li class="active">Escandallo</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid"> 
   <!-- body -->

<!-- ============================================================================== -->




<!-- ============================================================================== -->
   <div class="row">
     <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="box box-primary">
       <div class="box-header with-border">
        <form accept-charset="UTF-8" method="post">
         <div class="form-group">
            
          <!-- ======================================= --> 
            <div class="row"> 

              <div class="col-xs-6 col-sm-6 col-md-6">
                <button type="button" class="btn btn-primary" id="b_new_escandallo" data-toggle="modal" data-target="#Modal_add_escandallo">Nuevo escandallo</button>
              </div>

              <div class="col-xs-6 col-sm-6 col-md-6">
                <div style="float: right;" hidden>
                 <button type="button" class="btn btn-default" style="margin-right:  10px" id="b_save_escandallo"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                 <button type="button" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
               </div> 
             </div>

           </div>
          <!-- =========================== -->
        </div>
      </form>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
      <!-- ====== Todo el contenido========= -->




      <div id="container_table_escandallo"> </div>

      <!-- / col 12-->
      <!-- ====== */ Todo el contenido========= -->
    </div>
    <!-- /.box-body -->

<!--               <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div> -->
            </div>
          </div>
          <!-- / col 12-->
        </div>
        <!-- / row-->


        <!-- /.body -->
      </section>
      <!-- </section> -->
    </div>
<!-- /.content-wrapper -->





















<!-- ============= Modals ================  -->

<div class="modal fade" id="Modal_add_escandallo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #e3f2fd;">
        <h3 class="modal-title" id="exampleModalLabel" style="float: left;">Nuevo escandallo</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float: right;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="i_nuevo_escandallo" placeholder="Ejem: Tiramisu &hellip;">
        </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="b_cerrar_Modal_add_escandallo" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="b_guardar_Modal_add_escandallo">Guardar</button>
      </div>
    </div>
  </div>
</div>







<div class="modal fade" tabindex="-1" role="dialog" id="Modal_add_ingredites">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #e3f2fd;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Ingrediente</h4>
      </div>
      <div class="modal-body">

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Ingrediente</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="i_ingrediente" placeholder="Ejem: Mermelada de fresa &hellip;">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-raigh" id="bm_add_ingrediente" >Agregar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->








<div class="modal fade" tabindex="-1" role="dialog" id="Modal_cerrar_escandallo">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #e3f2fd;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Ingrediente</h4>
      </div>
      <div class="modal-body">

      <h2>!! Esto va a ser la alerta de cerrar modal sin guardar datos</h2>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="bm_add_ingrediente" >Agregar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->