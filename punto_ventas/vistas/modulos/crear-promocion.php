<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Promociones
    </h1>
    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Crear promociones</li>
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

                <div class="form-group">
                  <div class="input-group">

                    <div class="col-lg-5">
                      <label>Nombre de promoción:</label>
                      <input type="text" class="form-control" name="nombre_promo" placeholder="Ej. Lista escolar" required>   
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
                        <label>Precio de proción:</label>
                          <input type="number" class="form-control" name="precio_descuento" min="0" step="any" placeholder="$20.00" required>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="form-gruop row Productos">

                </div>

                <?php 
                    $item = null;
                    $valor = null;

                    $num_promocion = ControladorPromocion::ctrMostrarPromocion($item,$valor);

                    if (!$num_promocion) {
                      echo ' <input type="hidden"  class="form-control input-lg" name="codigoPromocion" value="1" required readonly>';
                    }else{
                      foreach ($num_promocion as $key => $value) { }
                        $identificador = $value["codigo"] + 1;
                      echo ' <input type="hidden"  class="form-control input-lg" name="codigoPromocion" value="'.$identificador.'" required readonly>';
                    }
                   ?>

                <input type="hidden" id="productos" name="listproductos">
                <input type="hidden" name="ProductoID" id="ppid">
                
                <button type="button" class="btn btn-default hidden-lg btnAdd">Agregar producto</button>

              </div>
            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Guardar promoción</button>
            </div>

          </form>
          <?php 
            $crearPromocion = new ControladorPromocion();
            $crearPromocion -> ctrCrearPromocion();
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