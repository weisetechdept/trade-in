<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    function DateThai($strDate)
    {
        $strYear = date("y",strtotime($strDate));
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
    
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    } 

    function DateThaiTime($strDate)
    {
        $strYear = date("y",strtotime($strDate));
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strHour= date("H",strtotime($strDate));
        $strMin= date("i",strtotime($strDate));
    
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear, $strHour:$strMin";
    } 

    function getTeamName($uid){
        global $db_nms;
        $team = $db_nms->get('db_user_group', null, 'name,detail,leader');
        foreach($team as $t){
            $tm = array_merge(json_decode($t['detail']),json_decode($t['leader']));
            if(in_array($uid,$tm)){
                return $t['name'];
            } 
        }
    }

    function getSaleName($uid){
        global $db_nms;
        $sale = $db_nms->where('id', $uid)->getOne('db_member', null,'first_name ,last_name, nickname');
        if($sale['nickname'] == ''){
            return $sale['first_name'].' '.$sale['last_name'];
        } else {
            return $sale['first_name'].' '.$sale['last_name'].' - '.$sale['nickname'];
        }
    }

    function thumb($uid){
        global $db;
        $thumb = $db->where('cari_parent ', $uid)->where('cari_group',10)->getOne('car_image', null,'cari_link');
        if(empty($thumb)){
            return 'https://dummyimage.com/600x400/c4c4c4/fff&amp;text=no-image';
        }else {
            return $thumb['cari_link'];
        }
    }

    function getBrandSerie($uid){
        global $db;
        $brand = $db->where('find_id', $uid)->getOne('finance_data', null,'find_brand ,find_serie');
        if (!empty($brand)) {
            return $brand['find_brand'].' '.$brand['find_serie'];
        } else {
            return "N/A"; // Return a default message or handle as needed
        }
    }

    function getOfferPrice($uid){
        global $db;
        $offer = $db->where('off_parent', $uid)->orderBy('off_price','DESC')->getOne('offer', null,'off_price');
        if(empty($offer)){
            return "ไม่มี";
        } else {
            return number_format($offer['off_price']);
        }
    }

    function getTLTPrice($uid){
        global $db;
        $offer = $db->where('find_id', $uid)->getOne('finance_data', null,'find_price');
        if(empty($offer)){
            return "ไม่มี";
        } else {
            return number_format($offer['find_price']);
        }
    }

    function countOffer($id){
        global $db;
        $count = $db->where('off_parent', $id)->getValue('offer','count(*)');
        return $count;
    }

    $request = json_decode(file_get_contents('php://input'));

    $ecardId = $request->ecardId;

    $api = array();

    $ecard_data = $db->where('cast_id',$ecardId)->getOne('car_stock');

    $offer = $db->where('off_parent', $ecard_data['cast_id'])->orderBy('off_id','ASC')->get('offer');

    foreach($offer as $key => $value){
        $offer[$key]['off_price'] = number_format($value['off_price']);
        $offer[$key]['off_datetime'] = DateThaiTime($value['off_datetime']);
        $offer[$key]['off_name'] = '****';
    }

    $api = array(
        'id' => $ecard_data['cast_id'],
        'brand' => $ecard_data['cast_year'].' '.getBrandSerie($ecard_data['cast_car']).' '.$ecard_data['cast_transmission'],
        'model' => getBrandSerie($ecard_data['cast_car']),
        'thumb' => thumb($ecard_data['cast_id']),
        'year' => $ecard_data['cast_year'],
        'mileage' => number_format($ecard_data['cast_mileage']),
        'customer_price' => number_format($ecard_data['cast_price']),
        'license_no' => $ecard_data['cast_license'],

        'highBid' => getOfferPrice($ecard_data['cast_id']),
        'tradePrice' => number_format($ecard_data['cast_trade_price']),
        'tltPrice' => getTLTPrice($ecard_data['cast_car']),
        'nowDate' => DateThai(date('Y-m-d')),

        'sale' => getSaleName($ecard_data['cast_sales_parent_no']),
        'team' => getTeamName($ecard_data['cast_sales_parent_no']),
        'cearteDate' => DateThai($ecard_data['cast_datetime']),

        'offerCount' => countOffer($ecard_data['cast_id']),
        'offer' => $offer
        
    );

    echo json_encode($api);