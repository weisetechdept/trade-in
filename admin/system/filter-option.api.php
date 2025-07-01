<?php
session_start();
require_once '../../db-conn.php';
header('Content-Type: application/json');

try {
    $result = [];
    
    // ดึงข้อมูลเซลล์
    $sales = $db_nms->get('db_member', null, 'id, first_name');
    $result['sales'] = [];
    foreach($sales as $sale) {
        $result['sales'][] = [
            'id' => $sale['id'],
            'name' => $sale['first_name']
        ];
    }
    
    // ดึงข้อมูลทีม
    $teams = $db_nms->get('db_user_group', null, 'name');
    $result['teams'] = [];
    foreach($teams as $team) {
        $result['teams'][] = [
            'name' => $team['name']
        ];
    }
    
    // ดึงข้อมูลผู้ซื้อ/พันธมิตร
    $db->join('partner_bus b', 'p.part_bus_id = b.busi_id', 'LEFT');
    $partners = $db->get('partner p', null, 'part_id, part_fname, part_lname, busi_name');
    $result['partners'] = [];
    foreach($partners as $partner) {
        $result['partners'][] = [
            'id' => $partner['part_id'],
            'name' => trim($partner['part_fname'] . ' ' . $partner['part_lname'] . ' ' . $partner['busi_name'])
        ];
    }
    
    // ดึงข้อมูลสีรถที่มีในระบบ
    $colors = $db->get('car_stock', null, 'DISTINCT cast_color as color');
    $result['colors'] = [];
    foreach($colors as $color) {
        if(!empty($color['color'])) {
            $result['colors'][] = $color['color'];
        }
    }
    
    // ดึงข้อมูลแบบรุ่นรถ
    $models = $db->get('finance_data', null, 'DISTINCT CONCAT(find_brand, " ", find_serie) as model');
    $result['models'] = [];
    foreach($models as $model) {
        if(!empty($model['model'])) {
            $result['models'][] = $model['model'];
        }
    }
    
    // ดึงข้อมูลปีรุ่น
    $years = $db->get('finance_data', null, 'DISTINCT find_year as year');
    $result['years'] = [];
    foreach($years as $year) {
        if(!empty($year['year'])) {
            $result['years'][] = $year['year'];
        }
    }
    
    echo json_encode([
        'success' => true,
        'data' => $result
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}