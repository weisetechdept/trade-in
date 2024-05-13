<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    

        $db->join('car_stock c', "f.find_id=c.cast_car", "RIGHT");
        $stock = $db->where('cast_status',array(0,1,2,3,4),'IN')->get("finance_data f", null ,"c.cast_id,c.cast_license,f.find_brand,f.find_serie,f.find_section,c.cast_color,c.cast_price,c.cast_sales_parent,c.cast_sales_team,c.cast_status,cast_sales_parent_no,cast_datetime,cast_year,cast_thumb");

        

        foreach ($stock as $value) {

            $img_count = $db->where('cari_parent',$value['cast_id'])->where('cari_status', '1')->getValue('car_image','count(*)');


            if(empty($value['cast_sales_parent_no'])){
                $data_owner = $value['cast_sales_parent'].' - '.$value['cast_sales_team'];
            } else {
                $sales = $db_nms->where('id', $value['cast_sales_parent_no'])->getOne('db_member');
                $data_owner = $sales['first_name'];
            }

            $img = $db->where('cari_id', $value['cast_thumb'])->getOne('car_image');

            if(!empty($img)){
                $thumbnail = $img['cari_link'];
            } else {
                $thumbnail = 'https://dummyimage.com/600x400/c4c4c4/fff&text=no-image';
            }

            $api['data'][] = array($value['cast_id'],
                DateThai($value['cast_datetime']),
                $value['find_serie'].' '.substr($value['find_section'],0,15).'...',
                $value['cast_seller_name'],
                number_format($value['cast_price']),
                $data_owner,
                $value['cast_status'],
                DateThai($value['cast_datetime']),
                '',
                $value['cast_year'],
                getTeam($value['cast_sales_parent_no']),
                $img_count,
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
            );
        }

    