<?php 

class ControladorSubCategorias{


	static public function ctrMostrarSubCategorias($item,$valor){
		$table = "subcategoria";

		$res = ModeloSubCategorias::MdlMostrarSubCategoria($table,$item,$valor);

		return $res;
	}
} 