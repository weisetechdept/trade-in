<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $sql_details = ['user'=> $usern,'pass'=> $passn,'db'=> $dbn,'host'=> $hostn,'charset'=>'utf8'];
    require('ssp.class.php');

        $table = 'offer';

        $primaryKey = 'off_id';
        $columns = [
            
            ['db' => 'o.off_id', 'dt' => 0, 'field' => 'off_id'],
            ['db' => 'i.cari_link', 'dt' => 1, 'field' => 'cari_link',
                'formatter' => function($d, $row) {
                    return '<div class="overlay-sold" style="background-image: linear-gradient(rgba(255,0,0,0), rgba(255,0,0,0)), url('.$d.');"></div>';
                }
            ],
            ['db' => 'o.off_price', 'dt' => 2, 'field' => 'off_price',
                'formatter' => function($d, $row) {
                    return number_format($d);
                }
            ],
            ['db' => 'o.off_id', 'dt' => 3, 'field' => 'off_id',
                'formatter' => function($d, $row) {
                    return '<a href="/pt/stock/'.base64_encode($d).'" class="btn btn-outline-primary btn-sm">ดูข้อมูล</a>';
                }
            ]
        ];

        $joinQuery = "FROM offer o
        INNER JOIN partner p
        ON o.off_vender = p.part_id AND p.part_id = '".$_SESSION['partner_id']."'";
        
        $joinQuery .= " INNER JOIN car_image i
        ON o.off_parent = i.cari_parent";

        $joinQuery .= " GROUP BY o.off_id";

        echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery)
        );

    

    

   
