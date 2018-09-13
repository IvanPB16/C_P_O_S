$(".btnEditarCliente").click(function(){

	var idCliente = $(this).attr("idCliente");

	var dato =  new FormData();

	dato.append("idCliente",idCliente);

		$.ajax({
		url: "ajax/cliente.ajax.php",
		method: "POST",
		data: dato,
		cache: false,
		contentType: false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			$("#IdCliente").val(respuesta["id"]);
			$("#editarCliente").val(respuesta["nombre_cliente"]);
			$("#editarNumeroCliente").val(respuesta["numero_cliente"]);
			$("#editarRFC").val(respuesta["rfc"]);
			$("#editarEmail").val(respuesta["email"]);
			$("#editarTelefono").val(respuesta["telefono"]);
		}
	})

})
 /*Eliminar cliente*/
$(".btnEliminarCliente").click(function(){

	var idCliente = $(this).attr("idCliente");

	swal({
			title:'¿Estas seguro de borrar al cliente?',
			text: "Si no lo está puede cancelar la acción",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3885d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Borrar cliente'
		}).then((res)=>{
		if (res.value){
			window.location = "index.php?ruta=clientes&idCliente="+idCliente;
		}
	})
})

		