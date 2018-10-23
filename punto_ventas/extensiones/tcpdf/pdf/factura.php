<?php 
	
require_once"../../../controladores/ventas.controlador.php";
require_once"../../../controladores/clientes.controlador.php";
require_once"../../../controladores/usuarios.controlador.php";
require_once"../../../controladores/productos.controlador.php";

require_once"../../../modelos/ventas.modelo.php";
require_once"../../../modelos/clientes.modelo.php";
require_once"../../../modelos/usuarios.modelo.php";
require_once"../../../modelos/productos.modelo.php";

class imprimirFactura{
	public $codigo;
	public $idCliente;

	public function traerImpresion(){

		//traer informacion de la venta
		$itemVenta = "codigo_venta";
		$valorVenta = $this->codigo;

		$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta,$valorVenta);

		$fecha = substr($respuestaVenta["fecha"], 0,-8);
		$producto = json_decode($respuestaVenta["producto"],true);

		$neto = number_format($respuestaVenta["subtotal"],2);
		$impuesto = number_format($respuestaVenta["impuesto"],2);
		$total = number_format($respuestaVenta["total"],2);

		//trae información del cliente
		$itemCliente = "id";
		$valorCliente = $this->idCliente;

		$respuestaCliente = ControladorCliente::ctrMostrarCliente($itemCliente,$valorCliente);

		//se trae informaccion del empleado vendedor
		$itemEmpleado = "id";
		$valorEmpleado =  $respuestaVenta["id_vendedor"];

		$respuestaEmpleado = ControladorUsuarios::ctrMostrarUsuario($itemEmpleado,$valorEmpleado);

//requerimos la clase tcpdf
require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);

$pdf->startPageGroup();

$pdf->AddPage();
/* primero bloque */

$bloque1 = <<<EOF
	<table>
		<tr>
			<td style="width:150px"><img src="images/logo.jpeg"></td>
			<td style="backgroud-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					Nombre: CompuActual
					<br>
					Dirección: 12 de Octubre
				</div>
			</td>
			<td style="backgroud-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					teléfono:01 233 311 6045
					<br>
					Email:compuactual@hotmail.com
				</div>
			</td>
			<td style="backgroud-color:white; width:110px">

				<div style="font-size:8.5px; text-align:right; line-height:15px; color:red;">
					<br>
					FACTURA N.
					<br>$valorVenta<br>	
				</div>
			</td>		
		</tr>
	</table>
EOF;
$pdf->writeHTML($bloque1,false,false,false,false,'');

/* bloque 2 */

$bloque2 = <<<EOF

	<table>
		<tr>
			<td style="width=540px"><img src="images/back.jpg"></td>
		</tr>

	</table>
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid:#666; background-color:white; width:390px ">
				Cliente: $respuestaCliente[nombre_cliente]
			</td>

			<td style="border: 1px solid:#666; background-color:white; width:150px text-aling:right ">
					Fecha: $fecha
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid:#666; background-color:white; width:540px">
				Vendedor:$respuestaEmpleado[nombre]
			</td>

		</tr>
		<tr>	
		<td style:"border-bottom:1px solid:#666;background-color:white; width:540;"></td>
		</tr>

	</table>

EOF;
$pdf->writeHTML($bloque2,false,false,false,false,'');

/* bloque 3 */

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid:#666; background-color:white; width: 80px text-aling:center">Cantidad</td>
			<td style="border: 1px solid:#666; background-color:white; width: 260px text-aling:center">Producto</td>
			<td style="border: 1px solid:#666; background-color:white; width: 100px text-aling:center">Valor Unitario</td>
			<td style="border: 1px solid:#666; background-color:white; width: 100px text-aling:center">Total</td>

		</tr>
	</table>
EOF;
$pdf->writeHTML($bloque3,false,false,false,false,'');

/* bloque 4 */
foreach ($producto as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;
$respuestaProducto = ControladorProducto::ctrMostrarProducto($itemProducto,$valorProducto,$orden);


$valorUnitario = number_format($respuestaProducto["precio_venta"],2);

$precioTotal = number_format($item["total"],2);

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 80px; text-align:center">
				$item[cantidad]
			</td>
			
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 260px; text-align:center">
				$item[descripcion]
			</td>
	
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 100px; text-align:center">
				$ $valorUnitario
			</td>

			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 100px; text-align:center">
				$ $precioTotal
			</td>
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque4,false,false,false,false,'');
}

/*bloque 5*/

$bloque4 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="color:#333; background-color:white; width: 340px; text-align:center"></td>

			<td style="border-bottom: 1px solid:#666; background-color:white; width: 100px; text-align:center"></td>

			<td style="border-bottom: 1px solid:#666;
				color:#333; background-color:white; width: 100px; text-align:center"></td>
		</tr>

		<tr>
			<td style="border-right: 1px solid:#666; color:#333; background-color:white; width: 340px; text-align:center"></td>

			<td style="border: 1px solid:#666; background-color:white; width: 100px; text-align:center">
				Neto:
			</td>
			<td style="border: 1px solid:#666; background-color:white; width: 100px; text-align:center">
				$ $neto
			</td>
		</tr>

		<tr>
			<td style="border-right: 1px solid:#666; color:#333; background-color:white; width: 340px; text-align:center"></td>

			<td style="border: 1px solid:#666; background-color:white; width: 100px; text-align:center">
				Impuesto:
			</td>
			<td style="border: 1px solid:#666; background-color:white; width: 100px; text-align:center">
				$ $impuesto
			</td>	
		</tr>

		<tr>
			<td style="border-right: 1px solid:#666; color:#333; background-color:white; width: 340px; text-align:center"></td>

			<td style="border: 1px solid:#666; background-color:white; width: 100px; text-align:center">
				Total:
			</td>
			<td style="border: 1px solid:#666; background-color:white; width: 100px; text-align:center">
				$ $total
			</td>	
		</tr>
	</table>
EOF;

$pdf->writeHTML($bloque4,false,false,false,false,'');



$pdf->Output('factura.php');

	}
}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> idCliente = $_GET["cliente"];
$factura->traerImpresion(); 
?>