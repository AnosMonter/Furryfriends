<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once 'system/core/config.php';
include_once 'system/core/Database.php';
include_once 'site/controller/Site_Controller.php';
$Page = isset($_GET['Page']) ? $_GET['Page'] : 'trang_chu';
$Action = isset($_GET['Action']) ? $_GET['Action'] : '';
$Site_Controller = new Site_Controller;
if (method_exists($Site_Controller,$Page)){
    $Site_Controller->$Page();
} else {
    echo "Page not found!";
}

?>
    
