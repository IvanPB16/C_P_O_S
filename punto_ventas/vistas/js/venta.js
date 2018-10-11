/*tabla dinamamica*/ 
  
var tabla_ventas = $(".tablaVentas").DataTable({
	"ajax":"ajax/dtventas.ajax.php",
	"columnDefs":[
				 {
				 	"targets":-2,
				 	"data":null,
				 	"defaultContent":'<div class="btn-group"><button class="btn btn-success limitestock" ></button></div>'
				 },
				 {
				 	"targets":-1,
				 	"data":null,
				 	"defaultContent":'<div class="btn-group"><button class="btn btn-primary agregarProducto recuperar" idProducto>Agregar</button></div>'
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

/*activar boton*/

$(".tablaVentas").on('click','button.agregarProducto',function(){

	//se hace recorrido en sus filas saliendo al tr y tomar toda la linea data 
	var data = tabla_ventas.row($(this).parents('tr')).data();

	//para colocar al idProducto el indice 5
	$(this).attr("idProducto",data[4]);
})

function mostrarLimiteStock(){

	var limitestock = $(".limitestock");
	for(var i=0; i < limitestock.length;i++){

		var data = tabla_ventas.row($(limitestock[i]).parents('tr')).data();
	
		if (data[3] <= 10) {

			$(limitestock[i]).addClass("btn-danger");
			$(limitestock[i]).html(data[3]);

		}else if(data[3] > 11 && data[3]  <= 15){

			$(limitestock[i]).addClass("btn-warning");
			$(limitestock[i]).html(data[3]);

		}else{

			$(limitestock[i]).addClass("btn-success");
			$(limitestock[i]).html(data[3]);
		}
	}
}


setTimeout(function(){
mostrarLimiteStock();
},300)

$(".dataTables_paginate").click(function(){

	mostrarLimiteStock();
})

$("input[aria-controls='DataTables_Table_0']").focus(function(){
	$(document).keyup(function(event){

		event.preventDefault();

		mostrarLimiteStock();
	})
})

/* Cargar imagenes con el filtro de cantidad */

$("select[name='DataTables_Table_0_length']").change(function(){
	mostrarLimiteStock();
})

/*cargar imagenes con ordenar*/

$(".sorting").click(function(){
	mostrarLimiteStock();
})

/*agregar productos desde tablas*/

$(".tablaVentas").on('click','button.agregarProducto',function(){

	var idProducto = $(this).attr("idProducto");
	
	$(this).removeClass("btn-primary agregarProducto");
	$(this).addClass("btn-default");

	var dato = new FormData();

	dato.append("idProducto",idProducto);

	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			var descripcion = respuesta["descripcion"];
			var stock = respuesta["stock"];
			var precio = respuesta["precio_venta"];

			$(".nuevoProducto").append(
				'<div class="row" style="padding:5px 15px">'+
					'<div class="col-xs-6" style="padding-right:0px">'+
		             	'<div class="input-group">'+
			                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+
			                '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'"  readonly required>'+
		                '</div>'+
	           		 '</div>'+

		           	'<div class="col-xs-3">'+
		                '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
	            	'</div>'+
	                     
		            '<div class="col-xs-3 ingresoPrecio" style="padding-left: 0px">'+
		             	'<div class="input-group">'+
		                  	'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+               
		                    '<input type="text" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" value="'+precio+'" precioReal="'+precio+'" required readonly>'+
						'</div>'+
		            '</div>'+
	            '</div>'
	            )
			/*ejecutamos la funcion suma precio*/
			sumarPrecio()

			agregarImpuesto()
			//agrupar productos json
			listarProducto()

			/*poner formato a los precios*/
			$(".nuevoPrecioProducto").number(true,2);
		}

	})


});
/*quitar productos*/

$(".formularioVenta").on('click','button.quitarProducto',function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	$("button.recuperar[idProducto = '"+idProducto+"']").removeClass('btn-default');
	$("button.recuperar[idProducto = '"+idProducto+"']").addClass('btn-primary agregarProducto');

	if ($(".nuevoProducto").children().length == 0) {
	
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);

	}else{
		sumarPrecio()
		agregarImpuesto()
		//agrupar productos json
		listarProducto()
	}
})

/*Agregado productos desde dispositios*/

$(".btnAgregarProducto").click(function(){
	var dato = new FormData();

	dato.append("traerProducto","ok");

	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			$(".nuevoProducto").append(
				'<div class="row" style="padding:5px 15px">'+
					'<div class="col-xs-6" style="padding-right:0px">'+
		             	'<div class="input-group">'+
			                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+
			               '<select class="form-control nuevaDescripcionProducto" idProducto name="nuevaDescripcionProducto" required>'+

			                '<option>Selecciona un producto</option>'+
			                '</select>'+

		                '</div>'+
	           		 '</div>'+

		           	'<div class="col-xs-3 ingresaCantidad">'+
		                '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock nuevoStock required>'+
	            	'</div>'+
	                     
		            '<div class="col-xs-3 ingresoPrecio" style="padding-left: 0px">'+
		             	'<div class="input-group">'+
		                  	'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+               
		                    '<input type="text"  class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" precioReal readonly required>'+
						'</div>'+
		            '</div>'+
	            '</div>'
	            );
			respuesta.forEach(funcionFor);

			function funcionFor(item,index){
				$(".nuevaDescripcionProducto").append(	
					'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
					)
			}
		sumarPrecio()
		agregarImpuesto()
		/*poner formato a los precios*/
			$(".nuevoPrecioProducto").number(true,2);
		}

	})
})

/*Selecionar producto*/
$(".formularioVenta").on("change","select.nuevaDescripcionProducto",function(){
	var nombreProducto = $(this).val();

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresaCantidad").children(".nuevaCantidadProducto");
	
	

	var dato = new FormData();
	dato.append("nombreProducto",nombreProducto);
	$.ajax({
		url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: dato,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(res){
      		$(nuevaCantidadProducto).attr("stock",res["stock"]);
      		$(nuevaCantidadProducto).attr("nuevoStock",Number(res["stock"])-1);
      		$(nuevoPrecioProducto).val(res["precio_venta"]);
      		$(nuevoPrecioProducto).attr("precioReal",res["precio_venta"]);

      		//agrupar productos json
			listarProducto()
      	}

	})


})

/*modificar cantidad producto*/

$(".formularioVenta").on("change","input.nuevaCantidadProducto",function(){

	//se ingresa al value del input nuevoPrecio
	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	//se multiplica el valor de la cantidad por el valor del precio
	var precioFinal = $(this).val() * precio.attr("precioReal");

	precio.val(precioFinal);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock",nuevoStock);

	if (Number($(this).val()) > Number($(this).attr("stock"))) {
		$(this).val(1); 
		swal({
			title:"La cantidad supera el Stock",
			text: "Solo hay en exitencia "+ $(this).attr("stock") + "unidades",
			type:"warning",
			confirmButtonText:"!Cerrar¡"
		});
	}

	sumarPrecio() 
	agregarImpuesto()
	//agrupar productos json
			listarProducto()
	
})

/*Sumar los productos*/

function sumarPrecio(){
	var precioTodoProducto = $(".nuevoPrecioProducto");
	var sumaPrecioProducto = [];
	for(var i=0;i<precioTodoProducto.length;i++){
		sumaPrecioProducto.push(Number($(precioTodoProducto[i]).val()));
	}

	function calcularTotalPrecio(total,numero){
		return total+numero;
	}

	var totalPrecio = sumaPrecioProducto.reduce(calcularTotalPrecio);

	$("#nuevoTotalVenta").val(totalPrecio);
	$("#totalVenta").val(totalPrecio);
	$("#nuevoTotalVenta").attr("total",  totalPrecio);
}

/*agregar impuesto*/

function agregarImpuesto(){
	var impuesto = $("#nuevoImpuestoVenta").val();
	var precioTotal = $("#nuevoTotalVenta").attr("total");
	
	var precioImpuesto = Number((precioTotal *impuesto)/100);

	var totalConImpuesto = Number(precioImpuesto) +  Number(precioTotal); 

	
	$("#nuevoTotalVenta").val(totalConImpuesto);
	$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);
	$("#nuevoPrecioNeto").val(precioTotal);
	
}

/*cambio del impuesto*/
$("#nuevoImpuestoVenta").change(function(){
	agregarImpuesto(); 
})

/*poner formato a  precios final*/
	$("#nuevoTotalVenta").number(true,2);
/*Seleccionar metodo pago*/

$("#nuevoMetodoPago").change(function(){
	var cambio = $(this).val();
	if (cambio == "Efectivo") {

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(
			'<div class="col-xs-4">'+
				'<div class="input-group">'+
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
					'<input type="text"  class="form-control nuevoValorEfectivo" placeholder="0.00" required>'+
				'</div>'+
			'</div>'+

			'<div class="col-xs-4 capturaCambioEfectivo" style="padding-left:0px">'+
				'<div class="input-group">'+
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
					'<input type="text"  class="form-control CambioEfectivo" placeholder="0.00" required readonly>'+
				'</div>'+
			'</div>'
			)
			//formato al precio
			$(".nuevoValorEfectivo").number(true,2);
			$(".CambioEfectivo").number(true,2);

			//lista metodo en la entrada
			listarMetodos(); 

	}else{
		$(this).parent().parent().removeClass("col-xs-4");
		$(this).parent().parent().addClass("col-xs-6");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(
			' <div class="col-xs-6" style="padding-left:0px">'+
               '<div class="input-group">'+
                         
               ' <input type="text" class="form-control" id="codigoTransicion" name="codigoTransicion" placeholder="Código transacción"  required>'+      
                '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
               '</div>'+
            '</div>'
			)

	}
})

/*cambio en efectivo*/
$(".formularioVenta").on('change','input.nuevoValorEfectivo',function(){

	var efectivo = $(this).val();
	var totalpagar = $("#nuevoTotalVenta").val();
	
	//if (efectivo > totalpagar) {
		
		var cambio = Number(efectivo) - Number(totalpagar);
		var NcambioEfectivo = $(this).parent().parent().parent().children(".capturaCambioEfectivo").children().children(".CambioEfectivo");
		
		NcambioEfectivo.val(cambio);
		
		//}else{
		// $(this).val(0); 
		// swal({
		// 	title:"La cantidad que ingreso es inferior a ",
		// 	text: "pulse para continuar",
		// 	type:"warning",
		// 	confirmButtonText:"!Cerrar¡"
		// })
		//}
})
/*cambio transacion*/
$(".formularioVenta").on('change','input#codigoTransicion',function(){
	//lista metodo en la entrada
			listarMetodos(); 

})
/*listar productos*/

function listarProducto(){
	
	var listaProducto = [];
	var descripcion = $(".nuevaDescripcionProducto");
	var cantidad = $(".nuevaCantidadProducto");
	var precio = $(".nuevoPrecioProducto");

	for(var i = 0; i<descripcion.length; i++){
		listaProducto.push({
			"id":$(descripcion[i]).attr("idProducto"),
			"descripcion":$(descripcion[i]).val(),
			"cantidad":$(cantidad[i]).val(),
			"stock":$(cantidad[i]).attr("nuevoStock"),
			"precio":$(precio[i]).attr("precioReal"),
			"total":$(precio[i]).val()
		});
	}

	$("#listaProductos").val(JSON.stringify(listaProducto));
}

/*listar metodo pago*/
function listarMetodos(){
	var listaMetodos = "";
	if($("#nuevoMetodoPago").val() == "Efectivo"){
		$("#listaMetodoPago").val("Efectivo");
	}else{
		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#codigoTransicion").val());
	}

}
/*Borrar venta*/
$(".btnEliminarVenta").click(function(){
	var idVenta = $(this).attr("idVenta");
	swal({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then((result) => {
        if (result.value) {
          
            window.location = "index.php?ruta=ventas&idVenta="+idVenta;
        }

  })
})

// Imprimir Factura
$(".tablas").on("click",".btnImprimirFactura",function(){
	var codigoVenta = $(this).attr("codigoVenta");
	var idCliente = $("#mcliente").val();
	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta+"&cliente="+idCliente, "_blank");
})
