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

    function thumb($uid){
        global $db;
        $thumb = $db->where('cari_parent', $uid)->where('cari_status',1)->getOne('car_image', null,'cari_link');
        if(empty($thumb)){
            return '<img src="https://dummyimage.com/600x400/c4c4c4/fff&amp;text=no-image" class="car-thumb">';
        }else {
            return "<img src=\"" . $thumb['cari_link'] . "\" class=\"car-thumb\">";
        }
    }
    
    $sql_details = ['user'=> $usern,'pass'=> $passn,'db'=> $dbn,'host'=> $hostn,'charset'=>'utf8'];
    
    require 'ssp.class.php';

    $table = 'customer_data';

    $primaryKey = 'cust_id';
    $columns = [
        ['db' => 'cust_id', 'dt' => 0, 'field' => 'cust_id'],
        ['db' => 'cust_parent', 'dt' => 1, 'field' => 'cust_parent',
            'formatter' => function($d, $row){
                return thumb($d);
            }],
        ['db' => 'cust_parent', 'dt' => 2, 'field' => 'cust_parent',
            'formatter' => function($d, $row){
                return '<a href="/admin/detail/'.$d.'" target="_blank">'.$d.'</a>';
            }],
        ['db' => 'cust_name', 'dt' => 3, 'field'=> 'cust_name'],
        ['db' => 'cust_detail', 'dt' => 4, 'field'=> 'cust_detail'],
        ['db' => 'cust_tel', 'dt' => 5, 'field'=> 'cust_tel'],
        ['db' => 'cust_line', 'dt' => 6, 'field'=> 'cust_line'],
        ['db' => 'cust_status', 'dt' => 7, 'field'=> 'cust_status',
            'formatter' => function($d, $row) {
                if($d == 1){
                    return '<span class="badge badge-success">HOT</span>';
                }elseif($d == 2){
                    return '<span class="badge badge-primary">WORM</span>';
                }elseif($d == 3){
                    return '<span class="badge badge-info">COOL</span>';
                }
            }
        ],
        ['db' => 'cust_datetime', 'dt' => 8, 'field'=> 'cust_datetime',
            'formatter' => function($d, $row) {
                return DateThai($d);
            }
        ],
        ['db' => 'cust_id', 'dt' => 9, 'field'=> 'cust_id',
            'formatter' => function($d, $row) {
                return '<button class="btn btn-outline-primary btn-sm" @click="editCust('.$d.')" data-toggle="modal" data-target="#editModal">แก้ไข</button> <button class="btn btn-outline-danger btn-sm" @click="deleteCust">ลบ</button>';
            }
        ]
    ];

    echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    );
?>