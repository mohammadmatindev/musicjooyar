<?php

require_once('../../init.php');


if (!is_user_login()) {
    send_json([
        "message" => "please login first"
    ], 401);
}

$user_id = get_user_id();

if (!isset($_FILES['music_audio'])) {
    send_json([
        "message" => "آپلود موزیک با خطا روبه رو شد :):("
    ], 400);
}



$music = $_FILES['music_audio'];

if ($music["error"] != UPLOAD_ERR_OK) {
    send_json([
        "message" => "آپلود موزیک با خطا روبه رو شد :):("
    ], 400);
}

if ($music["type"] != 'audio/mpeg') {
    send_json([
        "message" => "فرمت موزیک تو چک کن :( "
    ], 400);
}

$file_info = pathinfo($music["name"]);

if ($file_info['extension'] != "mp3") {
    send_json([
        "message" => "فرمت موزیک تو چک کن :( "
    ], 400);
}


$uploaded_real_path = "uploads/musics/" . date('Y/m') . "/";

$uploaded_dir = ABSPATH . $uploaded_real_path;

if (!file_exists($uploaded_dir)) {
    mkdir($uploaded_dir, 0777, true);
}



$new_music_name = $music["name"] ;

$uploaded_path = $uploaded_dir . $new_music_name;

$moved = move_uploaded_file($music["tmp_name"], $uploaded_path);



if (!$moved) {
    send_json([
        "message" => "یه مشکلی هَ :)  "
    ], 400);
}

$music_url = site_url($uploaded_real_path . $new_music_name);


send_json([
    "message" => "یه مشکلی نی :(  ",
    "music" => $music_url
]);
