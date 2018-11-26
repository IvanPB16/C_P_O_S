
 <div class="content-wrapper">
 
  <section class="content-header"> 
    
    <h1>
      
      Crear venta
      
    
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
    </ol>

  </section>
  <?php 
    date_default_timezone_set('America/Mexico_City');
    $fechaActual = date('Y-m-d');
    echo $fechaActual;

    $item = null;
    $valor = null;

    $respues = ControladorPromocion::ctrMostrarPromocion($item,$valor);
    
    if ($respues[0]["fecha_fin"] >= $fechaActual) {
       echo '<input type="hidden" id="fechaFinalPromocion" value="'.$respues[0]["fecha_fin"].'">';
       echo '<input type="hidden" id="fechaFinalPromocion" value="'.$respues[0]["codigo"].'">';
    }
  ?>
    <div class="ValoresPromocion">
      <input type="hidden" id="fechaFinalPromocion" value="<?php echo $respues[0]["fecha_fin"] ?>">     
    </div>
  <section class="content">
    <div class="row">
        <div class="col-lg-5 col-xs-12">
          <div class="box box-success">
            <div class="box header with-border"></div>
              <form role="form" method="post" class="formularioVenta">

                <div class="box-body">
                  <div class="box">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                        <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                     </div>  
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <?php   
                          $item = null;
                          $valor = null;

                          $num_ventas = ControladorVentas::ctrMostrarVentas($item,$valor);

                          if(!$num_ventas){

                          echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="1" readonly>';
                      

                        }else{

                          foreach ($num_ventas as $key => $value) {}

                          $codigo = $value["codigo_venta"] + 1;

                          echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                      

                        }
                         ?>
                      </div>
                    </div>

                    <div class="form-group">
                  
                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        
                        <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                        <?php 
                        $item = null;
                        $valor = null;

                        $listaClientes = ControladorCliente::ctrMostrarCliente($item,$valor);

                        foreach ($listaClientes as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["nombre_cliente"].'</option>';
                        }

                        ?>

                        </select>
                        
                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAddCliente" data-dismiss="modal">Agregar cliente</button></span>
                      
                      </div>
                    
                    </div>

                    <div class="form-group row nuevoProducto">

                    </div>

                    <input type="hidden" id="listaProductos" name="listaProductos">

                    <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                    <hr>

                    <div class="row">
                      <div class="col-xs-8 pull-right">
                        <table class="table">

                          <thead>
                            <tr>
                              <th></th>
                              <th>Total</th>
                            </tr>
                          </thead>

                          <tbody>
                            <tr>
                              <td style="width: 50%">
                                <div class="input-group">

                                  <input type="hidden" class="form-control  input-lg"readonly >

                                  <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>
                                  <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

                                </div>
                              </td>

                              <td style="width: 50%">
                                <div class="input-group">

                                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                  <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0" readonly required>

                                  <input type="hidden" name="totalVenta" id="totalVenta">

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
                            <option value="">Seleccionar</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="TC">Tarjeta Crédito</option>
                            <option value="TD">Tarjeta Débito</option>
                          </select>

                        </div>

                      </div>
                     
                       <div class="cajasMetodoPago">
                   <!--      <div class="col-xs-4"><b>Pago Cliente</b>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                            <input type="text"  class="form-control nuevoValorEfectivo" placeholder="0.00" required>
                          </div>
                        </div>

                        <div class="col-xs-4 capturaCambioEfectivo" style="padding-left:0px"><b>Cambio</b>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                            <input type="text"  class="form-control CambioEfectivo" placeholder="0.00" required readonly>
                          </div>
                        </div> -->
                       </div>
                        <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                    </div>
                    <div style="font-size:20px; text-align:right; line-height:15px;">
                        <label ><b>Calcular cambio</b></label>
                    </div>

                     <br>

                  </div>
           
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>
              </div>
            </form>

            <?php  
            $crearVenta = new ControladorVentas();
            $crearVenta -> ctrCrearVenta();
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

<!--=====================================
=            Modal add user            =
===================== =================-->

<div id="modalAddCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">
          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Agregar Cliente</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="nuevoCliente" name="nuevoCliente" placeholder="Ingresa el nombre del cliente" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="number" min="0" class="form-control input-lg" id="nuevoNumeroCliente" name="nuevoNumeroCliente" required >
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" min="0" class="form-control input-lg" name="nuevoRFC" placeholder="Ingresa el RFC" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresa el Correo electrónico" required>
                </div>
              </div>

              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
              </div>
            </div>
            
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar cliente</button>
          </div>

        </form>
      
        <?php 
          $crearCliente = new ControladorCliente();
          $crearCliente ->  ctrAltaCliente();
         ?>

    </div>
      
  </div>
</div>