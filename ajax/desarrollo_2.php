<?php 
  require_once ('../core/init.php');
  header('Access-Control-Allow-Origin: *');

  if (isset($_GET['d'])) {

    $statement = $pdo->prepare("SELECT * FROM desarrollos WHERE  id = '".$_GET['d']."' ");
    $statement->execute();
    $result = $statement->fetch();
    $data = array();
    $output = array();
    $sub_array["id"] = $result["id"];
    $sub_array["idcategoria"] = $result["idcategoria"];
    $sub_array["direccion"]          = $result["direccion"];
    $sub_array["precio_por_metro"]   = $result["precio_por_metro"];
    $sub_array["descripcion"]        = $result["descripcion"];
    $sub_array["latitud"]            = $result["latitud"];
    $sub_array["longitud"]           = $result["longitud"];
    $sub_array["detalle_de_entrega"] = $result["detalle_de_entrega"];
    $sub_array["foto_portada"] = $result["foto_portada"];
    $sub_array["foto_section"] = $result["foto_section"];
    $data[] = $sub_array;
    $output = array(
      "data" =>  $data
    );
    echo json_encode($output);

  }else{

    $output =  array();
    $statement = $pdo->prepare("SELECT * FROM desarrollos ORDER BY id ASC ");
    $statement->execute();
    $result = $statement->fetchAll();
    $data = array();
    $filtered_rows = $statement->rowCount();
    foreach($result as $row){
      $sub_array =  array();
      $sub_array["id"]                 = $row["id"];
      $sub_array["idcategoria"]        = $row["idcategoria"];
      $sub_array["idsubcategoria"]     = $row["idsubcategoria"];
      $sub_array["direccion"]          = $row["direccion"];
      $sub_array["precio_por_metro"]   = $row["precio_por_metro"];
      $sub_array["descripcion"]        = $row["descripcion"];
      $sub_array["latitud"]            = $row["latitud"];
      $sub_array["longitud"]           = $row["longitud"];
      $sub_array["detalle_de_entrega"] = $row["detalle_de_entrega"];
      $sub_array["foto_portada"] = $result["foto_portada"];
      $sub_array["foto_section"] = $result["foto_section"];

      $data[] = $sub_array;
    }
    $output = array(
      "data" =>  $data
    );
    echo json_encode($output);
}

