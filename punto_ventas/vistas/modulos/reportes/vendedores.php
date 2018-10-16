<?php 
 
	$item = null;
	$valor = null;

	$ventas = ControladorVentas::ctrMostrarVentas($item,$valor);
	$empleados = ControladorUsuarios::ctrMostrarUsuario($item,$valor);

	$arrayVendedores = array();
	$arrayListaVendedores = array();

	foreach ($ventas as $key => $valueVentas) {

		foreach ($empleados as $key => $valueEmpleados) {

			if ($valueEmpleados["id"] == $valueVentas["id_vendedor"]) {
				/*se capturan los nombre de los empleados vendedores*/
				array_push($arrayVendedores, $valueEmpleados["nombre"]);
				/*Capturamos los nombres y valores*/
				$arrayListaVendedores = array($valueEmpleados["nombre"] => $valueVentas["subtotal"]);

				foreach ($arrayListaVendedores as $key => $value) {
					$sumaTotalxVendedor[$key] += $value;
				}	

			}
			/*ciclo para obtener el neto de cada vendedor*/
		
		}
	}
/*Evitamos repetir nombres*/
$noRepetirNombre = array_unique($arrayVendedores);

?>
<div< class="box box-success">

	<div class="box-header with-border">
		<h3 class="box-title">Vendedores</h3>
	</div>
	<div class="box-body">
		<div class="chart-responsive">
			<div class="chart" id="bar-chart1" style=""></div>
		</div>
	</div>
</div>

<!--char -->

<script>
	var bar = new Morris.Bar({
      element: 'bar-chart1',
      resize: true,
      data: [
      <?php 

      	foreach ($noRepetirNombre as $value) {
       		echo "{y: '".$value."', a: '".$sumaTotalxVendedor[$value]."'},";
       }	 
       ?>    
      ],
      barColors: ['#00a65a'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Ventas'],
      preUnits:'$',
      hideHover: 'auto'
    });
</script>