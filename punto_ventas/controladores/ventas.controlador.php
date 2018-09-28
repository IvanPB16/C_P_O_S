<?php

class ControladorVentas{
	public static function ctrMostrarVentas($item,$valor){
		$tabla = "venta";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);

		return $respuesta;
	}
} 
 