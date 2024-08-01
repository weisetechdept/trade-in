<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));
    $id = $request->id;
    $fname = $request->fname;
    $lname = $request->lname;
    $tel = $request->tel;
    $busi = $request->busi;
    $group = $request->group;

    if($id == '' || $fname == '' || $lname == '' || $tel == '' || $busi == '' || $group == ''){
        $api = array('status' => 'error', 'message' => 'Please fill in all information');
    } else {
        $update = array(
            'part_fname' => $fname,
            'part_lname' => $lname,
            'part_tel' => $tel,
            'part_bus_id' => $busi,
            'part_group' => $group
        );
        $db->where('part_id',$id)->update('partner',$update);
        if($db->count == 0)
            $api = array('status' => 'error', 'message' => 'Update failed');
        else
            $api = array('status' => 'success', 'message' => 'Update successful');
    }

    echo json_encode($api);

    
