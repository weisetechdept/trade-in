<?php 
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
   

    if (isset($_POST['submit']))
    {
         
        $fileMimes = array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain'
        );
     
        // Validate selected file is a CSV file or not
        if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
        {
     
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
    
            // Skip the first line
            fgetcsv($csvFile);
    
            // Parse data from CSV file line by line        
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
            {
                // Get row data
                $tltid = $getData[0];
                $brand = $getData[1];
                $serie = $getData[2];
                $year = $getData[3];
                $section = $getData[4];
                $price = $getData[5];

                $data = Array ("find_tltid" => $tltid,
                    "find_brand" => $brand,
                    "find_serie" => $serie,
                    "find_section" => $section,
                    "find_year" => $year,
                    "find_price" => $price,
                    "find_group" => '1',
                    "find_datetime" => date("Y-m-d H:i:s")
                );
                $id = $db->insert ('finance_data', $data);
                if($id)
                    echo 'user was created. Id=' . $id.'<br>';


    
                // If user already exists in the database with the same email
                /*
                $query = "SELECT id FROM users WHERE email = '" . $getData[1] . "'";
    
                $check = mysqli_query($con, $query);
    
                if ($check->num_rows > 0)
                {
                    mysqli_query($conn, "UPDATE users SET name = '" . $name . "', created_at = NOW() WHERE email = '" . $email . "'");
                }
                else
                {
                    mysqli_query($con, "INSERT INTO users (name, email, created_at, updated_at) VALUES ('" . $name . "', '" . $email . "', NOW(), NOW())");
                }
                */
            }
    
            // Close opened CSV file
            fclose($csvFile);
    
            header("Location: index.php");         
        }
        else
        {
            echo "Please select valid file";
        }
    }