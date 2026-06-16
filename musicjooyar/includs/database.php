<?php
mysqli_report(MYSQLI_REPORT_ERROR);

$db= mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if (!$db) {
    $error = mysqli_connect_error();
    db_log($error);
    include ("db-error.php");
    exit;
}