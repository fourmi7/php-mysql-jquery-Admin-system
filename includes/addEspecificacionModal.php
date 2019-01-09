<?php 
  if (isset($_POST['addEspecificacion']) || isset($_POST['editEspecificacion'])) {
    
    $Estar_y_Monoambiente = $_POST['Estar_y_Monoambiente'];
    $banios               = $_POST['banios'];
    $dormitorios          = $_POST['dormitorios'];
    $cocinas              = $_POST['cocinas'];

    if (empty($Estar_y_Monoambiente) ||  empty($banios) ||  empty($dormitorios) ||  empty($cocinas) ) {
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
      $Estar_y_Monoambiente = $getFromD->checkInput($Estar_y_Monoambiente);
      $banios               = $getFromD->checkInput($banios);
      $dormitorios          = $getFromD->checkInput($dormitorios);
      $cocinas              = $getFromD->checkInput($cocinas);

      if (isset($_POST['addEspecificacion'])) {
        $id_desarrollo        = $_POST['id_desarrollo'];
        /*var_dump($id_desarrollo, $Estar_y_Monoambiente, $banios, $dormitorios, $cocinas);*/
        $result = $getFromD->addNewEspecificacion($id_desarrollo, $Estar_y_Monoambiente, $banios, $dormitorios, $cocinas);

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
              }
            );
          </script>';
        }else{
          echo '<script>
            swal({
              title : "¡Error!",
              text: "¡hubo un error al guardar!",
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
      }else if (isset($_POST['editEspecificacion'])) {
        $id_desarrollo    = $_POST['id_desarrollo'];
        /*var_dump($id_desarrollo, $Estar_y_Monoambiente, $banios, $dormitorios, $cocinas);*/
        $result = $getFromD->updateEspecificacion($id_desarrollo, $Estar_y_Monoambiente, $banios, $dormitorios, $cocinas);

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
              }
            );
          </script>';
        }else{
          echo '<script>
            swal({
              title : "¡Error!",
              text: "¡hubo un error al guardar!",
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

<!-- add Especificacion Modal -->
<div class="modal fade" id="esp-<?php echo $des->id ;?>" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content card card-primary">
      <div class="modal-header card-header">
        <h5 class="text-center" >Agregar Especificacion </h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post">
          <div class="col-md-12">
            <label><b>Estar y Monoambiente </b></label>
            <textarea name="Estar_y_Monoambiente" rows="5" class="form-control">
              Agregar Estar y Monoambiente.....
            </textarea>
          </div><br>
          <div class="col-md-12">
            <label><b>Baños </b></label>
            <textarea type="text" name="banios" rows="5" class="form-control">
              Especificaciones para Baños....
            </textarea>
          </div><br>
          <div class="col-md-12">
            <label><b>Dormitorios</b></label>
            <textarea type="text" name="dormitorios" class="form-control text-left" rows="5">
              Especificaciones para Dormitorios.....
            </textarea>
          </div><br>
          <div class="col-md-12">
            <label><b>Cocinas</b></label>
            <textarea type="text" name="cocinas" class="form-control text-left" rows="5">
              Especificaciones para Cocinas....
            </textarea>
          </div><br>
          <div class="card-footer">
            <input type="hidden" name="id_desarrollo" value="<?php echo $des->id; ?>">
            <button type="submit" name="addEspecificacion" class="btn btn-block btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div> 
    </div> 
  </div>
</div>

<!-- Edit Especificacion Modal  -->
<div class="modal fade" id="especificacion-<?php echo $esp->id ;?>" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content card card-warning">
      <div class="modal-header card-header">
        <h5 class="text-center" >Editar Especificacion </h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post">
          <div class="col-md-12">
            <label><b>Estar y Monoambiente </b></label>
            <textarea type="text" name="Estar_y_Monoambiente"  rows="5" class="form-control">
              <?php echo $esp->Estar_y_Monoambiente ?>
            </textarea>
          </div><br>
          <div class="col-md-12">
            <label><b>Baños </b></label>
            <textarea type="text" name="banios"  rows="5" class="form-control">
              <?php echo $esp->banios ?>
            </textarea>
          </div><br>
          <div class="col-md-12">
            <label><b>Dormitorios</b></label>
            <textarea type="text" name="dormitorios"  class="form-control text-left" rows="5">
              <?php echo $esp->dormitorios ?>
            </textarea>
          </div><br>
          <div class="col-md-12">
            <label><b>Cocinas</b></label>
            <textarea type="text" name="cocinas" class="form-control text-left" rows="5">
              <?php echo $esp->cocinas ?>
            </textarea>
          </div><br>
          <div class="card-footer">
            <input type="hidden" name="id_desarrollo" value="<?php echo $esp->id_desarrollo; ?>">
            <button type="submit" name="editEspecificacion" class="btn btn-block btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div> 
    </div> 
  </div>
</div>
