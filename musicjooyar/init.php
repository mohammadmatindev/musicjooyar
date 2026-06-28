<?php


/* 
مسیر ثابت یا مطلق  ABSPATH 
یه مسیر ثابت تنظیم کردیم برای اینکه 
مسیر بعضی فایل ها رو باهاش درست کنیم
__DIR__ = > دایرکتوری فایل یا پوشه فایل میده 
/ => !برای توی لینوکس میزارن لینوکس جان حساسسسسسه
*/
define("ABSPATH", __DIR__ . "/");

/*استincludes برای ادرس فایل های 
 فولدری که داخل اش فایل های که میخوایمهست + ABSPATH آدرس کامل*/

define("INC_PATH", ABSPATH . "includs/");

// مسیر گزارش ها

define("REPORT_PATH", ABSPATH . "reports/");

/*
استفاده شده INC_PATH داخل کد پایین مشخص که چرا از 
INC_PATH در اصل همون مسیر ثابت است که معمولا پوشه سایه + اون پوشه ایی که داخل این فایل هستن

*/


require(INC_PATH . "config.php");
require(INC_PATH . "jdf.php");


date_default_timezone_set(SET_TIMEZONE);


require(INC_PATH . "function-database.php");
require(INC_PATH . "database.php");
require(INC_PATH . "functions.php");









