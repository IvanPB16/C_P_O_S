  <?php

  require_once "../controladores/proveedores.controlador.php";
  require_once "../modelos/proveedores.modelo.php";

  class AjaxProveedor{

  	public $idProveedor;

  	public function ajaxEditarProveedor(){

  		$item = "id";
  		$valor = $this->idProveedor;

  		$enviar = ControladorProveedor::ctrMostrarProveedor($item,$valor);

  		echo json_encode($enviar);
  	}

  }

/*editar provedor*/
  if (isset($_POST["idProveedor"])) {
  	$editarProv = new AjaxProveedor();
  	$editarProv -> idProveedor = $_POST["idProveedor"];
  	$editarProv -> ajaxEditarProveedor();
  }