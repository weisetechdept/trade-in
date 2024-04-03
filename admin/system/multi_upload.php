<?php 
     session_start();
     if($_SESSION['tin_admin'] != true){
         header("location: /404");
         exit();
     }
    $api = array('status' => 200);
    echo json_encode($api);