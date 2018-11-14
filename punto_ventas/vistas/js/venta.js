// cargar tabla ventas
 
// $.ajax({
// 	url:"ajax/dtproductos.ajax.php",
// 	success:function(respuesta){
// 		console.log(respuesta);
// 	}
// })
if (localStorage.getItem("capturarRango") != null) {
	$('#daterange-btn span').html(localStorage.getItem("capturarRango"));
}else{
	$('#daterange-btn span').html('<i class="fa fa-calendar"></i>Rango de fecha');
}

$(".tablaVentas").DataTable({
	"ajax":"ajax/dtventas.ajax.php",
	"deferRender":true,
	"retrieve":true,
	"processing":true,
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
});
/*agregar producto de la tabla*/
$(".tablaVentas tbody").on("click",'button.agregarProducto',function(){
	
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

			//evitar agregar producto cuando el stock está en cero
			if (stock == 0) {
				swal({
					title:"No hay más productos",
					type:"error",
					confirmButtonText:"Cerrar"
				});

				$("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");
				return;
			}

			$(".nuevoProducto").append(
				'<div class="row" style="padding:5px 15px">'+
					'<div class="col-xs-6" style="padding-right:0px">'+
		             	'<div class="input-group">'+
			                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+
			                '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+
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
			// //agrupar productos json
			listarProducto()

			// poner formato a los precios
			$(".nuevoPrecioProducto").number(true,2);

			localStorage.removeItem("quitarProducto");
		}

	})

});


/*cuando carge la tabla navegando en ella */
$(".tablaVentas").on("draw.dt",function(){
	if (localStorage.getItem("quitarProducto") != null) {
		
		var listarIdProducto = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i=0;i<listarIdProducto.length;i++){
			$("button.recuperar[idProducto = '"+listarIdProducto[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperar[idProducto = '"+listarIdProducto[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');
		}
	}
});



/*quitar producto*/
var idQuitarProducto = [];

$(".formularioVenta").on('click','button.quitarProducto',function(){
		//se elimna las etiquetas
	$(this).parent().parent().parent().parent().remove();
	//capturamos el id del producto
	var idProducto = $(this).attr("idProducto");

	/*Almacenar el id de producto a quitar*/
	if (localStorage.getItem("quitarProducto") == null) {
		idQuitarProducto = [];
	}else{
		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))
	}
	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto",JSON.stringify(idQuitarProducto));

	//recuperamos el boton
	$("button.recuperar[idProducto = '"+idProducto+"']").removeClass('btn-default');
	$("button.recuperar[idProducto = '"+idProducto+"']").addClass('btn-primary agregarProducto');

	if ($(".nuevoProducto").children().length == 0) {
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);
	}else{
		//ejecuta metodo
		sumarPrecio()
		agregarImpuesto()
		listarProducto()
	}
	
})

/*desactivar boton al agregar producto si ya habia sido seleccionado*/
function quitarAgregarProducto(){
	//captura el id de los productos elegidos
	var idProducto = $(".quitarProducto");
	//capturan botones de agregar de la tabla
	var botonesTabla = $(".tablaVentas tbody button.agregarProducto");
	//recorremos en un ciclo para obtener los diferentes id que fueron elegidos
	for(var i = 0;i<idProducto.length;i++){
		//se captura el id de los productos agregados
		var boton = $(idProducto[i]).attr("idProducto");
		//Se hace recorrido por la tabla q aparece para desactivar botones
		for(var j=0;j<botonesTabla.length;j++){

			if ($(botonesTabla[j]).attr("idProducto") ==  boton) {
				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-default");
			}
		}
	}

}

$(".tablaVentas").on("draw.dt",function(){
	quitarAgregarProducto();
});


/*Agregado productos desde dispositios*/
var numProducto = 0;
$(".btnAgregarProducto").click(function(){

	numProducto ++;

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
			               '<select class="form-control nuevaDescripcionProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+

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
		                    '<input type="text"  class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" precioReal="" readonly required>'+
						'</div>'+
		            '</div>'+
	            '</div>'
	            );
			//se agrega los productos al select
			respuesta.forEach(funcionFor);

			function funcionFor(item,index){

				if (item.stock != 0) {
				$("#producto"+numProducto).append(	
					'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
					)
				}
			}
		 sumarPrecio()
		 agregarImpuesto()
		 
		// poner formato a los precios
		$(".nuevoPrecioProducto").number(true,2);
		}

	})
})

/*Selecionar producto*/
$(".formularioVenta").on("change","select.nuevaDescripcionProducto",function(){
	
	var nombreProducto = $(this).val();
	

	var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");

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
      		$(nuevaDescripcionProducto).attr("idProducto", res["id"]);
      		$(nuevaCantidadProducto).attr("stock",res["stock"]);
      		$(nuevaCantidadProducto).attr("nuevoStock",Number(res["stock"])-1);
      		$(nuevoPrecioProducto).val(res["precio_venta"]);
      		$(nuevoPrecioProducto).attr("precioReal",res["precio_venta"]);

      		//agrupar productos json
			listarProducto()
			sumarPrecio()
      	}

	})


})

/*modificar cantidad*/
$(".formularioVenta").on("change","input.nuevaCantidadProducto",function(){

	//se ingresa al value del input nuevoPrecio
	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	//se multiplica el valor de la cantidad por el valor del precio
	var precioFinal = $(this).val() * precio.attr("precioReal");

	precio.val(precioFinal);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock",nuevoStock);

	if (Number($(this).val()) > Number($(this).attr("stock"))) {

		$(this).val(0);
		$(this).attr("nuevoStock",$(this).attr("stock"));
		
		var precioFinal = $(this).val() * precio.attr("precioReal");

		precio.val(precioFinal);

		sumarPrecio(); 

		swal({
			title:"La cantidad supera el Stock",
			text: "Solo hay en exitencia "+ $(this).attr("stock") + " unidades",
			type:"warning",
			confirmButtonText:"!Cerrar¡"
		});
		return;
	}

	 sumarPrecio() 
	 agregarImpuesto()
	 //agrupar productos json
	 listarProducto()
	
})
/*sumar precios*/
function sumarPrecio(){
	var precioTodoProducto = $(".nuevoPrecioProducto");
	var sumaPrecioProducto = [];
	for(var i=0;i<precioTodoProducto.length;i++){
		sumaPrecioProducto.push(Number($(precioTodoProducto[i]).val()));
	}
	/*sumamos los indeces del array*/
	function calcularTotalPrecio(total,numero){
		return total+numero;
	}

	var totalPrecio = sumaPrecioProducto.reduce(calcularTotalPrecio);

	$("#nuevoTotalVenta").val(totalPrecio);
	$("#totalVenta").val(totalPrecio);
	$("#nuevoTotalVenta").attr("total",  totalPrecio);
}

/*Calculando impuesto*/
 function agregarImpuesto(){
	var precioTotal = $("#nuevoTotalVenta").attr("total");
	
	
	var precioSinImpuesto = Number(precioTotal/1.16);
	
	
	var impuesto = Number(precioSinImpuesto*.16);

	
	var totalConImpuesto = Number(impuesto) +  Number(precioSinImpuesto); 

	
	$("#nuevoTotalVenta").val(totalConImpuesto);
	$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(impuesto);
	$("#nuevoPrecioNeto").val(precioSinImpuesto);
	
}

/*poner formato a  precios final*/
$("#nuevoTotalVenta").number(true,2);


/*Seleccionar metodo pago*/
$("#nuevoMetodoPago").change(function(){
	var cambio = $(this).val();
	if (cambio == "Efectivo") {

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

			'<div class="col-xs-4"><b>Pago Cliente</b>'+
				'<div class="input-group">'+
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
					'<input type="text"  class="form-control nuevoValorEfectivo" placeholder="0.00" required>'+
				'</div>'+
			'</div>'+

			'<div class="col-xs-4 capturaCambioEfectivo" style="padding-left:0px"><b>Cambio</b>'+
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
	
		
		var cambio = Number(efectivo) - Number(totalpagar);
		var NcambioEfectivo = $(this).parent().parent().parent().children(".capturaCambioEfectivo").children().children(".CambioEfectivo");
		
		NcambioEfectivo.val(cambio);
			
})

/*cambio transacion*/
$(".formularioVenta").on('change','input#codigoTransicion',function(){

	//lista metodo en la entrada
	listarMetodos()			
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

/*btn editar venta*/
$(".tablas").on("click",".btnEditarVenta",function(){
	var idVenta = $(this).attr("idVenta");
	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;
})

/*Borrar venta*/
$(".tablas").on("click",".btnEliminarVenta",function(){
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
	// if ($("#mcliente").val() !== "Seleccione" ) {
	var codigoVenta = $(this).attr("codigoVenta");
	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta, "_blank");

	// }else{
	// 	swal({
	// 		title:"Debe seleccionar a un cliente para imprimir una factura",
	// 		type:"warning",
	// 		confirmButtonText:"Continuar"
	// 	});
	// }
});

/*Rango de fechas*/
$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
	function (start, end) {
	  $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))

	  var fechaInicial = start.format("YYYY-MM-DD");
	  
	  var fechaFinal = end.format("YYYY-MM-DD");
	  
	  var capturarRango = $('#daterange-btn span').html();
	  localStorage.setItem("capturarRango",capturarRango);

	  window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
   	}
)

/*Cancelar rango de fechas*/
$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ventas";
})

/*capturar hoy*/
$(".daterangepicker.opensleft .ranges li").on("click",function(){

	var textoHoy = $(this).attr("data-range-key");
	if (textoHoy == "Hoy") {

		var d = new Date();

		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var anio = d.getFullYear();

		if (mes < 10) {
			var fechaInicial = anio+"-0"+mes+"-"+dia;
			var fechaFinal = anio+"-0"+mes+"-"+dia;
		}else if (dia < 10) {
			var fechaInicial = anio+"-"+mes+"-0"+dia;
			var fechaFinal = anio+"-"+mes+"-0"+dia;
		}else if (mes < 10 && dia < 10) {
			var fechaInicial = anio+"-0"+mes+"-0"+dia;
			var fechaFinal = anio+"-0"+mes+"-0"+dia;
		}else{
			var fechaInicial = anio+"-"+mes+"-"+dia;
			var fechaFinal = anio+"-"+mes+"-"+dia;
		}

		localStorage.setItem("capturarRango","Hoy");

		window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}
})

