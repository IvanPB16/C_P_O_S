<?php

require_once"../../../controladores/proveedores.controlador.php";

require_once"../../../modelos/proveedores.modelo.php";



class imprimirFactura{
	public $OrdenId;


	public function traerImpresion(){

		//traer informacion orden
		$itemOrden = "id";
		$valorOrden = $this->OrdenId;

		$respuestaOrden = ControladorProveedor::ctrMostrarOrden($itemOrden,$valorOrden);

		$fecha = substr($respuestaOrden["fecha"], 0,-8);
		$producto = json_decode($respuestaOrden["productos"],true);
		$total = $respuestaOrden["total"];

		//trae información del proveedor
		$itemProveedor = "id";
		$valorProveedor = $respuestaOrden["id_proveedor"];

		$respuestaProveedor = ControladorProveedor::ctrMostrarProveedor($itemProveedor,$valorProveedor);

//requerimos la clase tcpdf
require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);

$pdf->startPageGroup();

$pdf->AddPage();
/* primero bloque */

$bloque1 = <<<EOF
	<table>
		<tr>
			<td style="width:150px"><img src="images/logo.jpg"></td>
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
					Orden de compra N.
					<br>$valorOrden<br>	
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
				Proveedor: $respuestaProveedor[nombre_proveedor]
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:150px text-aling:right ">
				Descripción: $respuestaProveedor[descripcion]
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:540px">
				Correo: $respuestaProveedor[correo]
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:540px">
				Teléfono: $respuestaProveedor[telefono]
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
			<td style="border: 1px solid:#666; background-color:white; width: 50px text-aling:center">#</td>
			<td style="border: 1px solid:#666; background-color:white; width: 350px text-aling:center">Descripción</td>
			<td style="border: 1px solid:#666; background-color:white; width: 50px text-aling:center">Cant.</td>
			<td style="border: 1px solid:#666; background-color:white; width: 50px text-aling:center">Precio</td>
		</tr>
	</table>
EOF;
$pdf->writeHTML($bloque3,false,false,false,false,'');

/* bloque 4 */
foreach ($producto as $key => $item) {
$contador = $key+1;

$bloque4 = <<<EOF

	<table style="font-size:8px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 50px; ">
			$contador
			</td>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 350px; text-align:center">
				$item[descripcion]
			</td>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 50px; text-align:center">
				$item[cantidad]
			</td>
			<td style="border: 1px solid:#666; color: #333; background-color:white; width: 50px; text-align:center">$
				$item[precio]
			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque4,false,false,false,false,'');
}

$bloque5 = <<< EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="color:#333; background-color:white; width: 300px; text-align:center"></td>

			<td style="border-bottom: 1px solid:#666; background-color:white; width: 100px; text-align:center"></td>

			<td style="border-bottom: 1px solid:#666; color:#333; background-color:white; width: 100px; text-align:center"></td>
		</tr>

		<tr>
			<td style="border-right: 1px solid:#666; color:#333; background-color:white; width: 300px; text-align:center"></td>

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


$pdf->Output('imporden.php');

	}
}

$factura = new imprimirFactura();
$factura -> OrdenId = $_GET["OrdenId"];
$factura->traerImpresion(); 
?>