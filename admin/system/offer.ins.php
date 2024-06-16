<?php 
        session_start();
        require_once '../../db-conn.php';
        date_default_timezone_set("Asia/Bangkok");

        if($_SESSION['tin_admin'] != true){
            header("location: /404");
            exit();
        }

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

        $ins = $db->insert('offer', $data);
        if ($ins){

            
            $car = $db->where('cast_id', $id)->getOne('car_stock');

            $luid = $db_nms->where('id', $car['cast_sales_parent_no'])->getOne('db_member');

            $access_token = 'GtacKYhQw2Y7U9Wzc8GeNUW32big3VZs4oeUU7U8wEtlPUDq1kLKQYBpD1HbwP/nFetgiLI0GA8pxPG7fAxvOYO001rJ6WXN4uNp7d+pxM43hKKZ1klmScK6z8jr3XJZno1X1AGGwwQWUP9lBjUuEAdB04t89/1O/w1cDnyilFU=';
            $userId = $luid['line_usrid'];
        
            $messages = array(
                'type' => 'text',
                'text' => '[พ่อสื่อ]คุณ '.$car['cast_seller_name'].' ได้รับประเมินราคา '.number_format($price).' บาท คุยรายละเอียดผ่านแชทไลน์ PP ได้เลยค่ะ'
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
        