<?php
include_once '../../system/core/Database.php';
$Import_Database = new Database();

$sevenDay = [
    $_GET['Date1'],
    $_GET['Date2'],
    $_GET['Date3'],
    $_GET['Date4'],
    $_GET['Date5'],
    $_GET['Date6'],
    $_GET['Date7']
];

$Return_Total = [];
foreach($sevenDay as $day){
    $value = $Import_Database->Get_Total_Order_By_Date($day) == null? 1: $Import_Database->Get_Total_Order_By_Date($day);
    $Return_Total[] = ['Date' => $day, 'Value' => $value['Doanh Thu']];
}

header('Content-Type: application/json');
echo json_encode($Return_Total);