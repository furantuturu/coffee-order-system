<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'Database.php';
    $db = new Database();
    
    $db->query("DELETE FROM coffee_order WHERE receipt_id = :id", [
        ':id' => $_POST['receipt_id']
    ]);

    $_SESSION['toast'] = 'Successfully deleted!';
    header('Location: orderhistory.php');
    exit();
}
