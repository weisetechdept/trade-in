<?php

session_start();
require_once '../../db-conn.php';
date_default_timezone_set("Asia/Bangkok");
 
  $strAccessToken = "IZd/+LM0eFbZBGVq67BcM6AC8MDkZSi7/DsikGWU45/a2moikJuzGP77d8J3w1UOFcc98ku2MmnnQwnKwYOyAWvkuMScEfxrImfS5NrC+nRX/bzJNehiCX9PwezVE3St1i81+6WuMUj90anooQivAAdB04t89/1O/w1cDnyilFU=";
  $content = file_get_contents('php://input');
  $arrJson = json_decode($content, true);
  
  $strUrl = "https://api.line.me/v2/bot/message/reply";
  
  $arrHeader = array();
  $arrHeader[] = "Content-Type: application/json";
  $arrHeader[] = "Authorization: Bearer {$strAccessToken}";

  if($arrJson['events'][0]['message']['text'] == "[ระบบ] พ่อสื่อเมนู"){

      $uid = $arrJson['events'][0]['source']['userId'];

      $chk = $db->where('user_line_uid', $uid)->get('user');
      if(!$chk){
        $chk = $db_nms->where('line_usrid', $uid)->get('db_member');
      }

      if($chk){

        $pp = $db_nms->where('line_usrid', $uid)->where('verify',1)->getOne('db_member');

        $arrPostData = array();
        $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
        $arrPostData['messages'][0]['type'] = "template";
        $arrPostData['messages'][0]['altText'] = "Main Menu";
        $arrPostData['messages'][0]['template'] = array(
          "type" => "buttons",
          "thumbnailImageUrl" => "https://trade-in.toyotaparagon.com/public/assets/images/flexmenu.jpg",
          "imageAspectRatio" => "rectangle",
          "imageSize" => "cover",
          "imageBackgroundColor" => "#FFFFFF",
          "title" => "พ่อสื่อเมนู",
          "text" => "กรุณาเลือกเมนูที่ต้องการ",
          "defaultAction" => array(
              "type" => "uri",
              "label" => "View detail",
              "uri" => "https://trade-in.toyotaparagon.com/public/assets/images/flexmenu.jpg"
          ),
          "actions" => array(
              array(
                  "type" => "uri",
                  "label" => "รถทั้งหมดของคุณ",
                  "uri" => "https://trade-in.toyotaparagon.com/app?way=list"
              ),
              array(
                  "type" => "uri",
                  "label" => "เพิ่มรถยนต์ใหม่",
                  "uri" => "https://trade-in.toyotaparagon.com/app"
              )
          )
        );

      } 
      
      /*
       else {

        $pp = $db_nms->where('line_usrid', $uid)->where('verify',1)->getOne('db_member');
        if($pp){
            $name = $pp['first_name'].' '.$pp['last_name'];
            $permission = 'sales';
        } else {
            $name = 'user-'.rand(100000,999999);
            $permission = 'user';
        }

        $data = array(
          'user_nickname' => $name,
          'user_line_uid' => $arrJson['events'][0]['source']['userId'],
          'user_line_img' => '/assets/images/public/avatar-images.png',
          'user_permission' => $permission,
          'user_status' => '1',
          'user_datetime' => date('Y-m-d H:i:s')
        );
        $update = $db->insert('user', $data);

        if($update){

            $arrPostData = array();
            $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
            $arrPostData['messages'][0]['type'] = "text";
            $arrPostData['messages'][0]['text'] = '$ การลงทะเบียนเสร็จสิ้น กดปุ่ม "เริ่มเลย" อีกครั้งเพื่อเริ่มหาผู้ซื้อให้กับรถยนต์ของคุณ';
            $arrPostData['messages'][0]['emojis'] = array(
              array(
                "index" => 0,
                "productId" => "5ac2213e040ab15980c9b447",
                "emojiId" => "038"
              )
            );

        } else {
          $arrPostData = array();
          $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
          $arrPostData['messages'][0]['type'] = "text";
          $arrPostData['messages'][0]['text'] = "เกิดข้อผิดพลาดในการลงทะเบียน โปรดลองใหม่อีกครั้ง";
        }
        
      }

      */
      
  }

  /*
  if($arrJson['events'][0]['message']['text'] == "[ระบบ] ประเมินราคา"){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = "สวัสดี ID คุณคือ ".$arrJson['events'][0]['source']['userId'];
  }
  */
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$strUrl);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close ($ch);

?>

