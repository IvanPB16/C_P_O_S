 <div class="content-wrapper">
   
  <section class="content-header">
     
    <h1>
      
     Administrar Productos
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Productos</li>
    
    </ol>

  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddProducto">
          Agregar productos
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
          
         <thead>
            <th style="width: 10px">#</th>
            <th>Imagen</th>
            <th>Código</th>
            <th>Descripcion</th>
            <th>Categoria</th>
            <th>Stock</th>
            <th>Precio de compra</th>
            <th>Precio de venta</th>
            <th>Agregado</th>
            <th>Acciones</th>
          </thead>
           

        </table>
      </div>

    </div>

  </section>

</div>

<!--=====================================
=            Modal add product            =
======================================-->

<div id="modalAddProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Agregar productos</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">
              <label>Clave del producto:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>
                  <input type="number" class="form-control input-lg" id="nuevoClavePro" name="nuevoClavePro" placeholder="Ingresa clave de producto ej.55151618" required>
                </div>
              </div>
              <label>Categoría:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria"  required>
                    <option value="0">Seleccionar categoria</option>
                    <?php 

                    $item = null;
                    $valor = null;

                    $mostrarCategorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);
                                      
                    foreach ($mostrarCategorias as $key => $value) {
                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                      }            
                    ?>
                  </select>
                </div>
              </div>

              <label>Subcategoría:</label>
              <div class="form-group mostrarSub">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>
                  
                  <select class="form-control input-lg" id="nuevaSubCategoria" name="nuevaSubCategoria">

                  </select>
                </div>
              </div>

              <label>Código del producto:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-code"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Código" id="nuevoCodigo"readonly>
                </div>
              </div>
              
              <label>Descripción de producto:</label>
               <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                  <input type="text" class="form-control input-lg" id="nuevaDescripcion" name="nuevaDescripcion" placeholder="Ingresar descripción" required>
                </div>
              </div>

               <label>Stock</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-check"></i></span>
                  <input type="number" class="form-control input-lg" id="nuevoStock" name="nuevoStock" min="0" placeholder="Cantidad disponible" required>
                </div>
              </div>
  
              <div class="form-group row">
                
                <div class="col-xs-12 col-sm-6">
                  <label>Precio de compra:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                    <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                  <label>Precio de venta:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>
                  </div>

                  <br>

                  <label>Porcentaje</label>
                  <div class="col-xs-6">
                    <div class="form-group">
                      <label>
                        <input type="checkbox" class="minimal porcentaje" checked>Utilizar porcentaje
                      </label>
                    </div>
                  </div>

                  <div class="col-xs-6" style="padding: 0">
                    <div class="input-group">
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="10" required>
                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    </div>
                  </div>
                </div>

              </div>

               <div class="form-group">
                <div class="panel">Subir imagen</div>

                <input type="file" class="nuevaImagen" name="nuevaImagen">
                <p class="help-block">Peso máximo de la imagen 2MB</p>
                
                <img src="vistas/img/productos/default/anonymous.png" alt="" class="img-thumbnail previsualizar" width="100px">

              </div> 


            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar productos</button>
          </div>
        </form>
        <?php 
          $crearProducto = new ControladorProducto();
          $crearProducto -> ctrCrearProducto();
        ?>

    </div>
      
  </div>
</div>


 <!--=====================================
=            Modal edit product            =
====================================== -->
<div id="modalEditProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Editar productos</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">

              <label>Código de producto:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>
                  <input type="number" class="form-control input-lg" id="editarClavePro" name="editarClavePro" required >
                </div>
              </div>

              <label>Categoría:</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                  <select class="form-control input-lg editarS" name="editarCategoria" required >
                    <option id="editarCategoria"></option>
                    <?php 

                    $item = null;
                    $valor = null;

                    $mostrarCategorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);
                                      
                    foreach ($mostrarCategorias as $key => $value) {
                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                      }            
                    ?>
                  </select>
                </div>
              </div>
              <label>Subcategoría</label>
              <div class="form-group mostrarSub">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>
                    <select class="form-control input-lg"  id="editarSubCategoria" name="editarSubCategoria" required>
                    </select>
                </div>
              </div>

              <label>Código</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-code"></i></span>
                  <input type="text" class="form-control input-lg" name="editarCodigo" id="editarCodigo"readonly>
                </div>
              </div>
              
              <label>Descripción del producto</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                  <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>
                </div>
              </div>
                
              <label>Stock</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-check"></i></span>
                  <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                  <label>Precio de compra</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                    <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" step="any"  required>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                  <div class="input-group">
                    <label>Precio de venta</label>
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                    <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" step="any"  required readonly>
                  </div>

                  <br>
                  <label>Porcentanje</label>
                  <div class="col-xs-6">
                    <div class="form-group">
                      <label>
                        <input type="checkbox" class="minimal porcentaje" checked>Utilizar porcentaje
                      </label>
                    </div>
                  </div>

                  <div class="col-xs-6" style="padding: 0">
                    <div class="input-group">
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0"value="10" required>
                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    </div>
                  </div>
                </div>

              </div>

               <div class="form-group">
                <div class="panel">Subir imagen</div>

                <input type="file" class="nuevaImagen" name="editarImagen">

                <p class="help-block">Peso máximo de la imagen 2MB</p>
                
                <img src="vistas/img/productos/default/anonymous.png" alt="" class="img-thumbnail previsualizar" width="100px">

                <input type="hidden" name="imagenActual" id="imagenActual">

              </div> 


            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>
        </form>
        <?php 
          $editarProducto = new ControladorProducto();
          $editarProducto -> ctrEditarProducto();
         ?>

    </div>
      
  </div>
</div>

<!--=====================================
=            Modal add cantidad product =
====================================== -->
<div id="modalCantidadProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">
          <div class="modal-header" style="background: #3c8bdc; color:white;">
            <button type="button" class="close" data-dismiss="modal" >&times;</button>
            <h4 class="modal-title">Agregar más productos</h4>
          </div>

          <div class="modal-body">
            <div class="box-body">  
              <label>Cantidad a agregar</label>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-check"></i></span>
                  <input type="hidden" id="numeroAyuda" name="numeroAyuda" readonly>
                  <input type="number" class="form-control input-lg" id="agregarCantidadStock" min="0" value="0" required>
                  <input type="hidden" id="stockActual"  readonly>
                  <input type="hidden" id="stockFn" name="stockFN" readonly>
                </div>
              </div>

            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
        <?php 
          $agregarCantidadProducto = new ControladorProducto();
          $agregarCantidadProducto -> ctrAddCantidadProducto();
         ?>

    </div>
      
  </div>
</div>

<?php 
  $eliminarProducto = new ControladorProducto();
  $eliminarProducto -> ctrEliminarProducto();
 ?>