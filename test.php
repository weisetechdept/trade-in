<?php
    session_start();
    require_once 'db-conn.php';
    date_default_timezone_set("Asia/Bangkok");


    function send_mgr($id){
        global $db_nms;
        $team = $db_nms->get('db_user_group');
        foreach ($team as $val) {
            $se = array_search($id,json_decode($val['detail']));
            if($se !== false){
                $mgr = json_decode($val['leader']);
                $uid = $db_nms->where('id',$mgr[0])->getOne('db_member');
            }
        }
        //return $uid['line_usrid'];

        $access_token = 'GtacKYhQw2Y7U9Wzc8GeNUW32big3VZs4oeUU7U8wEtlPUDq1kLKQYBpD1HbwP/nFetgiLI0GA8pxPG7fAxvOYO001rJ6WXN4uNp7d+pxM43hKKZ1klmScK6z8jr3XJZno1X1AGGwwQWUP9lBjUuEAdB04t89/1O/w1cDnyilFU=';

        $userId = $uid['line_usrid'];
        $messages = array(
            'type' => 'text',
            'text' => '[Thank God] ลูกทีมลูกค้าได้รับลูกค้าชื่อ'.' '.$_POST['txt_firstname'].' '.$_POST['txt_lastname']
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
        curl_close($ch);
        
    }

    echo send_mgr(271);