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
		$pago = $respuestaVenta["metodo_pago"];

		//trae información del cliente
		$itemCliente = "id";
		$valorCliente = $respuestaVenta["id_cliente"];

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
					Teléfono:01 233 311 6045
					<br>
					Email:compuactual@hotmail.com
				</div>
			</td>
			<td style="backgroud-color:white; width:110px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					FACTURA N.
					<br>$valorVenta<br>	
					Fecha:
					<br>$fecha<br>	
					Lugar de emisión:
					<br>73700<br>
				</div>
			</td>		
		</tr>
	</table>
EOF;
$pdf->writeHTML($bloque1,false,false,false,false,'');

/* bloque 2 */

$bloque2 = <<<EOF

	<table style="font-size:8px; padding:5px 10px;">
		<tr>
			<td style="background-color:white; width:280px ">
				Cliente: $respuestaCliente[nombre_cliente]
			</td>
			<td>
				<label style="font-size:8.5px; text-align:right; line-height:15px;">
				Forma de pago: $pago
				</label>
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:150px text-aling:right ">
				RFC: $respuestaCliente[rfc]
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:540px">
				Correo: $respuestaCliente[email]
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:540px">
				Teléfono: $respuestaCliente[telefono]
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

	<table style="font-size:8px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid:#666; background-color:white; width: 30px text-aling:center">#</td>
			<td style="border: 1px solid:#666; background-color:white; width: 60px text-aling:center">Código</td>
			<td style="border: 1px solid:#666; background-color:white; width: 70px text-aling:center">Clave Pro</td>
			<td style="border: 1px solid:#666; background-color:white; width: 90px text-aling:center">Descripción</td>
			<td style="border: 1px solid:#666; background-color:white; width: 60px text-aling:center">Unidad de Medida</td>
			<td style="border: 1px solid:#666; background-color:white; width: 40px text-aling:center">Cant.</td>
			<td style="border: 1px solid:#666; background-color:white; width: 70px text-aling:center">Precio Unitario</td>
			<td style="border: 1px solid:#666; background-color:white; width: 60px text-aling:center">Impuesto</td>
			<td style="border: 1px solid:#666; background-color:white; width: 70px text-aling:center">Total</td>
		</tr>
	</table>
EOF;
$pdf->writeHTML($bloque3,false,false,false,false,'');

/* bloque 4 */
$sumImpuesto = 0;
$sumTotal = 0;
foreach ($producto as $key => $item) {
$contador = $key+1;
$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];

$respuestaProducto = ControladorProducto::ctrMostrarProducto($itemProducto,$valorProducto);

$valorcodigo = $respuestaProducto["codigo"];

$valorClave = $respuestaProducto["nuevaclave"];

$valorUnitario = $respuestaProducto["precio_venta"];

$precioSinIva = number_format(($valorUnitario/1.16),2);


//$precioTotalF = number_format($item["total"],2)

$cantProducto = $item["cantidad"];

$precioTotal = number_format(($precioSinIva * $cantProducto),2);

$imp = (float)$precioTotal;
$valorImpuesto = number_format((($imp*0.16)),2);

$bloque4 = <<<EOF

	<table style="font-size:8px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 30px; ">
			$contador
			</td>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 60px; ">
			$valorcodigo
			</td>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 70px; ">
			$valorClave
			</td>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 90px; text-align:center">
				$item[descripcion]
			</td>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 60px; text-align:center">
				H87-pza
			</td>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 40px; text-align:center">
				$item[cantidad]
			</td>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 70px; text-align:center">$
				$precioSinIva
			</td>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 60px; text-align:center">$
				$valorImpuesto
			</td>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 70px; text-align:center">$
				$precioTotal
			</td>
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque4,false,false,false,false,'');
}

/*bloque 5*/

$bloque5 = <<< EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="color:#333; background-color:white; width: 350px; text-align:center"></td>

			<td style="border-bottom: 1px solid:#666; background-color:white; width: 100px; text-align:center"></td>

			<td style="border-bottom: 1px solid:#666; color:#333; background-color:white; width: 100px; text-align:center"></td>
		</tr>

		<tr>
			<td style="border-right: 1px solid:#666; color:#333; background-color:white; width: 350px; text-align:center"></td>

			<td style="border: 1px solid:#666; background-color:white; width: 100px; text-align:center">
				Subtotal:
			</td>
			<td style="border: 1px solid:#666; background-color:white; width: 100px; text-align:center">
				$ $neto
			</td>
		</tr>

		<tr>	
			<td style="border-right: 1px solid:#666; color:#333; background-color:white; width: 350px; text-align:center"></td>

			<td style="border: 1px solid:#666; background-color:white; width: 100px; text-align:center">
				Impuesto:
			</td>
			<td style="border: 1px solid:#666; background-color:white; width: 100px; text-align:center">
				$ $impuesto
			</td>
		</tr>

		<tr>
			<td style="border-right: 1px solid:#666; color:#333; background-color:white; width: 350px; text-align:center"></td>

			<td style="border: 1px solid:#666; background-color:white; width: 100px; text-align:center">
				Total:
			</td>
			<td style="border: 1px solid:#666; background-color:white; width: 100px; text-align:center">
				$ $total
			</td>
		</tr>
	</table>
EOF;

$pdf->writeHTML($bloque5,false,false,false,false,'');



$pdf->Output('factura.php');

	}
}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura->traerImpresion(); 
?>