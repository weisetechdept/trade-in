<?php  
        session_start();
        date_default_timezone_set("Asia/Bangkok");

        $_SESSION['tin_admin'] = true;
        $_SESSION['user_id_admin'] = 34;
        $_SESSION['adname_name'] = 'อภิรักษ์ อภิจิตรชัยโชติ';
        $_SESSION['adname_img'] = '';

        header('Location: /admin/home');
                
           
