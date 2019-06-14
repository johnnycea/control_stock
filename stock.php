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


 <div><hr></div>

  <div class="container contenedor-principal" >


       <!-- 1-. RECORRERO POR WHILE TODOS LOS INGREDIENTES

         WHILE(INGREDIENTES){

                 CONSULTAR LA SUMA DE TODOS LOS INGRESOS DEL INGREDIENTE (TABLA DETALLE_FACTURA)

       }

     -->


  </div>

</div>


</body>
</html>
