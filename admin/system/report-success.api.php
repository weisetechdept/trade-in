<?php 
session_start();
require_once '../../db-conn.php';
date_default_timezone_set("Asia/Bangkok");

if($_GET['show'] == '0'){
    $show = '0';
} elseif($_GET['show'] == '1'){
    $show = '1';
} elseif($_GET['show'] == '2'){
    $show = '2';
} elseif($_GET['show'] == '3'){
    $show = '3';
} elseif($_GET['show'] == '4'){
    $show = '4';
} else {
    $show = '0,1,2,3,4';
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

function getBuyerName($uid){
    global $db;
    $db->join('partner_bus b', 'p.part_bus_id = b.busi_id', 'LEFT');
    $buyer = $db->where('part_id', $uid)->getOne('partner p', null,'part_fname, part_lname');
    if($buyer) {
        return $buyer['part_fname'].' '.$buyer['part_lname'];
    }
    return '-';
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
    return '-';
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
    if(empty($brand)){
        return 'Unknown';
    } else {
        return $brand['find_brand'].' '.$brand['find_serie'];
    }
}

function getSubStatus($st) {
    if($st == 1) {
        return "<span class=\"badge badge-soft-unknow\">จบรถเก่า / จองรถใหม่</span>";
    } elseif ($st == 2) {
        return "<span class=\"badge badge-soft-primary\">จบรถเก่า / ไม่จองรถใหม่</span>";
    } elseif ($st == 3) {
        return "<span class=\"badge badge-soft-warning\">ไม่จบรถเก่า / ไม่จองรถใหม่</span>";
    } elseif ($st == 4) {
        return "<span class=\"badge badge-soft-info\">ไม่จบรถเก่า / จองรถใหม่</span>";
    } 
    return '-';
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
            if(empty($d)){
                return '-';
            } else {
                return $d;
            }
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
    ['db' => 'cast_trade_price', 'dt' => 7, 'field'=> 'cast_trade_price',
        'formatter' => function($d, $row){
            return number_format($d);
        }
    ],
    ['db' => 'cast_car', 'dt' => 8, 'field'=> 'cast_car',
        'formatter' => function($d, $row){
            return getTLTPrice($d);
        }
    ],
    ['db' => 'cast_price', 'dt' => 9, 'field'=> 'cast_price',
        'formatter' => function($d, $row){
            return number_format($d);
        }
    ],
    ['db' => 'cast_id', 'dt' => 10, 'field'=> 'cast_id',
        'formatter' => function($d, $row){
            return getOfferPrice($d);
        }
    ],
    ['db' => 'cast_id', 'dt' => 11, 'field'=> 'cast_id',
        'formatter' => function($d, $row){
            return countOffer($d);
        }
    ],
    ['db' => 'succ_partner', 'dt' => 12, 'field'=> 'succ_partner',
        'formatter' => function($d, $row){
            if(empty($d)){
                return '-';
            } else {
                return getBuyerName($d);
            }
        }
    ],
    ['db' => 'succ_price', 'dt' => 13, 'field'=> 'succ_price',
        'formatter' => function($d, $row){
            if(empty($d)){
                return '-';
            } else {
                return number_format($d);
            }
        }
    ],
    ['db' => 'succ_commission', 'dt' => 14, 'field'=> 'succ_commission',
        'formatter' => function($d, $row){
            if(empty($d)){
                return '-';
            } else {
                return number_format($d);
            }
        }
    ],
    ['db' => 'succ_newcar', 'dt' => 15, 'field'=> 'succ_newcar',
        'formatter' => function($d, $row){
            if(empty($d)){
                return '-';
            } else {
                return getSubStatus($d);
            }
        }
    ],
    ['db' => 'succ_comment', 'dt' => 16, 'field'=> 'succ_comment',
        'formatter' => function($d, $row){
            if(empty($d)){
                return '-';
            } else {
                return $d;
            }
        }
    ],
    ['db' => 'succ_date', 'dt' => 17, 'field'=> 'succ_date',
        'formatter' => function($d, $row){
            if($d == '' || $d == '0000-00-00' || empty($d)){
                return '-';
            } else {
                return DateThai($d);
            }
        }
    ],
    ['db' => 'succ_newcar_rs', 'dt' => 18, 'field'=> 'succ_newcar_rs',
        'formatter' => function($d, $row){
            if($d == '' || $d == '0' || empty($d)){
                return '✕';
            } else {
                return '✓';
            }
        }
    ],
    ['db' => 'cast_id', 'dt' => 19, 'field'=> 'cast_id',
        'formatter' => function($d, $row){
            return "<button data-ecard=\"$d\" class=\"btn btn-outline-success btn-sm ecard-btn\">+ ข้อมูล</button> <a href=\"/admin/detail/$d\"  target=\"_blank\" class=\"btn btn-outline-primary btn-sm mr-2 ml-2\">ดู</a>";
        }        
    ]
];

$joinQuery = "FROM car_stock s LEFT JOIN finance_data f ON s.cast_car = f.find_id";
$joinQuery .= " LEFT JOIN success sc ON s.cast_id = sc.succ_parent";

$where = " s.cast_status IN ($show) ";

// Handle global search
if(isset($_GET['search']['value']) && !empty($_GET['search']['value'])){
    $searchValue = $_GET['search']['value'];
    $where .= " AND (s.cast_id LIKE '%$searchValue%' OR s.cast_sales_parent_no LIKE '%$searchValue%' OR f.find_section LIKE '%$searchValue%' OR s.cast_year LIKE '%$searchValue%' OR s.cast_license LIKE '%$searchValue%' OR s.cast_color LIKE '%$searchValue%' OR s.cast_price LIKE '%$searchValue%' OR s.cast_status LIKE '%$searchValue%' OR s.cast_datetime LIKE '%$searchValue%')";
}

// Handle individual column search
if(isset($_GET['columns'])){
    foreach($_GET['columns'] as $i => $column){
        if(!empty($column['search']['value'])){
            $searchValue = $column['search']['value'];
            
            switch($i){
                case 0: // รหัส
                    $where .= " AND s.cast_id LIKE '%$searchValue%'";
                    break;
                case 2: // แบบรุ่น
                    $where .= " AND (f.find_brand LIKE '%$searchValue%' OR f.find_serie LIKE '%$searchValue%')";
                    break;
                case 3: // ปีรุ่น
                    $where .= " AND f.find_year LIKE '%$searchValue%'";
                    break;
                case 4: // สี
                    $where .= " AND s.cast_color LIKE '%$searchValue%'";
                    break;
                case 5: // เซลล์ - ต้องค้นหาจากชื่อ member
                    $where .= " AND s.cast_sales_parent_no IN (SELECT id FROM " . $dbn . ".db_member WHERE first_name LIKE '%$searchValue%')";
                    break;
                case 6: // ทีม - ต้องค้นหาจากชื่อทีม
                    $where .= " AND s.cast_sales_parent_no IN (SELECT JSON_UNQUOTE(JSON_EXTRACT(detail, '$[*]')) FROM " . $dbn . ".db_user_group WHERE name LIKE '%$searchValue%')";
                    break;
                case 7: // ตั้งขาย
                    $where .= " AND s.cast_trade_price LIKE '%$searchValue%'";
                    break;
                case 8: // จัด TLT
                    $where .= " AND f.find_price LIKE '%$searchValue%'";
                    break;
                case 9: // รับได้
                    $where .= " AND s.cast_price LIKE '%$searchValue%'";
                    break;
                case 10: // เสนอราคา
                    $where .= " AND s.cast_id IN (SELECT off_parent FROM offer WHERE off_price LIKE '%$searchValue%')";
                    break;
                case 11: // เสนอ (จำนวน)
                    // ค้นหาตาม count ของ offer
                    break;
                case 12: // ผู้ซื้อ
                    $where .= " AND sc.succ_partner IN (SELECT part_id FROM partner WHERE part_fname LIKE '%$searchValue%' OR part_lname LIKE '%$searchValue%')";
                    break;
                case 13: // ราคา
                    $where .= " AND sc.succ_price LIKE '%$searchValue%'";
                    break;
                case 14: // ค่าคอม
                    $where .= " AND sc.succ_commission LIKE '%$searchValue%'";
                    break;
                case 15: // สถานะรอง
                    $where .= " AND sc.succ_newcar = '$searchValue'";
                    break;
                case 16: // หมายเหตุ
                    $where .= " AND sc.succ_comment LIKE '%$searchValue%'";
                    break;
                case 17: // วันที่จบ
                    $where .= " AND sc.succ_date LIKE '%$searchValue%'";
                    break;
                case 18: // RS
                    $where .= " AND sc.succ_newcar_rs = '$searchValue'";
                    break;
            }
        }
    }
}

echo json_encode(
    SSP::simple($_GET, $sql_details_1, $table, $primaryKey, $columns, $joinQuery, $where)
);