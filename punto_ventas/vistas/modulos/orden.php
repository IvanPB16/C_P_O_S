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
         <h1 class="box-title">Crear Orden</h1>
       </div>
    </div>
    
  <form role="form" method="post" class="form-orden">
    <div class="box box-success">
     <div class="box-header with-border">
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
            <div class="col-xs-6">
              <label>Productos</label>
                <input type="text-area" class="form-control" value="'.$mostrar["producto"].'" readonly>
            </div>
            <div class="col-xs-4">
                  <label>Descripción</label>
                    <input type="text" class="form-control" value="'.$mostrar["descripcion"].'" readonly>   
                </div>
                <div class="col-xs-4">
                  <label>Correo Electronico</label>
                    <input type="text-area" class="form-control" value="'.$mostrar["correo"].'" readonly>
                </div>
                <div class="col-xs-4">
                  <label>Teléfono</label>
                    <input type="text-area" class="form-control" value="'.$mostrar["telefono"].'" readonly>
                </div>';
              }
            ?>
            <div class="form-group nuevaOrden">
              <div class="row" style="padding:5px 15px">
                <div class="col-xs-5" >Nombre
                  <div class="input-group">
                      <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProductoO" "><i class="fa fa-times"></i></button></span>
                      <input type="text" class="form-control DescripcionProducto" id="nombre" required>
                  </div>
                </div>

<!--                 <div class="col-xs-3 ingresoPrecioU" style="padding-left: 0px">Precio Unitario
                    <div class="input-group">
                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>              
                        <input type="text" value="" class="form-control PrecioProductoU" required>
                    </div>
                </div> -->


                <div class="col-xs-2">Cantidad
                  <input type="number" class="form-control CantidadProducto" min="1" value="1" required>
                </div>             

                <div class="col-xs-5 ingresoPrecioT">Precio Total
                    <div class="input-group">
                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>              
                        <input type="text" class="form-control PrecioProducto"required>
                    </div>
                </div>
              </div>          
            </div>
              <input type="hidden" value="<?php echo $mostrar["id"]; ?>" name="idProveedor">
             <input type="hidden" id="listaOrden" name="listaOrden">
        </div>
      </div>
    </div>
    <div class="box-footer">
        <div class="col-xs-4">Total
            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
            <input type="text input-lg" class="form-control" id="total" name="TotalOrden"  required readonly>
        </div> 
      <button type="submit" class="btn btn-primary pull-right btn-enviar">Guardar Orden</button>
     </div>
  </form>
  <?php   
    $guardarOrden = new ControladorProveedor();
    $guardarOrden -> crearOrden();

   ?>
    <div class="row">
      <div class="col-lg-12 hidden-md hidden-sm hidden-xs center">
        <div class="box">
          <button class="btn btn-primary agregarProducto">Agregar</button>
          <button class="btn btn-warning Validar">Validar</button>
        </div>
      </div>
    </div> 

  </section>
</div>
