<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }

    $b = $_GET['b'];
    $s = $_GET['s'];
    $t = $_GET['t'];
    $serie = $_GET['serie'];

    if(!empty($b)){

        $brand = $db->where('find_brand',$b)->get('finance_data');
        foreach ($brand as $value) {
            $api['serie'][] = $value['find_serie'];

        }
        $api['serie'] = array_unique($api['serie']);

    }

    if(!empty($s)){

        $brand = $db->where('find_serie',$s)->get('finance_data');
        foreach ($brand as $value) {
            $api['year'][] = $value['find_year'];

        }
        $api['year'] = array_unique($api['year']);

    }

    if(!empty($t)){

        $brand = $db->where('find_serie',$serie)->where('find_year',$t)->get('finance_data');
        foreach ($brand as $value) {
            $api['section'][] = array('name' => $value['find_section'],'id' => $value['find_id']);

        }

    }

    print_r(json_encode($api));