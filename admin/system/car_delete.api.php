<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));

    $id = $request->id;

    $data = array(
        'cast_status' => '10',
    );

    $deleteCar = $db->where('cast_id',$id)->update('car_stock', $data);
    if($deleteCar){
        $api = array(
            'status' => 200,
            'message' => 'ลบข้อมูลสำเร็จ',
            'id' => $id
        );
    } else {
        $api = array(
            'status' => 400,
            'message' => 'ลบข้อมูลไม่สำเร็จ'
        );
    }

    echo json_encode($api);