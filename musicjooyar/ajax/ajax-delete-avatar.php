<?php
require_once('../init.php');

if (!is_user_login()) {
    send_json([
        "message" => "باید اول داخل شی :) "
    ]);
}

$user_id = get_user_id();

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
    "avatar" => SITE_URL . "images/default-avatar.jpg"
]);