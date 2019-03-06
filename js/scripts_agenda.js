var mostrarTodosEstablecimientos=1;

// 1:MUESTRA AGENDA TODOS LOS ESTABLECIMIENTOS
// 2:MUESTRA SOLO LA AGENDA DEL USUARIO QUE INICIO SESSION

	function actualizarEventos(departamento){


		$.ajax({
			url: './metodos_ajax/agenda_general/mostrar_actividades.php?departamento='+departamento,
	        type: 'POST', // Send post data
	        async: false,
	        success: function(s){
						// alert(s);
	        	freshevents = s;
						$('#calendar').fullCalendar('removeEvents');
						$('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
	        }
		});
	}

function enviarCorreoNuevaIntervencion(id){
	// alert("funcion que envia correo id es: "+id);

		$.ajax({
			url:"./metodos_ajax/intervenciones/correo_nueva_intervencion.php?intervencion="+id,
			method:"POST",
			success:function(respuesta){
				 // alert(respuesta);
			}
		});
}

function crearModificarActividad(){

		$.ajax({
			url:"./metodos_ajax/agenda_general/crear_modificar_actividad.php",
			method:"POST",
			data:$("#formulario_actividad").serialize(),
			success:function(respuesta){
				 // alert(respuesta);
				 if(respuesta==1){
						swal("Guardado","Datos guardados correctamente.","success");
						$("#modal_actividad").modal('hide');
					  actualizarEventos();

				 }else if(respuesta==2){
					 swal("Error al guardar","Ocurrio un error.","danger");
				 }
			}
		});

}

function modificarFechaActividad(id,inicio,fin){
		$.ajax({
			url:"./metodos_ajax/agenda_general/modificar_fechas.php?id="+id+"&inicio="+inicio+"&fin="+fin,
			method:"POST",
			success:function(respuesta){

				 if(respuesta==1){
						swal("Guardado","Datos guardados correctamente.","success");
						$("#modal_actividad").modal('hide');
					  actualizarEventos();
				 }else if(respuesta==2){
					 swal("Error al guardar","Ocurrio un error.","danger");
				 }
			}
		});
}

function eliminarActividad(){

  swal({
    title: "Desea eliminar actividad?",
    text: "No podrá recuperar los datos.",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, conservar",
    closeOnConfirm: false
  },
  function(){

	    var id=$("#txt_id_actividad").val();

	    $.ajax({
	      url:"./metodos_ajax/agenda_general/eliminar_actividad.php?id="+id,
	      method:"POST",
	      success:function(respuesta){
	         // alert(respuesta);
	         if(respuesta==1){
	            swal("Guardado","Datos guardados correctamente.","success");
							actualizarEventos();

	         }else if(respuesta==2){
	           swal("Error al guardar","Ocurrio un error.","danger");
	         }
	      }
	    });

  });

}
