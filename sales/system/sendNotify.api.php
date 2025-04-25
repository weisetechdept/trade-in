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

		$sales = $nms['first_name'];
		$team = getTeam($nms['id']);

		function sendOffer() {

			$channelToken = 'ZTh79ef5O5rWV7Hn0Bi/DBcLUUDYrhrsJxx3J1Tabc9sN7EwaIx6h1ngB/4RotU6rSvCgayGXCLNXETQy/g/JRRFdiAvPmpJ2847cK56p6nAOO8njpvSGIDL6Vp6p4WJ+iXoiXTCAmJ74r3kfZVt2QdB04t89/1O/w1cDnyilFU='; // ใส่ Token จริงของพี่พีตรงนี้
			$groupId = 'Cfa616153832373dceb32b2fc028b6404'; // Group ID ที่พี่ได้จาก webhook

			// ข้อความที่ต้องการส่ง
			$data = [
				'to' => $groupId,
				'messages' => [
					[
						'type' => 'text',
						'text' => 'แจ้งเตือนเข้ากลุ่มมาแล้วจ้า 🎉'
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
			if (curl_errno($ch)) {
				echo 'Curl error: ' . curl_error($ch);
			} else {
				echo 'Response: ' . $result;
			}
			curl_close($ch);
			
			
		}

		sendOffer();

				
?>