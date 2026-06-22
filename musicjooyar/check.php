<?php
require_once('init.php');

$response = [];

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

if (isset($_POST["btn"]) && $_POST["btn"] == "check") {

    $token_user = trim($_POST["token"]);
    $otp = trim($_POST["otp"]);
    $sql = "SELECT * FROM `code_status` WHERE token = '$token_user'  ";
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



    }

    $now = date('Y-m-d H:i:s');

    db_query("UPDATE `code_status` SET `status`='used',`used_at` = '$now' WHERE `ID` = $otp_id;");

    // گرفتن تلفن کاربر برای ساخت کاربر 

    $phone_user = $otp_row["phone"];

    // تابع ساخت یا گرفتن کاربر با تلفن

    $user = get_or_create_user_by_phone($phone_user);

    // اگر کاربری نبود این کار ها رو بکنه

    if (!$user) {
        send_json([
            "message" => "ERROR FROM SERVER :( "
        ], 500);
    }

    // کاربر بسازه ID برای session اگر هیچ مشکلی نبود


    set_login_session($user['ID']);

    send_json([
        "message" => "ENTER",
        "redirect_path" => site_url("panel")
    ]);

}

if (isset($_POST['update']) && $_POST['update'] == "true") {

    if (!is_user_login()) {
        send_json([
            "message" => "please login first"
        ], 401);
    }

    $username = isset($_POST['username']) ? db_escape(trim($_POST['username'])) : null;
    $first_name = isset($_POST['first_name']) ? db_escape(trim($_POST['first_name'])) : null;
    $last_name = isset($_POST['last_name']) ? db_escape(trim($_POST['last_name'])) : null;

    $user_id = get_user_id();


    $exits_username_sql = "SELECT * FROM `users` WHERE username = '$username' AND ID != $user_id;";

    $exits_username_res = db_query($exits_username_sql);

    if ($exits_username_res && $exits_username_res->num_rows) {

        send_json([
            "message" => "username is exits"
        ], 400);

    }

    $data = [
        "username" => $username,
        "first_name" => $first_name,
        "last_name" => $last_name
    ];

    db_update("users", $data, [
        "ID" => $user_id
    ]);

    send_json([
        "message" => "Successfully",
        "username_message" => "It's Available"
    ], 200);



}
$user_id = get_user_id();
if (isset($_GET['deleted'])) {
    $del_res = db_update("users", [
        "avatar" => NULL
    ], [
        "ID" => $user_id
    ]);

    if (!$del_res) {
        send_json([
            "message" => "اون عکس پروفایل کذایی رو پاک نکردم چون یه چی شده نمی دونم چی "
        ]);
    }
    send_json([
        "message" => "اون عکس پروفایل کذایی رو پاک کردم   ",
        "avatar"=> SITE_URL ."images/default-avatar.jpg"
    ]);
}

if (!isset($_FILES['user_avatar'])) {
    send_json([
        "message" => "آپلودفایل با خطا روبه رو شد :):("
    ], 400);
}

$avatar = $_FILES['user_avatar'];

if ($avatar["error"] != UPLOAD_ERR_OK) {
    send_json([
        "message" => "آپلودفایل با خطا روبه رو شد :):("
    ], 400);
}

if ($avatar["type"] != 'image/png' || $avatar["name"] != "avatar.png") {
    send_json([
        "message" => "فرمت فایل تو چک کن :( "
    ], 400);
}

$uploaded_real_path = "uploads/" . date('Y/m') . "/";

$uploaded_dir = ABSPATH . $uploaded_real_path;

if (!file_exists($uploaded_dir)) {
    mkdir($uploaded_dir, 0777, true);
}

$new_avatar_name = generateRandomString(5) . ".png";

$uploaded_path = $uploaded_dir . $new_avatar_name;

$moved = move_uploaded_file($avatar["tmp_name"], $uploaded_path);

if (!$moved) {
    send_json([
        "message" => "یه مشکلی هَ :)  "
    ], 400);
}

$avatar_url = site_url($uploaded_real_path . $new_avatar_name);



db_update("users", [
    "avatar" => $avatar_url
], [
    "ID" => $user_id
]);

send_json([
    "message" => "یه مشکلی نی :(  ",
    "avatar" => $avatar_url
]);


