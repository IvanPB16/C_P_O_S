<?php 

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxCliente{
	public $idCliente;
	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;

		$res = ControladorCliente::ctrMostrarCliente($item,$valor);
		echo json_encode($res);
	}

}
 
/*editar cliente*/
if (isset($_POST["idCliente"])) {
	$editarCliente = new AjaxCliente();
	$editarCliente -> idCliente = $_POST["idCliente"];
	$editarCliente -> ajaxEditarCliente();
}
