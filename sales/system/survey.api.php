<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");




    $db_sv->join('provinces p', "s.sv_province=p.id", "LEFT");
    $db_sv->join('amphures a', "s.sv_amphure=a.id", "LEFT");
    $sv = $db_sv->get("survey s", null ,"sv_id,sv_type,sv_tel,sv_line,sv_addline,sv_name,p.name_th as prov,a.name_th as amp,sv_email,sv_need,sv_time,sv_car_used,sv_car_other,sv_datetime");

    foreach ($sv as $value) {
        if($value['sv_type'] == 1){
            $type = 'รถปิ๊กอัพ';
        }elseif($value['sv_type'] == 2){
            $type = 'รถอเนกประสงค์';
        }elseif($value['sv_type'] == 3){
            $type = 'รถเก๋งเล็ก';
        }elseif($value['sv_type'] == 4){
            $type = 'รถเก๋งใหญ่';
        }

        if($value['sv_addline'] == 0){
            $addline = 'ไม่ได้';
        }else{
            $addline = 'ได้';
        }

        if($value['sv_need'] == 1){
            $need = 'ภายใน 1 เดือน';
        }elseif($value['sv_need'] == 2){
            $need = 'ภายใน 3 เดือน';
        }elseif($value['sv_need'] == 3){
            $need = 'ภายใน 6 เดือน';
        }elseif($value['sv_need'] == 4){
            $need = 'มากกว่า 6 เดือน';
        }

        if($value['sv_time'] == '1'){
            $time = 'ตลอดเวลา';
        }elseif($value['sv_time'] == '2'){
            $time = '8.00 - 10.00น.';
        }elseif($value['sv_time'] == '3'){
            $time = '10.00 - 12.00น.';
        }elseif($value['sv_time'] == '4'){
            $time = '12.00 - 17.00น.';
        }elseif($value['sv_time'] == '5'){
            $time = '17.00 - 20.00น.';
        }
        //echo $value['sv_name'].' - '.$value['prov'].' - '.$value['amp'].' - '.$type.' - '.$value['sv_tel'].' - '.$value['sv_line'].' - '.$addline.' - '.$value['sv_email'].'<br/>';
        $api['data'][] = array(
            $value['sv_id'],
            $value['sv_name'],
            $value['prov'],
            $value['amp'],
            $value['sv_tel'],
            $value['sv_line'],
            $addline,
            $value['sv_email'],
            $type,
            $need,
            $time,
            $value['sv_car_used'],
            $value['sv_car_other'],
            $value['sv_datetime']
        );
    }

    print_r(json_encode($api));