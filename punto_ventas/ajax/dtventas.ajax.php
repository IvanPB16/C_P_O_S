<?php 
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class TablaMostraProductos{

	public function mostrarTablaProducto(){

		$item = null;
	 	$valor = null;

	 	$mostrar = ControladorProducto::ctrMostrarProducto($item,$valor);

	 		$datosJS='{
	 			"data": [';
	 		for($i = 0;$i<count($mostrar);$i++){

	 			if ($mostrar[$i]["stock"] <= 10) {

	 					$stock = "<button class='btn btn-danger'>".$mostrar[$i]["stock"]."</button>";

	 				}else if ($mostrar[$i]["stock"] > 11 && $mostrar[$i]["stock"] <= 15) {

	 					$stock = "<button class='btn btn-warning'>".$mostrar[$i]["stock"]."</button>";

	 				}else{

	 					$stock = "<button class='btn btn-success'>".$mostrar[$i]["stock"]."</button>";

	 				}
	 			$botonAdd = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperar' idProducto='".$mostrar[$i]["id"]."'>Agregar</button></div>";
	 			/*concatena*/
	 		$datosJS .='[
	 					"'.($i+1).'",
	 					"'.$mostrar[$i]["codigo"].'",
	 					"'.$mostrar[$i]["descripcion"].'",
	 					"'.$stock.'",
	 					"'.$botonAdd.'" 
	 					],';
	 		}

	 		/*devolvemos los datos sin el ultimo caracter que es la coma para el ultimo indece */
	 		$datosJS = substr($datosJS,0,-1);

	 		$datosJS.= ']
			}';
			echo $datosJS;
	}
}

$mostrarProducto = new TablaMostraProductos();
$mostrarProducto -> mostrarTablaProducto();