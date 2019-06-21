<?php
function comprobarSession(){
  @session_start();
  if(isset($_SESSION['run']) and isset($_SESSION['nombre'])){

  }else{
     header("location: index.php");
  }
}

function cargarHead(){
?>
  <meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/estilos.css">
  <link rel="stylesheet" href="./sweetalert/sweet-alert.css">
  <link rel="stylesheet" href='./css/bootstrap-datepicker.min.css' />
  <link rel="stylesheet" href='./fonts/css/fontawesome.min.css' />

  <script src='./js/jquery-3.1.0.min.js'></script>
  <script src='./js/bootstrap.min.js'></script>
  <script src="./js/validaciones.js"></script>
  <script src="./sweetalert/sweet-alert.min.js"></script>
  <script src='./js/moment.min.js'></script>
  <script src="./js/bootstrap-datepicker.min.js"></script>
  <script src="./js/fontawesome-all.min.js"></script>
  <script src="./js/validaciones.js"></script>


  <?php
}


function VentanaCargando(){
  ?>
<style>
.loader,
.loader:before,
.loader:after {
  background: #b63333;
  -webkit-animation: load1 1s infinite ease-in-out;
  animation: load1 1s infinite ease-in-out;
  width: 1em;
  height: 4em;
}
.loader:before,
.loader:after {
  position: absolute;
  top: 0;
  content: '';
}
.loader:before {
  left: -1.5em;
}
.loader {
  text-indent: -9999em;
  margin: 40% auto;
  position: relative;
  font-size: 11px;
  -webkit-animation-delay: 0.16s;
  animation-delay: 0.16s;
}
.loader:after {
  left: 1.5em;
  -webkit-animation-delay: 0.32s;
  animation-delay: 0.32s;
}
@-webkit-keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0 #b63333;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em #b63333;
    height: 5em;
  }
}
@keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0 #b63333;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em #b63333;
    height: 5em;
  }
}
</style>
  <div id="contenedor">
      <div class="loader" id="loader">Loading...</div>
   </div>

  <?php
}


function cargarMenuConfiguraciones(){
  $url= basename($_SERVER['PHP_SELF']);

  if($url=="usuarios.php"){
      echo '<a href="./usuarios.php" class="active btn btn-info col-12">Usuarios </a>';
  }else{
      echo '<a href="./usuarios.php" class="btn btn-info col-12">Usuarios </a>';
  }

  echo'<hr>';
  
  if($url=="unidadMedidad.php"){
      echo '<a href="./unidadMedidad.php" class="active btn btn-info col-12">Unidad de medida </a>';
  }else{
      echo '<a href="./unidadMedidad.php" class="btn btn-info col-12">Unidad de medida </a>';
  }

  //    echo'<hr>';
  //
  // if($url=="marca.php"){
  //     echo '<a href="./marca.php" class="active btn btn-info col-12">Marca </a>';
  // }else{
  //     echo '<a href="./marca.php" class="btn btn-info col-12">Marca </a>';
  // }

  //    echo'<hr>';
  //
  // if($url=="categoria.php"){
  //     echo '<a href="./categoria.php" class="active btn btn-info col-12">Categoria </a>';
  // }else{
  //     echo '<a href="./categoria.php" class="btn btn-info col-12">Categoria </a>';
  // }


  ?>


  <?php
}

function cargarMenuProveedor(){
  $url= basename($_SERVER['PHP_SELF']);

  if($url=="usuarios.php"){
      echo '<a href="./proveedores.php" class="active btn btn-info col-12">Proveedor </a>';
  }else{
      echo '<a href="./proveedores.php" class="btn btn-info col-12">Proveedor </a>';
  }

     echo'<hr>';


  ?>


  <?php
}
//
// function cargarMenuInformes(){
//   $url= basename($_SERVER['PHP_SELF']);
//
//   if($url=="usuarios.php"){
//       echo '<a href="./usuarios.php" class="active btn btn-info col-12">Por subvencion </a>';
//   }else{
//       echo '<a href="./usuarios.php" class="btn btn-info col-12">Por subvencion </a>';
//   }
//
//      echo'<hr>';
//
//   if($url=="colegios.php"){
//       echo '<a href="./colegios.php" class="active btn btn-info col-12">Resumen </a>';
//   }else{
//       echo '<a href="./colegios.php" class="btn btn-info col-12">Resumen </a>';
//   }
//
//
//
//
//
//
// }

function cargarMenuPrincipal(){
?>


<style>

#contenedor_logo_menu{
  height:70px;
  width: 70px;
  background:white;
  margin-top: -5px;
  margin-bottom: -5px;
  margin-left: -5px;
  border-radius: 5px;

}
#logo_menu{
  background-image: url("./img/logo_cochento.jpg");
  height: 100%;
  width:100%;
  background-size: cover;
  background-position: center;
  border-radius: 10px;
}

.estilo_opciones_menu{
 font-style: italic;
}

.nav-link{
  /* background-color: rgb(28, 196, 201); */
  margin-right: 5px;
}
.nav-link:hover{
 color:white;
 background-color: #0d7073;
 border-radius: 5px;

}
</style>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark " style="background-image: url('img/madera1.jpg');">
  <a class="navbar-brand" href="#">
    <div id="contenedor_logo_menu">
      <div id="logo_menu"></div>
    </div>
    <!-- <img src="./img/logo.png" width="80" height="50" class="d-inline-block align-top" alt=""> -->
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">

     <?php

     $url= basename($_SERVER['PHP_SELF']);
            //UN LINK
            echo '<li class="nav-item">';
                  if($url=="ventas.php"){
                    echo '<a class="nav-link estilo_opciones_menu active" href="./ventas.php">Ventas</span></a>';
                  }else{
                    echo '<a class="nav-link estilo_opciones_menu active " href="./ventas.php">Ventas</span></a>';
                  }
            echo '</li>';


            //UN LINK
            echo '<li class="nav-item">';
                  if($url=="facturas.php"){
                    echo '<a class="nav-link estilo_opciones_menu active" href="./facturas.php">Ingresos</span></a>';
                  }else{
                    echo '<a class="nav-link estilo_opciones_menu active " href="./facturas.php">Ingresos</span></a>';
                  }
            echo '</li>';

            //UN LINK
            echo '<li class="nav-item">';
                  if($url=="productos_elaborados.php"){
                    echo '<a class="nav-link estilo_opciones_menu active" href="./productos_elaborados.php">Productos</span></a>';
                  }else{
                    echo '<a class="nav-link estilo_opciones_menu active " href="./productos_elaborados.php">Productos</span></a>';
                  }
            echo '</li>';

            //UN LINK
            echo '<li class="nav-item">';
                  if($url=="ingredientes.php"){
                    echo '<a class="nav-link estilo_opciones_menu active" href="./ingredientes.php">Ingredientes</span></a>';
                  }else{
                    echo '<a class="nav-link estilo_opciones_menu active " href="./ingredientes.php">Ingredientes</span></a>';
                  }
            echo '</li>';


            //UN LINK
            echo '<li class="nav-item">';
                  if($url=="stock.php"){
                    echo '<a class="nav-link estilo_opciones_menu active" href="./stock.php">Stock</span></a>';
                  }else{
                    echo '<a class="nav-link estilo_opciones_menu active " href="./stock.php">Stock</span></a>';
                  }
            echo '</li>';

            //UN LINK
            echo '<li class="nav-item">';
                  if($url=="proveedores.php"){
                    echo '<a class="nav-link estilo_opciones_menu active" href="./proveedores.php">Proveedores</span></a>';
                  }else{
                    echo '<a class="nav-link estilo_opciones_menu active " href="./proveedores.php">Proveedores</span></a>';
                  }
            echo '</li>';

            //UN LINK
            echo '<li class="nav-item">';
                  if($url=="informes.php"){
                    echo '<a class="nav-link estilo_opciones_menu active" href="./informes.php">Informes</span></a>';
                  }else{
                    echo '<a class="nav-link estilo_opciones_menu active " href="./informes.php">Informes</span></a>';
                  }
            echo '</li>';

            //UN LINK
            echo '<li class="nav-item">';
                  if($url=="configuraciones.php"){
                    echo '<a class="nav-link estilo_opciones_menu active" href="./configuraciones.php">Configuraciones</span></a>';
                  }else{
                    echo '<a class="nav-link estilo_opciones_menu active  laed" href="./configuraciones.php">Configuraciones</span></a>';
                  }
            echo '</li>';

     ?>


    </ul>

     <!-- <label class="text-white"><?php echo $usuario['nombre'].', área de &nbsp;'.$usuario['nombre_departamento'].' &nbsp;'; ?></label> -->
     <a href="./cerrarSesion.php" class="btn btn-danger my-2 my-sm-0" >Salir</a>
  </div>
</nav>
<div><hr></div>
<div><hr></div>

<?php
}

 ?>
