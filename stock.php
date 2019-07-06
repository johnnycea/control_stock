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

   <title>Stock</title>
   <?php cargarHead(); ?>
   <script src="./js/script_stock.js"></script>

</head>
<body>

  <?php cargarMenuPrincipal(); ?>

  <div class="container contenedor-principal" >
       <div id="contenedor_stock_ingresos" class="table-responsive"><center><h3>Calculando...</h3></center></div>
  </div>



</body>
</html>
