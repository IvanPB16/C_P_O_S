$(document).on("click",".btnEditarCliente",function(){

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
$(document).on("click",".btnEliminarCliente",function(){

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

$("#nuevoCliente").change(function(){

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
			if (!respuesta) {
				var codigoCliente = "CA " + 1;
				$("#nuevoNumeroCliente").val(codigoCliente);
			}else{
				var nuevoCodigo = Number(respuesta["codigo"]) + 1;
				$("#nuevoNumeroCliente").val(codigoCliente);
			}
		}
	})
})

/* capturar categoria para asiganr codigo */
// $("#nuevaCategoria").change(function(){

// 	var idCategoria = $(this).val();

// 	var datos = new FormData();

// 	datos.append("idCategoria",idCategoria);

// 	$.ajax({
// 		url: "ajax/productos.ajax.php",
// 		method: "POST",
// 		data: datos,
// 		cache: false,
// 		contentType: false,
// 		processData:false,
// 		dataType:"json",
// 		success:function(respuesta){

// 			if (!respuesta) {
// 				var nuevoCodigo = idCategoria +"01";
// 				$("#nuevoCodigo").val(nuevoCodigo); 
// 			}else{
			
// 			var nuevoCodigo = Number(respuesta["codigo"]) + 1;
// 			$("#nuevoCodigo").val(nuevoCodigo); 
// 		}
			
// 		}

// 	})
// })