<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
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
   <title>Ventas</title>
   <?php cargarHead(); ?>

  <script src="./js/script_ventas.js"></script>
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
  <?php



     $venta= new Ventas();
     $numero_venta = $venta->crearVenta();



   ?>


<div class="row">

  <?php cargarMenuPrincipal(); ?>



  <div class="col-10">


    <!-- <div class="form-group col-12">
      <label for="title" class="control-label">Fecha de ingreso</label>
      <input value="<?php //echo $filas['fecha']; ?>" class="form-control" type="text" id="txt_fecha" name="txt_fecha" readonly placeholder="Dia/Mes/Año" >
    </div> -->

    <form id="formulario_ingreso_producto" action="javascript:guardarProductoVenta();" method="post">

      <div class="card ">
        <div class="row ">
            <div class="form-group col-md-2">
              <label for="">Buscar Producto:</label>
              <input type="text" class="form-control" id="txt_codigo_agregar_producto" value="">
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
             <th>Descriipcion</th>
          </thead>
        </table>
    </div>


  </div>

</div>





<script type="text/javascript">
    // listarFacturas("");
</script>

</body>
</html>
