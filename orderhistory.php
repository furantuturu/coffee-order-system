<?php

require_once 'Database.php';
$db = new Database();

$receipts = $db->query("SELECT DISTINCT receipt_id, total_price, created_at FROM coffee_order ORDER BY created_at DESC")->getAll();
    
require 'view.php';

return view('orderhistory.view.php', [
    'receipts' => $receipts,
]);