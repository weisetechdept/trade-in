<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    if($_SESSION['tin_admin'] != true){
        header("location: /404");
        exit();
    }

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

    function DateThai($strDate)
    {
        $strYear = date("y",strtotime($strDate));
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
    
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    } 

    if($_GET['get'] == 'list'){
        
        $api['data'] = array();

    } 

    if($_GET['get'] == 'count'){
        $count = $db->where('cast_status',array(0,1,2,3,4),"IN")->getValue('car_stock','count(*)');
        $api['count'] = $count;

        $team = $db_nms->where('department',8)->get('db_user_group',null,'name');
        $api['team'] = $team;
    }


    if($_GET['get'] == 'search'){

        $start = $_GET['start'].' 00:00:00';
        $end = $_GET['end'].' 23:59:59';
        $data_status = $_GET['status'];

        if($data_status == 'all'){
            $status = array('0','1','2','3','4');
        }elseif($data_status == '0'){
            $status = array('0');
        }elseif($data_status == '1'){
            $status = array('1');
        }elseif($data_status == '2'){
            $status = array('2');
        }elseif($data_status == '3'){
            $status = array('3');
        }elseif($data_status == '4'){
            $status = array('4');
        }


        $db->join('car_stock c', "f.find_id=c.cast_car", "RIGHT");
        $stock = $db->where('cast_datetime', array($start, $end), 'BETWEEN')->where('cast_status',$status,"IN")->get("finance_data f", null ,"c.cast_id,c.cast_license,f.find_brand,f.find_serie,f.find_section,c.cast_color,c.cast_price,c.cast_sales_parent,c.cast_sales_team,c.cast_status,cast_sales_parent_no,cast_datetime");

        $ct = 0;

        if(empty($stock)){

            $api['data'] = [];

        } else {

            foreach ($stock as $value) {
                $img_count = $db->where('cari_parent',$value['cast_id'])->where('cari_status', '1')->getValue('car_image','count(*)');
                $t = getTeam($value['cast_sales_parent_no']);

    

                    if(empty($value['cast_sales_parent_no'])){
                        $data_owner = $value['cast_sales_parent'].' - '.$value['cast_sales_team'];
                    } else {
                        $sales = $db_nms->where('id', $value['cast_sales_parent_no'])->getOne('db_member');
                        $data_owner = $sales['first_name'];
                    }
    
                    $img = $db->where('cari_parent', $value['cast_id'])->where('cari_status', '1')->getOne('car_image');
    
                    if(!empty($img)){
                        $thumbnail = $img['cari_link'];
                    } else {
                        $thumbnail = 'https://dummyimage.com/600x400/c4c4c4/fff&text=no-image';
                    }

                    if($_GET['team'] == 'all'){

                        $api['data'][] = array(
                            /*
                            $value['cast_id'],
                            $value['cast_license'],
                            $value['find_brand'].' '.$value['find_serie'].' '.$value['find_section'],
                            $value['cast_color'],
                            number_format($value['cast_price']),
                            $data_owner,
                            $value['cast_status'],
                            DateThai($value['cast_datetime']),
                            $thumbnail,
                            $value['cast_year'],
                            $t,
                            $img_count
                            */
                            $value['cast_id'],
                            $thumbnail,
                            $img_count,
                            $value['cast_license'],
                            $value['cast_year'],
                            $value['find_serie'].' '.substr($value['find_section'],0,15).'...',
                            $value['cast_color'],
                            number_format($value['cast_price']),
                            $data_owner,
                            getTeam($value['cast_sales_parent_no']),
                            $value['cast_status'],
                            DateThai($value['cast_datetime']),
                            number_format($value['cast_price'] * 0.02625),
                            number_format($value['cast_price'] * 0.02208),
                            number_format($value['cast_price'] * 0.01931),
                            number_format($value['cast_price'] * 0.01732)
                        );
                        $ct++;


                    } else {
                        if($t == $_GET['team']){
                            $api['data'][] = array(
                                $value['cast_id'],
                                $value['cast_license'],
                                $value['find_brand'].' '.$value['find_serie'].' '.$value['find_section'],
                                $value['cast_color'],
                                number_format($value['cast_price']),
                                $data_owner,
                                $value['cast_status'],
                                DateThai($value['cast_datetime']),
                                $thumbnail,
                                $value['cast_year'],
                                $t,
                                $img_count
                            );
                            $ct++;
                        } else {
                            $api['data'] = [];
                        }
                    }
               
            }
            $api['count'] = $ct;

        }

    }

    print_r(json_encode($api));