<?php

@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Estado.php';

comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<style>


</style>
   <title>Control Gastos</title>
   <?php cargarHead(); ?>

  <script src="./js/script_movimientos.js"></script>

  <script>
      $(document).ready(function(){

        var date_input=$('input[name="txt_fecha_ingreso"]'); //our date input has the name "date"
        var options={
          format: 'dd-mm-yyyy',
          todayHighlight: true,
          autoclose: true,
          language: 'es',
        };
        date_input.datepicker(options);

      })
      $(document).ready(function(){

        var date_input=$('input[name="txt_fecha_creacion"]'); //our date input has the name "date"
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

<?php cargarMenuPrincipal(); ?>

</body>
</html>
