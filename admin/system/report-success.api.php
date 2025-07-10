<?php 
session_start();
require_once '../../db-conn.php';
date_default_timezone_set("Asia/Bangkok");

if($_SESSION['tin_admin'] != true){
    echo json_encode(array('error' => 'Unauthorized access'));
    exit();
} else {
    // Disable error display and enable error logging
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);

    // Debug: Log all incoming parameters
    error_log("=== Search Debug ===");
    error_log("GET parameters: " . json_encode($_GET));

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
            $detail = json_decode($t['detail'], true);
            $leader = json_decode($t['leader'], true);
            $tm = array_merge(
                is_array($detail) ? $detail : [],
                is_array($leader) ? $leader : []
            );
            if(in_array($uid, $tm)){
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

    // Helper functions สำหรับการค้นหา
    function getSalesIdsByName($searchValue) {
        global $db_nms;
        $sales = $db_nms->where('first_name', '%'.$searchValue.'%', 'LIKE')->get('db_member', null, 'id');
        $ids = [];
        foreach($sales as $sale) {
            $ids[] = $sale['id'];
        }
        return $ids;
    }

    function getTeamMemberIdsByTeamName($searchValue) {
        global $db_nms;
        $teams = $db_nms->where('name', '%'.$searchValue.'%', 'LIKE')->get('db_user_group', null, 'detail,leader');
        $memberIds = [];
        
        foreach($teams as $team) {
            $detail = json_decode($team['detail'], true);
            $leader = json_decode($team['leader'], true);
            if(is_array($detail)) $memberIds = array_merge($memberIds, $detail);
            if(is_array($leader)) $memberIds = array_merge($memberIds, $leader);
        }
        
        return array_unique($memberIds);
    }

    function getPartnerIdsByName($searchValue) {
        global $db;
        $partners = $db->where('part_fname', '%'.$searchValue.'%', 'LIKE')
                      ->orWhere('part_lname', '%'.$searchValue.'%', 'LIKE')
                      ->get('partner', null, 'part_id');
        $ids = [];
        foreach($partners as $partner) {
            $ids[] = $partner['part_id'];
        }
        return $ids;
    }

    $sql_details_1 = ['user'=> $usern,'pass'=> $passn,'db'=> $dbn,'host'=> $hostn,'charset'=>'utf8'];

    require 'ssp.class.php';
    $table = 'car_stock';

    $primaryKey = 'cast_id';
    
    // แก้ไข columns ให้ตรงกับ HTML order
    $columns = [
        // 0: รหัส
        ['db' => 'cast_id', 'dt' => 0, 'field' => 'cast_id',
            'formatter' => function($d, $row){
                return "<a href=\"/admin/detail/$d\" target=\"_blank\">$d</a>";
            }
        ],

        ['db' => 'cast_id', 'dt' => 1, 'field'=> 'cast_id',
            'formatter' => function($d, $row){
                return "<button data-ecard=\"$d\" class=\"btn btn-outline-success btn-sm ecard-btn\">+ ข้อมูล</button> <a href=\"/admin/detail/$d\" target=\"_blank\" class=\"btn btn-outline-primary btn-sm mr-2 ml-2\">ดู</a>";
            }
        ],
        // 1: รูป  
        ['db' => 'cast_id', 'dt' => 2, 'field' => 'cast_id',
            'formatter' => function($d, $row){
                return thumb($d);
            }
        ],
        // 2: แบบรุ่น
        ['db' => 'CONCAT(IFNULL(f.find_brand,""), " ", IFNULL(f.find_serie,""))', 'dt' => 3, 'field' => 'brand_serie', 'as' => 'brand_serie',
            'formatter' => function($d, $row){
                return $d;
            }
        ],
        // 3: ปีรุ่น
        ['db' => 'find_year', 'dt' => 4, 'field'=> 'find_year'],
        // 4: สี
        ['db' => 'cast_color', 'dt' => 5, 'field'=> 'cast_color'],
        // 5: เซลล์ - เก็บ ID และชื่อ
        ['db' => 'cast_sales_parent_no', 'dt' => 6, 'field'=> 'cast_sales_parent_no',
            'formatter' => function($d, $row){
                return getSaleName($d); 
            }
        ],
        // 6: ทีม - เก็บ ID และชื่อ
        ['db' => 'cast_sales_parent_no', 'dt' => 7, 'field'=> 'cast_sales_parent_no',
            'formatter' => function($d, $row){
                return getTeamName($d); 
            }
        ],
        // 7: ตั้งขาย
        ['db' => 'cast_trade_price', 'dt' => 8, 'field'=> 'cast_trade_price',
            'formatter' => function($d, $row){
                return number_format($d);
            }
        ],
        // 8: จัด TLT
        ['db' => 'find_price', 'dt' => 9, 'field'=> 'find_price',
            'formatter' => function($d, $row){
                if(empty($d)){
                    return "ไม่มี";
                } else {
                    return number_format($d);
                }
            }
        ],
        // 9: รับได้
        ['db' => 'cast_price', 'dt' => 10, 'field'=> 'cast_price',
            'formatter' => function($d, $row){
                return number_format($d);
            }
        ],
        // 10: เสนอราคา
        ['db' => 'cast_id', 'dt' => 11, 'field'=> 'cast_id',
            'formatter' => function($d, $row){
                return getOfferPrice($d);
            }
        ],
        // 11: เสนอ (จำนวน)
        ['db' => 'cast_id', 'dt' => 12, 'field'=> 'cast_id',
            'formatter' => function($d, $row){
                return countOffer($d);
            }
        ],
        // 12: ผู้ซื้อ
        ['db' => 'succ_partner', 'dt' => 13, 'field'=> 'succ_partner',
            'formatter' => function($d, $row){
                if(empty($d)){
                    return '-';
                } else {
                    return getBuyerName($d);
                }
            }
        ],
        // 13: ราคา
        ['db' => 'succ_price', 'dt' => 14, 'field'=> 'succ_price',
            'formatter' => function($d, $row){
                if(empty($d)){
                    return '-';
                } else {
                    return number_format($d);
                }
            }
        ],
        // 14: ค่าคอม
        ['db' => 'succ_commission', 'dt' => 15, 'field'=> 'succ_commission',
            'formatter' => function($d, $row){
                if(empty($d)){
                    return '-';
                } else {
                    return number_format($d);
                }
            }
        ],
        // 15: สถานะรอง
        ['db' => 'succ_newcar', 'dt' => 16, 'field'=> 'succ_newcar',
            'formatter' => function($d, $row){
                if(empty($d)){
                    return '-';
                } else {
                    return getSubStatus($d);
                }
            }
        ],
        // 16: หมายเหตุ
        ['db' => 'succ_comment', 'dt' => 17, 'field'=> 'succ_comment',
            'formatter' => function($d, $row){
                if(empty($d)){
                    return '-';
                } else {
                    return htmlspecialchars(mb_substr($d, 0, 50, 'UTF-8'), ENT_QUOTES, 'UTF-8');
                }
            }
        ],

        ['db' => 'succ_date', 'dt' => 18, 'field'=> 'succ_date',
            'formatter' => function($d, $row){
                if($d == '' || $d == '0000-00-00' || empty($d)){
                    return '-';
                } else {
                    return DateThai($d);
                }
            }
        ],
        // 18: RS
        ['db' => 'succ_newcar_rs', 'dt' => 19, 'field'=> 'succ_newcar_rs',
            'formatter' => function($d, $row){
                if($d == '' || $d == '0' || empty($d)){
                    return '✕';
                } else {
                    return '✓';
                }
            }
        ]
        
    ];

    $joinQuery = "FROM car_stock s 
        LEFT JOIN finance_data f ON s.cast_car = f.find_id 
        LEFT JOIN success sc ON s.cast_id = sc.succ_parent";

    $where = " s.cast_status IN ($show) ";

    // Handle global search
    if(isset($_GET['search']['value']) && !empty($_GET['search']['value'])){
        $searchValue = mysqli_real_escape_string($db->mysqli, $_GET['search']['value']);
        $where .= " AND (s.cast_id LIKE '%$searchValue%' 
            OR s.cast_sales_parent_no LIKE '%$searchValue%' 
            OR f.find_brand LIKE '%$searchValue%' 
            OR f.find_serie LIKE '%$searchValue%' 
            OR s.cast_color LIKE '%$searchValue%' 
            OR s.cast_price LIKE '%$searchValue%' 
            OR s.cast_status LIKE '%$searchValue%' 
            OR s.cast_datetime LIKE '%$searchValue%')";
    }

    // Handle individual column search - แก้ไข index ให้ตรงกับ HTML
    if(isset($_GET['columns'])){
        foreach($_GET['columns'] as $i => $column){
            if(!empty($column['search']['value'])){
                $searchValue = mysqli_real_escape_string($db->mysqli, $column['search']['value']);
                
                switch($i){
                    case 0: // รหัส
                        $where .= " AND s.cast_id LIKE '%$searchValue%'";
                        break;
                    case 3: // แบบรุ่น
                        $where .= " AND (f.find_brand LIKE '%$searchValue%' 
                            OR f.find_serie LIKE '%$searchValue%' 
                            OR CONCAT(IFNULL(f.find_brand,''), ' ', IFNULL(f.find_serie,'')) LIKE '%$searchValue%')";
                        break;
                    case 4: // ปีรุ่น
                        $where .= " AND f.find_year LIKE '%$searchValue%'";
                        break;
                    case 5: // สี
                        $where .= " AND s.cast_color LIKE '%$searchValue%'";
                        break;
                    case 6: // เซลล์ - ค้นหาผ่าน PHP function
                        $salesIds = getSalesIdsByName($searchValue);
                        if(!empty($salesIds)) {
                            $salesIdList = implode(',', array_map('intval', $salesIds));
                            $where .= " AND s.cast_sales_parent_no IN ($salesIdList)";
                        } else {
                            $where .= " AND s.cast_sales_parent_no = -1"; // ไม่พบเซลล์
                        }
                        break;
                    case 7: // ทีม - ค้นหาผ่าง PHP function
                        $teamMemberIds = getTeamMemberIdsByTeamName($searchValue);
                        if(!empty($teamMemberIds)) {
                            $memberIdList = implode(',', array_map('intval', $teamMemberIds));
                            $where .= " AND s.cast_sales_parent_no IN ($memberIdList)";
                        } else {
                            $where .= " AND s.cast_sales_parent_no = -1"; // ไม่พบทีม
                        }
                        break;
                    case 8: // ตั้งขาย
                        $numericSearch = str_replace(',', '', $searchValue);
                        if(is_numeric($numericSearch)) {
                            $where .= " AND s.cast_trade_price = '$numericSearch'";
                        } else {
                            $where .= " AND s.cast_trade_price LIKE '%$searchValue%'";
                        }
                        break;
                    case 9: // จัด TLT
                        $numericSearch = str_replace(',', '', $searchValue);
                        if(is_numeric($numericSearch)) {
                            $where .= " AND f.find_price = '$numericSearch'";
                        } else {
                            $where .= " AND f.find_price LIKE '%$searchValue%'";
                        }
                        break;
                    case 10: // รับได้
                        $numericSearch = str_replace(',', '', $searchValue);
                        if(is_numeric($numericSearch)) {
                            $where .= " AND s.cast_price = '$numericSearch'";
                        } else {
                            $where .= " AND s.cast_price LIKE '%$searchValue%'";
                        }
                        break;
                    case 11: // เสนอราคา - ค้นหาในตาราง offer
                        $numericSearch = str_replace(',', '', $searchValue);
                        if($searchValue === 'ไม่มี') {
                            $where .= " AND s.cast_id NOT IN (SELECT DISTINCT off_parent FROM offer)";
                        } elseif(is_numeric($numericSearch)) {
                            $where .= " AND s.cast_id IN (SELECT off_parent FROM offer WHERE off_price = '$numericSearch')";
                        } else {
                            $where .= " AND s.cast_id IN (SELECT off_parent FROM offer WHERE off_price LIKE '%$numericSearch%')";
                        }
                        break;
                    case 12: // เสนอ (จำนวน)
                        if(is_numeric($searchValue)) {
                            $where .= " AND (SELECT COUNT(*) FROM offer WHERE off_parent = s.cast_id) = $searchValue";
                        }
                        break;
                    case 13: // ผู้ซื้อ - ค้นหาผ่าน PHP function
                        $partnerIds = getPartnerIdsByName($searchValue);
                        if(!empty($partnerIds)) {
                            $partnerIdList = implode(',', array_map('intval', $partnerIds));
                            $where .= " AND sc.succ_partner IN ($partnerIdList)";
                        } else {
                            $where .= " AND sc.succ_partner = -1"; // ไม่พบผู้ซื้อ
                        }
                        break;
                    case 14: // ราคา
                        $numericSearch = str_replace(',', '', $searchValue);
                        if(is_numeric($numericSearch)) {
                            $where .= " AND sc.succ_price = '$numericSearch'";
                        } else {
                            $where .= " AND sc.succ_price LIKE '%$searchValue%'";
                        }
                        break;
                    case 15: // ค่าคอม
                        $numericSearch = str_replace(',', '', $searchValue);
                        if(is_numeric($numericSearch)) {
                            $where .= " AND sc.succ_commission = '$numericSearch'";
                        } else {
                            $where .= " AND sc.succ_commission LIKE '%$searchValue%'";
                        }
                        break;
                    case 16: // สถานะรอง
                        $where .= " AND sc.succ_newcar = '$searchValue'";
                        break;
                    case 17: // หมายเหตุ
                        $where .= " AND sc.succ_comment LIKE '%$searchValue%'";
                        break;
                    case 18: // วันที่จบ
                        $where .= " AND sc.succ_date LIKE '%$searchValue%'";
                        break;
                    case 19: // RS
                        $where .= " AND sc.succ_newcar_rs = '$searchValue'";
                        break;
                }
            }
        }
    }

    // Debug: Log the final query for troubleshooting
    error_log("Final WHERE clause: " . $where);

    echo json_encode(
        SSP::simple($_GET, $sql_details_1, $table, $primaryKey, $columns, $joinQuery, $where)
    );

    // Debug log สำหรับ development
    if (isset($_GET['debug'])) {
        error_log("Search WHERE clause: " . $where);
        error_log("Search parameters: " . json_encode($_GET));
    }
}