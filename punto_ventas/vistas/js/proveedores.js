/*editar*/
$(document).on("click",".btnEditarProveedor",function(){

  	var idProveedor = $(this).attr("idProveedor");

  	var dato = new FormData();

  	dato.append("idProveedor",idProveedor);

  	$.ajax({
		url: "ajax/proveedores.ajax.php",
		method: "POST",
		data: dato,
		cache: false,
		contentType: false,
		processData:false,
		dataType:"json",
		success:function(res){
			$("#IdProv").val(res["id"]);
  			$("#editarProveedor").val(res["nombre_proveedor"]);
  			$("#editarArticulo").val(res["producto"]);
  			$("#editarTelefono").val(res["telefono"]);
  			$("#editarEmail").val(res["correo"]);
  		}
  	})
  })


/*eliminar*/
$(document).on("click",".btnEliminarProveedor",function(){
	var idProveedor = $(this).attr("idProveedor");

		swal({
			title:'¿Estas seguro de borrar al proveedor?',
			text: "Si no lo está puede cancelar la acción",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3885d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Borrar proveedor'
		}).then((res)=>{
		if (res.value){
			window.location = "index.php?ruta=proveedores&idProveedor="+idProveedor;
		}
	})
})