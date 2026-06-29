<?php
require_once('../../init.php');


if (!is_user_login()) {
    send_json([
        "message" => "please login first"
    ], 401);
}

$user_id = get_user_id();

if (!isset($_FILES['music_cover'])) {
    send_json([
        "message" => "آپلودفایل با خطا روبه رو شد :):("
    ], 400);
}



$cover = $_FILES['music_cover'];

if ($cover["error"] != UPLOAD_ERR_OK) {
    send_json([
        "message" => "آپلودفایل با خطا روبه رو شد :):("
    ], 400);
}

if ($cover["type"] != 'image/png' && $cover["type"] != 'image/jpeg' ) {
    send_json([
        "message" => "فرمت فایل تو چک کن :( "
    ], 400);
}

$uploaded_real_path = "uploads/cover/" . date('Y/m') . "/";

$uploaded_dir = ABSPATH . $uploaded_real_path;

if (!file_exists($uploaded_dir)) {
    mkdir($uploaded_dir, 0777, true);
}

$extension = "png";
if($cover["type"] == 'image/jpeg'){
    $extension = "jpeg";
}

$new_cover_name = generateRandomString(5) . "." .  $extension;

$uploaded_path = $uploaded_dir . $new_cover_name;

$moved = move_uploaded_file($cover["tmp_name"], $uploaded_path);



if (!$moved) {
    send_json([
        "message" => "یه مشکلی هَ :)  "
    ], 400);
}

$cover_url = site_url($uploaded_real_path . $new_cover_name);


send_json([
    "message" => "یه مشکلی نی :(  ",
    "cover" => $cover_url
]);
