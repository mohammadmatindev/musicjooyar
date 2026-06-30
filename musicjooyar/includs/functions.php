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

function get_recoed_by($table, $col, $val)
{
    $sql = "SELECT * FROM $table WHERE $col = '$val' LIMIT 1 ";
    $res = db_query($sql);
    if ($res && $res->num_rows) {
        return mysqli_fetch_assoc($res);
    }

    return false;

}
function get_user_by($col, $val)
{

    return get_recoed_by("users", $col, $val);



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

    $full_name = trim($user["first_name"] . " " . $user["last_name"]);

    if (!$full_name) {
        $full_name = "بدون نام ";
    }

    return $full_name;


}

// Source - https://stackoverflow.com/a/4356295
// Posted by Stephen Watkins, modified by community. See post 'Timeline' for change history
// Retrieved 2026-06-22, License - CC BY-SA 4.0

function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}

function is_current_user_admin()
{
    $user = get_user_current();
    return $user && $user["role"] == "admin";

}



// categories 

function get_cats_by($col, $val)
{
    return get_recoed_by("categories", $col, $val);
}

function insert_cat($title, $parent = 0)
{

    $data = [
        "title" => $title,
        "parent" => $parent,
        "created_at" => current_time()
    ];
    return db_insert("categories", $data);

}

function get_cats()
{
    $sql = "SELECT * FROM categories ORDER BY created_at DESC";
    $res = db_query($sql);
    if ($res && $res->num_rows) {
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
    return [];
}


// artists 

function insert_artist($data)
{
    $data["created_at"] = current_time();
    return db_insert("artists", $data);
}

function get_artisit_by($col, $val)
{
    return get_recoed_by("artists", $col, $val);
}

function get_artists()
{
    $sql = "SELECT * FROM  artists ORDER BY created_at DESC";
    $res = db_query($sql);
    if ($res && $res->num_rows) {
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
    return [];
}

// music 

function get_music_by($field, $val)
{

    return get_recoed_by("musics", $field, $val);

}

function get_music($music_id)
{
    return get_music_by("ID", $music_id);
}

function selected($val)
{
    echo $val ? "selected" : "";
}

function get_music_artist_ids($id)
{

    $sql = "SELECT artist_id FROM music_artist WHERE music_id = $id";
    $res = db_query($sql);
    $resualt = [];
    if ($res && $res->num_rows) {
        $res_arr = mysqli_fetch_all($res, MYSQLI_ASSOC);

        foreach ($res_arr as $row) {
            $resualt[] = intval($row["artist_id"]);
        }
    }

    return $resualt;

}

function get_music_category_ids($id)
{

    $sql = "SELECT category_id FROM music_category WHERE music_id = $id";
    $res = db_query($sql);
    $resualt = [];
    if ($res && $res->num_rows) {
        $res_arr = mysqli_fetch_all($res, MYSQLI_ASSOC);

        foreach ($res_arr as $row) {
            $resualt[] = intval($row["category_id"]);
        }
    }

    return $resualt;

}

function get_filename_from_url($url)
{
    if (empty($url)) {
        return '';
    }

    $info = pathinfo($url);

    if (isset($info['extension']) && $info['extension'] == "mp3") {
        return $info['basename'];
    }

    return '';

}

function get_size_from_url($url)
{
    if (!$url) {
        return 0;
    }

    $url = str_replace(' ','%20',$url);
    $ch = curl_init($url);

    

  
    curl_setopt_array(
        $ch,
        [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_NOBODY => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ]

    );

    $res = curl_exec($ch);

    $file_size = curl_getinfo($ch,CURLINFO_CONTENT_LENGTH_DOWNLOAD);

    return $file_size;
  


}


function byte_to_megabyte($size){
    return round($size /1024 /1024 ,1);
}