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

    $router->get( '/admin/qm-report', function() {
        require_once 'admin/pages/qm-report.php';
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

    $router->get( '/admin/team-report', function() {
        require_once 'admin/pages/report-team.php'; 
    });

    $router->get( '/admin/g-report', function() {
        require_once 'admin/pages/g-report.php'; 
    });

    $router->get( '/admin/trast', function() {
        require_once 'admin/pages/trast.php'; 
    });

    $router->get( '/admin/owner/(.*)', function($id) {
        require_once 'admin/pages/car_owner.php'; 
    });

    $router->get( '/admin/event', function() {
        require_once 'admin/pages/event.php';
    });

    $router->get( '/admin/member', function() {
        require_once 'admin/pages/member.php';
    });

    $router->get( '/admin-regis', function() {
        require_once 'admin/pages/member-regis.php';
    });

    $router->get( '/admin/logout', function() {
        require_once 'admin/logout.php';
    });

    $router->get( '/admin/partner', function() {
        require_once 'admin/pages/partner.php';
    });

    $router->get( '/admin/business', function() {
        require_once 'admin/pages/partner-business.php';
    });

    $router->get( '/admin/pt/detail/(.*)', function($id) {
        require_once 'admin/pages/partner-detail.php';
    });

    $router->get( '/admin/add-business', function() {
        require_once 'admin/pages/partner-add-business.php';
    });

    $router->get( '/alink', function() {
        require_once 'admin/line_login.php';
    });

    $router->get( '/admin/home-report', function() {
        require_once 'admin/pages/report-home.php';
    });


    /* sales */

    $router->get( '/app', function() {
        require_once 'sales/pages/auth.php';
    });

    $router->get( '/sales/home', function() {
        require_once 'sales/pages/home.php';
    });

    $router->get( '/sales/add-car', function() {
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


    /* mgr */

    $router->get( '/sales/mgr', function() {
        require_once 'sales/pages/mgr.php'; 
    });

    $router->get( '/sales/mgr-list', function() {
        require_once 'sales/pages/mgr-list.php'; 
    });

    $router->get( '/sales/de/mgr/(.*)', function($cid) {
        require_once 'sales/pages/car_mgr_detail.php';
    });

    /* public */

    $router->get( '/stock/(.*)', function($id) {
        require_once 'public/pages/detail.php';
    });

    $router->get( '/trade', function() {
        require_once 'frontend/pages/trade.php';
    });

    /* Partner */

    $router->get( '/partner/register', function() {
        require_once 'partner/pages/register.php';
    });

    $router->get( '/partner/welcome', function() {
        require_once 'partner/pages/welcome.php';
    });

    $router->get( '/partner/car/(.*)', function($page) {
        require_once 'partner/pages/car.php';
    });

    $router->get( '/pt/stock/(.*)', function($id) {
        require_once 'partner/pages/detail.php';
    });

    $router->get( '/offer/stock/(.*)', function($id) {
        require_once 'partner/pages/offer.php';
    });

    $router->get( '/partner/login', function() {
        require_once 'partner/line_login.php';
    });

    $router->get( '/partner/cars', function() {
        require_once 'partner/pages/car-list.php';
    });

    $router->get( '/partner/offered', function() {
        require_once 'partner/pages/offered.php';
    });

    $router->run();
    



