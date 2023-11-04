<?php 
    require_once __DIR__.'/vendor/autoload.php';

    $db = new MysqliDb (Array (
        'host' => '206.189.157.77',
        'username' => 'admin_master',
        'password' => 'EUOWIzeo0K',
        'db'=> 'admin_trade-in',
        'port' => 3306,
        'charset' => 'utf8'
    ));

    $db_sv = new MysqliDb (Array (
        'host' => '206.189.157.77',
        'username' => 'admin_survey',
        'password' => 'qTcxhWmCoJ',
        'db'=> 'admin_survey',
        'port' => 3306,
        'charset' => 'utf8'
    ));
    
?>