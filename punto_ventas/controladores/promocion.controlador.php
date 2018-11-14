<?php 
class ControladorPromocion{
	
	static public function ctrCrearPromocion(){
		if (isset($_POST["nombre_promo"])) {
			if (preg_match('/^[a-z-A-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nombre_promo"])) {
				$tabla = "promocion";

				$dato = array("nombre"=>$_POST["nombre_promo"],
							  "fechaInicio" =>$_POST["fechaUno"],
							  "fechaFinal" => $_POST["fechaDos"],
							  "precioPromo" => $_POST["precio_descuento"],
							  "productos" => $_POST["listproductos"]
							);
				
				$respuesta = ModeloPromocion::mdlCrearPromocion($tabla,$dato);

				if ($respuesta == "ok") {
					echo '<script>
							localStorage.removeItem("rango");
							swal({
								type: "success",
								title:"venta realziada",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: true
								}).then((result)=>{
									if(result.value){
									window.location = "promociones";
									}
								})
						  </script>';
				}
			}
		}
	}

	static public function ctrMostrarPromocion($item,$valor){
		$tabla = "promocion";

		$respuesta = ModeloPromocion::mdlMostrarPromocion($tabla,$item,$valor);
		return $respuesta;
	}

	static public function ctrEditarPromocion(){
		if (isset($_POST["editarNombrePromo"])) {
			if (preg_match('/^[a-z-A-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarNombrePromo"])) {
				$tabla = "promocion";

				$item = "nombre_promocion";
				$valor = $_POST["editarNombrePromo"];

				$traerPromo = ModeloPromocion::mdlMostrarPromocion($tabla,$item,$valor);
			
				if ($_POST["listproductos"] == "") {
					$listproductos = $traerPromo["productos"];
					$cambioProducto = false; 
				}else{
					$listproductos = $_POST["listproductos"];
					$cambioProducto = true; 
				}

				$dato = array("nombre"=>$_POST["editarNombrePromo"],
							  "fechaInicio" =>$_POST["fechaUno"],
							  "fechaFinal" => $_POST["fechaDos"],
							  "precioPromo" => $_POST["precio_descuento"],
							  "productos" => $listproductos
							);
				
				$respuesta = ModeloPromocion::mdlEditarPromocion($tabla,$dato);

				if ($respuesta == "ok") {
					echo '<script>
							localStorage.removeItem("rango");
							swal({
								type: "success",
								title:"Edición realizada",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: true
								}).then((result)=>{
									if(result.value){
									window.location = "promociones";
									}
								})
						  </script>';
				}
			}
		}
	}


	
	static public function ctrEliminarPromo(){
		if (isset($_GET["idPromo"])) {
			$tabla = "promocion";

			$respuesta = ModeloPromocion::mdlEliminarPromo($tabla,$_GET["idPromo"]);
			if ($respuesta == "ok") {
					echo '<script>
						
							swal({
								type: "success",
								title:"Promocion eliminada",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: true
								}).then((result)=>{
									if(result.value){
									window.location = "promociones";
									}
								})
						  </script>';
				}	
			}
	}
}