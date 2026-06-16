<?php
require_once('init.php');

$response = [];




if (isset($_POST["btn"]) && $_POST["btn"] == "tick") {



    $phone = trim($_POST["phone"]);
    $code = rand(1, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);


    if (empty($phone)) {

        send_json([
            "message" => "Number Phone is Empty"
        ]);

    }

    if (!$phone) {
        send_json([
            "message" => "Number Phone NotFound"
        ]);
    }

    $response = [
        "message" => "NEXT",
    ];





    /*  عوض کن  MESSAGE_ID بعدا با  */

    if ($response["message"] == "NEXT") {


        send_sms_bot(BOT_TOKEN_KEY, $phone, $code);



        $data_status_code = [
            'user_id' => 1,
            "phone" => "$phone",
            "code" => "$code",
            "action" => "login",
            "status" => "pending",
            'try_conut' => 0,
            'sms_id' => "0",
            'used_at' => date('Y-m-d H:i:s'),
            'expire_date' => date('Y-m-d H:i:s', strtotime("+3 minutes")),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $insert_code = db_insert('code_status', $data_status_code);
        if ($insert_code) {


        }
       


        if (!$insert_code) {

            send_json([
                "message" => "OH , I can't load , ERROR ",

            ]);









        }

         send_json([
            "message" => "NEXT",

        ]);



    }
}

if (isset($_POST["btn"]) && $_POST["btn"] == "check") {
    header("content-Type:application/json");
    $phone = trim($_POST["phone"]);
    $otp = trim($_POST["otp"]);
    $sql = "SELECT * FROM `code_status` WHERE phone = '$phone' AND code = '$otp' ORDER BY created_at DESC LIMIT 1";
    var_dump(db_query($sql));



}


