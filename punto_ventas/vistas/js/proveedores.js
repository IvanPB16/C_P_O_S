/*editar*/
$(document).on("click",".btnEditarProveedor",function(){

  	var idProveedor = $(this).attr("idProveedor");
  	console.log(idProveedor);

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
  			$("#editarDescripcion").val(res["descripcion"]);
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

$(document).on("click",".btnOrden",function(){
	var idProveedor = $(this).attr("idProveedor");
	
	window.location = "index.php?ruta=orden&idProveedor="+idProveedor;
})

$(".agregarProducto").on('click',function(){
	$(".nuevaOrden").append(
	'<div class="row" style="padding:5px 15px">'+
					'<div class="col-xs-5">Nombre'+

		             	'<div class="input-group">'+
			                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProductoO" "><i class="fa fa-times"></i></button></span>'+
			                '<input type="text" class="form-control DescripcionProducto" name="agregarProducto" id="nombre" required>'+
		                '</div>'+
	           		 '</div>'+

		           	'<div class="col-xs-2">Cantidad'+
		                '<input type="number" class="form-control CantidadProducto" name="CantidadProducto" min="1" value="1" required>'+
	            	'</div>'+

		            '<div class="col-xs-5 ingresoPrecioT" style="padding-left: 0px">Precio Total'+
		             	'<div class="input-group">'+
		                  	'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+               
		                    '<input type="text" class="form-control PrecioProducto" name="PrecioProducto" required>'+
						'</div>'+
		            '</div>'+
	'</div>'	
		);
	sumarTotal()
})

$(".form-orden").on('click','.quitarProductoO',function(){
	$(this).parent().parent().parent().parent().remove();
	listar()
	sumarTotal()
})

$(".btn-enviar").hide();

$(".Validar").click(function(){
	listar()
	$(".btn-enviar").show();
	sumarTotal()
})

// $(".form-orden").on('change','input.CantidadProducto',function(){

// 	var precioUnitario = $(".PrecioProductoU").val();

// 	var precioFinal = $(this).val() * precioUnitario;

// 	$(".PrecioProducto").val(precioFinal);
// 		sumarTotal()
// })

function listar(){
	var listaProducto = [];
	var descripcion = $(".DescripcionProducto");
	var cantidad = $(".CantidadProducto");
	var precioU = $(".PrecioProductoU");
	var precio = $(".PrecioProducto");

	for(var i = 0; i<descripcion.length; i++){
		listaProducto.push({
			"descripcion":$(descripcion[i]).val(),
			"cantidad":$(cantidad[i]).val(),
			"precioU":$(precioU[i]).val(),
			"precio":$(precio[i]).val()
		});
	}
	$("#listaOrden").val(JSON.stringify(listaProducto));
}

$(".tablas").on('click','.btnEditarOrden',function(){
	var idOrden = $(this).attr("idOrden");
	window.location = "index.php?ruta=editar-orden&idOrden="+idOrden;
})

$(".tablas").on("click",".btnEliminarOrden",function(){
	
	var idOrden = $(this).attr("idOrden");

	swal({
        title: '¿Está seguro de borrar la orden de compra?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=ordenes&idOrden="+idOrden;
        }

  })
	
});

$(".tablas").on("click",".btnImprimirOrden",function(){
	var idOrden = $(this).attr("idOrden");
	window.open("extensiones/tcpdf/pdf/imporden.php?OrdenId="+idOrden, "_blank");
});

function sumarTotal(){
	var costoProducto = $(".PrecioProducto");
	var sumaPrecio = [];
	for(var i=0;i<costoProducto.length;i++){
		sumaPrecio.push(Number($(costoProducto[i]).val()));
	}
	/*sumamos los indeces del array*/
	function calcularTotal(total,numero){
		return total+numero;
	}

	var totalPrecio = sumaPrecio.reduce(calcularTotal);

	$("#total").val(totalPrecio);

}

