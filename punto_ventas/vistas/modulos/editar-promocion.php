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

                  $item = "codigo";
                  $valor = $_GET["codigo"];

                  $Promo = ControladorPromocion::ctrMostrarPromocion($item,$valor);

                 ?>
                  <input type="hidden"  class="form-control input-lg" name="codigoPromocion" value="<?php echo $Promo["codigo"]?>" required readonly>
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

                <div class="form-group row Producto">
                  <?php 
                    $itemPromocion = "codigo";
                    $valorPromocion = $Promo["codigo"];

                    $promocion = ControladorPromocion::ctrMostrarPromocion2($item,$valor);

                    foreach ($promocion as $key => $value) {

                      $itemproducto = "id";
                      $valorproducto = $value["id_producto"];
                      $respuesta = ControladorProducto::ctrMostrarProducto($itemproducto,$valorproducto);
      
                        echo '<div class="row" style="padding:5px 15px">
                              <div class="col-xs-6" style="padding-right:0px">
                                 <div class="input-group">
                                         <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitar" idProducto="'.$respuesta["id"].'"><i class="fa fa-times"></i></button></span>
                                          <input type="text" class="form-control PProducto" idProducto="'.$respuesta["id"].'" name="nuevoProductop[]" value="'.$respuesta["descripcion"].'" readonly required>
                                          <input type=hidden name="idProducto[]" value="'.$respuesta["id"].'">
                                        </div>
                                     </div>
                                  </div>';
                    }
                  ?>

                </div>

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