function cargar_solicitantes(){

  $.ajax({
     url:"./metodos_ajax/cargar_selector_solicitantes.php",
     dataType:"json",
     success:function(respuesta){
        $("#contenedor_selector_solicitante").html(respuesta);
     }
  });
}
function mostrar_campo_nuevo(){

  var solicitante= $("#select_solicitante_crear").val();
  // alert("solicitante: "+solicitante);
  if(solicitante==0){
     $("#txt_nuevo_solicitante").removeClass("hidden");
     $("#txt_nuevo_solicitante").attr("required","required");
  }else{
    $("#txt_nuevo_solicitante").addClass("hidden");
    $("#txt_nuevo_solicitante").removeAttr("required");
  }

}


function mostrar_campo_editar(){

  var solicitante= $("#select_solicitante_editar").val();
  // alert("solicitante: "+solicitante);
  if(solicitante==0){
     $("#txt_editar_solicitante").removeClass("hidden");
     $("#txt_editar_solicitante").attr("required");
  }else{
     $("#txt_editar_solicitante").addClass("hidden");
     $("#txt_editar_solicitante").removeAttr("required");
  }

}

function eliminarEvento(){

  var id_evento= $("#ModalEdit #id").val();
  var recinto= $("#ModalEdit #recinto_deportivo_editar_evento").val();
  // alert("evento: "+id_evento+" recinto: "+recinto);

  window.location="eliminar_evento.php?id_evento="+id_evento+"&recinto="+recinto;
}
