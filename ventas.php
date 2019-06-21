<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Ventas.php';
require_once './clases/ProductoElaborado.php';
require_once './clases/TipoVenta.php';
require_once './clases/MedioPago.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<style>


</style>
   <title>Ventas</title>
   <?php cargarHead(); ?>

  <script src="./js/script_ventas.js"></script>
  <!-- <script src="./js/script_productosElaborados.js"></script> -->
  <script>
      $(document).ready(function(){

        var date_input=$('input[name="txt_fecha"]'); //our date input has the name "date"
        var options={
          format: 'dd-mm-yyyy',
          todayHighlight: true,
          autoclose: true,
          language: 'es',
        };
        date_input.datepicker(options);

      })
    </script>
</head>
<body>



<div class="row">

  <?php cargarMenuPrincipal(); ?>


 <div><hr></div>

  <div class="container contenedor-principal" >


    <!-- <div class="form-group col-12">
      <label for="title" class="control-label">Fecha de ingreso</label>
      <input value="<?php //echo $filas['fecha']; ?>" class="form-control" type="text" id="txt_fecha" name="txt_fecha" readonly placeholder="Dia/Mes/Año" >
    </div> -->


<div class="row">

      <div class="form-group col-2">
        <?php
           $venta= new Ventas();
           $numero_venta = $venta->crearVenta();

         ?>
       <label for="title" class="control-label">N° Venta:</label>
        <input readonly value="<?php echo $numero_venta; ?>" class="form-control col-6" type="text" id="txt_id_venta" name="txt_id_venta">

      </div>


      <div class="form-group col-10" >
        <label for="title" class="col-12 control-label">Buscar Producto:</label>
        <div class="row">
          <input  type="text" onkeyup="listarProductosElaborados()" class="form-control col-9" name="txt_texto_buscar_ingredientes" id="txt_texto_buscar_ingredientes">
          <!-- <input class="btn btn-warning col-2" onclick="listarProductosElaborados()" type="button" value="Buscar"> -->
        </div>
      </div>

</div>
<!-- ****************** -->


<div><hr></div>
<div id="contenedor_buscador_ingredientes"  class="">

            <div class="container" id="contenedor_listado_productos_elaborados">

            </div>

</div>




    <div><hr></div>
    <div id="contenedor_listado_venta" class=""></div>


<br>
<br>
<br>
<br>




  </div>

</div>




<!-- MODAL Producto CREAR-->
<div class="modal fade" id="modal_finalizar_venta" name="modal_finalizar_venta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog modal-sm" role="document">
  <div class="modal-content">

    <div class="modal-header">
      <h5 class="modal-title" id="myModalLabel">Finalizar Venta</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">

      <form id="formulario_finalizar_venta" class="" action="javascript:confirmarVenta()" method="post" enctype="multipart/form-data">

         <div class="row">

              <div class="form-group col-md-12" >
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

              <div class="form-group col-md-12" >
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


         </div>

        <div class="form-group col-md-12" >
          <br>
          <input type="submit" id="btn_boton_guardar" name="btn_boton_guardar" class="btn btn-info btn-block" value="Guardar">
        </div>

    </form>




</div>
</div>
</div>
</div>

<!-- FINAL DEL MODAL -->




<script type="text/javascript">
    // listarProductosElaborados();
    listaVenta("");
</script>







</body>
</html>
