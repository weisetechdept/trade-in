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

        function sendBackPartner($carid,$img,$price){

            
            global $db;
            //global $pt_access_token;
            $access_token = 'ZTh79ef5O5rWV7Hn0Bi/DBcLUUDYrhrsJxx3J1Tabc9sN7EwaIx6h1ngB/4RotU6rSvCgayGXCLNXETQy/g/JRRFdiAvPmpJ2847cK56p6nAOO8njpvSGIDL6Vp6p4WJ+iXoiXTCAmJ74r3kfZVt2QdB04t89/1O/w1cDnyilFU=';
            $userId = 'U6f5da61c00cd349634881dafa7a6e624';

            // $customer_need_price = $db->where('cast_id',$carid)->getOne('car_stock');
            // $customer_need_price = $customer_need_price['cast_price'];
            // $diff_price = $customer_need_price - $price;

            $diff_price = '20000';


            if($diff_price <= 50000){

                $random_true = array(
                    'ราคานี้โอเคเลยครับ! เดี๋ยวเอาไปเสนอให้ลูกค้าก่อนนะ ถ้าผ่านเดี๋ยวติดต่อกลับทันทีเลยครับ',
                    'ราคาน่าเจรจามากครับ ขอเวลาเราคุยกับลูกค้าสักนิด แล้วจะรีบแจ้งกลับครับ',
                    'เข้าข่ายที่ลูกค้าน่าจะโอเคครับ เดี๋ยวลองเจรจาให้ แล้วคุณอาจได้สิทธิ์ปิดดีลนี้เลยครับ!',
                    'ดีเลยครับ ราคานี้สามารถเข้าสู่กระบวนการเจรจาได้ทันที เดี๋ยวเราจะจัดการให้ต่อครับผม',
                    'ราคานี้น่าจะโอเคกับลูกค้า เดี๋ยวเราจะลองคุยให้ครับ',
                    'ราคานี้เข้าเกณฑ์ที่เราสามารถเสนอให้ลูกค้าได้ เดี๋ยวเราจะดำเนินการเจรจาให้ครับผม'
                );
                $random = array_rand($random_true, 1);
                $res_text = $random_true[$random];

            } else {
                $random_false = array(
                    'ราคานี้อาจยังไม่โดนใจลูกค้า ลองปรับขึ้นอีกนิดให้พอได้เริ่มคุยกันนะครับ',
                    'อีกนิดเดียวก็อาจจะเข้าเขตต่อรองได้แล้ว ลองขยับราคาขึ้นนิดนึงครับ',
                    'ถ้าราคาขยับขึ้นอีกนิด ลูกค้าน่าจะสนใจมากขึ้นครับ ลองดูนะครับ!',
                    'หากเพิ่มราคาอีกสักหน่อย อาจช่วยให้เราเริ่มต้นบทสนทนากับลูกค้าได้ง่ายขึ้นครับ',
                    'โอกาสในการปิดการขายอาจเพิ่มขึ้นหากราคาสูงขึ้นใกล้กับความคาดหวังของลูกค้า',
                    'ราคานี้อาจจะยังไม่ตรงใจลูกค้า ลองปรับขึ้นอีกนิดเพื่อให้เริ่มคุยกันได้ครับ',
                );
                $random = array_rand($random_false, 1);
                $res_text = $random_false[$random];

            }

            $messages = array(
                'type' => 'template',
                'altText' => 'ให้ราคาจากพันธมิตร',
                'template' => array(
                    "type" => "buttons",
                    "thumbnailImageUrl" => $img,
                    "imageAspectRatio" => "rectangle",
                    "imageSize" => "cover",
                    "imageBackgroundColor" => "#FFFFFF",
                    "title" => "[ระบบ] เสนอราคา",
                    "text" => $res_text,
                    "defaultAction" => array(
                        "type" => "uri",
                        "label" => "View detail",
                        "uri" => $img
                    ),
                    "actions" => array(
                        array(
                            "type" => "uri",
                            "label" => "ดูข้อมูลรถยนต์",
                            "uri" => "https://trade-in.toyotaparagon.com/pt/stock/".base64_encode($carid)
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

        function sendOffer($carid,$uid,$img,$price) {

            global $pt_access_token;
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
            $headers = array('Content-Type: application/json', 'Authorization: Bearer '.$pt_access_token);
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

            global $pt_Token;
            $sMessage = "[พันธมิตร] $part_name ให้ราคารหัสรถ ID : $carid ราคา $r_price บาท [ https://trade-in.toyotaparagon.com/alink?cid=$carid ]";

            $chOne = curl_init(); 
            curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt( $chOne, CURLOPT_POST, 1); 
            curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$pt_Token.'', );
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

                sendBackPartner($id,$car['cari_link'],$price);

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


