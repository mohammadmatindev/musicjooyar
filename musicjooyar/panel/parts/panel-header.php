<?php include('../init.php') ?>
<?php
$page_name = get_page_name();

if ($page_name == "login") {

    if (isset($_GET['log_out']) && !empty($_GET['log_out'])) {
        logout();
    }

    if (is_user_login()) {

        redirect(site_url("panel/"));

    }
} else {

    if (!is_user_login()) {

        redirect(site_url("panel/login.php"));

    }

}

if( $page_name != "login" && !is_current_user_admin()){
    $allow_pages =["index","favorites","profile"];
    if(!in_array($page_name,$allow_pages)){
        die("YOU NOT ACCESS :( ");
    }
}
?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo get_panel_page_title() ?></title>
    <link rel="stylesheet" href="https://dl.daneshjooyar.com/mvie/Moodi_Hamed/assets/css/font-yekanbakh-vf.css">
    <link href="../css/select2.min.css" rel="stylesheet" />
       <link rel="stylesheet" href="../css/persian-datepicker.min.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/panel.css">
    <link rel="stylesheet" href="../css/croppie.css">
    <link rel="stylesheet" href="../css/musicjooyar-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>