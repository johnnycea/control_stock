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

  <script src="./js/script_stock.js"></script>

</head>
<body>



<div class="row">

  <?php cargarMenuPrincipal(); ?>


 <div><hr></div>

  <div class="container contenedor-principal" >


   <div id="contenedor_stock_ingresos"></div>


  </div>

</div>


</body>
</html>
