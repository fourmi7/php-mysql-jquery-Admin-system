<?php 
  if (isset($_POST['newD']) || isset($_POST['savechangeD'])) {
      
    $idcategoria        = $_POST['idcategoria'];
    $idsubcategoria     = $_POST['idsubcategoria'];
    $direccion          = $_POST['direccion'];
    $precio_por_metro   = $_POST['precio_por_metro'];
    $descripcion        = $_POST['descripcion'];
    $latitud            = $_POST['latitud'];
    $longitud           = $_POST['longitud'];
    $detalle_de_entrega = $_POST['detalle_de_entrega'];

    if (empty($idsubcategoria)) {
      $idsubcategoria = 4;
    }

    if (empty($idcategoria) ||  empty($direccion) ||  empty($precio_por_metro) ||  empty($descripcion) ||  empty($latitud) ||  empty($longitud) ||  empty($detalle_de_entrega)) {
      echo '<script>
          swal({
            title : "¡Error!",
            text: "¡Todos los campos son obligatorios!",
            type: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            },
            function(isConfirm){
              if(isConfirm){
                history.back();
              }
            }
          );
        </script>';
    }else{
      $idcategoria        = $getFromD->checkInput($idcategoria);
      $idsubcategoria     = $getFromD->checkInput($idsubcategoria);
      $direccion          = $getFromD->checkInput($direccion);
      $precio_por_metro   = $getFromD->checkInput($precio_por_metro);
      $descripcion        = $getFromD->checkInput($descripcion);
      $latitud            = $getFromD->checkInput($latitud);
      $longitud           = $getFromD->checkInput($longitud);
      $detalle_de_entrega = $getFromD->checkInput($detalle_de_entrega);

      if (isset($_POST['newD'])) {
        $result = $getFromD->registrarDesarrollo($idcategoria, $idsubcategoria, $direccion, $precio_por_metro, $descripcion, $latitud, $longitud, $detalle_de_entrega);
        $Myid = $_SESSION['desarrollo_id'];

        if ($Myid > 0) { 
          echo '<script>
            swal({
              title : "¡Ok!",
              text: "¡Se registro con exito, Ahora agregar las especificaciones !",
              type:"success",
              confirmButtonText:"Cerrar",
              closeOnConfirm: false
              },
              function(isConfirm){
                if(isConfirm){
                  location.href = "http://localhost/aamasea/account/dashboard?i=Desarrollos&id='.$Myid.'"; 
                }
              }
            );
          </script>';
        }else{
          echo '<script>
            swal({
              title : "¡Error!",
              text: "¡hubo un error al registrar el usuario!",
              type: "error",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
              },
              function(isConfirm){
                if(isConfirm){
                  history.back();
                }
              }
            );
          </script>';
        }
      }else if (isset($_POST['savechangeD'])) {
        $id   = $_POST['id_des'];
        /*var_dump($id);*/
        $response = $getFromD->updateDesarrollo($id, $idcategoria, $idsubcategoria, $direccion, $precio_por_metro, $descripcion, $latitud, $longitud, $detalle_de_entrega);

        if ($response == "ok") {
          echo '<script>
              swal({
                title : "¡Ok!",
                text: "¡Se registro con exito!",
                type:"success",
                confirmButtonText:"Cerrar",
                closeOnConfirm: false
                },
                function(isConfirm){
                  if(isConfirm){
                    history.back();
                }
              });
            </script>';
        }else{
          echo '<script>
          swal({
            title : "¡Error!",
            text: "¡Hubo un error al actualizar los datos!",
            type: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            },
            function(isConfirm){
              if(isConfirm){
                history.back();
              }
            }
          );
        </script>';
        }
      }
    }
  }  
?>

<?php if ($_GET['d'] == "set") {?>
<div class="card card-dark">
	<div class="card-header">
      <h3 class="card-title">Editar Desarrollo </h3>
    </div>
      <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover">
        <tbody>
          <form action="" method="post">
            <div class="col-md-12">
              <label><b>Seleccione Categoria </b></label>
              <select class="form-control" name="idcategoria" data-id="idcategoria">
                <option value="<?php echo $des->idcategoria ?>">
                  <?php 
                    if ($des->idcategoria == 1) {
                      echo "Terminado";
                    }else if ($des->idcategoria == 2) {
                      echo "En Desarrollo";
                    }else if ($des->idcategoria == 3){
                      echo "Proximo Desarrollo";
                    }
                  ?>
                </option>
                <option value="" class="text-danger">Seleccione una categoria</option>
                <?php foreach ($categorias as $cat) { ?>
                  <option value="<?php echo $cat->id ?>" ><?php echo $cat->nombre ?></option>
                <?php } ?>
              </select>
            </div><br>
            <div class="col-md-12" id="subcategoria">
              <label><b>Seleccione Subcategoria </b></label>
              <select class="form-control" name="idsubcategoria">
                <option value="<?php echo $des->idsubcategoria ?>">
                  <?php 
                    if ($des->idsubcategoria == 1) {
                      echo "Inicio de Obra";
                    }else if ($des->idsubcategoria == 2) {
                      echo "Estructura Terminada";
                    }else if ($des->idsubcategoria == 3){
                      echo "Terminaciones";
                    }
                  ?>
                </option>
                <option value="" class="text-danger">Seleccione una subcategoria</option>
                <?php foreach ($subcategorias as $subcat) { ?>
                  <option value="<?php echo $subcat->id ?>" ><?php echo $subcat->nombre ?></option>
                <?php } ?>
              </select>
            </div><br>
            <div class="col-md-12">
              <label><b>Direccion de Desarrollo </b></label>
              <input type="text" name="direccion" value="<?php echo $des->direccion ?>" class="form-control">
            </div><br>
            <div class="col-md-12">
              <label><b>Precio por metro Cuadrado </b></label>
              <input type="text" name="precio_por_metro" value="<?php echo $des->precio_por_metro ?>" class="form-control">
            </div><br>
            <div class="col-md-12">
              <label><b>Breve descripcion</b></label>
              <textarea type="text" name="descripcion"  class="form-control text-left" rows="2">
                <?php echo $des->descripcion ?>
              </textarea>
            </div><br>
            <div class="col-md-12">
              <label><b>Latitud</b></label>
              <input type="text" name="latitud" value="<?php echo $des->latitud ?>" class="form-control">
            </div><br>
            <div class="col-md-12">
              <label><b>Longitud</b></label>
              <input type="text" name="longitud" value="<?php echo $des->longitud ?>" class="form-control">
            </div><br>
            <div class="col-md-12">
              <label><b>Detalle de Entrega</b></label>
              <textarea type="text" name="detalle_de_entrega" value="<?php echo $des->detalle_de_entrega ?>" rows="10" class="form-control">
                <?php echo $des->detalle_de_entrega ?>
              </textarea>
            </div><br>
            <div class="row">
              <div class="col-md-12 btn-group justify-content-center">
                <!-- Button to save change -->
                <div class="col-md-4">
                  <input type="hidden" name="id_des" value="<?php echo $des->id; ?>">
                  <button type="submit" name="savechangeD" class="btn btn-primary btn-block">
                     Guardar Cambio
                  </button>
                </div>
                <!-- button to cancel change -->
                <div class="col-md-4">
                  <a href="?i=Desarrollos&id=<?php echo $des->id; ?>"><button type="button" class="btn btn-danger btn-block">Cancelar</button></a>
                </div>
              </div><br>
            </div>
          </form>
        <tbody>
      </table>
    </div>
  </div>
<?php }else if ( $_GET['d'] == "new" ) {?>
  
  <div class="card card-dark">
  <div class="card-header">
      <h3 class="card-title">Nuevo Desarrollo </h3>
    </div>
      <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover">
        <tbody>
          <form action="" method="post">
            <div class="col-md-12">
              <label><b>Seleccione Categoria </b></label>
              <select class="form-control" name="idcategoria">
                <option value="" class="text-danger">Seleccione una categoria</option>
                <?php foreach ($categorias as $cat) { ?>
                  <option value="<?php echo $cat->id ?>" ><?php echo $cat->nombre ?></option>
                <?php } ?>
              </select>
            </div><br>
            <div class="col-md-12">
              <label><b>Seleccione Subcategoria </b></label>
              <select class="form-control" name="idsubcategoria">
                <option value="" class="text-danger">Seleccione una subcategoria</option>
                <?php foreach ($subcategorias as $subcat) { ?>
                  <option value="<?php echo $subcat->id ?>" ><?php echo $subcat->nombre ?></option>
                <?php } ?>
              </select>
            </div><br>
            <div class="col-md-12">
              <label><b>Direccion de Desarrollo </b></label>
              <input type="text" name="direccion" placeholder="Direccion del desarrollo" class="form-control">
            </div><br>
            <div class="col-md-12">
              <label><b>Precio por metro Cuadrado </b></label>
              <input type="text" name="precio_por_metro"  placeholder="Precio por metro Cuadrado" class="form-control">
            </div><br>
            <div class="col-md-12">
              <label><b>Breve descripcion</b></label>
              <textarea type="text" name="descripcion"  class="form-control text-left" rows="2">
                Breve descripcion
              </textarea>
            </div><br>
            <div class="col-md-12">
              <label><b>Latitud</b></label>
              <input type="text" name="latitud" placeholder="Latitud" class="form-control">
            </div><br>
            <div class="col-md-12">
              <label><b>Longitud</b></label>
              <input type="text" name="longitud" placeholder="Longitud" class="form-control">
            </div><br>
            <div class="col-md-12">
              <label><b>Detalle de Entrega</b></label>
              <textarea type="text" name="detalle_de_entrega" placeholder="<?php echo $des->detalle_de_entrega ?>" rows="10" class="form-control">
                Detalle de Entrega
              </textarea>
            </div><br>
            <div class="row">
              <div class="col-md-12 btn-group justify-content-center">
                <!-- Button to save change -->
                <div class="col-md-4">
                  <button type="submit" name="newD" class="btn btn-primary btn-block">
                     Guardar Cambio
                  </button>
                </div>
                <!-- button to cancel change -->
                <div class="col-md-4">
                  <a href="?i=Desarrollos"><button type="button" class="btn btn-danger btn-block">Cancelar</button></a>
                </div>
              </div><br>
            </div>
          </form>
        <tbody>
      </table>
    </div>
  </div>
<?php } ?>