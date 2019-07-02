<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Pedido.php';
require_once './clases/Ventas.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<style>


</style>
   <title>Pedidos</title>
   <?php cargarHead(); ?>

  <script src="./js/script_pedido.js"></script>
  <!-- <script src="./js/script_ventas.js"></script> -->
</head>
<body>




<div class="row">

  <?php cargarMenuPrincipal(); ?>



  <div class="container contenedor-principal" >


       <div class="col-12">

          <div  class="col-12">




              <div>
                <h4>Pedidos</h4>
              </div>
              <div><hr></div>


                  <div class="container">
                      <div class="row">

                         <div class="col-4">
                            <button onclick="listarPedido(2)" class="btn btn-block btn-warning btn-lg" type="button" name="">POR PREPARAR</button>
                         </div>

                         <div class="col-4">
                            <button onclick="listarPedido(3)" class="btn btn-block btn-info btn-lg" type="button" name="">POR REPARTIR</button>
                         </div>

                         <div class="col-4">
                            <button onclick="listarPedido(4)" class="btn btn-block btn-success btn-lg" type="button" name="">ENTREGADOS</button>
                         </div>

                      </div>
                  </div>

              <div><hr></div>

              <!-- <div>
                <button type="button" onclick="limpiarFormularioFactura();" class="btn boton-morado" data-target="#modal_factura" data-toggle="modal" name="button">Crear nueva factura</button>

              </div>
              <div><hr></div>

              <div id="contenedorBuscador" class="form-group col-4" >

                     Buscar: <input onkeyup="listarPedido(this.value)" class="form-control col-9" type="text" name="txt_buscar_pedido" id="txt_buscar_pedido" value="">

              </div> -->


              <div id='contenedor_listado_pedido'></div>

            </div>

          </div>

       </div>

  </div>

</div>




  <!-- MODAL Proveedor-->
  <div class="modal fade" id="modal_pedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Pedidos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_pedido" class="" action="javascript:cambiarEstadoPedido()" method="post">

           <input type="hidden" name="txt_id_venta" id="txt_id_venta" value="">
           <input type="hidden" name="txt_tipo_entrega" id="txt_tipo_entrega" value="">

              <div id="contenedor_informacion_cliente" class="">

                    <div><hr></div>
                    <center><h5 class="modal-title" id="myModalLabel">Datos del cliente</h5></center>
                    <div><hr></div>
                    <div class="container">
                      <div class="row">

                               <div class="col-md-3" >
                                   <label for="title" class="col-12 control-label">Rut:</label>
                                  <input type="text" readonly placeholder="Ej: 11222333-0" max="10" onkeyup="cargarInformacionCliente(this.value)" class="form-control" name="txt_rut_cliente" id="txt_rut_cliente">
                               </div>

                               <div class="col-md-3" >
                                   <label for="title" class="col-12 control-label">Nombre:</label>
                                  <input type="text" readonly placeholder="Nombres" class="form-control" name="txt_nombre" id="txt_nombre">
                               </div>


                               <div class="col-md-3" >
                                   <label for="title" class="col-12 control-label">Apellido:</label>
                                  <input type="text"  readonly placeholder="Apellidos" class="form-control" name="txt_apellidos" id="txt_apellidos">
                               </div>

                               <div class="col-md-3" >
                                   <label for="title" class="col-12 control-label">Teléfono:</label>
                                  <input type="text" readonly placeholder="Telefono" class="form-control" name="txt_telefono" id="txt_telefono">
                               </div>

                               <div class="col-md-4" >
                                 <label for="title" class="col-12 control-label">Calle:</label>
                                 <input type="text" readonly placeholder="Nombre calle" class="form-control" name="txt_calle" id="txt_calle">
                               </div>

                               <div class="col-md-2" >
                                 <label for="title" class="col-12 control-label">Número:</label>
                                 <input type="text" readonly placeholder="Numero casa" class="form-control" name="txt_numero" id="txt_numero">
                               </div>

                               <div class="col-md-6" >
                                   <label for="title" class="col-12 control-label">Observación direccion:</label>
                                  <input type="text" readonly placeholder="Opcional" class="form-control" name="txt_observacion" id="txt_observacion">
                               </div>



                      </div>
                   </div>

              </div>


    <div class=""><hr></div>
    <center><h5 class="modal-title" id="myModalLabel">Datos de la venta</h5></center>
    <div><hr></div>
            <div id='contenedor_listado_venta'></div>

        </form>

      </div>


    </div>
    </div>
  </div>



</body>
</html>


  <!-- <div class="container">
      <div class="row">

              <div class="col-md-4" >
                <label for="title" class="col-2 control-label">Id Venta:</label>
                <input type="text" class="form-control" onkeyup="cargarInformacionVentaPedido(this.value)" name="id_venta" id="id_venta">
              </div>

               <div class="col-md-4" >
                   <label for="title" class="col-2 control-label">Id Producto:</label>
                  <input type="text" class="form-control" name="id_producto" id="id_producto">
               </div>

               <div class="col-md-4" >
                   <label for="title" class="col-3 control-label">Valor Unitario:</label>
                  <input type="text" placeholder="Nombres" class="form-control" name="valor_unitario" id="valor_unitario">
               </div>


               <div class="col-md-4" >
                   <label for="title" class="col-3 control-label">Cantidad:</label>
                  <input type="text" placeholder="Apellidos" class="form-control" name="cantidad" id="cantidad">
               </div>

               <div class="col-md-4" >
                   <label for="title" class="col-3 control-label">Valor Total:</label>
                  <input type="text" placeholder="Apellidos" class="form-control" name="valor_total" id="valor_total">
               </div>

        </div>
    </div> -->
