<?php 
  require_once ('../core/init.php');
  header('Access-Control-Allow-Origin: *');

  if (isset($_GET['d'])) {

    $output = array();
    $statement = $pdo->prepare("SELECT * FROM caracteristicas WHERE  id_desarrollo = '".$_GET['d']."' ");
    $statement->execute();
    $result = $statement->fetchAll();
    $data = array();

    foreach($result as $row){
      $sub_array =  array();
      $sub_array["id"]            = $row["id"];
      $sub_array["id_desarrollo"] = $row["id_desarrollo"];
      $sub_array["planta"]        = $row["planta"];
      $sub_array["ambiente_1"]    = $row["ambiente_1"];
      $sub_array["ambiente_2"]    = $row["ambiente_2"];
      $sub_array["ambiente_3"]    = $row["ambiente_3"];
      $sub_array["ambiente_4"]    = $row["ambiente_4"];

      $data[] = $sub_array;
    }
    $output = array(
      "data" =>  $data
    );
    echo json_encode($output);
  }

