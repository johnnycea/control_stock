<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
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

  <script src="./js/script_usuarios.js"></script>
</head>
<body>

<div class="row">

<?php cargarMenuPrincipal(); ?>



<div class="container contenedor-principal">

  <div class="row">

      <div class="col-12 col-md-3">

          <div class="card text-dark">
            <div class="card-header ">
                OPCIONES
            </div>
            <div class="card-body">
                 <?php cargarMenuConfiguraciones(); ?>
            </div>
          </div>

      </div>
       <div class="col-12 col-md-9">

              <div id='' style="" class=" card col-12">
                  <ul>
                    <li>Seleccione opcion que desea modificar del menu de opciones.</li>
                  </ul>
              </div>

       </div>

  </div>

</div>




</body>
</html>
