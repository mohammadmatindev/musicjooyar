<?php
require_once('../../init.php');


if (!is_user_login()) {
    send_json([
        "message" => "please login first"
    ], 401);
}

$user_id = get_user_id();

if (!isset($_FILES['artist_avatar'])) {
    send_json([
        "message" => "آپلودفایل با خطا روبه رو شد :):("
    ], 400);
}



$avatar = $_FILES['artist_avatar'];

if ($avatar["error"] != UPLOAD_ERR_OK) {
    send_json([
        "message" => "آپلودفایل با خطا روبه رو شد :):("
    ], 400);
}

if ($avatar["type"] != 'image/png' || $avatar["name"] != "artist_avatar.png") {
    send_json([
        "message" => "فرمت فایل تو چک کن :( "
    ], 400);
}

$uploaded_real_path = "uploads/artists/" . date('Y/m') . "/";

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


send_json([
    "message" => "یه مشکلی نی :(  ",
    "avatar" => $avatar_url
]);
