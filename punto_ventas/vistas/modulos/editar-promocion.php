<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Promociones
    </h1>
    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Editar promoción</li>
    </ol>
  </section>
 <section class="content">
  <div class="row">
    <div class="col-lg-5 col-xs-12">
      <div class="box box-success">
        <div class="box header with-border">
          <form role="form" method="post" class="form_promocion" >
            <div class="box-body">
              <div class="box">
                <?php 

                  $item = "id_promocion";
                  $valor = $_GET["idPromo"];

                  $Promo = ControladorPromocion::ctrMostrarPromocion($item,$valor);
                 ?>

                <div class="form-group">
                  <div class="input-group">

                    <div class="col-lg-5">
                      <label>Nombre de promoción</label>
                      <input type="text" class="form-control" name="editarNombrePromo" value="<?php echo $Promo["nombre_promocion"]?>" required>   
                    </div>

                    <div class="col-lg-5">
                      <label>Fecha:</label>
                      <i class="fa fa-calendar"></i>
                      <input type="text" class="form-control pull-right" id="reservation" name="daterange" required />
                      <input id="promof_uno" type="hidden" name="fechaUno">
                      <input id="promof_dos" type="hidden" name="fechaDos">
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-5 col-xs-12">
                    <div class="form-group">
                      <div class="input-group">
                        <label>Precio de proción</label>
                          <input type="number" class="form-control" name="precio_descuento" min="0" step="any" value="<?php echo $Promo["precio_promocion"]?>" required>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="form-gruop row Productos">

                  <?php 

                    $productoPromo = json_decode($Promo["productos"],true);

                    foreach ($productoPromo as $key => $value) {
                    $item = "id";
                    $valor = $value["id"];

                    $respuesta = ControladorProducto::ctrMostrarProducto($item,$valor);

                       echo '<div class="row" style="padding:5px 15px">
                            <div class="col-xs-6" style="padding-right:0px">
                               <div class="input-group">
                                       <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitar" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>
                                        <input type="text" class="form-control PProducto" idProducto="'.$value["id"].'" name="nuevoProductop" value="'.$value["descripcion"].'" readonly required>
                                      </div>
                                   </div>
                                </div>';
                    }

                  ?>

                </div>

                <input type="hidden" id="productos" name="listproductos">

                <button type="button" class="btn btn-default hidden-lg btnAdd">Agregar producto</button>

              </div>
            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>
            </div>

          </form>
          <?php 
          $editar = new ControladorPromocion();
          $editar -> ctrEditarPromocion();

           ?>
        </div>
      </div>
    </div>
     

    <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
      <div class="box box-info">
        <div class="box-header">

          <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive dtPromocion">
              <thead>
                <tr>
                  <th style="width: 10px">Código</th>
                  <th>Descripción</th>
                  <th></th>
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