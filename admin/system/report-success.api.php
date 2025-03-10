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
        $sale = $db_nms->where('id', $uid)->getOne('db_member', null,'first_name');
        return $sale ? $sale['first_name'] : 'Unknown';
    }

    function thumb($uid){
        global $db;
        $thumb = $db->where('cari_parent', $uid)->where('cari_group',1)->getOne('car_image', null,'cari_link');
        if(empty($thumb)){
            return '<img src="https://dummyimage.com/600x400/c4c4c4/fff&amp;text=no-image" class="car-thumb">';
        } else {
            return "<img src=\"" . $thumb['cari_link'] . "\" class=\"car-thumb\">";
        }
    }

    function getBrandSerie($uid){
        global $db;
        $brand = $db->where('find_id', $uid)->getOne('finance_data', null,'find_brand ,find_serie');
        return $brand['find_brand'].' '.$brand['find_serie'];
    }

    
    $sql_details_1 = ['user'=> $usern,'pass'=> $passn,'db'=> $dbn,'host'=> $hostn,'charset'=>'utf8'];
    
    require 'ssp.class.php';
    $table = 'car_stock';

    $primaryKey = 'cast_id';
    $columns = [
        ['db' => 'cast_id', 'dt' => 0, 'field' => 'cast_id',
            'formatter' => function($d, $row){
                return $d;
            }
        ],
        ['db' => 'cast_id', 'dt' => 1, 'field' => 'cast_id',
            'formatter' => function($d, $row){
                return thumb($d);
            }
        ],
        ['db' => 'cast_car', 'dt' => 2, 'field' => 'cast_car',
            'formatter' => function($d, $row){
                return getBrandSerie($d);
            }
        ],
        ['db' => 'find_year', 'dt' => 3, 'field'=> 'find_year',
            'formatter' => function($d, $row){
                return $d;
            }
        ],
        ['db' => 'cast_color', 'dt' => 4, 'field'=> 'cast_color',
            'formatter' => function($d, $row){
                return $d; 
            }
        ],
        ['db' => 'cast_sales_parent_no', 'dt' => 5, 'field'=> 'cast_sales_parent_no',
            'formatter' => function($d, $row){
                return getSaleName($d); 
            }
        ],
        ['db' => 'cast_sales_parent_no', 'dt' => 6, 'field'=> 'cast_sales_parent_no',
            'formatter' => function($d, $row){
                return getTeamName($d); 
            }
        ],
        ['db' => 'cast_datetime', 'dt' => 7, 'field'=> 'cast_datetime',
            'formatter' => function($d, $row){
                return DateThai($d); 
            }
        ],
        ['db' => 'cast_id', 'dt' => 8, 'field'=> 'cast_id',
            'formatter' => function($d, $row){
                return "<button data-ecard=\"$d\" class=\"btn btn-outline-success btn-sm ecard-btn\"><span class=\"mdi mdi-account-edit\"></span> เพิ่มข้อมูลขาย</button> <a href=\"/admin/detail/$d\"  target=\"_blank\" class=\"btn btn-outline-primary btn-sm mr-2\"><span class=\"mdi mdi-account-edit\"></span> ข้อมูล</a>";
            }        
        ]
    ];

    // $db->join('finance_data f', 's.cast_car = f.find_id', 'LEFT');
    // $db->groupBy('cast_id');
    // $success = $db->where('cast_status', 4)->get('car_stock s');

    // $api = array();

    // foreach($success as $value) {
    //     $api['data'][] = array(
    //         $value['cast_id'],
    //         $value['find_brand'],
    //         isset($value['find_year']) ? $value['find_year'] : 'ไม่มีข้อมูล',
    //         isset($value['find_color']) ? $value['find_color'] : 'ไม่มีข้อมูล',
    //         date('d/m/Y', strtotime($value['cast_datetime'])),
    //     );
    // }

    $joinQuery = "FROM car_stock s LEFT JOIN finance_data f ON s.cast_car = f.find_id";
    
    $where = " s.cast_status IN (4)";

    if(isset($_GET['search']['value'])){
        $searchValue = $_GET['search']['value'];
        $joinQuery .= " AND (s.cast_id LIKE '%$searchValue%' OR s.cast_sales_parent_no LIKE '%$searchValue%' OR f.find_section LIKE '%$searchValue%' OR s.cast_year LIKE '%$searchValue%' OR s.cast_license LIKE '%$searchValue%' OR s.cast_color LIKE '%$searchValue%' OR s.cast_price LIKE '%$searchValue%' OR s.cast_status LIKE '%$searchValue%' OR s.cast_datetime LIKE '%$searchValue%')";
    }
    
    echo json_encode(
        SSP::simple($_GET, $sql_details_1, $table, $primaryKey, $columns, $joinQuery, $where)
    );