<?php 
  require_once ('../core/init.php');
  header('Access-Control-Allow-Origin: *');

  if (isset($_GET['d'])) {

    $output = array();
    $statement = $pdo->prepare("SELECT * FROM relevantes WHERE  id_desarrollo = '".$_GET['d']."' ");
    $statement->execute();
    $result = $statement->fetchAll();
    $data = array();

    foreach($result as $row){
      $sub_array =  array();
      $sub_array["id"]            = $row["id"];
      $sub_array["id_desarrollo"] = $row["id_desarrollo"];
      $sub_array["cantidad"]        = $row["cantidad"];
      $sub_array["descripcion"]    = $row["descripcion"];

      $data[] = $sub_array;
    }
    $output = array(
      "data" =>  $data
    );
    echo json_encode($output);
  }

