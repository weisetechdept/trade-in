<?php 
        session_start();
        require_once '../../db-conn.php';
        date_default_timezone_set("Asia/Bangkok");

        $request = json_decode(file_get_contents('php://input'));
        $price = $request->price;
        $partner = $request->partner;
        $id = $request->parent;

        $data = array(
            'off_price' => $price,
            'off_vender' => $partner,
            'off_parent' => $id,
            'off_datetime' => date('Y-m-d H:i:s')
        );

        $id = $db->insert('offer', $data);
        if ($id){

            $luid = $db_nms->where('id', 271)->getOne('db_member');

            $car = $db->where('cast_id', $id)->getOne('car_stock');

            $access_token = 'GtacKYhQw2Y7U9Wzc8GeNUW32big3VZs4oeUU7U8wEtlPUDq1kLKQYBpD1HbwP/nFetgiLI0GA8pxPG7fAxvOYO001rJ6WXN4uNp7d+pxM43hKKZ1klmScK6z8jr3XJZno1X1AGGwwQWUP9lBjUuEAdB04t89/1O/w1cDnyilFU=';
            $userId = $luid['line_usrid'];
        
            $messages = array(
                'type' => 'text',
                'text' => '[พ่อสื่อ]รถยนต์ของคุณ '.$car['cast_seller_name'].' ได้รับประเมินราคา 100,000 บาท'
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

            echo json_encode(array('status' => '200','id' => $id));
        } else {
            echo json_encode(array('status' => '400'));
        }
        