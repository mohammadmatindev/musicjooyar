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

if (isset($_POST['save_music']) && $_POST['save_music'] == "reved") {

    

    $music_id = isset($_POST["id"]) ? db_escape($_POST["id"]) : 0;

    $is_updated = $music_id > 0;


    $music_title = isset($_POST["title"]) ? db_escape($_POST["title"]) : NULL;

    $music_content = str_replace(["\\r\\n", "\\n"], PHP_EOL, $_POST["content"]);
    $music_q320 = isset($_POST["q320"]) ? db_escape($_POST["q320"]) : NULL;
    $music_q128 = isset($_POST["q128"]) ? db_escape($_POST["q128"]) : NULL;
    $music_cover = isset($_POST["cover"]) ? db_escape($_POST["cover"]) : NULL;
    $music_status = isset($_POST["status"]) ? db_escape($_POST["status"]) : NULL;





    $music_data = [
        "title" => $music_title,
        "content" => $music_content,
        "quality_320" => $music_q320,
        "quality_128" => $music_q128,
        "status" => $music_status,
        "cover" => $music_cover,
        "updated_at" => current_time()
    ];

    if ($is_updated) {

        $updated = db_update("musics", $music_data, [
            "ID" => $music_id
        ]);


    } else {
        $music_data["created_at"] = current_time();
        $music_data["author_id"] = get_user_id();

        $music_id = db_insert("musics", $music_data);

        if (!$music_id) {
            send_json([
                "message" => "مشتی گلی یه مشکلی هَ"
            ], 400);
        }

    }

    db_delete("music_artist", [
        "music_id" => $music_id
    ]);

    if (isset($_POST["artists"]) && is_array($_POST["artists"])) {


        $artist_ids = array_map("intval", $_POST["artists"]);
        foreach ($artist_ids as $artist_id) {
            db_insert("music_artist", [
                "music_id" => $music_id,
                "artist_id" => $artist_id
            ]);

        }
        ;

    }



    db_delete("music_category", [
        "music_id" => $music_id
    ]);

    if (isset($_POST["categoryies"]) && is_array($_POST["categoryies"])) {


        $cat_ids = array_map("intval", $_POST["categoryies"]);
        foreach ($cat_ids as $cat_id) {
            db_insert("music_category", [
                "music_id" => $music_id,
                "category_id" => $cat_id
            ]);

        }
        ;

    }





    ;
    $redirect_path = SITE_URL . "panel/music.php";
    $action_lable = $is_updated ? "ویرایش" : "اضافه";

    send_json([
        "message" => "
        مشتی گلی یه مشکلی نی 
        این  $action_lable  رواله نگران یوخت
        ",
        "redirect_path" => $redirect_path
    ], 200);



}