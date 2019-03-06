<?php

if($_REQUEST['tipo']=="nuevo"){
?>
      <div class="form-group col-12" >

              <label for="title" class="col-12 control-label">Contraseña</label>
              <input required type="password" class="form-control" name="txt_contrasenia_usuario" id="txt_contrasenia_usuario" value="">

      </div>
      <div class="form-group col-12" >

              <label for="title" class="col-12 control-label">Confirme contraseña</label>
              <input required type="password" class="form-control" name="txt_confirme_contrasenia_usuario" id="txt_confirme_contrasenia_usuario" value="">

      </div>

<?php
}else if($_REQUEST['tipo']=="modificar"){
  ?>
  <div class="form-group col-12" >

          <label for="title" class="col-12 control-label">Contraseña</label>
          <input required type="password" class="form-control" name="txt_contrasenia_usuario" id="txt_contrasenia_usuario" value="">

  </div>
  <div class="form-group col-12" >

          <label for="title" class="col-12 control-label">Confirme contraseña</label>
          <input required type="password" class="form-control" name="txt_confirme_contrasenia_usuario" id="txt_confirme_contrasenia_usuario" value="">

  </div>
        <div class="form-group col-12" >
             <button type="button" class="btn btn-warning btn-block" onclick="cargarFormularioClaves('nada')" name="button">No cambiar clave</button>
        </div>
  <?php

}else if($_REQUEST['tipo']=="nada"){
   ?>

   <div class="form-group col-12" >
        <button type="button" class="btn btn-primary btn-block" onclick="cargarFormularioClaves('modificar')" name="button">Cambiar clave</button>
   </div>


   <?php
}

?>
