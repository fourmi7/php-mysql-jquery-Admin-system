<?php 
  require_once ('../core/init.php');
  header('Access-Control-Allow-Origin: *');

  if (isset($_GET['d'])) {

    $statement = $pdo->prepare("SELECT * FROM especificaciones WHERE  id_desarrollo = '".$_GET['d']."' ");
    $statement->execute();
    $result = $statement->fetch();
    $data = array();
    $output = array();
    $sub_array["id"] = $result["id"];
    $sub_array["id_desarrollo"]        = $result["id_desarrollo"];
    $sub_array["Estar_y_Monoambiente"] = $result["Estar_y_Monoambiente"];
    $sub_array["banios"]               = $result["banios"];
    $sub_array["dormitorios"]          = $result["dormitorios"];
    $sub_array["cocinas"]              = $result["cocinas"];
    $data[] = $sub_array;
    $output = array(
      "data" =>  $data
    );
    echo json_encode($output);
  }

