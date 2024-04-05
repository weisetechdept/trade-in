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

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$sToken = "8PejR1DTTI8B8rEb8STbW2bZs8FDAtA21Ll7nBO7Hmf";
		$sMessage = "มีรถเข้ามาใหม่ จากเซลล์ ".$sales." ทีม ".$team;

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

		//Result error 
		if(curl_error($chOne)) 
		{ 
			//echo 'error:' . curl_error($chOne); 
			echo json_encode(array('status' => '400'));
		} 
		else { 
			/*
			$result_ = json_decode($result, true); 
			echo "status : ".$result_['status']; echo "message : ". $result_['message'];
			*/
			echo json_encode(array('status' => '200'));
		} 
		curl_close( $chOne );   
?>