<?php 
 
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class TablaProductos{

	public function mostrarTablaProducto(){

		$item = null;
	 	$valor = null;

	 	$mostrar = ControladorProducto::ctrMostrarProducto($item,$valor);

	 	echo '{
	 			"data": [';
	 			#i es igual a 0, i debe ser menor que el arreglo productos menos 1 e i se incrementa en 1
	 			for($i = 0; $i<count($mostrar)-1;$i++){

	 				echo '[
	 					"'.($i+1).'",
	 					"'.$mostrar[$i]["codigo"].'",
	 					"'.$mostrar[$i]["descripcion"].'",
	 					"'.$mostrar[$i]["stock"].'",
	 					"'.$mostrar[$i]["id"].'" 
	 					],';

	 			}

	 			echo'	[
	 					"'.count($mostrar).'",
	 					"'.$mostrar[count($mostrar)-1]["codigo"].'",
	 					"'.$mostrar[count($mostrar)-1]["descripcion"].'",
	 					"'.$mostrar[count($mostrar)-1]["stock"].'",
	 					"'.$mostrar[count($mostrar)-1]["id"].'" 
	 					]
	 				]

	 		}';
	}
}

$mostrarProducto = new TablaProductos();
$mostrarProducto -> mostrarTablaProducto();