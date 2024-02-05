<?php
    require 'vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    $router->get( '/', function() {
        header("location: /404");
		exit();
    });

    $router->get( '/404', function() {
        require_once 'error/404.php';
    });

    /* admin */
    $router->get( '/access', function() {
        require_once 'admin/access.php';
    });

    $router->get( '/admin/home', function() {
        require_once 'admin/pages/home.php';
    });

    $router->get( '/admin/add', function() {
        require_once 'admin/pages/add_car.php';
    });

    $router->get( '/admin/extension', function() {
        require_once 'admin/pages/extension.php';
    });

    $router->get( '/admin/extension/(.*)', function($id) {
        require_once 'admin/pages/extension_detail.php';
    });
    $router->get( '/admin/ext-edit/(.*)', function($id) {
        require_once 'admin/pages/extension_edit.php';
    });

    $router->get( '/admin/detail/(.*)', function($cid) {
        require_once 'admin/pages/car_detail.php';
    });

    $router->get( '/admin/edit/(.*)', function($cid) {
        require_once 'admin/pages/car_edit.php';
    });

    $router->get( '/admin/survey', function() {
        require_once 'admin/pages/survey.php';
    });

    /* sales */

    $router->get( '/app', function() {
        require_once 'sales/pages/auth.php';
    });

    $router->get( '/sales/home', function() {
        require_once 'sales/pages/home.php';
    });

    $router->get( '/sales/add', function() {
        require_once 'sales/pages/add_car.php';
    });

    $router->get( '/sales/extension', function() {
        require_once 'sales/pages/extension.php';
    });

    $router->get( '/sales/extension/(.*)', function($id) {
        require_once 'sales/pages/extension_detail.php';
    });
    $router->get( '/sales/ext-edit/(.*)', function($id) {
        require_once 'sales/pages/extension_edit.php';
    });

    $router->get( '/sales/detail/(.*)', function($cid) {
        require_once 'sales/pages/car_detail.php';
    });

    $router->get( '/sales/edit/(.*)', function($cid) {
        require_once 'sales/pages/car_edit.php';
    });

    $router->get( '/sales/survey', function() {
        require_once 'sales/pages/survey.php';
    });



    $router->run();
    



