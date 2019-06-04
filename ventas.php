<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Ventas.php';
require_once './clases/ProductoElaborado.php';
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



  <div class="col-10">


    <!-- <div class="form-group col-12">
      <label for="title" class="control-label">Fecha de ingreso</label>
      <input value="<?php //echo $filas['fecha']; ?>" class="form-control" type="text" id="txt_fecha" name="txt_fecha" readonly placeholder="Dia/Mes/Año" >
    </div> -->


    <div class="form-group col-12">
      <?php
         $venta= new Ventas();
         $numero_venta = $venta->crearVenta();

       ?>
     <label for="title" class="control-label">Numero de Venta:</label>
      <input readonly value="<?php echo $numero_venta; ?>" class="form-control col-6" type="text" id="txt_fecha"  >

    </div>


      <div class="table-responsive">

          <table class="table table-stripped table-bordered">
            <thead>
               <th>Código</th>
               <th>Descripcion</th>
               <th>Cantidad</th>
               <th>Valor</th>
               <th>Total</th>
               <th></th>
            </thead>
            <tbody>
               <tr>
                 <td>123456</td>
                 <td>Pizza de mil amores y poemas</td>
                 <td>5</td>
                 <td>$1.000</td>
                 <td>$15.000</td>
                 <td>
                   <button type="button" class="btn btn-danger" name="button">Quitar</button>
                 </td>
               </tr>
            </tbody>
          </table>
      </div>

<br>
<br>
<br>
<br>

<!-- ****************** -->
<div id="contenedor_buscador_ingredientes"  class="">

           <div class="card border-info">

             <h5 class="card-title">Busqueda de productos elaborados</h5>

             <div class="form-group col-md-12" >
               <label for="title" class="col-12 control-label">Buscar Producto:</label>
               <div class="row">
                 <input  type="text" onkeyup="listarProductosElaborados()" class="form-control col-9" name="txt_texto_buscar_ingredientes" id="txt_texto_buscar_ingredientes">
                 <input class="btn btn-warning col-2" onclick="listarProductosElaborados()" type="button" value="Buscar">
               </div>
             </div>

            <div class="" id="contenedor_listado_productos_elaborados">

            </div>

           </div>

</div>
<!-- ****************** -->


    <!-- <form id="formulario_ingreso_producto" action="javascript:guardarProductoVenta();" method="post">

      <div class="card ">
        <div class="row ">
            <div class="form-group col-md-2">
              <label for="">Buscar Producto:</label>
              <input type="text" class="form-control" id="txt_codigo_agregar_producto" name="txt_codigo_agregar_producto" value="">
            </div>


            <div class="form-group col-md-2">
              <label for="">&nbsp;</label>
              <button type="submit" class="btn btn-success btn-block" name="button">BUSCAR</button>
            </div>
        </div>
      </div>

    </form>


    <div class="container">

        <table>
          <caption>LISTA PRODUCTOS VENTA</caption>
          <thead>
             <th>Codigo</th>
             <th>Descripcion</th>
          </thead>
        </table>
    </div> -->


  </div>

</div>





<script type="text/javascript">
    // listarFacturas("");
</script>

</body>
</html>
