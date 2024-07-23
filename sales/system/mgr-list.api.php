<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    
    //$user_id = $_SESSION['tin_user_id'];

    if($_SESSION['tin_permission'] !== 'leader') {
        header("location: /404");
    }

    $user_id = $_SESSION['tin_user_id'];

    function mgr($data){
        global $db_nms;
        $group = $db_nms->get('db_user_group');
        foreach($group as $value){
            $chk = in_array($data, json_decode($value['leader']));
            if($chk){
                foreach(json_decode($value['detail']) as $emp){
                    $team[] = $emp;
                }
            }
        }
        return array_unique($team);
    }

    if($_GET['get'] == 'count'){
        
        $countAll = $db->where('cast_sales_parent_no',mgr($user_id),'IN')->getValue("car_stock","count(*)");
        $countChk = $db->where('cast_sales_parent_no',mgr($user_id),'IN')->where('cast_status',0)->getValue("car_stock","count(*)");
        $countCar = $db->where('cast_sales_parent_no',mgr($user_id),'IN')->where('cast_status',1)->getValue("car_stock","count(*)");
        $countFollow = $db->where('cast_sales_parent_no',mgr($user_id),'IN')->where('cast_status',2)->getValue("car_stock","count(*)");
        $countCancel = $db->where('cast_sales_parent_no',mgr($user_id),'IN')->where('cast_status',3)->getValue("car_stock","count(*)");
        $countSuccess = $db->where('cast_sales_parent_no',mgr($user_id),'IN')->where('cast_status',4)->getValue("car_stock","count(*)");

        $api['count']['All'] = $countAll;
        $api['count']['ckh'] = $countChk;
        $api['count']['car'] = $countCar;
        $api['count']['follow'] = $countFollow;
        $api['count']['cancel'] = $countCancel;
        $api['count']['success'] = $countSuccess;

    }

        $status = $_GET['get'];
    
        $db->join('car_stock c', "f.find_id=c.cast_car", "RIGHT");
        $stock = $db->where('c.cast_sales_parent_no',mgr($user_id),'IN')->where('cast_status',$status)->get("finance_data f", null ,"c.cast_id,c.cast_license,f.find_brand,f.find_serie,f.find_section,c.cast_color,c.cast_price,c.cast_sales_parent,c.cast_sales_team,c.cast_status,cast_sales_parent_no");

        if(!empty($stock)){
            foreach ($stock as $value) {

                $thumb = $db->where('cari_parent',$value['cast_id'])->where('cari_group',10)->where('cari_status',1)->getOne('car_image');
                if(!empty($thumb)){
                    
                    $thumbnail = $thumb['cari_link'];
                } else {
                    $thumbnail = 'https://dummyimage.com/600x400/c4c4c4/fff&text=no-image';
                }
                
                $sales = $db_nms->where('id',$value['cast_sales_parent_no'])->getOne('db_member');

                $api['data'][] = array($value['cast_id'],
                    $value['cast_status'],
                    substr($value['find_brand'].' '.$value['find_serie'].' '.$value['find_section'],0,25),
                    $value['cast_color'],
                    number_format($value['cast_price']),
                    $thumbnail,
                    $sales['first_name']
                );
                
            }
        } else {
            $api['data'] = '';
        }

    print_r(json_encode($api));