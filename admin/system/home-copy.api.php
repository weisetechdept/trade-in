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
        return $sale['first_name'];
    }

    function thumb($uid){
        global $db;
        $thumb = $db->where('cari_id ', $uid)->getOne('car_image', null,'cari_link');
        if(empty($thumb)){
            return '<img src="https://dummyimage.com/600x400/c4c4c4/fff&amp;text=no-image" class="car-thumb">';
        }else {
            return "<img src=\"" . $thumb['cari_link'] . "\" class=\"car-thumb\">";
        }
    }

    function getBrandSerie($uid){
        global $db;
        $brand = $db->where('find_id', $uid)->getOne('finance_data', null,'find_brand ,find_serie');
        return $brand['find_brand'].' '.$brand['find_serie'];
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
        ['db' => 'cast_thumb', 'dt' => 1, 'field' => 'cast_thumb',
            'formatter' => function($d, $row){
                return thumb($d);
            }
        ],
        ['db' => 'cast_sales_parent_no', 'dt' => 2, 'field'=> 'cast_sales_parent_no',
            'formatter' => function($d, $row){
                return getSaleName($d);
            }
        ],
        ['db' => 'cast_sales_parent_no', 'dt' => 3, 'field'=> 'cast_sales_parent_no',
            'formatter' => function($d, $row){
                return getTeamName($d); 
            }
        ],
        ['db' => 'cast_pv', 'dt' => 4, 'field'=> 'cast_pv',
            'formatter' => function($d, $row){
                if(empty($d)){
                    return "ยังไม่ระบุ";
                } else {
                    return $d; 
                }
                
            }
        ],
        ['db' => 'find_id', 'dt' => 5, 'field'=> 'find_id',
            'formatter' => function($d, $row){
                if(empty($d)){
                    return "ยังไม่ระบุ";
                } else {
                    return getBrandSerie($d);
                }
            }
        ],
        ['db' => 'cast_year', 'dt' => 6, 'field'=> 'cast_year'],
        ['db' => 'cast_license', 'dt' => 7, 'field'=> 'cast_license'],
        
        ['db' => 'cast_trade_price', 'dt' => 8, 'field'=> 'cast_trade_price',
            'formatter' => function($d, $row){
                return number_format($d);
            }
        ],

        ['db' => 'cast_car', 'dt' => 9, 'field'=> 'cast_car',
            'formatter' => function($d, $row){
                return getTLTPrice($d);
            }
        ],

        ['db' => 'cast_price', 'dt' => 10, 'field'=> 'cast_price',
            'formatter' => function($d, $row){
                return number_format($d);
            }
        ],
        ['db' => 'cast_id', 'dt' => 11, 'field'=> 'cast_id',
            'formatter' => function($d, $row){
                return '<a href="/admin/detail/'.$d.'" target="_blank">'.getOfferPrice($d).'</a>';
            }
        ],
        ['db' => 'cast_id', 'dt' => 12, 'field'=> 'cast_id',
            'formatter' => function($d, $row){
                return '<a href="/admin/detail/'.$d.'" target="_blank">'.countOffer($d).'</a>';
            }
        ],
        ['db' => 'cast_car_check', 'dt' => 13, 'field'=> 'cast_car_check',
            'formatter' => function($d, $row){
                if($d == 0){
                    return "<span class=\"badge badge-soft-warning\">ยังไม่ตรวจ</span>";
                } else {
                    return "<span class=\"badge badge-soft-success\">ตรวจแล้ว</span>";
                }
            }
        ],
        ['db' => 'cast_status', 'dt' => 14, 'field'=> 'cast_status',
            'formatter' => function($d, $row){
                if($d == 0){
                    return "<span class=\"badge badge-soft-unknow\">ไม่มีสถานะ</span>";
                } elseif($d == 1){
                    return "<span class=\"badge badge-soft-primary\">ติดตามลูกค้า</span>";
                } elseif($d == 2){
                    return "<span class=\"badge badge-soft-warning\">ไม่ได้สัมผัสรถ</span>";
                } elseif($d == 3){
                    return "<span class=\"badge badge-soft-info\">ลูกค้าขายเอง / ขายที่อื่น</span>";
                } elseif($d == 4){
                    return "<span class=\"badge badge-soft-success\">สำเร็จ</span>";
                } elseif($d == 10) {
                    return "<span class=\"badge badge-soft-danger\">ลบ</span>";
                }
            }
        ],
        ['db' => 'cast_datetime', 'dt' => 15, 'field'=> 'cast_datetime',
            'formatter' => function($d, $row){
                return DateThai($d);
            }
        ],
        ['db' => 'cast_id', 'dt' => 16, 'field'=> 'cast_id',
            'formatter' => function($d, $row){
                return "<a href=\"/admin/detail/$d\"  target=\"_blank\" class=\"btn btn-outline-primary btn-sm mr-2\"><span class=\"mdi mdi-account-edit\"></span> แก้ไข</a>
                <button data-ecard=\"$d\" class=\"btn btn-outline-success btn-sm ecard-btn\">e-card</button>";
            }        
        ]
    ];

    $joinQuery = "FROM car_stock s LEFT JOIN finance_data f ON s.cast_car = f.find_id";
    
    $where = " s.cast_status IN (0,1,2,3,4)";

    if(isset($_GET['search']['value'])){
        $searchValue = $_GET['search']['value'];
        $joinQuery .= " AND (s.cast_id LIKE '%$searchValue%' OR s.cast_sales_parent_no LIKE '%$searchValue%' OR f.find_section LIKE '%$searchValue%' OR s.cast_year LIKE '%$searchValue%' OR s.cast_license LIKE '%$searchValue%' OR s.cast_color LIKE '%$searchValue%' OR s.cast_price LIKE '%$searchValue%' OR s.cast_status LIKE '%$searchValue%' OR s.cast_datetime LIKE '%$searchValue%')";
    }
    
    echo json_encode(
        SSP::simple($_GET, $sql_details_1, $table, $primaryKey, $columns, $joinQuery, $where)
    );
?>