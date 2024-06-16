<?php 
     session_start();
     require_once '../../db-conn.php';
     date_default_timezone_set("Asia/Bangkok");

     $id = $_POST['id'];
     $group = $_POST['group'];

     $files_arr = array();
     if (isset($_FILES['files']['name'])) {
          $countfiles = count($_FILES['files']['name']);

          for ($index = 0; $index < $countfiles; $index++) {
               //echo $_FILES['files']['name'][$index];

               if (isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != '') {
                    $image = $_FILES['files']['tmp_name'][$index];
                    $type = mime_content_type($image);
                    $name = basename($image);

                    $url = 'https://api.cloudflare.com/client/v4/accounts/1adf66719c0e0ef72e53038acebcc018/images/v1';
                    $cfile = curl_file_create($image, $type, $name);
                    $data = array("file" => $cfile);

                    $headers = [
                         'Authorization: Bearer x2skj57v2poPW8UxIQGqBACBxkJ4Glg42lVhbDPe',
                         'Content-Type: multipart/form-data'
                    ];

                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                    $response = curl_exec($curl);
                    curl_close($curl);

                    $response = json_decode($response);
                    $img1 = $response->result->variants[0];
                    $img2 = $response->result->variants[1];
                    $img_id = $response->result->id;

                    $data = Array (
                         "cari_img_id" => $img_id,
                         "cari_link" => $img1,
                         "cari_link_500" => $img2,
                         "cari_group" => $group,
                         "cari_parent" => $id,
                         "cari_status" => "1",
                         "cari_datetime" => date("Y-m-d H:i:s")
                     );
                     $img_id = $db->insert ('car_image', $data);
                         if($img_id){
                              $api['status'] = 200;
                         }
                              

               }
          }
     }

     echo json_encode($api);
     
     /*
          { "result": { "id": "8e5ddf43-8c72-4966-5f09-5fa0d271ee00", "filename": "weise-logo.jpg", "uploaded": "2023-10-01T16:39:02.543Z", "requireSignedURLs": false, "variants": [ "https://imagedelivery.net/FG9yH3i4rybjZWgNeKKJvA/8e5ddf43-8c72-4966-5f09-5fa0d271ee00/resize500", "https://imagedelivery.net/FG9yH3i4rybjZWgNeKKJvA/8e5ddf43-8c72-4966-5f09-5fa0d271ee00/public" ] }, "success": true, "errors": [], "messages": [] }
     */


