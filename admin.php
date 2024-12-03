<?php
session_start();
if (isset($_SESSION['User_login']) && $_SESSION['User_login']['Role'] == 1) {
    include_once 'admin/controller/Admin_Controller.php';
    $Page = isset($_GET['Page']) ? $_GET['Page'] : 'thong_ke_doanh_thu';
    $Admin_Controller = new Admin_Controller;
    if (method_exists($Admin_Controller, $Page)) {
        $Admin_Controller->$Page();
    } else {
        echo "Page not found!";
    }
} else {
    header('Location: index.php');
    exit();
}
