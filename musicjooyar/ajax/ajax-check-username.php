<?php
require_once('../init.php');

$user_id = get_user_id();

$username = isset($_POST['username']) ? db_escape(trim($_POST['username'])) : null;

$exits_username_sql = "SELECT * FROM `users` WHERE username = '$username' AND ID != $user_id;";

$exits_username_res = db_query($exits_username_sql);

if ($exits_username_res && $exits_username_res->num_rows) {

    send_json([
        "message" => "username is exits"
    ], 400);

}

$data = [
    "username" => $username,


];

db_update("users", $data, [
    "ID" => $user_id
]);

send_json([
    "message" => "Successfully",
    "username_message" => "It's Available"
], 200);
