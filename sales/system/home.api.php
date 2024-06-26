<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    
    $user_id = $_SESSION['tin_user_id'];

    $db->join('car_stock c', "f.find_id=c.cast_car", "RIGHT");
    $stock = $db->where('c.cast_sales_parent_no',$user_id)->get("finance_data f", null ,"c.cast_id,c.cast_license,f.find_brand,f.find_serie,f.find_section,c.cast_color,c.cast_price,c.cast_sales_parent,c.cast_sales_team,c.cast_status");

    if(!empty($stock)){
        foreach ($stock as $value) {

            $thumb = $db->where('cari_parent',$value['cast_id'])->where('cari_group',10)->where('cari_status',1)->getOne('car_image');
            if(!empty($thumb)){
                
                $thumbnail = $thumb['cari_link'];
            } else {
                $thumbnail = 'https://dummyimage.com/600x400/c4c4c4/fff&text=no-image';
            }

            $api['data'][] = array($value['cast_id'],
                $value['cast_status'],
                substr($value['find_brand'].' '.$value['find_serie'].' '.$value['find_section'],0,25),
                $value['cast_color'],
                number_format($value['cast_price']),
                $thumbnail
            );
            
        } 
    } else {
        $api['data'] = '';
    }

    print_r(json_encode($api));