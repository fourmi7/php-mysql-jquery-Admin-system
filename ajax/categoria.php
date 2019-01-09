<?php 
  require_once ('../core/init.php');
  header('Access-Control-Allow-Origin: *');
  
  $output =  array();
  $statement = $pdo->prepare("SELECT * FROM categorias ORDER BY id ASC ");
  $statement->execute();
  $result = $statement->fetchAll();
  $data = array();
  $filtered_rows = $statement->rowCount();
  foreach($result as $row){
    $sub_array =  array();
    $sub_array["id"]          = $row["id"];
    $sub_array["nombre"]      = $row ["nombre"];
    $sub_array["descripcion"] = $row["descripcion"];

    $data[] = $sub_array;
  }
  $output = array(
    "data" =>  $data
  );
  echo json_encode($output);
  

