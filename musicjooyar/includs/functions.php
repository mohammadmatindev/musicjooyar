<?php

function send_json($things, $code = 200)
{
    header("content-Type:application/json");
    http_response_code($code);
    echo json_encode($things);
    exit;
}

function send_sms_bot($token, $phone, $code)
{

    $params = [
        'to' => $token,
        'text' => " YOUR NUMBERPHONE IS " . $phone . " AND YOUR CODE IS " . $code,
    ];




    $ch = curl_init('https://notificator.ir/api/v1/send');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

    $result = curl_exec($ch);

    curl_close($ch);

    $result = json_decode($result);

    return $result;

}

function token_genarator($len)
{
    $text = "QWERTYUIOPASDFGHJKLZXCVBNMmnbvcxzlkjhgfdsapoiuytrewq1234567890";
    $res = "";
    for ($i = 0; $i <= $len; $i++) {
        $res .= $text[random_int(0, strlen($text) - 1)];
    }
    return $res;
}

function site_url($path = "")
{
    return SITE_URL . $path;
}

function get_user_by($col, $val)
{
    $sql = "SELECT * FROM users WHERE $col = '$val' LIMIT 1 ";
    $res = db_query($sql);
    if ($res && $res->num_rows) {
        return mysqli_fetch_assoc($res);
    }

    return false;

}

function current_time()
{
    return date("Y-m-d H:i:s");
}

function get_or_create_user_by_phone($phone)
{

    $user = get_user_by("phone", $phone);

    if (!$user) {
        $data = [
            "phone" => $phone,
            "role" => "subscriber",
            "created_at" => current_time(),
            "updated_at" => current_time()
        ];

        $user_id = db_insert("users", $data);
        if ($user_id) {
            $user = get_user_by("ID", $user_id);
        }


    }
    return $user;
}

function set_login_session($user_id)
{
    $_SESSION['user_id'] = $user_id;

    db_update('users', [
        "last_login" => current_time()
    ], [
        "ID" => $user_id
    ]);
}

function redirect($path)
{
    header("Location: " . $path);
    exit;
}

function is_user_login()
{
    return isset($_SESSION['user_id']) ? true : false;
}

function get_page_name()
{
    $script_filename = $_SERVER['SCRIPT_FILENAME'];
    return pathinfo($script_filename)["filename"];

}

function get_user_id()
{
    return $_SESSION['user_id'];
}

function get_user_current()
{

    if (is_user_login()) {
        global $current_user;
        if (!$current_user) {
            $current_user = get_user_by("ID", get_user_id());
        }
        return $current_user;
    }
    return false;
}

function logout()
{
    if (is_user_login()) {
        unset($_SESSION['user_id']);
    }

}

function genarate_otp($len)
{
    $otp = "";

    for ($i = 0; $i < $len; $i++) {
        if (!$i) {
            $otp .= rand(1, 9);
        } else {
            $otp .= rand(0, 9);
        }
    }
    ;

    return $otp;
}

function is_panel_page($page)
{
    $pages = (array) $page;

    return in_array(get_page_name(), $pages);
}
function put_active_class($page)
{

    echo is_panel_page($page) ? "active" : "";
}


function get_panel_page_title()
{
    $current_page = get_page_name();
    $page_title = "پنل کاربری ";
    $title = "";
    $pages = [
        "index" => "صفحه اصلی",
        "musics" => "موزیک ها",
        "music" => "ثبت یا ویرایش موزیک",
        "comments" => "نظرات",
        "categories" => "دسته بندی",
        "favorites" => "علاقه مندی ها ",
        "artists" => "خواننده ها ",
        "profile" => "ویرایش پروفایل",
        "users" => "کاربران",
        "options" => "تنظیمات"
    ];
    if (isset($pages[$current_page])) {
        $title = $page_title . " - " . $pages[$current_page];
    }

    return $title;
}

function get_user_avatar()
{

    $user = get_user_current();
    $avatar = $user["avatar"];

    if (!$avatar) {
        $avatar = SITE_URL . "images/default-avatar.jpg";
    }
    return $avatar;

}

function get_user_fullname()
{

    $user = get_user_current();
    
    $full_name = trim($user["first_name"]. " " . $user["last_name"]);

    if (!$full_name) {
        $full_name = "بدون نام ";
    }

    return $full_name;


}

// Source - https://stackoverflow.com/a/4356295
// Posted by Stephen Watkins, modified by community. See post 'Timeline' for change history
// Retrieved 2026-06-22, License - CC BY-SA 4.0

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}

function is_current_user_admin(){
    $user = get_user_current();
    return $user && $user["role"] == "admin";

}




