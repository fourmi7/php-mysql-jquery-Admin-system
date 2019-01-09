<?php 
  /*ob_start();*/
  if (isset($_POST['newD']) || isset($_POST['savechangeD'])) {
      
    $idcategoria        = $_POST['idcategoria'];
    $idsubcategoria     = $_POST['idsubcategoria'];
    $direccion          = $_POST['direccion'];
    $precio_por_metro   = $_POST['precio_por_metro'];
    $descripcion        = $_POST['descripcion'];
    $latitud            = $_POST['latitud'];
    $longitud           = $_POST['longitud'];
    $detalle_de_entrega = $_POST['detalle_de_entrega'];

    $image_1            = '';
    $image_2           = '';

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

        $image_1 = $_FILES["image_1"]["name"];
        $image_2 = $_FILES["image_2"]["name"];
        $target_img1 = "Fotos/".basename($image_1);
        $target_img2 = "Fotos/".basename($image_2);
        move_uploaded_file($_FILES['image_1']['tmp_name'], $target_img1);
        move_uploaded_file($_FILES['image_2']['tmp_name'], $target_img2);

        $result = $getFromD->registrarDesarrollo($idcategoria, $idsubcategoria, $direccion, $precio_por_metro, $image_1, $image_2, $descripcion, $latitud, $longitud, $detalle_de_entrega);
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

        $image_1 = $_FILES['image_1']['name'];
        $image_2 = $_FILES['image_2']['name'];
        $target_img1  = "Fotos/".basename($image_1);
        $target_img2  = "Fotos/".basename($image_2);
        move_uploaded_file($_FILES['image_1']['tmp_name'], $target_img1);
        move_uploaded_file($_FILES['image_2']['tmp_name'], $target_img2);

        /*var_dump($id);*/
        $response = $getFromD->updateDesarrollo($id, $idcategoria, $idsubcategoria, $direccion, $precio_por_metro, $image_1, $image_2,  $descripcion, $latitud, $longitud, $detalle_de_entrega);

        if ($response == "ok") {
          /*header('Location : account/dashboard?i=Desarrollos&id='.$id  );*/
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
                } 
              );
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
 /*ob_end_flush();*/
?>

<!-- add Especificacion Modal -->
<div class="modal fade" id="newDesarrollo" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content card card-primary">
      <div class="modal-header card-header">
        <h5 class="text-center" >Agregar Desarrollo </h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post"  enctype="multipart/form-data">
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
            <label>Subir Imagen de Portada </label>
            <input type="file" name="image_1" class="form-control" >
          </div><br>
          <div class="col-md-12">
            <label>Subir Imagen de Section </label>
            <input type="file" name="image_2" class="form-control" >
          </div><br>
          <div class="col-md-12">
            <label><b>Breve descripcion*</b> <span class="text-danger">(150 caracteres)</span></label>
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
          <div class="card-footer">
            <button type="submit" name="newD" class="btn btn-block btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div> 
    </div> 
  </div>
</div>

<!-- Edit Especificacion Modal  -->
<div class="modal fade" id="desar-<?php echo $des->id ;?>" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content card card-warning">
      <div class="modal-header card-header">
        <h5 class="text-center" >Editar Desarrollo </h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post"  enctype="multipart/form-data">
          <div class="col-md-12">
            <label><b>Seleccione Categoria </b></label>
            <select class="form-control" name="idcategoria">
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
          <div class="col-md-12">
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
            <label>Subir Imagen de Portada </label>
            <input type="file" name="image_1" value="<?php echo $des->foto_portada ?>" class="form-control">
          </div><br>
          <div class="col-md-12">
            <label>Subir Imagen de Section </label>
            <input type="file" name="image_2" value="<?php echo $des->foto_section ?>" class="form-control">
          </div><br>
          <div class="col-md-12">
             <label><b>Breve descripcion*</b> <span class="text-danger">(150 caracteres)</span></label>
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
          <div class="card-footer">
            <input type="hidden" name="id_des" value="<?php echo $des->id; ?>">
            <button type="submit" name="savechangeD" class="btn btn-block btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div> 
    </div> 
  </div>
</div>
