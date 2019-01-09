<?php 
  require_once ('core/init.php');
  if (isset($_SESSION['user_id'])) {
      header('Location:' .BASE_URL.'dashboard.php');
  }

  //login user
  if (isset($_POST['login']))
  {
    $email    = $_POST['email'];
    $password = $_POST['password'];
    
    $error = '';
    if (empty($email) or empty($password)) 
    {
      $error ='email o password vacio';
    }else{
      $email       = $getFromU->checkInput($email);
      $password    = $getFromU->checkInput($password);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
      {
        $error = 'Formato de correo inválido';
      }else{
        if ($getFromU->Login($email, $password) === false) {
          $error = "correo o contraseña incorrecta!";
        }
        if ($getFromU->loggedIn() === true) {
          $user_id = $_SESSION['user_id'];
          header('Location:' .BASE_URL.'account/dashboard');
        }
      }
    }
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/estilos.css">
  <link rel="stylesheet" href="assets/css/fonts.css">
</head>

<body>
  <div class="principal">
    <div class="container-fluid">
      <div class="row">
        <div class="col col-6 col-izquierda">
          <div class="formulario">
            <form method="post" id="form-sc">
              <div class="form-group">
                <div class="col-12">
                  <h5><strong>Panel Autoadministrable.</strong></h5>
                  <p class="form-text">Por favor, ingrese la siguiente información:</p>
                </div>
                <div class="col-12">
                  <input type="email" class="form-control" name="email" id="correo" aria-describedby="emailHelp"
                    placeholder="E-mail" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                </div>
                <!-- <p class="login-box-msg">Ingresar </p> -->
                <?php if (isset($error)) {echo ' <br><p class="alert alert-danger text-center" >'.$error.'</p> '; } ?>
                <div class="col-12 col-md-12">
                  <button type="submit" class="btn btn-block btn-warning" name="login"><strong>ACCEDER</strong></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col col-6 bg-dark">
          <img src="assets/img/logo-symbol.png" alt="" style="margin-top:300px;margin-left: 200px;width:200px;">
        </div>
      </div>
    </div>
  </div>
</body>

</html>