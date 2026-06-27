<?php
require_once('../init.php');

$token = token_genarator(5);
$expire = OTP_EXPIRE;

if (isset($_POST["btn"]) && $_POST["btn"] == "tick") {




    $phone = trim($_POST["phone"]);



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

    $current_time = current_time();
    $exits_sql = "SELECT * FROM `code_status` WHERE phone = '$phone' AND status = 'pending' AND expire_date > '$current_time' ORDER BY created_at DESC LIMIT 1;";
    $res_exits = db_query($exits_sql);
    if ($res_exits && $res_exits->num_rows) {
        $fech_data = mysqli_fetch_assoc($res_exits);
        $expire = strtotime($fech_data["expire_date"]) - strtotime($current_time);
        $token = $fech_data["token"];

    } else {

        $code = genarate_otp(OTP_CODE_LENGTH);





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
                "token" => $token,
                'used_at' => date('Y-m-d H:i:s'),
                'expire_date' => date('Y-m-d H:i:s', strtotime("+180 seconds")),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $insert_code = db_insert('code_status', $data_status_code);

            if (!$insert_code) {

                send_json([
                    "message" => "OH , I can't load , ERROR ",

                ], 404);

            }

            send_json([
                "message" => "NEXT",
                "token" => $token,
                "expire" => $expire

            ]);



        }
    }
}