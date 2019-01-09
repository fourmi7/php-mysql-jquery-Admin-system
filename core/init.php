<?php 

    include 'database/connection.php';
    include 'classes/user.php';
    include 'classes/desarrollo.php';


    global $pdo;

    session_start();
    
    $getFromU = new User($pdo);
    $getFromD = new Desarrollo($pdo);

    define("BASE_URL", "http://localhost/aamasea/");
 ?>