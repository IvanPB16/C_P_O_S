 <div class="content-wrapper">
 
  <section class="content-header"> 
    
    <h1>
      
      Crear venta
      
    
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
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
