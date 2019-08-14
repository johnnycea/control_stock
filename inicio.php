<?php
       require_once 'comun.php';
       comprobarSession();


       require_once './clases/Usuario.php';
       $usuario= new Usuario();
       $usuario= $usuario->obtenerUsuarioActual();


         // header("location: registro_movimientos.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>

   <title>Resumen</title>
   <?php cargarHead(); ?>

</head>
<body>



<div class="row">

  <?php cargarMenuPrincipal();?>

  <div class="col-10">


<?php

  $Usuario = new Usuario();
  $usuario_actual = $Usuario->obtenerUsuarioActual();
  $tipo_usuario_actual = $usuario_actual['tipo_usuario'];

  switch ($tipo_usuario_actual) {
    case '1'://admin
      header("Location: ./ventas.php");
      break;
    case '2':
      header("Location: ./ventas.php");
      break;
    case '3':
      header("Location: ./pedidos.php");
      break;

    default:
      // code...
      break;
  }

 ?>

  </div>

</div>


</body>
</html>
