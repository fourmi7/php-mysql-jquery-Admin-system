<?php 
  if (isset($_POST['deleteD'])) {
    
    $d_id = $_POST['d_id'];
    $responseE = $getFromD->deleteEspecificacionD($d_id);
    $responseC = $getFromD->deleteCaracteristicaD($d_id);
    $responseF = $getFromD->deleteFotoD($d_id);
    $responseP = $getFromD->deletePlantaD($d_id);

    $responseD = $getFromD->deleteDesarrollo($d_id);
    if ( $responseD == "ok" ) {
      echo '<script>
        swal({
          title : "¡Ok!",
          text: "¡Se Borro con exito!",
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
          text: "¡Hubo un error al borrar !",
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
?>
<div class="col-sm-6">
  <!-- <a href="#" data-toggle="modal" data-target="#newDesarrollo"><button class="btn btn-primary "> Nuevo Desarrollo <i class="fa fa-plus"></i></button>
  </a> --> 
  <a href="<?php echo BASE_URL.'account/dashboard?i=Desarrollos&d=new'; ?>"><button class="btn btn-primary "> Nuevo Desarrollo <i class="fa fa-plus"></i></button>
  </a>
</div><br>
<div class="card card-warning card-outline">
  <div class="card-header">
    <h3 class="card-title">Datos de los Desarrollos</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>Opciones</th>
        <th>Categoria</th>
        <th>Direccion</th>
        <th>Subcategoria</th>
        <th>Borrar</th>
      </tr>
      </thead>
      <tbody>
        <?php foreach ($desarrollos as $d) { ?>
          <tr>
            <td>
              <!-- <a href="<?php /*echo BASE_URL.'desarrollo/?id='. $d->id;*/ ?>"><button class="btn btn-info fa fa-eye"> Ver</button></a> -->
              <a href="?i=Desarrollos&id=<?php echo $d->id; ?>"><button class="btn btn-success fa fa-eye"> Ver</button></a>
            </td>
            <td>
              <?php 
                if ($d->idcategoria == 1) {
                  echo "Terminado";
                }else if ($d->idcategoria == 2) {
                  echo "En Desarrollo";
                }else if ($d->idcategoria == 3){
                  echo "Proximo Desarrollo";
                }
              ?> 
            </td>
            <td><?php echo $d->direccion ; ?> </td>
            <td>
              <?php 
                if ($d->idsubcategoria == 1) {
                  echo "Inicio de Obra";
                }else if ($d->idsubcategoria == 2) {
                  echo "Estructura Terminada";
                }else if ($d->idsubcategoria == 3){
                  echo "Terminaciones";
                }else if ($d->idsubcategoria == 4){
                  echo "";                    
                }
              ?> 
              </td>
              <td>
                <form action="" method="post">
                  <input type="hidden" name="d_id" value="<?php echo $d->id; ?>">
                  <button type="submit" class="btn btn-danger" name="deleteD">borrar</button> 
                </form>
             </td>
          </tr>
        <?php } ?>
      <tbody>
    </table>
  </div>
</div>

<?php include "addDesarrolloModal.php"; ?>