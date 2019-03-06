function cambiarFormulario(formulario){

          mostrarCargando("contenedor_formularios");

          $.ajax({
            url:"./metodos_ajax/crear_documento/"+formulario+".php",
            method:"POST",
            success:function(respuesta){
               $("#contenedor_formularios").html(respuesta);
            }
          });

}

// OFICIOS
function crearOficio(){
   alert("funciona");

   $.ajax({
     url:"./metodos_ajax/crear_documento/crear_oficio.php",
     method:"POST",
     data:$("#formulario_crear_oficio").serialize(),
     success:function(respuesta){
        alert(respuesta);
     }
   });
}
