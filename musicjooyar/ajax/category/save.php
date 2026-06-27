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


if (isset($_POST['setcategory']) && $_POST['setcategory'] == "accept") {

    $cat_id = isset($_POST["id"]) ? db_escape($_POST["id"]) : 0;

    $cat_name = isset($_POST["category_name"]) ? db_escape($_POST["category_name"]) : NULL;

    $cat_par = isset($_POST["category_parent"]) ? db_escape($_POST["category_parent"]) : 0;

    $is_updated = $cat_id>0;

    $exits_cat = get_cats_by("title", $cat_name);
    if ($exits_cat && $exits_cat["ID"] != $cat_id) {
        send_json([
            "message" => "سلطان این دسته هست که :( "
        ], 400);
    }
    if ($cat_id) {
        $updated = db_update("categories", [
            "title" => $cat_name,
            "parent" => $cat_par
        ], [
            "ID" => $cat_id
        ]);
    } else {
        $cat_id = insert_cat($cat_name, $cat_par);
        if (!$cat_id) {
            send_json([
                "message" => "مشتی گلی یه مشکلی هَ"
            ], 400);
        }

    }




    $action_lable = $is_updated ? "ویرایش" : "اضافه";

    send_json([
        "message" => "عجیبه ! سایت عجیبیه دسته رو $action_lable کرد ! :) ",
        "item" => "<option value='$cat_id'>$cat_name</option>"
    ]);
}




