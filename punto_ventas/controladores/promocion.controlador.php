<?php 
class ControladorPromocion{
	
	static public function ctrCrearPromocion(){
		if (isset($_POST["nombre_promo"])) {
			if (preg_match('/^[a-z-A-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nombre_promo"])) {
				$tabla = "promocion";

				foreach ($_POST["idProducto"] as $key => $value) {
					$dato = array("nombre"=>$_POST["nombre_promo"],
							  "codigo" => $_POST["codigoPromocion"],
							  "fechaInicio" =>$_POST["fechaUno"],
							  "fechaFinal" => $_POST["fechaDos"],
							  "precioPromo" => $_POST["precio_descuento"],
							  "idproducto" => $_POST["idProducto"][$key]
							);
				$respuesta = ModeloPromocion::mdlCrearPromocion($tabla,$dato);
	
				}

				if ($respuesta == "ok") {
					echo '<script>
							localStorage.removeItem("rango");
							swal({
								type: "success",
								title:"Promoción creada",
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

	static public function ctrMostrarPromocion2($item,$valor){
		$tabla = "promocion";

		$respuesta = ModeloPromocion::mdlMostrarPromocion2($tabla,$item,$valor);
		return $respuesta;
	}

	static public function ctrEditarPromocion(){
		if (isset($_POST["editarNombrePromo"])) {
			if (preg_match('/^[a-z-A-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarNombrePromo"])) {

				$tabla = "promocion";

				foreach ($_POST["idProducto"] as $key) {
					
					$dato = array("nombre"=>$_POST["editarNombrePromo"],
							  "codigo" => $_POST["codigoPromocion"],
							  "fechaInicio" =>$_POST["fechaUno"],
							  "fechaFinal" => $_POST["fechaDos"],
							  "precioPromo" => $_POST["precio_descuento"],
							  "idproducto" => $_POST["idProducto"][$key]
							);
					$respuesta = ModeloPromocion::mdlEditarPromocion($tabla,$dato);
				}

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
		if (isset($_GET["codigo"])) {
			$tabla = "promocion";

			$respuesta = ModeloPromocion::mdlEliminarPromo($tabla,$_GET["codigo"]);
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