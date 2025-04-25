<?php
	session_start();
    require_once '../../db-conn.php';
	date_default_timezone_set("Asia/Bangkok");

	

		$request = json_decode(file_get_contents('php://input'));
		$id = $request->id;

		$stock = $db->where('cast_id',$id)->getOne('car_stock');

		$nms = $db_nms->where('id',$stock['cast_sales_parent_no'])->getOne('db_member');

		function getTeam($uid){
			global $db_nms;
			$team = $db_nms->get('db_user_group');
			foreach($team as $t){
				$tm = array_merge(json_decode($t['detail']),json_decode($t['leader']));
				//$team_data = json_decode($t['detail']);
				if(in_array($uid,$tm)){
					return $t['name'];
				} 
			}
		}

		function sendOffer($sales,$team,$id) {

			$channelToken = 'IZd/+LM0eFbZBGVq67BcM6AC8MDkZSi7/DsikGWU45/a2moikJuzGP77d8J3w1UOFcc98ku2MmnnQwnKwYOyAWvkuMScEfxrImfS5NrC+nRX/bzJNehiCX9PwezVE3St1i81+6WuMUj90anooQivAAdB04t89/1O/w1cDnyilFU='; // ใส่ Token จริงของพี่พีตรงนี้
			$groupId = 'Cfa616153832373dceb32b2fc028b6404'; // Group ID ที่พี่ได้จาก webhook

			// ข้อความที่ต้องการส่ง
			$data = [
				'to' => $groupId,
				'messages' => [
					[
						'type' => 'text',
						'text' => '[เซลล์] มีรถเข้ามาใหม่ จากเซลล์ '.$sales.' ทีม '.$team.' , รหัสรถ ID : '.$id.'[ https://trade-in.toyotaparagon.com/alink?cid='.$id.' ]'
					]
				]
			];

			// ส่ง HTTP POST ไปที่ LINE Messaging API
			$ch = curl_init('https://api.line.me/v2/bot/message/push');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				'Content-Type: application/json',
				'Authorization: Bearer ' . $channelToken
			]);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

			$result = curl_exec($ch);
			curl_close($ch);

			if ($result) {
				$api = array(
					'status' => 200,
					'message' => 'ส่งข้อความสำเร็จ'
				);
			} else {
				$api = array(
					'status' => 400,
					'message' => 'ส่งข้อความไม่สำเร็จ'
				);
			}
			
		}

		$sales = $nms['first_name'];
		$team = getTeam($nms['id']);

		sendOffer($sales,$team,$id);

		echo json_encode($api);
				
?>