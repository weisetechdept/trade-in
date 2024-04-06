<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }

    $request = json_decode(file_get_contents('php://input'));

    $id = $request->id;
    $sales = $request->sales;

    $data = array(
        'cast_sales_parent_no' => $sales,
    );

    $upOwner = $db->where('cast_id',$id)->update('car_stock', $data);
    if($upOwner){
        $api = array(
            'status' => 'success',
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'id' => $id
        );
    } else {
        $api = array(
            'status' => 'failed',
            'message' => 'บันทึกข้อมูลไม่สำเร็จ'
        );
    }

    echo json_encode($api);