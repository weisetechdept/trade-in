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

    function getTeamName($uid){
        global $db_nms;
        if(empty($uid)){
            return "ยังไม่ระบุ";
        } else {
            $team = $db_nms->get('db_user_group', null, 'name,detail,leader');
            foreach($team as $t){
                $tm = array_merge(json_decode($t['detail']),json_decode($t['leader']));
                if(in_array($uid,$tm)){
                    return $t['name'];
                } 
            }
        }
        
    }

    function getSaleName($uid){
        global $db_nms;
        if(empty($uid)){
            return "ยังไม่ระบุ";
        } else {
            $sale = $db_nms->where('id', $uid)->getOne('db_member', null,'first_name');
            return $sale['first_name'];
        }
    }

    
    $sql_details_1 = ['user'=> $usern,'pass'=> $passn,'db'=> $dbn,'host'=> $hostn,'charset'=>'utf8'];
    
    require 'ssp.class.php';

    $table = 'car_stock';

    $primaryKey = 'cast_id';
    $columns = [
        ['db' => 'cast_id', 'dt' => 0, 'field' => 'cast_id'],
        ['db' => 'cast_sales_parent_no', 'dt' => 1, 'field'=> 'cast_sales_parent_no',
            'formatter' => function($d, $row){
                return getSaleName($d);
            }
        ],
        ['db' => 'cast_sales_parent_no', 'dt' => 2, 'field'=> 'cast_sales_parent_no',
            'formatter' => function($d, $row){
                return getTeamName($d); 
            }
        ],
        ['db' => 'find_section', 'dt' => 3, 'field'=> 'find_section',
            'formatter' => function($d, $row){
                if(empty($d)){
                    return "ยังไม่ระบุ";
                } else {
                    return $d;
                }
            }
        ],
        ['db' => 'cast_year', 'dt' => 4, 'field'=> 'cast_year'],
        ['db' => 'cast_license', 'dt' => 5, 'field'=> 'cast_license'],
        ['db' => 'cast_color', 'dt' => 6, 'field'=> 'cast_color'],
        ['db' => 'cast_price', 'dt' => 7, 'field'=> 'cast_price',
            'formatter' => function($d, $row){
                return number_format($d);
            }
        ],
        ['db' => 'cast_status', 'dt' => 8, 'field'=> 'cast_status',
            'formatter' => function($d, $row){
                return "<span class=\"badge badge-danger\">ลบ</span>";
            }
        ],
        ['db' => 'cast_datetime', 'dt' => 9, 'field'=> 'cast_datetime',
            'formatter' => function($d, $row){
                return DateThai($d);
            }
        ],
        ['db' => 'cast_id', 'dt' => 10, 'field'=> 'cast_id',
            'formatter' => function($d, $row){
                return "<a href=\"/admin/detail/$d\" class=\"btn btn-outline-primary btn-sm\"><span class=\"mdi mdi-account-edit\"></span> แก้ไข</a>";
            }        
        ]
    ];

    $joinQuery = "FROM car_stock s LEFT JOIN finance_data f ON s.cast_car = f.find_id";
 
    $where = " s.cast_status = 10";

    if(isset($_GET['search']['value'])){
        $searchValue = $_GET['search']['value'];
        $joinQuery .= " AND (s.cast_id LIKE '%$searchValue%' OR s.cast_sales_parent_no LIKE '%$searchValue%' OR f.find_section LIKE '%$searchValue%' OR s.cast_year LIKE '%$searchValue%' OR s.cast_license LIKE '%$searchValue%' OR s.cast_color LIKE '%$searchValue%' OR s.cast_price LIKE '%$searchValue%' OR s.cast_status LIKE '%$searchValue%' OR s.cast_datetime LIKE '%$searchValue%')";
    }
    
    echo json_encode(
        SSP::simple($_GET, $sql_details_1, $table, $primaryKey, $columns, $joinQuery, $where)
    );
?> 