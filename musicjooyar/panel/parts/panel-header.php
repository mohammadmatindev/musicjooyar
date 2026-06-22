<?php include('../init.php') ?>
<?php
$page_name = get_page_name();

if ($page_name == "login") {
    if (is_user_login()) {

        redirect(site_url("panel/"));

    }
} else {

    if (!is_user_login()) {

        redirect(site_url("panel/login.php"));

    }

}
?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ورود - پروفایل</title>
    <link rel="stylesheet" href="https://dl.daneshjooyar.com/mvie/Moodi_Hamed/assets/css/font-yekanbakh-vf.css">
    <link href="../css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/panel.css">
    <link rel="stylesheet" href="../css/musicjooyar-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>