/* Editar categorias */

$(".btnEditarSub").click(function(){
	var idSub = $(this).attr("idSub");
	console.log(idSub);
	var datos = new FormData();

	datos.append("idSub",idSub);

	$.ajax({
		url: "ajax/subcategoria.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			console.log(respuesta);
			$("#editarAgregarCategoria").val(respuesta["id_categoria"]);
			$("#editarSubCategoria").val(respuesta["nombre"]);
		}
	})
})