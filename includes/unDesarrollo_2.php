<?php 

	$id =  $_GET['id'];
	
	$id     = $getFromU->checkInput($id);
	
	$des    = $getFromD->selectDesarrolloById($id);
	$esp    = $getFromD->especificacionById($id);
	$car    = $getFromD->caracteristicaById($id);
	$foto   = $getFromD->fotoById($id);
	$planta = $getFromD->plantaById($id);

   if (isset($_POST['deleteE'])) {
    $especificacion_id = $_POST['especificacion_id'];
    $response = $getFromD->deleteEspecificacion($especificacion_id);
    /*var_dump($especificacion_id);*/
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

  if (isset($_POST['deleteC'])) {
    $caracteristica_id = $_POST['caracteristica_id'];
    $response = $getFromD->deleteCaracteristica($caracteristica_id);
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
  if (isset($_POST['editCaracteristica'])) {
    $caracteristica_id = $_POST['caracteristica_id'];
    $planta            = $_POST['planta'];
    $ambiente_1        = $_POST['ambiente_1'];
    $ambiente_2        = $_POST['ambiente_2'];
    $ambiente_3        = $_POST['ambiente_3'];
    $ambiente_4        = $_POST['ambiente_4'];

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
    }else{
      $planta     = $getFromD->checkInput($planta);
      $ambiente_1 = $getFromD->checkInput($ambiente_1);
      $ambiente_2 = $getFromD->checkInput($ambiente_2);
      $ambiente_3 = $getFromD->checkInput($ambiente_3);
      $ambiente_4 = $getFromD->checkInput($ambiente_4);
      
      $result = $getFromD->updateCaracteristica($caracteristica_id, $planta, $ambiente_1, $ambiente_2,  $ambiente_3,  $ambiente_4);
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
            text: "¡hubo un error al registrar !",
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
  if (isset($_POST['deleteF'])) {
    $foto_id = $_POST['foto_id'];
    $response = $getFromD->deleteFoto($foto_id);
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
          text: "¡Hubo un error al borrar!",
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
  if (isset($_POST['editFoto'])) {

    $foto_id = $_POST['foto_id'];
    $nombre  = $_POST['nombre'];
    $image   = $_FILES['image']['name'];

    if (empty($nombre) || $image = '') {
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
        
      /*var_dump($foto_id, $nombre, $image);*/
      $result = $getFromD->updateFoto($foto_id, $nombre, $image);
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
  if (isset($_POST['deleteP'])) {
    $pdf_id = $_POST['pdf_id'];
    $response = $getFromD->deletePlanta($pdf_id);
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
   if (isset($_POST['editPlanta'])) {

    $pdf_id = $_POST['pdf_id'];
    $nombre = $_POST['nombre'];
    $imagen = $_FILES['imagen']['name'];
    $pdf    = $_FILES['pdf']['name'];

    if (empty($nombre) ) {
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
      
      $imagen        = $_FILES["imagen"]["name"];
      $pdf           = $_FILES["pdf"]["name"];
      $target_img = "Imagen_planta/".basename($imagen);
      $target_pdf = "pdf/".basename($pdf);
      move_uploaded_file($_FILES['imagen']['tmp_name'], $target_img);
      move_uploaded_file($_FILES['pdf']['tmp_name'], $target_pdf);
        
      /*var_dump($foto_id, $nombre, $image);*/
      $result = $getFromD->updatePlanta($pdf_id, $nombre, $imagen, $pdf);
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

if(isset($_GET['d']) ) {
  include ("includes/setDesarrollo.php");
}else{ ?>

  <div class="card card-dark">

      <div class="card-header">
        <h3 class="card-title">Datos del Desarrollo
      	  <!-- <a href="?i=Desarrollos&id=<?php echo $des->id; ?>&d=set">
            <button class="float-right btn btn-warning">Editar <i class="fa fa-pencil"></i></button>
          </a> -->
          <a href="#" data-toggle="modal" class="text-white" data-target="#desar-<?php echo $des->id ; ?>"><button class="float-right btn btn-warning mr-4">Editar Desarrollo&nbsp; <i class="fa fa-pencil"></i></button></a>
        </h3>
        
      </div>

      <!-- /.card-header -->
      <div class="card-body">
        <!-- <?php /*include "addDesarrolloModal.php";*/ ?> -->
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Informmacion</th>
              <th>Datos</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>Direccion</th>
              <td><?php echo $des->direccion ?></td>
            </tr>
            <tr>
              <th>Categoria</th>
              <td>
                <?php 
                  if ($des->idcategoria == 1) {
                    echo "Terminado";
                  }else if ($des->idcategoria == 2) {
                    echo "En Desarrollo";
                  }else if ($des->idcategoria == 3){
                    echo "Proximo Desarrollo";
                  }
                ?> 
              </td>
            </tr>
            <tr>
              <th>Subcategoria</th>
              <td>
                <?php 
                  if ($des->idsubcategoria == 1) {
                    echo "Inicio de Obra";
                  }else if ($des->idsubcategoria == 2) {
                    echo "Estructura Terminada";
                  }else if ($des->idsubcategoria == 3){
                    echo "Terminaciones";
                  }else if ($des->idsubcategoria == 4){
                    echo "";
                  }
                ?> 
              </td>
            </tr>
            <tr>
              <th>Precio por metro Cuadrado</th>
              <td><?php echo $des->precio_por_metro ?></td>
            </tr>
            <tr>
              <th>Breve descripcion</th>
              <td><?php echo $des->descripcion ?></td>
            </tr>
            <tr>
              <th>Latitud </th>
              <td><?php echo $des->latitud ?></td>
            </tr>
            <tr>
              <th>Longitud </th>
              <td><?php echo $des->longitud ?></td>
            </tr>
            <tr>
              <th>Detalle de Entrega  </th>
              <td><?php echo $des->detalle_de_entrega ?></td>
            </tr>
          <tbody>
        </table>
      </div>
    </div>
	 
		<!-- Especificaciones -->
    <div class="card card-dark">
      <div class="card-header">
        <h3 class="card-title">Especificacion del Desarrollos 
          <?php if (empty($esp->id)) {?>
            <a href="#" data-toggle="modal" class="text-white" data-target="#esp-<?php echo $des->id ; ?>"><button class="float-right btn btn-primary">Agregar Especificaciones&nbsp; <i class="fa fa-plus"></i></button></a>
          <?php }else{?>
            <div class="float-right">
              <form action="" method="post">
                <input type="hidden" name="especificacion_id" value="<?php echo $esp->id ; ?>">
                <button class="btn btn-danger" type="submit" name="deleteE">Borrar <i class="fa fa-times"></i></button>
              </form>
            </div>
            <a href="#" data-toggle="modal" class="text-white" data-target="#especificacion-<?php echo $esp->id ; ?>"><button class="float-right btn btn-warning mr-4">Editar Especificaciones&nbsp; <i class="fa fa-pencil"></i></button></a>
         <?php } ?>
      	</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Informacion</th>
            <th>Datos</th>
          </tr>
          </thead>
          <tbody>
          	<?php if ($esp == null) {?>
              <tr>
                <th>Estar y Monoambiente</th>
                <td></td>
              </tr>
              <tr>
                <th>Baños</th>
                <td></td>
              </tr>
              <tr>
                <th>Dormitorios</th>
                <td></td>
              </tr>
              <tr>
                <th>Cocinas </th>
                <td></td>
              </tr>  
            <?php  }else{ ?>
              <tr>
                <th>Estar y Monoambiente</th>
                <td><?php echo $esp->Estar_y_Monoambiente ?></td>
              </tr>
              <tr>
                <th>Baños</th>
                <td><?php echo $esp->banios ?></td>
              </tr>
              <tr>
                <th>Dormitorios</th>
                <td><?php echo $esp->dormitorios ?></td>
              </tr>
              <tr>
                <th>Cocinas </th>
                <td><?php echo $esp->cocinas ?></td>
              </tr>
            <?php } ?>
          <tbody>
        </table>
      </div>
    </div>

    <?php include "addEspecificacionModal.php"; ?>
    
    <!-- Caracteristica -->
    <div class="card card-dark">
      <div class="card-header">
        <h3 class="card-title">Caracteristicas del Desarrollos
        <a href="#" data-toggle="modal" class="text-white" data-target="#caracteristicas-<?php echo $des->id ; ?>"><button class="float-right btn btn-primary">Agregar Caracteristicas&nbsp; <i class="fa fa-plus"></i></button></a>
      </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Planta</th>
            <th>Ambiente 1</th>
            <th>Ambiente 2</th>
            <th>Ambiente 3</th>
            <th>Ambiente 4</th>
            <th>Editar / Borrar</th>
          </tr>
          </thead>
          <tbody>
          	<?php foreach ($car as $c) {?>
          	<tr>
	            <td><?php echo $c->planta ?></td>
	            <td><?php echo $c->ambiente_1 ?></td>
	            <td><?php echo $c->ambiente_2 ?></td>
	            <td><?php echo $c->ambiente_3 ?></td>
	            <td><?php echo $c->ambiente_4 ?></td>
	            <td>
	            	<a href="#" data-toggle="modal"  data-target="#caract-<?php echo $c->id ; ?>"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>
                <div class="float-right">
                  <form action="" method="post">
                    <input type="hidden" name="caracteristica_id" value="<?php echo $c->id ; ?>">
                    <button class="fa fa-times btn btn-danger" type="submit" name="deleteC"></button>
                  </form>
                </div>
	            </td>
          	</tr>
          	
            <!-- add caracteristicas Modal -->
            <div class="modal fade" id="caract-<?php echo $c->id; ?>" role="dialog" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content card card-warning">
                  <div class="modal-header card-header">
                    <h5 class="text-center" >Modificar Caracteristica </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form method="post" >
                      <div class="form-group">
                        <label for="username">Planta <small>(*)</small></label>
                        <input type="text" name="planta" class="form-control"  value="<?php echo $c->planta ?>">
                      </div>
                      <div class="form-group">
                        <label for="email">Ambiente 1 </label>
                        <input type="text" name="ambiente_1" class="form-control" value="<?php echo $c->ambiente_1 ?>">
                      </div>
                      <div class="form-group">
                        <label for="email">Ambiente 2 </label>
                        <input type="text" name="ambiente_2" class="form-control" value="<?php echo $c->ambiente_2 ?>">
                      </div>
                      <div class="form-group">
                        <label for="email">Ambiente 3 </label>
                        <input type="text" name="ambiente_3" class="form-control" value="<?php echo $c->ambiente_3 ?>">
                      </div>
                      <div class="form-group">
                        <label for="email">Ambiente 4</label>
                        <input type="text" name="ambiente_4" class="form-control" value="<?php echo $c->ambiente_4 ?>">
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="caracteristica_id" value="<?php echo $c->id; ?>" class="form-control">
                      </div>
                      <div class="card-footer">
                        <button type="submit" name="editCaracteristica" class="btn btn-block btn-primary">Guardar</button>
                      </div>
                    </form>
                  </div>
                </div> 
              </div>
            </div>
            <?php } ?>
          <tbody>
        </table>
      </div>
    </div>
    <?php include "addCaracteristicaModal.php"; ?>
    <!-- Fotos -->
    <div class="card card-dark">
      <div class="card-header">
        <h3 class="card-title">
        	Fotos del Desarrollos 
          <a href="#" data-toggle="modal" class="text-white" data-target="#fotos-<?php echo $des->id ; ?>"><button class="float-right btn btn-primary">Agregar Fotos&nbsp; <i class="fa fa-plus"></i></button></a>
        </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Nombre de la foto</th>
            <th>Foto</th>
            <th>Editar / Borrar</th>
          </tr>
          </thead>
          <tbody>
          	<?php foreach ($foto as $f) {?>
            	<tr>
  	            <td><?php echo $f->nombre ?></td>
  	            <td><img src="<?php echo BASE_URL.'Fotos/'.$f->foto ?>" class="img-responsive" height="70" width="90"></td>
  	            <td>
  	            	<a href="#" data-toggle="modal"  data-target="#fot-<?php echo $f->id ; ?>"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>
                  <div class="float-right">
                    <form action="" method="post">
                      <input type="hidden" name="foto_id" value="<?php echo $f->id ; ?>">
                      <button class="fa fa-times btn btn-danger" type="submit" name="deleteF"></button>
                    </form>
                  </div>
  	            </td>
            	</tr>
              <!-- edit foto Modal -->
              <div class="modal fade" id="fot-<?php echo $f->id ;?>" role="dialog" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content card card-primary">
                    <div class="modal-header card-header">
                      <h5 class="text-center" >Editar Foto </h5>
                      <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="username">Nombre de la foto <small>(*)</small></label>
                          <input type="text" name="nombre" class="form-control"  value="<?php echo $f->nombre; ?>">
                        </div>
                        <div class="form-group">
                          <label for="email">Subir Foto </label>
                          <input type="file" name="image" class="form-control" >
                          <span><img src="<?php echo BASE_URL.'Fotos/'.$f->foto ?>" class="img-responsive" height="70" width="90"></span>
                        </div>
                        <div class="card-footer">
                          <input type="hidden" name="foto_id" value="<?php echo $f->id; ?>">
                          <button type="submit" name="editFoto" class="btn btn-block btn-primary">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div> 
                </div>
              </div>
          	<?php } ?>
          <tbody>
        </table>
      </div>
    </div>
    <?php include "addFotoModal.php"; ?>
    <!-- Fotos -->
    <div class="card card-dark">
      <div class="card-header">
        <h3 class="card-title">
        	Imagen Planta y Pdf del Desarrollos 
        	<a href="#" data-toggle="modal" class="text-white" data-target="#plantas-<?php echo $des->id ; ?>"><button class="float-right btn btn-primary">Agregar pdf&nbsp; <i class="fa fa-plus"></i></button></a>
        </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Nombre de la planta</th>
            <th>Imagen</th>
            <th>Pdf</th>
            <th>Editar / Borrar</th>
          </tr>
          </thead>
          <tbody>
          	<?php foreach ($planta as $p) {?>
          		
          	<tr>
	            <td><?php echo $p->nombre ?></td>
	            <td><img src="<?php echo BASE_URL.'Imagen_planta/'.$p->imagen ?>" class="img-responsive" height="70" width="90"></td>
	            <td><embed src="<?php echo BASE_URL.'pdf/'.$p->pdf ?>" width="70" height="70" type='application/pdf'></td>
	            <td>
	            	<a href="#" data-toggle="modal"  data-target="#pdfs-<?php echo $p->id ; ?>"><button class="btn btn-warning "><i class="fa fa-pencil"></i></button></a>
                <div class="float-right">
                  <form action="" method="post">
                    <input type="hidden" name="pdf_id" value="<?php echo $p->id ; ?>">
                    <button class="fa fa-times btn btn-danger" type="submit" name="deleteP"></button>
                  </form>
                </div>
	            </td>
          	</tr>

            <!-- add planta Modal -->
            <div class="modal fade" id="pdfs-<?php echo $p->id ;?>" role="dialog" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content card card-primary">
                  <div class="modal-header card-header">
                    <h5 class="text-center" >Editar Imagen de Planta y Pdf </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="username">Nombre de la planta <small>(*)</small></label>
                        <input type="text" name="nombre" class="form-control"  value="<?php echo $p->nombre; ?>">
                      </div>
                      <div class="form-group">
                        <label for="email">Subir Imagen de la planta </label>
                        <input type="file" name="imagen" class="form-control" >
                         <span><img src="<?php echo BASE_URL.'Imagen_planta/'.$p->imagen ?>" class="img-responsive" height="70" width="90"></span>
                      </div>
                      <div class="form-group">
                        <label for="email">Subir Imagen de la planta </label>
                        <input type="file" name="pdf" class="form-control" >
                         <span><embed src="<?php echo BASE_URL.'pdf/'.$p->pdf ?>" width="70" height="70" type='application/pdf'></span>
                      </div>
                      <div class="card-footer">
                        <input type="hidden" name="pdf_id" value="<?php echo $p->id; ?>">
                        <button type="submit" name="editPlanta" class="btn btn-block btn-primary">Guardar</button>
                      </div>
                    </form>
                  </div>
                </div> 
              </div>
            </div>
          	<?php } ?>
          <tbody>
        </table>
      </div>
    </div>
    <?php include "addPlantaModal.php"; ?>
    <?php include "addDesarrolloModal.php"; ?>
<?php } ?>  
