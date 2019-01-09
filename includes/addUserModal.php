<?php 
  // register user
  if (isset($_POST['register'])) {
    $idrole    = $_POST['role'];
    $username      = $_POST['username'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];

    if (empty($idrole) or empty($username) or empty($email) or empty($password)) {
      echo '<script>
              swal({
                title : "¡Error!",
                text: "¡Todo los campos son obligatorios!",
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

      $idrole   = $getFromU->checkInput($idrole);
      $username = $getFromU->checkInput($username);
      $email    = $getFromU->checkInput($email);
      $password = $getFromU->checkInput($password); 
          
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>
              swal({
                title : "¡Error!",
                text: "¡Formato de correo inválido!",
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
        $password = md5($password);
        $result = $getFromU->Register($idrole, $username, $email, $password);
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
  }
?>

<!-- add user Modal -->
<div class="modal fade" id="addUsers" role="dialog" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content card card-warning">
      <div class="modal-header card-header">
        <h5 class="text-center" >Agregar Usuario</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" onsubmit="return addUser()"><!--  -->
          <div class="form-group">
            <label for="username">Seleccione Role<small>(*)</small></label>
            <select name="role" id="role" class="form-control">
              <option value="">seleccione un role</option>
              <?php foreach ($roles as $key) { ?>
                <option value="<?php echo $key->id; ?>"> <?php echo $key->role; ?></option>
              <?php } ?> 
            </select>
          </div> 
          <div class="form-group">
            <label for="username">Nombre Completo<small>(*)</small></label>
            <input type="text" name="username" id="username" class="form-control"  placeholder="Nombre">
          </div>
          <div class="form-group">
            <label for="email">Email <small>(*)</small></label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Ingresar email">
          </div>
          <div class="form-group">
            <label for="password">Contraseña <small>(*)</small></label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
          </div>
          <div class="card-footer">
            <button type="submit" name="register" id="register" class="btn btn-block btn-primary btnRegister">Guardar</button>
          </div>
        </form>
      </div>
    </div> 
  </div>
</div>

<!--End Add User Modal -->
<script type="text/javascript">
  function addUser(){

    /*==================== formate input ====================*/
      $("input").focus(function(){
        $(".text-danger").remove();
      })
    /*==================== validate name ====================*/
    var userName = $("#username").val();
    if (userName != "") {
      var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;
      if (!expresion.test(userName)) {
        $("#username").parent().before('<div class="text text-danger">No se permiten números ni caracteres especiales </div>')
      return false;
      }

    }else{
      $("#username").parent().before('<div class="text text-danger">Este campo es obligatorio </div>')
      return false;
    }

    /*==================== validate email ====================*/
    var userEmail = $("#email").val();
    if (userEmail != "") {
      var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
      if (!expresion.test(userEmail)) {
        $("#email").parent().before('<div class="text text-danger">Email invalido </div>')
      return false;
      }

    }else{
      $("#email").parent().before('<div class="text text-danger">Este campo es obligatorio </div>')
      return false;
    }
    
    /*==================== validate password ====================*/
    var userPassword = $("#password").val();
    if (userPassword != "") {
      var expresion = /^[a-zA-Z0-9]*$/;
      if (!expresion.test(userPassword)) {
        $("#password").parent().before('<div class="text text-danger">No se permiten caracteres especiales </div>')
      return false;
      }

    }else{
      $("#password").parent().before('<div class="text text-danger">Este campo es obligatorio </div>')
      return false;
    }
    
}
</script>
