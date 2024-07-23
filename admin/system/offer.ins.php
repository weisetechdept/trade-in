<?php 
        session_start();
        require_once '../../db-conn.php';
        date_default_timezone_set("Asia/Bangkok");

        $request = json_decode(file_get_contents('php://input'));
        $price = $request->price;
        $partner = $request->partner;
        $id = $request->parent;


        function getTeamMgr($uid){
            global $db_nms;

            $team = $db_nms->get('db_user_group');
            foreach($team as $t){
                $tm = array_merge(json_decode($t['detail']),json_decode($t['leader']));

                if(in_array($uid,$tm)){
                    $mgr = $db_nms->where('id', $t['id'])->getOne('db_user_group');

                    $mgrid = json_decode($mgr['leader']);
                    $mgr_id = $db_nms->where('id', $mgrid[0])->getOne('db_member');

                    return $mgr_id['line_usrid'];
                } 
            }
        }

        function sendOffer($carid,$uid,$img,$price,$partner) {

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
    

        function sendMsg($line_uid,$cust_name,$price) {
            $access_token = 'GtacKYhQw2Y7U9Wzc8GeNUW32big3VZs4oeUU7U8wEtlPUDq1kLKQYBpD1HbwP/nFetgiLI0GA8pxPG7fAxvOYO001rJ6WXN4uNp7d+pxM43hKKZ1klmScK6z8jr3XJZno1X1AGGwwQWUP9lBjUuEAdB04t89/1O/w1cDnyilFU=';
            $userId = $line_uid;
        
            $messages = array(
                'type' => 'text',
                'text' => '[พ่อสื่อ] คุณ '.$cust_name.' ได้รับประเมินราคา '.$price.' บาท หากได้คำตอบจากลูกค้า กรุณาแจ้งทีมงานทราบด้วยค่ะ'
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


        if($_SESSION['tin_admin'] != true){

            $api = array('status' => '401','message' => 'Unauthorized Access!');

        } else {

            $mgr = $db_nms->where('id', $_SESSION['tin_admin_id'])->getOne('db_member');

            $data = array(
                'off_price' => $price,
                'off_vender' => $partner.' - '.$_SESSION['adname_name'],
                'off_parent' => $id,
                'off_datetime' => date('Y-m-d H:i:s')
            );

            $ins = $db->insert('offer', $data);
            if ($ins){
                
                $car = $db->where('cast_id', $id)->getOne('car_stock');
                $luid = $db_nms->where('id', $car['cast_sales_parent_no'])->getOne('db_member');
                $img = $db->where('cari_parent',$car['cast_id'])->getOne('car_image');

                sendMsg($luid['line_usrid'],$car['cast_seller_name'],number_format($price));
                sleep(3);
                sendOffer($car['cast_id'],$luid['line_usrid'],$img['cari_link'],$price,'');
                sleep(3);
                sendMsg(getTeamMgr($car['cast_sales_parent_no']),$car['cast_seller_name'],number_format($price));

                //echo json_encode(array('status' => '200','id' => $id));
                $api = array('status' => '200','id' => $id);

            } else {

                //echo json_encode(array('status' => '400'));
                $api = array('status' => '400');

            }

        }

        echo json_encode($api);

        