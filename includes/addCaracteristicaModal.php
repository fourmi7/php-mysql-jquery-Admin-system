<?php 
  // add Caracteristica
  if (isset($_POST['addCaracteristica'])) {
    $id_desarrollo    = $_POST['id_desarrollo'];
    $planta  = $_POST['planta'];
    $ambiente_1     = $_POST['ambiente_1'];
    $ambiente_2     = $_POST['ambiente_2'];
    $ambiente_3     = $_POST['ambiente_3'];
    $ambiente_4     = $_POST['ambiente_4'];

    if (empty($planta)) {
      echo '<script>
          swal({
            title : "¡Error!",
            text: "¡el campo planta no puede estar vacio!",
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
      $planta     = $getFromD->checkInput($planta);
      $ambiente_1 = $getFromD->checkInput($ambiente_1);
      $ambiente_2 = $getFromD->checkInput($ambiente_2);
      $ambiente_3 = $getFromD->checkInput($ambiente_3);
      $ambiente_4 = $getFromD->checkInput($ambiente_4);
    
      $result = $getFromD->addCaracteristica($id_desarrollo, $planta, $ambiente_1, $ambiente_2,  $ambiente_3,  $ambiente_4);
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

<!-- add caracteristicas Modal -->
<div class="modal fade" id="caracteristicas-<?php echo $des->id ;?>" role="dialog" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content card card-primary">
      <div class="modal-header card-header">
        <h5 class="text-center" >Agregar Caracteristica </h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" >
          <div class="form-group">
            <label for="username">Planta <small>(*)</small></label>
            <input type="text" name="planta" class="form-control"  placeholder="planta">
          </div>
          <div class="form-group">
            <label for="email">Ambiente 1 </label>
            <input type="text" name="ambiente_1" class="form-control" placeholder="Ingresar ambiente 1">
          </div>
          <div class="form-group">
            <label for="email">Ambiente 2 </label>
            <input type="text" name="ambiente_2" class="form-control" placeholder="Ingresar ambiente 2">
          </div>
          <div class="form-group">
            <label for="email">Ambiente 3 </label>
            <input type="text" name="ambiente_3" class="form-control" placeholder="Ingresar ambiente 3">
          </div>
          <div class="form-group">
            <label for="email">Ambiente 4</label>
            <input type="text" name="ambiente_4" class="form-control" placeholder="Ingresar ambiente 4">
          </div>
          <div class="form-group">
            <input type="hidden" name="id_desarrollo" value="<?php echo $des->id; ?>" class="form-control">
          </div>
          <div class="card-footer">
            <button type="submit" name="addCaracteristica" class="btn btn-block btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div> 
  </div>
</div>
