 <div class="content-wrapper">
 
  <section class="content-header">
    
    <h1>
      
      Editar venta
       
    
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Editar venta</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="row">
        <div class="col-lg-5 col-xs-12">
          <div class="box box-success">
            <div class="box header with-border"></div>
              <form role="form" method="post" class="formularioVenta">

                <div class="box-body">
               
                  <div class="box">

                    <?php     
                        $item = "id";
                        $valor = $_GET["idVenta"];

                        $venta = ControladorVentas::ctrMostrarVentas($item,$valor);
                       $itemVendedor = "id";
                       $valorVendedor = $venta["id_vendedor"];

                       $vendedor = ControladorUsuarios::ctrMostrarUsuario($itemVendedor,$valorVendedor);

                       $porcentajeImpuesto = ($venta["impuesto"] *  100) / $venta["subtotal"];
                    ?>

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"]; ?>" readonly>
                        <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]; ?>">
                     </div>  
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        
                        <input type="text" class="form-control" id="editarVenta" name="editarVenta" value="<?php echo $venta["codigo_venta"]; ?>" readonly>
                      
                      </div>
                    </div>

                    <div class="form-group row nuevoProducto">
                        <?php 
                        $listaProducto = json_decode($venta["producto"],true);
                                                
                        foreach ($listaProducto as $key => $value){
                          $item = "id";
                          $valor = $value["id"];
                          $respuesta = ControladorProducto::ctrMostrarProducto($item,$valor);

                          $stockAntiguo = $respuesta["stock"]+$value["cantidad"];

                          echo '<div class="row" style="padding:5px 15px">
                                     <div class="col-xs-6" style="padding-right:0px">
                                       <div class="input-group">
                                        <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>
                                        <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'"  readonly required>
                                        </div>
                                      </div>

                                      <div class="col-xs-3">
                                          <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>
                                      </div>
                           
                                   <div class="col-xs-3 ingresoPrecio" style="padding-left: 0px">
                                      <div class="input-group">
                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>              
                                            <input type="text" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" value="'.$respuesta["precio_venta"].'" precioReal="'.$value["total"].'" required readonly>
                                      </div>
                                   </div>
                                </div>';
                        }
                        
                         ?>
                    </div>

                    <input type="hidden" id="listaProductos" name="listaProductos">

                    <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                    <hr>

                    <div class="row">
                      <div class="col-xs-8 pull-right">
                        <table class="table">

                          <thead>
                            <tr>
                              <th>Impuesto</th>
                              <th>Total</th>
                            </tr>
                          </thead>

                          <tbody>
                            <tr>
                              <td style="width: 50%">
                                <div class="input-group">

                                  <input type="number" class="form-control  input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta"  value="<?php echo $porcentajeImpuesto; ?>">

                                  <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value="<?php echo $venta["impuesto"]; ?>"required>
                                  <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["subtotal"]; ?>" required>
                                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                </div>
                              </td>

                              <td style="width: 50%">
                                <div class="input-group">

                                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                  <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" value="<?php echo $venta["total"]; ?>" readonly required>

                                  <input type="hidden" name="totalVenta" value="<?php echo $venta["total"]; ?>" id="totalVenta">

                                </div>
                              </td>

                              </tr>

                            </tbody>

                          </table>

                        </div>
                     
                    </div>

                    <hr>

                    <div class="form-group row">
                      <div class="col-xs-6" style="padding-right:0px">

                        <div class="input-group">

                          <select class="form-control" name="nuevoMetodoPago" id="nuevoMetodoPago" required>
                            <option value="">Seleccionar forma de pago</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="TC">Tarjeta Crédito</option>
                            <option value="TD">Tarjeta Débito</option>
                          </select>

                        </div>

                      </div>
                     
                       <div class="cajasMetodoPago">
                         
                       </div>
                        <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                    </div>

                     <br>

                  </div>
           
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>
              </div>
            </form>

           <?php  
            $editarVenta = new ControladorVentas();
            $editarVenta -> ctrEditarVenta();
            ?> 
          </div>
        </div>

        <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
          <div class="box box-warning">
            <div class="box-header">
              
              <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablaVentas">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                </table>
              </div>
            </div>
          
          </div>
        </div>

    </div>
  
    
  </section>

</div>
