<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));

    $id = $request->id;
    $price = $request->price;
    $commission = $request->commission;
    $total = $request->total;
    $parent = $request->parent;

        function sendOffer($carid,$uid,$img,$price) {

            $access_token = 'IZd/+LM0eFbZBGVq67BcM6AC8MDkZSi7/DsikGWU45/a2moikJuzGP77d8J3w1UOFcc98ku2MmnnQwnKwYOyAWvkuMScEfxrImfS5NrC+nRX/bzJNehiCX9PwezVE3St1i81+6WuMUj90anooQivAAdB04t89/1O/w1cDnyilFU=';
            $userId = $uid;

            $messages = array(
                'type' => 'template',
                'altText' => 'ให้ราคาจากพันธมิตร',
                'template' => array(
                    "type" => "buttons",
                    "thumbnailImageUrl" => $img,
                    "imageAspectRatio" => "rectangle",
                    "imageSize" => "cover",
                    "imageBackgroundColor" => "#FFFFFF",
                    "title" => "เสนอราคาจากพันธมิตร",
                    "text" => "พันธมิตรประเมิน ".number_format($price)." บาท ต้องการคุยรายละเอียดกดปุ่มด้านล่าง",
                    "defaultAction" => array(
                        "type" => "uri",
                        "label" => "View detail",
                        "uri" => $img
                    ),
                    "actions" => array(
                        array(
                            "type" => "message",
                            "label" => "คุยรายละเอียดคันนี้",
                            "text" => "ID : ".$carid." ต้องการติดต่อพ่อสื่อ, รอสักครู่..."
                        ),
                        array(
                            "type" => "uri",
                            "label" => "ดูข้อมูลรถยนต์",
                            "uri" => "https://trade-in.toyotaparagon.com/app?way=car&id=".$carid
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

        function sendNotify($carid,$price,$partner) {

            global $db;
            $db->join('partner_bus b','p.part_bus_id = b.busi_id','INNER');
            $name = $db->where('part_id',$partner)->getOne('partner p');

            $part_name = $name['part_fname'].' '.$name['busi_name'];

            $r_price = number_format($price);

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            $sToken = "8PejR1DTTI8B8rEb8STbW2bZs8FDAtA21Ll7nBO7Hmf";
            $sMessage = "[พันธมิตร] $part_name ให้ราคารหัสรถ ID : $carid ราคา $r_price บาท [ https://trade-in.toyotaparagon.com/alink?cid=$carid ]";

            $chOne = curl_init(); 
            curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt( $chOne, CURLOPT_POST, 1); 
            curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
            curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
            $result = curl_exec( $chOne );

        }

    if($id == '' | $price == '' | $parent == ''){
        $api = array(
            'status' => '400',
            'message' => 'ID not found'
        );

    } else {

        $data = array(
            'off_price' => $price,
            'off_vender' => $parent,
            'off_parent' => $id,
            'off_datetime' => date('Y-m-d H:i:s')
        );
    
        $up = $db->insert('offer',$data);
        if($up){
            $db->join('car_image i','s.cast_id = i.cari_parent','INNER');
            $car = $db->where('cast_id',$id)->getOne('car_stock s');

            $sales = $db_nms->where('id',$car['cast_sales_parent_no'])->getOne('db_member');
            sendOffer($id,$sales['line_usrid'],$car['cari_link'],$price);

            sendNotify($id,$price,$parent);
            $api = array(
                'status' => '200',
                'message' => 'Success to offer'
            );

        } else {

            $api = array(
                'status' => '400',
                'message' => 'Offer not Success'
            );
        }

    }

    echo json_encode($api);


