<?php 
        session_start();
        require_once '../../db-conn.php';
        date_default_timezone_set("Asia/Bangkok");

        $request = json_decode(file_get_contents('php://input'));
        $id = $request->id;

        $data = array(
            'cari_group' => '9'
        );

        