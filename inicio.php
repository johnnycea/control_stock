<?php
       require_once 'comun.php';
       comprobarSession();


       require_once './clases/Usuario.php';
       $usuario= new Usuario();
       $usuario= $usuario->obtenerUsuarioActual();


         header("location: registro_movimientos.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>

   <title>Resumen</title>
   <?php cargarHead(); ?>

</head>
<body>

<?php cargarMenuPrincipal();
?>



<div class="container">

</div>


</body>
</html>
