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

        function sendNotify($carid,$price,$partner) {

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            $sToken = "8PejR1DTTI8B8rEb8STbW2bZs8FDAtA21Ll7nBO7Hmf";
            /*
                $sMessage = "พันธมิตร $partner ให้ราคารหัสรถ ID : $carid ราคา $price บาท";
            */
            $sMessage = array(
                'type' => 'template',
                'altText' => 'ให้ราคาจากพันธมิตร',
                'template' => array(
                    "type" => "buttons",
                    "thumbnailImageUrl" => 'https://dummyimage.com/600x400/000/fff',
                    "imageAspectRatio" => "rectangle",
                    "imageSize" => "cover",
                    "imageBackgroundColor" => "#FFFFFF",
                    "title" => "เสนอราคาจากพันธมิตร",
                    "text" => "พันธมิต $partner รประเมิน ".number_format($price)." บาท ต้องการคุยรายละเอียดกดปุ่มด้านล่าง",
                    "defaultAction" => array(
                        "type" => "uri",
                        "label" => "View detail",
                        "uri" => 'https://dummyimage.com/600x400/000/fff'
                    ),
                    "actions" => array(
                        array(
                            "type" => "uri",
                            "label" => "ดูข้อมูลรถยนต์",
                            "uri" => "https://trade-in.toyotaparagon.com/app?way=car&id=".$carid
                        )
                    )
                )
            );

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


