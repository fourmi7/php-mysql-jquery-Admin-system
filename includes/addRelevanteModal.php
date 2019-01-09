<?php 
  // add Caracteristica
  if (isset($_POST['addRelevante'])) {
    $id_desarrollo    = $_POST['id_desarrollo'];
    $cantidad  = $_POST['cantidad'];
    $descripcion     = $_POST['descripcion'];

    if (empty($cantidad)) {
      echo '<script>
          swal({
            title : "¡Error!",
            text: "¡el campo cantidad no puede estar vacio!",
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
      $cantidad     = $getFromD->checkInput($cantidad);
      $descripcion = $getFromD->checkInput($descripcion);
    
      $result = $getFromD->addRelevante($id_desarrollo, $cantidad, $descripcion);
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
    }
  }
?>

<!-- add relevantes Modal -->
<div class="modal fade" id="relevantes-<?php echo $des->id ;?>" role="dialog" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content card card-primary">
      <div class="modal-header card-header">
        <h5 class="text-center" >Agregar Informacion Principal</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" >
          <div class="form-group">
            <label for="username">Cantidad <small>(*)</small></label>
            <input type="text" name="cantidad" class="form-control"  placeholder="cantidad">
          </div>
          <div class="form-group">
            <label for="email">Descripcion </label>
            <input type="text" name="descripcion" class="form-control" placeholder="Ingresar descripcion">
          </div>
          <div class="form-group">
            <input type="hidden" name="id_desarrollo" value="<?php echo $des->id; ?>" class="form-control">
          </div>
          <div class="card-footer">
            <button type="submit" name="addRelevante" class="btn btn-block btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div> 
  </div>
</div>
