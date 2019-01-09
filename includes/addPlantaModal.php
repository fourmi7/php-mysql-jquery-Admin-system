<?php 
  // add foto
  if (isset($_POST['addPlanta'])) {
    
    $id_desarrollo = $_POST['id_desarrollo'];
    $nombre        = $_POST['nombre'];
    $imagen        = $_FILES["imagen"]["name"];
    /*$pdf           = $_FILES["pdf"]["name"];*/

    if (empty($nombre) || $imagen = '' || $pdf = '') {
      echo '<script>
        swal({
          title : "¡Error!",
          text: "¡todos los campos obligatorios!",
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
      
      $imagen        = $_FILES["imagen"]["name"];
      $pdf           = $_FILES["pdf"]["name"];
      $target_img = "Imagen_planta/".basename($imagen);
      $target_pdf = "pdf/".basename($pdf);
      move_uploaded_file($_FILES['imagen']['tmp_name'], $target_img);
      move_uploaded_file($_FILES['pdf']['tmp_name'], $target_pdf);
        
      /*var_dump($id_desarrollo, $nombre, $imagen, $pdf);*/
      $result = $getFromD->addNewPlanta($id_desarrollo, $nombre, $imagen, $pdf);
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
<div class="modal fade" id="plantas-<?php echo $des->id ;?>" role="dialog" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content card card-primary">
      <div class="modal-header card-header">
        <h5 class="text-center" >Agregar Imagen de Planta y Pdf </h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="username">Nombre de la planta <small>(*)</small></label>
            <input type="text" name="nombre" class="form-control"  placeholder="Nombre de la foto">
          </div>
          <div class="form-group">
            <label for="email">Subir Imagen de la planta </label>
            <input type="file" name="imagen" class="form-control" >
          </div>
          <div class="form-group">
            <label for="email">Subir Pdf de la planta </label>
            <input type="file" name="pdf" class="form-control" >
          </div>
          <div class="card-footer">
            <input type="hidden" name="id_desarrollo" value="<?php echo $des->id; ?>">
            <button type="submit" name="addPlanta" class="btn btn-block btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div> 
  </div>
</div>
