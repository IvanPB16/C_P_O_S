  /* tabla dinamica */
  
var tabla = $(".tablaProductos").DataTable({
	"ajax":"ajax/dtproductos.ajax.php",
	"columnDefs":[{
				"targets": -9,
				"data": null,
			 	"defaultContent": '<img class="img-thumbnail imgTabla" width="40px">'
			},
			{
				"targets":-1,
				"data":null,
				"defaultContent":'<div class="btn-goup"><button class="btn btn-success btnCantidadProducto" data-toggle="modal" data-target="#modalCantidadProducto" idProducto><i class="fa fa-plus"></i></button><button class="btn btn-warning btnEditarProducto" data-toggle="modal" data-target="#modalEditProducto" idProducto><i class="fa fa-pencil"></i></button><button class="btn btn-danger btnEliminarProducto" idProducto codigo imagen><i class="fa fa-times"></i></button></div>'
			} 
	],
	"language":{
		 "sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

}) 


/* activar botones botones */

$('.tablaProductos tbody').on('click','button',function(){

	 if (window.matchMedia("(min-width:992px)").matches) {
	 	var data = tabla.row($(this).parents('tr')).data();
	 }else{
		var data = tabla.row($(this).parents('tbody tr ul li')).data();
	 }

	$(this).attr("idProducto",data[9])
	$(this).attr("codigo",data[2])
	$(this).attr("imagen",data[1])
});

/* cargar  imagenes */

function cargarImagenes(){

	var imgTabla = $(".imgTabla");

 	for(var i = 0;i < imgTabla.length; i++){

 		var data = tabla.row($(imgTabla[i]).parents('tr')).data(); 

 		$(imgTabla[i]).attr("src",data[1]);
	}

}
/* Primera carga de imagen al ingresar por primera vez*/

setTimeout(function(){
cargarImagenes();
},300)

/* carga de imagen con el buscador*/

$(".dataTables_paginate").click(function(){

	cargarImagenes();
})

$("input[aria-controls='DataTables_Table_0']").focus(function(){
	$(document).keyup(function(event){

		event.preventDefault();

		cargarImagenes();
	})
})

/* Cargar imagenes con el filtro de cantidad */

$("select[name='DataTables_Table_0_length']").change(function(){
	cargarImagenes();
})

/*cargar imagenes con ordenar*/

$(".sorting").click(function(){
	cargarImagenes();
})


/* capturar categoria para asiganr codigo */
$("#nuevaCategoria").change(function(){
 
	//se va a enviar a la tabla de productos para buscarlo en id_categoria
	var idCategoria = $(this).val();

	var datos = new FormData();

	datos.append("idCategoria",idCategoria);

	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData:false,
		dataType:"json",
		success:function(respuesta){

			if (!respuesta) {
				var nuevoCodigo = idCategoria +"01";
				$("#nuevoCodigo").val(nuevoCodigo); 
			}else{
			
			var nuevoCodigo = Number(respuesta["codigo"]) + 1;
			$("#nuevoCodigo").val(nuevoCodigo); 
			}
		
		}

	})
})

/*agregar precio de venta*/
$("#nuevoPrecioCompra,#editarPrecioCompra").change(function(){

	if ($(".porcentaje").prop("checked")) {
		var valorPorcentaje = $(".nuevoPorcentaje").val();
	
		var porcentaje = Number((($("#nuevoPrecioCompra").val()*valorPorcentaje)/100))+Number($("#nuevoPrecioCompra").val());

		var editarporcentaje = Number((($("#editarPrecioCompra").val()*valorPorcentaje)/100))+Number($("#editarPrecioCompra").val());

		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);

		$("#editarPrecioVenta").val(editarporcentaje );
		$("#editarPrecioVenta").prop("readonly",true);
	}
})

/*Cambio de porcentaje*/
$(".nuevoPorcentaje").change(function(){

	if ($(".porcentaje").prop("checked")) {
			var valorPorcentaje = $(this).val();
		
			var porcentaje = Number((($("#nuevoPrecioCompra").val()*valorPorcentaje)/100))+Number($("#nuevoPrecioCompra").val());

			var editarporcentaje = Number((($("#editarPrecioCompra").val()*valorPorcentaje)/100))+Number($("#editarPrecioCompra").val());

			

			$("#nuevoPrecioVenta").val(porcentaje);
			$("#nuevoPrecioVenta").prop("readonly",true);

			$("#editarPrecioVenta").val(editarporcentaje );
			$("#editarPrecioVenta").prop("readonly",true);

		
		} 
})

$(".porcentaje").on("ifUnchecked",function(){
	$("#nuevoPrecioVenta").prop("readonly",false);	
	$("#editarPrecioVenta").prop("readonly",false);
})

$(".porcentaje").on("ifChecked",function(){
	$("#nuevoPrecioVenta").prop("readonly",true);
	$("#editarPrecioVenta").prop("readonly",true);		
})


/*poner foto*/
$(".nuevaImagen").change(function() {

	var imagen = this.files[0];
	
	if (imagen["type"]  != "image/jpeg"  && imagen["type"]  != "image/png" ) {
		
		//limpiamos
		$(".nuevaImagen").val(""); 
		swal({
			  	type: "error",
				title: "Error al subir la imagen",
				text: "La imagen debe estar en formato jpeg o png",
				confirmButtonText: "Cerrar"
			});

	}else if (imagen["size"] > 2000000) {

		$(".nuevaImagen").val(""); 
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

/*Editar producto*/
$(".tablaProductos tbody").on("click","button.btnEditarProducto",function(){

	var idProducto = $(this).attr("idProducto");

	var datos = new FormData();

	datos.append("idProducto",idProducto);

	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData:false,
		dataType:"json",
		 success:function(respuesta){
		 	var datosCategoria = new FormData();
		 	datosCategoria.append("idCategoria",respuesta["id_categoria"]);
		 	$.ajax({
				url: "ajax/categorias.ajax.php",
				method: "POST",
				data: datosCategoria,
				cache: false,
				contentType: false,
				processData:false,
				dataType:"json",
				 success:function(respuesta){
				 	$("#editarCategoria").val(respuesta["id"]);
				 	$("#editarCategoria").html(respuesta["nombre"]);
				 }
			});

			var datosSub = new FormData();
		 	datosSub.append("idSubCategoria",respuesta["id_subcategoria"]);

			$.ajax({
				url: "ajax/subcategoria.ajax.php",
				method: "POST",
				data: datosSub,
				cache: false,
				contentType: false,
				processData:false,
				dataType:"json",
				success:function(respuesta){
					var h = '<option value="'+respuesta["id"]+'" selected>'+respuesta["nombre"]+'</option>';
				 	$("#editarSubCategoria").html(h);
				}
			});

		   $("#editarClavePro").val(respuesta["nuevaclave"]);
		   $("#editarCodigo").val(respuesta["codigo"]);
           $("#editarDescripcion").val(respuesta["descripcion"]);
           $("#editarStock").val(respuesta["stock"]);
           $("#editarPrecioCompra").val(respuesta["precio_compra"]);
           $("#editarPrecioVenta").val(respuesta["precio_venta"]);
           if (respuesta["imagen"] != "") {
           $("#imagenActual").val(respuesta["imagen"]);
           $(".previsualizar").attr("src",respuesta["imagen"]);
           }

		 }
	})
})

/*Eliminar producto*/
$(".tablaProductos tbody").on("click","button.btnEliminarProducto",function(){

	var idProducto = $(this).attr("idProducto");
	var codigo = $(this).attr("codigo");
	var imagen = $(this).attr("imagen");

		swal({
			title: '¿Seguro de que desea borrar el producto?',
			text: "Si no lo está puede cancelar la acción",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3885d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Borrar producto'
		}).then((result)=>{
			if (result.value) {
				window.location = "index.php?ruta=productos&idProducto="+idProducto+"&codigo="+codigo+"&imagen="+imagen;
			}
		})

	})



/*AgregarCantidad producto*/
$(".tablaProductos tbody").on("click","button.btnCantidadProducto",function(){

	var idProducto = $(this).attr("idProducto");

	var datos = new FormData();

	datos.append("idProducto",idProducto);

	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData:false,
		dataType:"json",
		 success:function(respuesta){
		 	$("#numeroAyuda").val(respuesta["codigo"]);
           	$("#stockActual").val(respuesta["stock"]);
		 }
	})

})

function agregarCantidad(){

	var stockActual = $("#stockActual").val();
	console.log(stockActual);
	var stockAgregar = $("#agregarCantidadStock").val();
	console.log(stockAgregar);
	var stockFinal = Number(stockActual) + Number(stockAgregar);
	console.log(stockFinal);

	$("#stockFn").val(stockFinal);

}

$("#agregarCantidadStock").change(function(){
	agregarCantidad();
})


/* mostrar subcategoria  */
$("#nuevaCategoria").change(function(){
 
	//se va a enviar a la tabla de productos para buscarlo en id_categoria
	var idCategoria = $(this).val();

	var datos = new FormData();
	datos.append("idCategoria",idCategoria);
	$.ajax({
		url: "ajax/subcategoria.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData:false,
		dataType:"json",
		success:function(respuesta){

			var h = '<option value="sinSeleccion" selected>Selecciona...</option>';
			respuesta.forEach(e => {
                h = h + '<option  value="'+e.id+'">'+e.nombre+'</option>';
            });

			 $("#nuevaSubCategoria").html(h);
		}
	})
})

/* mostrar editar subcategoria  */
$(".editarS").change(function(){
 
	//se va a enviar a la tabla de productos para buscarlo en id_categoria
	var idCategoria = $(this).val();

	var datos = new FormData();
	datos.append("idCategoria",idCategoria);
	$.ajax({
		url: "ajax/subcategoria.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			var valorActual = $("#editarSubCategoria").val();
			var h = '<option value="Sin seleccionar">Seleccionar...</option>';
			respuesta.forEach(e => {
                h = h + '<option  value="'+e.id+'">'+e.nombre+'</option>';
            });
			$("#editarSubCategoria").html(h);
		}
	})
})