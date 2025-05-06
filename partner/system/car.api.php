<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $sql_details = ['user'=> $usern,'pass'=> $passn,'db'=> $dbn,'host'=> $hostn,'charset'=>'utf8'];
    require('ssp.class.php'); 

    function getName($id){
        $fin_name = $db->where('find_id',$id)->getOne('finance_data');
        return $fin_name['find_year'].' '.$fin_name['find_brand'].' '.$fin_name['find_serie'];
    }

    if($_GET['get'] == 'today'){

        $table = 'car_stock';

        $primaryKey = 'cast_id';
        $columns = [
            ['db' => 's.cast_id', 'dt' => 0, 'field' => 'cast_id'],
            ['db' => 'c.cari_link', 'dt' => 1, 'field' => 'cari_link',
                'formatter' => function($d, $row) {
                    return '<div class="overlay-sold" style="background-image: linear-gradient(rgba(255,0,0,0), rgba(255,0,0,0)), url('.$d.');"></div>';
                }
            ],
            ['db' => 'f.find_id', 'dt' => 2, 'field' => 'find_id',
                'formatter' => function($d, $row) {
                    //return $d;
                    return getName($d);
                }
            ],
            ['db' => 's.cast_year', 'dt' => 3, 'field' => 'cast_year'],
            ['db' => 's.cast_transmission', 'dt' => 4, 'field' => 'cast_transmission'],
            ['db' => 's.cast_mileage', 'dt' => 5, 'field' => 'cast_mileage',
                'formatter' => function($d, $row) {
                    return number_format($d).' กม.';
                }
            ],
            [
                'db' => 'cast_id',
                'dt' => 6,
                'field' => 'cast_id',
                'formatter' => function($d, $row) {
                    return '<a href="/pt/stock/'.base64_encode($d).'" class="btn btn-outline-primary btn-sm">ดูข้อมูล</a>';
                }
            ]
        ];
       
        $joinQuery = "FROM car_stock s
            INNER JOIN finance_data f
            ON s.cast_car = f.find_id";
        
        $joinQuery .= " INNER JOIN car_image c
            ON s.cast_id = c.cari_parent AND s.cast_link_public = '1' AND s.cast_status IN ('1','2')";
        
        $joinQuery .= " AND s.cast_datetime BETWEEN '".date('Y-m-d', strtotime(date('Y-m-d').' 00:00:00'.' -30 days'))."' AND '".date('Y-m-d 23:59:59')."'";
        $joinQuery .= " GROUP BY s.cast_id";

        echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery)
        );

    }
/*
    if($_GET['get'] == 'all'){

        $table = 'car_stock';

        $primaryKey = 'cast_id';
        $columns = [
            ['db' => 's.cast_id', 'dt' => 0, 'field' => 'cast_id'],
            ['db' => 'c.cari_link', 'dt' => 1, 'field' => 'cari_link',
                'formatter' => function($d, $row) {
                    return '<div class="overlay-sold" style="background-image: linear-gradient(rgba(255,0,0,0), rgba(255,0,0,0)), url('.$d.');"></div>';
                }
            ],
            ['db' => 'f.find_section', 'dt' => 2, 'field' => 'find_section',
                'formatter' => function($d, $row) {
                    return $d;
                }
            ],
            ['db' => 's.cast_year', 'dt' => 3, 'field' => 'cast_year'],
            ['db' => 's.cast_transmission', 'dt' => 4, 'field' => 'cast_transmission'],
            ['db' => 's.cast_mileage', 'dt' => 5, 'field' => 'cast_mileage',
                'formatter' => function($d, $row) {
                    return number_format($d).' กม.';
                }
            ],
            [
                'db' => 'cast_id',
                'dt' => 6,
                'field' => 'cast_id',
                'formatter' => function($d, $row) {
                    return '<a href="/pt/stock/'.base64_encode($d).'" class="btn btn-outline-primary btn-sm">ดูข้อมูล</a>';
                }
            ]
        ];
        $joinQuery = "FROM car_stock s
            INNER JOIN finance_data f
            ON s.cast_car = f.find_id";

        $joinQuery .= " INNER JOIN car_image c
            ON s.cast_id = c.cari_parent AND s.cast_link_public = '1' AND s.cast_status = '1' AND s.cast_status IN ('1','2','4')";


        $joinQuery .= "GROUP BY s.cast_id";

        echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery)
        );

    }
*/

   
