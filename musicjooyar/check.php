<?php
require_once('init.php');

$response = [];

$token = token_genarator(5);


if (isset($_POST["btn"]) && $_POST["btn"] == "tick") {


    $phone = trim($_POST["token"]);
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
            "token"=> $token,
            'used_at' => date('Y-m-d H:i:s'),
            'expire_date' => date('Y-m-d H:i:s', strtotime("+180 seconds")),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $insert_code = db_insert('code_status', $data_status_code);

        if (!$insert_code) {

            send_json([
                "message" => "OH , I can't load , ERROR ",

            ]);

        }

        send_json([
            "message" => "NEXT",
            "token"=>$token

        ]);



    }
}

if (isset($_POST["btn"]) && $_POST["btn"] == "check") {

    $phone = trim($_POST["token"]);
    $otp = trim($_POST["otp"]);
    $sql = "SELECT * FROM `code_status` WHERE phone = '$phone'  ";
    $res = db_query($sql);



    if (!$res) {
        send_json([
            "message" => "ERROR PLEASE TRY AGAIN "
        ], 500);
    }
    // گرفتن اطلاعاعت  

    $otp_row = mysqli_fetch_assoc($res);
    
     $otp_id = $otp_row["ID"];

    /*  بررسی کردن اینکه داده گرفته شده از دیتابیس نتیجه یا ردیفی داره یا نه 
        برای بررسی درست وارد کردن کد هم هست 
    */
    
    if (!$res->num_rows) {

        send_json([
            "message" => " NOT CORRECT CODE "
        ], 400);

    }
    ;

    //  (try_count) بررسی درست بودن کد و تنظیم کردن میزان تلاش 

    if ($otp_row["code"] != $otp) {

       

        db_query("UPDATE `code_status` SET `try_conut`=`try_conut` + 1 WHERE `ID` = $otp_id;");

        send_json([
            "message" => "CODE NOT CORRECT 1"
        ], 400);


    }


    //  برای اینکه ببین کد استفاده شده یا نه status بررسی   
    if ($otp_row["status"] == "used") {
        send_json([
            "message" => "CODE WAS USED"
        ], 400);
    }


    // بررسی تاریخی که گد منقضی میشه 

    if (date("Y-m-d H:i:s") > $otp_row["expire_date"]) {
        send_json([
            "message" => "CODE WAS expired",
            date("Y-m-d H:i:s"),
            $otp_row["expire_date"]
        ], 400);
    }


    // بررسی تعداد دفعات که کاربر زده :)

    if ($otp_row["try_conut"] >= 3) {

        send_json([
            "message" => "VERY TRY :("
        ], 400);

        exit;

    }

    $now=date('Y-m-d H:i:s');

    var_dump(db_query("UPDATE `code_status` SET `status`='used',`used_at` = '$now' WHERE `ID` = $otp_id;"));



}


