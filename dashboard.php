<?php 
	require_once ('core/init.php');
  
  if (!isset($_SESSION['user_id'])) {
    header('Location:' .BASE_URL);
	}
	if ($getFromU->loggedIn() === true) {
    $user_id       = $_SESSION['user_id'];
    $user          = $getFromU->userData($user_id);
    $users         = $getFromU->selectUsers();
    $roles         = $getFromU->selectRoles();
    $desarrollos   = $getFromD->selectDesarrollos();
    $categorias    = $getFromD->selectCategorias();
    $subcategorias = $getFromD->selectSubcategorias();
  }


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Masea | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/adminlte2.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/img/favicon.png" type="image/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-warning navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo BASE_URL; ?>" class="nav-link">Sistema De Control Masea</a>
      </li>
    </ul>
    <ul class="navbar-nav navbar-right" >
    	<li class="nav-item d-none d-sm-inline-block ">
        <a href="<?php echo BASE_URL; ?>account/setting" class="nav-link ">
         <img src="<?php echo BASE_URL; ?>assets/img/avatar.png" alt="User Avatar" class="img-circle" width="25">
          &nbsp;<?php echo $user->username; ?> 
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block ">
    		<a href="<?php echo BASE_URL; ?>includes/logout.php"  class="nav-link " style="color:blue;">	<i class="fa fa-power-off" ></i> Salir
    		</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <img src="assets/img/logo.png" alt=""> -->
     <a href="<?php echo BASE_URL; ?>" class="brand-link bg-dark" ><span><img src="<?php echo BASE_URL; ?>assets/img/logo3.png" style="margin-left: 40px;" width="40" height=="10"></span>
     </a>
  <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php if (($user->idrole == 1) || ($user->idrole == 2)){ ?>
            <li class="nav-item">
              <a href="?i=Desarrollos" class="nav-link text-white">
                <i class="nav-icon"></i>
                <p>
                  Desarrollos
                  <span class="right badge badge-warning"> <i class="fa fa-eye"></i> </span>
                </p>
              </a>
            </li>
        	<?php } if ($user->idrole == 1) {?>
        		
	          <li class="nav-item has-treeview">
	            <a href="?i=Users" class="nav-link text-white">
	              <i class="nav-icon"></i>
	              <p>
	                Usuarios
	                <span class="right badge badge-success"><i class="fa fa-eye"></i></span>
	              </p>
	            </a>
	          </li>
	          <li class="nav-item has-treeview">
	            <a href="?i=Roles" class="nav-link text-white">
	              <i class="nav-icon"></i>
	              <p>
	                Roles
	                <span class="right badge badge-primary"><i class="fa fa-eye"></i></span>
	              </p>
	            </a>
	          </li>
        	<?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1><?php /*echo $user->name;*/ ?> </h1> -->
          </div>
         

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <?php
            if (isset($_GET['i']) ) {
              include ("includes/userInfo.php");
            }else{
             include ("includes/allDesarrollo.php");
            }
          ?>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
   
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
  <strong>Copyright &copy; 2018 <a href="https://solucionar.com.ar">Masea</a>.</strong> Todos Derechos Reservados.
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<!-- <script src="<?php /*echo BASE_URL;*/ ?>assets/js/adminlte.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script src="<?php /*echo BASE_URL;*/ ?>assets/js/sweetalert2.all.js"></script> -->
</body>
</html>