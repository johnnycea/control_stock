<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Ventas.php';
require_once './clases/ProductoElaborado.php';
require_once './clases/TipoVenta.php';
require_once './clases/MedioPago.php';
require_once './clases/Cliente.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();


//limpia el array que sirve para modificar ingredientes de un $producto_elaborado
$_SESSION['listado_ingredientes_productos'] = array();

?>

<!DOCTYPE html>
<html lang="en">
<head>


   <title>Ventas</title>
   <?php cargarHead(); ?>

   <script src="./js/script_ventas.js"></script>

</head>
<body>

  <?php cargarMenuPrincipal(); ?>


 <div><hr></div>

  <div class="container contenedor-principal" >

      <div class="row">

            <div class="form-group col-4 col-md-2">
                <label for="title" class="control-label">N° Venta:</label>
                <input readonly value="" class="form-control col-6" type="text" id="txt_id_venta" name="txt_id_venta">
            </div>


            <div class="form-group col-8 col-md-10" >
               <label for="title" class="col-12 control-label">Buscar Producto:</label>
               <div class="row">
                 <input  type="text" onkeyup="listarProductosElaborados()" class="form-control col-9" name="txt_texto_buscar_ingredientes" id="txt_texto_buscar_ingredientes">
               </div>
            </div>

      </div>


      <div><hr></div>
      <div id="contenedor_buscador_ingredientes"  class="">
                  <div class="container" id="contenedor_listado_productos_elaborados"></div>
      </div>

      <div><hr></div>
      <div class="table-responsive">
          <div id="contenedor_listado_venta" ></div>
      </div>


  </div>

<!-- </div> -->




<!-- MODAL -->
<div class="modal fade" id="modal_finalizar_venta" name="modal_finalizar_venta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">

    <div class="modal-header bg-modal">
      <center><h5 class="modal-title" id="myModalLabel">Finalizar Venta</h5></center>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">

      <form id="formulario_finalizar_venta" class="" action="javascript:confirmarVenta()" method="post" enctype="multipart/form-data">



         <div class="row">

              <div class="form-group col-md-6" >
                <label for="title" class="col-12 control-label">Tipo de Venta:</label>
                <select class="form-control" name="select_tipo_venta" id="select_tipo_venta">
                  <?php
                  $TipoVenta = new TipoVenta();
                  $listarTipoVenta = $TipoVenta->obtenerTiposVenta();

                  while($filas = $listarTipoVenta->fetch_array()){
                     echo '<option value="'.$filas['id_tipo_venta'].'">'.$filas['descripcion_tipo_venta'].'</option>';
                  }

                   ?>
                </select>
              </div>

              <div class="form-group col-md-6" >
                <label for="title" class="col-12 control-label">Medio de Pago:</label>
                <select class="form-control" name="select_medio_pago" id="select_medio_pago">
                  <?php
                  $MedioPago = new MedioPago();
                  $listarMedioPago = $MedioPago->obtenerMediosPago();

                  while($filas = $listarMedioPago->fetch_array()){
                     echo '<option value="'.$filas['id_medio_pago'].'">'.$filas['descripcion_medio_pago'].'</option>';
                  }

                   ?>
                </select>
              </div>

              <div class="form-group col-md-6" >
                <label for="title" class="col-12 control-label">Entrega:</label>
                <select onchange="cambiarTipoEntrega(this.value)" class="form-control" name="select_tipo_entrega" id="select_tipo_entrega">
                  <option value="1">RETIRA EN LOCAL</option>
                  <option value="2">REPARTO A DOMICILIO</option>
                </select>
              </div>

              <div class="form-group col-md-6" >

                  <div id="contenedor_checkbox_cliente" class="form-check">
                    <label for="title" class="col-12 control-label">&nbsp;</label>
                    <input type="checkbox" onclick="activarCheckboxCliente()" class="form-check-input" id="chb_cliente" name="chb_cliente">
                    <label class="form-check-label" for="chb_cliente">Registrar Cliente</label>
                  </div>

              </div>


              <div id="contenedor_informacion_cliente" class="d-none">

                    <div><hr></div>
                    <center><h5 class="modal-title" id="myModalLabel">Datos del cliente</h5></center>
                    <div><hr></div>
                    <div class="container">
                      <div class="row">



                               <div class="col-md-6" >
                                   <label for="title" class="col-12 control-label">Rut:</label>
                                  <input type="text" placeholder="Ej: 11222333-0" max="10" onkeyup="cargarInformacionCliente(this.value)" class="form-control" name="txt_rut_cliente" id="txt_rut_cliente">
                               </div>

                               <div class="col-md-6" >
                                   <label for="title" class="col-12 control-label">Nombre:</label>
                                  <input type="text" placeholder="Nombres" class="form-control" name="txt_nombre" id="txt_nombre">
                               </div>


                               <div class="col-md-6" >
                                   <label for="title" class="col-12 control-label">Apellido:</label>
                                  <input type="text" placeholder="Apellidos" class="form-control" name="txt_apellidos" id="txt_apellidos">
                               </div>

                               <div class="col-md-6" >
                                 <label for="title" class="col-12 control-label">Calle:</label>
                                 <input type="text" placeholder="Nombre calle" class="form-control" name="txt_calle" id="txt_calle">
                               </div>

                               <div class="col-md-6" >
                                 <label for="title" class="col-12 control-label">Número:</label>
                                 <input type="text" placeholder="Numero casa" class="form-control" name="txt_numero" id="txt_numero">
                               </div>

                               <div class="col-md-6" >
                                   <label for="title" class="col-12 control-label">Observación direccion:</label>
                                  <input type="text" placeholder="Opcional" class="form-control" name="txt_observacion" id="txt_observacion">
                               </div>

                               <div class="col-md-6" >
                                   <label for="title" class="col-12 control-label">Teléfono:</label>
                                  <input type="text" placeholder="Telefono" class="form-control" name="txt_telefono" id="txt_telefono">
                               </div>

                      </div>
                   </div>

              </div>


         </div>



        <div class="form-group col-md-12" >
          <br>
          <input type="submit" id="btn_boton_guardar" name="btn_boton_guardar" class="btn btn-success btn-block" value="CONFIRMAR">
        </div>


    </form>



</div>
</div>
</div>
</div>

<!-- FINAL DEL MODAL -->


<!-- MODAL EDITAR INGREDIENTES PRODUCTO ELABORADO -->
<div class="modal fade" id="modal_modificar_ingredientes_producto" name="modal_modificar_ingredientes_producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">

    <div class="modal-header bg-modal">
      <center><h5 class="modal-title" id="myModalLabel">Modificar Ingredientes Producto</h5></center>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">

      <form id="formulario_moficar_ingredientes_producto" class="" action="" method="post" enctype="multipart/form-data">

         <div id="contenedor_ingredientes_producto"></div>


    </form>



</div>
</div>
</div>
</div>

<!-- FINAL DEL MODAL -->


</body>
</html>
