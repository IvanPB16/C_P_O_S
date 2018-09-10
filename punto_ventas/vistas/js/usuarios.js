$(".nuevaFoto").change(function() {

	var imagen = this.files[0];
	
	if (imagen["type"]  != "image/jpeg"  && imagen["type"]  != "image/png" ) {
		
		//limpiamos
		$(".nuevaFoto").val(""); 
		swal({
			  	type: "error",
				title: "Error al subir la imagen",
				text: "La imagen debe estar en formato jpeg o png",
				confirmButtonText: "Cerrar"
			});

	}else if (imagen["size"] > 2000000) {

		$(".nuevaFoto").val(""); 
		swal({
			  	type: "error",
				title: "Error al subir la imagen",
				text: "El tamaño excede el limite",
				confirmButtonText: "Cerrar"
			});

	}else{
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);
		$(datosImagen).on("load",function(event){
			var rutaImagen = event.target.result;
			$(".previsualizar").attr("src",rutaImagen);
		})
	}
})


/**
 Editar usuario
  */

$(".btnEditarUsuario").click(function(){
	
	var idUsuario = $(this).attr("idUsuario");
	var datos = new FormData() ;
	datos.append("idUsuario",idUsuario);

	$.ajax({

		url:"ajax/usuario.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);
			$("#fotoActual").val(respuesta["foto"]);

			$("#passwordActual").val(respuesta["password"]);

			if (respuesta["foto"] != "") {
				$(".previsualizar").attr("src",respuesta["foto"]);
			}
		}
	});
})


/*Activar usuario*/

$(".btnActivar").click(function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();

	datos.append("activarId",idUsuario);
	datos.append("activarUsuario",estadoUsuario);

	$.ajax({
		url:"ajax/usuario.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success:function(respuesta){

		}

	})

	if (estadoUsuario == 0) {
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoUsuario',1);
	}else{
		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoUsuario',0);
	}

})

//Revisar usuario
$("#nuevoUsuario").change(function(){
	
	$(".alert").remove();

	var usuario = $(this).val();
	var datos = new FormData();

	datos.append("validarUsuario",usuario);

	$.ajax({
		url:"ajax/usuario.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			if (respuesta) {
				$("#nuevoUsuario").parent().after('<div class="alert alert-warning">El usuario ya existe en la base de datos.</div>');

				$("#nuevoUsuario").val("");
			}
		}

	})

})

//borrar usuario

$(".btnEliminarUsuario").click(function(){

	var idUsuario = $(this).attr("idUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var usuario = $(this).attr("usuario");

	swal({
			title:'¿Estas seguro de borrar el usuario?',
			text: "Si no lo está puede cancelar la acción",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3885d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Borrar usuario'
		}).then((result)=>{
			if (result.value) {
				window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
			}
		});

})

//validar contraseña agregar usuario
$(document).ready(function () {
	$('.btn-val').hide(); 
	 $('#validarNuevoPassword').keyup(function(){
	 	var pass =  $('#nuevoPassword').val();
	 	var pass2 = $('#validarNuevoPassword').val();

	 	if (pass == pass2) {
	 		$("#error").text("Coinciden").css("color","green");
	 		$('.btn-val').show(); 
	 	}else{
	 		$("#error").text("No coinciden").css("color","red");
	 		$('.btn-val').hide(); 
	 	}
	 });
});

//validar contraseña editar usuario

/*$(document).ready(function () {
	$('.btn-val').hide(); 
	 $('#validarNuevoPassword2').keyup(function(){
	 	var paseditar =  $('#editarPassword').val();
	 	var pasval = $('#validarNuevoPassword2').val();

	 	if (paseditar == pasval) {
	 		$("#error2").text("Coinciden").css("color","green");
	 		$('.btn-val').show(); 
	 	}else{
	 		$("#error").text("No coinciden").css("color","red");
	 		$('.btn-val').hide(); 
	 	}
	 });
});*/

