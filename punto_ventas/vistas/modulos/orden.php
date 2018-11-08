<div class="content-wrapper">
 
  <section class="content-header">
    
    <h1>
      
     Orden de compra
      <small>Panel de Control</small>
    
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      
      <li class="active">Orden</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="box">
       <div class="box-header with-border">
         <h1 class="box-title">Crear promociones</h1>
       </div>
    </div>
    
  <form role="form" action="post" id="ayuda">
    <div class="box box-success">
     <div class="box-header with-border">
        <h1 class="box-title"></h1>
         <button type="submit" class="btn btn-primary">Imprimir orden</button>
      </div>
     <div class="box-body">
        <div class="row">
            <?php 
            if (isset($_GET["idProveedor"])) {
              $item = "id";
              $valor = $_GET["idProveedor"];

              $mostrar = ControladorProveedor::ctrMostrarProveedor($item,$valor);
                                                  
         echo '<div class="col-xs-6">
            <label>Nombre del proveedor</label>
              <input type="text" class="form-control" value="'.$mostrar["nombre_proveedor"].'" readonly>   
          </div>
          <div class="col-xs-4">
            <label>Productos</label>
              <input type="text-area" class="form-control" name="precio_descuento" value="'.$mostrar["producto"].'">
          </div>
          <div class="col-xs-2">
            <div class="form-group">
                <label>Fecha:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                 <input type="text" class="form-control pull-right" id="dpt" name="daterange"/>
                </div>
              </div>
          </div>
          <div class="col-xs-4">
                <label>Descripción</label>
                  <input type="text" class="form-control" value="'.$mostrar["descripcion"].'" readonly>   
              </div>
              <div class="col-xs-4">
                <label>Correo Electronico</label>
                  <input type="text-area" class="form-control" name="precio_descuento" value="'.$mostrar["correo"].'">
              </div>
              <div class="col-xs-4">
                <label>Teléfono</label>
                  <input type="text-area" class="form-control" name="precio_descuento" value="'.$mostrar["telefono"].'">
              </div>';
            }
          ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 hidden-md hidden-sm hidden-xs center">
        <div class="box-body">
          

        </div>
      </div>
    </div>
  </form> 
  </section>
</div>
