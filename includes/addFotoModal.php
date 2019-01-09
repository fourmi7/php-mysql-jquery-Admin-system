<?php 
  // add foto
  if (isset($_POST['addFoto'])) {
    
    $id_desarrollo = $_POST['id_desarrollo'];
    $nombre        = $_POST['nombre'];
    $image         = '';
    /*$new_name      = '';*/

    if (empty($nombre) || $_FILES["file"]["name"] = '') {
      echo '<script>
        swal({
          title : "¡Error!",
          text: "¡el campo nombre no puede estar vacio!",
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
    }else {
      $nombre = $getFromD->checkInput($nombre);
      
      $image = $_FILES['image']['name'];
      $target = "Fotos/".basename($image);
      move_uploaded_file($_FILES['image']['tmp_name'], $target);
        
      /*var_dump($id_desarrollo, $nombre, $image);*/
      $result = $getFromD->addNewFoto($id_desarrollo, $nombre, $image);
      if ($result == "ok") {
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
            text: "¡hubo un error al guardar la foto!",
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
?>

<!-- add foto Modal -->
<div class="modal fade" id="fotos-<?php echo $des->id ;?>" role="dialog" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content card card-primary">
      <div class="modal-header card-header">
        <h5 class="text-center" >Agregar Foto </h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="username">Nombre de la foto <small>(*)</small></label>
            <input type="text" name="nombre" class="form-control"  placeholder="Nombre de la foto">
          </div>
          <div class="form-group">
            <label for="email">Subir Foto </label>
            <input type="file" name="image" class="form-control" >
          </div>
          <div class="card-footer">
            <input type="hidden" name="id_desarrollo" value="<?php echo $des->id; ?>">
            <button type="submit" name="addFoto" class="btn btn-block btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div> 
  </div>
</div>
