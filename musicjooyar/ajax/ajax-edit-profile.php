<?php
require_once('../init.php');



if (!is_user_login()) {
    send_json([
        "message" => "please login first"
    ], 401);
}

$username = isset($_POST['username']) ? db_escape(trim($_POST['username'])) : null;
$first_name = isset($_POST['first_name']) ? db_escape(trim($_POST['first_name'])) : null;
$last_name = isset($_POST['last_name']) ? db_escape(trim($_POST['last_name'])) : null;

$user_id = get_user_id();



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