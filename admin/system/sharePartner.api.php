<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    function sendOffer($uid,$img,$carid,$car_desc) {

        $access_token = 'ZTh79ef5O5rWV7Hn0Bi/DBcLUUDYrhrsJxx3J1Tabc9sN7EwaIx6h1ngB/4RotU6rSvCgayGXCLNXETQy/g/JRRFdiAvPmpJ2847cK56p6nAOO8njpvSGIDL6Vp6p4WJ+iXoiXTCAmJ74r3kfZVt2QdB04t89/1O/w1cDnyilFU=';
        $userId = $uid;

        $messages = array(
            'type' => 'template',
            'altText' => 'รถยนต์เข้าใหม่',
            'template' => array(
                "type" => "buttons",
                "thumbnailImageUrl" => $img,
                "imageAspectRatio" => "rectangle",
                "imageSize" => "cover",
                "imageBackgroundColor" => "#FFFFFF",
                "title" => "รถยนต์เข้าใหม่",
                "text" => $car_desc,
                "defaultAction" => array(
                    "type" => "uri",
                    "label" => "View detail",
                    "uri" => $img
                ),
                "actions" => array(
                    array(
                        "type" => "uri",
                        "label" => "ดูข้อมูลรถยนต์",
                        "uri" => "https://trade-in.toyotaparagon.com/pt/stock/".base64_encode($carid)
                    )
                )
            )
        );

        $post = json_encode(array(
            'to' => array($userId),
            'messages' => array($messages),
        ));

        $url = 'https://api.line.me/v2/bot/message/multicast';
        $headers = array('Content-Type: application/json', 'Authorization: Bearer '.$access_token);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.line.me/v2/bot/message/multicast");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);

        $result = curl_exec($ch);
        
    }

    $stock_id = $_GET['id'];

    $db->join('finance_data f', 'f.find_id = s.cast_car', 'LEFT');
    $desc = $db->where('cast_id',$stock_id)->getOne('car_stock s');
    $img_data = $db->where('cari_status',1)->getOne('car_image');

    $partner = $db->where('part_status',1)->get('partner');
    foreach ($partner as $value) {

        $uid = $value['part_line_uid'];
        $des = $desc['cast_year'].' '.$desc['find_brand'].' '.$desc['find_serie'];
        $id = $desc['cast_id'];
        $img = $img_data['cari_link'];

        //echo $id.' '.$uid.' '.$des.' '.$img;
        $send = sendOffer($uid,$img,$id,$des);
      
    }
