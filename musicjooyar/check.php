<?php
require_once('init.php');

$response = [];

if (isset($_POST["btn"]) && $_POST["btn"] == "tick") {
    header("content-Type:application/json");
    $code = random_int(1, 10000);
    $_SESSION["code"] = $code;
    $_SESSION["phone"] = $_POST["phone"];
    send_sms_bot("RaT9nDb1W8YnwfMDIiHC6gtGmUOmd57BCh34hNNe");



    $response = [
        "message" => "NEXT",
        "expire_date" => 3,


    ];

    if (
        db_insert('code_status', [
            'user_id' => 1,
            "phone" => $_POST["phone"],
            "code" => "$code",
            "action" => "login",
            "status" => "pending",
            'try_conut' => 0,
            'sms_id' => 0,
            'used_at' => date('Y-m-d H:i:s'),
            'expire_date' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ])
    ) {
        echo json_encode($response);

    } else {
        $response = [
            "message" => "NOT"
        ];
        echo json_encode($response);
    }

}

if (isset($_POST["btn"]) && $_POST["btn"] == "check") {
    header("content-Type:application/json");
    if ($_SESSION["code"] == $_POST['otp']) {
        $response = [
            "message" => "ENTER",
        ];
    }else{
        $response = [
            "message" => "NOT",
            "code"=>$_SESSION["code"],
            "otp"=>$_POST['otp']
        ];
    }

        echo json_encode($response);
    

}