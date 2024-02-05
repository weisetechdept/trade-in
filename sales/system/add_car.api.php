<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $user_id = $_SESSION['tin_user_id'];

    if(!empty($user_id)){
        
        $api['user'] = array(
            'id' => $user_id
        );

        if($_SESSION['tin_admin'] != true){
            header("location: /404");
            exit();
        }
    
        $brand = $db->get('finance_data');
        foreach ($brand as $value) {
            $api['brand'][] = $value['find_brand'];
    
        }
        $api['brand'] = array_unique($api['brand']);

    } else {

    }

    print_r(json_encode($api));