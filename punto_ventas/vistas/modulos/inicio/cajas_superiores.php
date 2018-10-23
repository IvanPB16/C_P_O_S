<?php 
 $item = null;
 $valor = null;
 $mostrarVentas = ControladorVentas::ctrsumaTotalVentas();

 $clientes = ControladorCliente::ctrMostrarCliente($item,$valor);
 $totalCliente = count($clientes);

 $productos = ControladorProducto::ctrMostrarProducto($item,$valor);
 $totalProductos = count($productos);

?>
<div class="col-lg-3 col-xs-6"> 
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3>$<?php echo number_format($mostrarVentas["total"],2); ?></h3>
      <p>Ventas</p>
    </div>
    <div class="icon">
      <i class="ion ion-social-usd"></i>
    </div>
    <a href="ventas" class="small-box-footer">Más información<i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</div>
       
<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-green">
    <div class="inner">
        <h3><?php echo number_format($totalProductos); ?></h3>
         <p>Productos</p>
    </div>
    <div class="icon">
      <i class="ion ion-clipboard"></i>
    </div>
      <a href="productos" class="small-box-footer">Más información<i class="fa fa-arrow-circle-right"></i>
      </a>
  </div>
</div>

<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3><?php echo number_format($totalCliente); ?></h3>

      <p>Clientes</p>
    </div>
    <div class="icon">
      <i class="ion ion-person-add"></i>
    </div>
      <a href="usuarios" class="small-box-footer">Más información<i class="fa fa-arrow-circle-right"></i>
      </a>
 </div>
</div>
  
<div class="col-lg-3 col-xs-6">       
  <div class="small-box bg-red">
      <div class="inner">
        <h3><br></h3>

        <p>Reportes</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
        <a href="reporte" class="small-box-footer">Más información<i class="fa fa-arrow-circle-right"></i>
      </a>
  </div>
</div>
