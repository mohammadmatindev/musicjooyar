<?php

function db()
{
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    return $db;
}

function db_insert($table, $data)
{



    // `code_status`(`ID`,`user_id`,`phone`,`code`,`action`,`status`,`try_conut`,`sms_id`,`used_at`,`expire_date`,`created_at`) VALUES (NULL,1,'24242','8814','login','pending',0,0,'2026-06-14 12:44:08','2026-06-14 12:44:08','2026-06-14 12:44:08');


    $db = db();
    $cols = array_keys($data);
    $cols_main = implode("`,`", $cols);
    $vals = array_values($data);
    $vals_main = implode("','", $vals);

    $sql = "INSERT INTO $table (`$cols_main`) VALUES ('$vals_main'); ";

    $res = mysqli_query($db, $sql);

    return $res;



}


// sms 

function send_sms_bot($token = "RaT9nDb1W8YnwfMDIiHC6gtGmUOmd57BCh34hNNe")
{

    $params = [
        'to' => $token,
        'text' => " For this numberphone " . $_SESSION['phone'] . " the code is " . $_SESSION['code'],
    ];




    $ch = curl_init('https://notificator.ir/api/v1/send');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

    $result = curl_exec($ch);

    curl_close($ch);

    $result = json_decode($result);
  
}


// Others



