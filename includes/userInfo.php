<?php if ($_GET['i']=='Users' && ($user->idrole == 1)) { 
  /*if ($_SERVER['REQUEST_METHOD'] == 'POST') {*/
    if (isset($_POST['delete'])) {
      $user_id  = $_POST['user_id'];
      if ($_SESSION['user_id'] == $user_id) {
        echo '<script>
          swal({
            title : "¡Error!",
            text: "¡No se puede Borrar este usuario!",
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

        $response = $getFromU->deleteUser($user_id);
        if ($response == "ok") {
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
              text: "¡Hubo un error al borrar este usuario!",
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
  if (isset($_POST['editUser'])) {
    $user_id  = $_POST['user_id'];
    $role     = $_POST['edit_role'];
    $username = $_POST['edit_username'];
    $email    = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    if (empty($email)) {
      echo '<script>
        swal({
          title : "¡Error!",
          text: "¡el campo email no puede estar vacio!",
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
   
      $role     = $getFromU->checkInput($role);
      $username = $getFromU->checkInput($username);
      $email    = $getFromU->checkInput($email);
      $password = $getFromU->checkInput($password); 
      $password = md5($password);
      $response = $getFromU->updateUser($user_id, $role, $username, $email, $password);
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
?>
  <div class="col-sm-6">
    <a href="#addUsers" data-toggle="modal" class="text-white"><button class="btn btn-success "> Agregar Usuario  <i class="fa fa-plus"></i></button></a>
  </div><br>
  <div class="card card-success card-outline">
    <div class="card-header">
      <h3 class="card-title">Datos de Usuarios</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
          <!-- <th>Numero</th> -->
          <th>Cargo</th>
          <th>Nombre</th>
          <th>email</th>
          <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $u) { ?>
            <tr>
              <!-- <td><?php /*echo "#".$u->user_id ;*/ ?> </td> -->
              <td>
                <?php 
                  if ($u->idrole == 1) {
                    echo "Administrador";
                  }else if ($u->idrole == 2) {
                    echo "Empleado";
                  }
                ?> 
              </td>
              <td><?php echo $u->username ; ?> </td>
              <td><?php echo $u->email ; ?> </td>
              <td>
                <a href="#" data-toggle="modal"  data-target="#user-<?php echo $u->user_id ; ?>"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>
                <div class="float-right">
                  <form action="" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $u->user_id ; ?>">
                    <button class="btn btn-danger" type="submit" name="delete">borrar <i class="fa fa-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
            <!-- Description Modal popup -->  
            <div class="modal fade sm" id="user-<?php echo $u->user_id; ?>" tabindex="-1" style="margin-top: 50px;">
              <div class="modal-dialog">
                <div class="modal-content card card-primary">
                  <div class="modal-header card-header" >
                    <h5 class="text-center" >Modificacion de Datos de Usuario</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form method="post" onsubmit="return userInfo()">
                      <div class="form-group">
                        <label for="username">Seleccione Role<small>(*)</small></label>
                        <select name="edit_role" class="form-control">
                          <option value="<?php echo $u->idrole ; ?>"><?php if ($u->idrole == 1){echo "Administrador";}else{echo "Empleado";}?></option>
                          <option value="">seleccionar Role</option>
                          <?php foreach ($roles as $key) { ?>
                            <option value="<?php echo $key->id; ?>"> <?php echo $key->role; ?></option>
                          <?php } ?> 
                        </select>
                      </div> 
                        <div class="form-group">
                          <input type="hidden" name="user_id" value="<?php echo $u->user_id ; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="username">Nombre Completo<small>(*)</small></label>
                          <input type="text" name="edit_username" class="form-control" value="<?php echo $u->username ; ?>">
                        </div>
                        <div class="form-group">
                          <label for="email">Email <small>(*)</small></label>
                          <input type="email" name="edit_email" class="form-control" placeholder="ingresar email" value="<?php echo $u->email ; ?>">
                        </div>
                        <div class="form-group">
                          <label for="password">Contraseña <small>(*)</small></label>
                          <input type="password" name="edit_password" class="form-control" placeholder="contraseña nueva">
                        </div>
                      <div class="card-footer">
                        <button type="submit" name="editUser" class="btn btn-block btn-warning ">Guardar Cambio</button>
                      </div>
                    </form>
                  </div>
                </div> 
              </div>
            <!-- End of Description Modal popup -->
          <?php } ?>
        <tbody>
      </table>
    </div>
  </div>
  
<!-- modal de editar usuario -->

<?php 
  include "addUserModal.php";

/*if(isset($_GET['u'])){
  include("editUser.php");
}*/

}else if ($_GET['i']=='Roles' && ($user->idrole == 1)) { ?>

  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Roles de Usuarios</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>Roles</th>
          <th>Descripcion</th>
        </tr>
        </thead>
        <tbody>
          <?php foreach ($roles as $r) { ?>
            <tr>
              <td><?php echo $r->role ; ?> </td>
              <td><?php echo $r->descripcion ; ?> </td>
            </tr>
          <?php } ?>
        <tbody>
      </table>
    </div>
  </div>
<?php }else if ($_GET['i']=='Desarrollos') { 
    if(isset($_GET['id']) && !empty($_GET['id']) ) {
      include ("includes/unDesarrollo.php");
    }else if(isset($_GET['d']) && !empty($_GET['d']) ) {
      include ("includes/setDesarrollo.php");
    }else{ 
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
                        <button type="submit" class="btn btn-danger" name="deleteD">borrar <i class="fa fa-trash"></i></button> 
                      </form>
                   </td>
                </tr>
              <?php } ?>
            <tbody>
          </table>
        </div>
      </div>
  <?php } } else { ?>

    <div class="col-sm-6">
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
          <th>Numero</th>
          <th>Categoria</th>
          <th>Direccion</th>
          <th>Subcategoria</th>
        </tr>
        </thead>
        <tbody>
          <?php foreach ($desarrollos as $d) { ?>
            <tr>
              <td>
                <button class="btn btn-info fa fa-eye"> Ver</button>
              </td>
              <td>
                <?php echo "#".$d->id; ?></td>
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
                    echo "Terminado";
                  }else if ($d->idsubcategoria == 2) {
                    echo "En Desarrollo";
                  }else if ($d->idsubcategoria == 3){
                    echo "Proximo Desarrollo";
                  }else if ($d->idsubcategoria == 4){
                    echo "";                    
                  }
                ?> 
            </tr>
          <?php } ?>
        <tbody>
      </table>
    </div>
  </div>
<?php  }?>