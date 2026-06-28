<?php
require_once('../../init.php');

if (!is_user_login()) {
    send_json([
        "message" => "please login first"
    ], 401);
}

if (!is_current_user_admin()) {
    send_json([
        "message" => "اخیییییی دسترسی ندارییییی :("
    ], 403);
}


if (isset($_POST['add_artisit']) && $_POST['add_artisit'] == "ticked") {

    $art_id = isset($_POST["id"]) ? db_escape($_POST["id"]) : 0;
    
    $art_name = isset($_POST["name"]) ? db_escape($_POST["name"]) : NULL;
    $art_family = isset($_POST["family"]) ? db_escape($_POST["family"]) : NULL;
    $art_birthdate = isset($_POST["birthdate_real"]) ? db_escape($_POST["birthdate_real"]) : NULL;
    $art_description = isset($_POST["description"]) ? db_escape($_POST["description"]) : NULL;
    $art_avatar = isset($_POST["artist_avatar_url"]) ? db_escape($_POST["artist_avatar_url"]) : NULL;

    $is_updated = $art_id > 0;

   

    $artists_data = [
        "first_name"    =>  $art_name,
        "last_name"     =>  $art_family,
        "avatar"        =>  $art_avatar,
        "biography"     =>  $art_description,
        "birthdate"     =>  $art_birthdate
    ]; 


    if ($art_id) {
        $updated = db_update("artists", 
            $artists_data
       , [
            "ID" => $art_id
        ]);

        
    } else {
        $art_id = db_insert("artists", $artists_data);

        if (!$art_id) {
      
            send_json([
                "message" => "مشتی گلی یه مشکلی هَ"
            ], 400);
        }


    }



    $redirect_path = SITE_URL . "panel/artists.php";
    $action_lable = $is_updated ? "ویرایش" : "اضافه";

    send_json([
        "message" => "عجیبه ! سایت عجیبیه هنرمند تو رو $action_lable کرد ! :) ",
        "redirect_path" => $redirect_path
    ]);
}




