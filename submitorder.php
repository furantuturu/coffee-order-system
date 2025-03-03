<?php
session_start();
function randomGeneratedReceiptID() {
    $strings = "abcdefghijklmnopqrstuvwxyz0123456789";
    $stringSplit = str_split($strings);
    $randomGeneratedID = "";
    
    for ($i = 0; $i < 6; $i++) {
        $randomGeneratedID .= $stringSplit[rand(0, count($stringSplit) -1)];
    }

    return $randomGeneratedID;
}

if (empty(trim(htmlspecialchars($_POST['coffee-names'])))) {
    header("Location: /#cart");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'Database.php';

    $db = new Database();

    $coffeeNames = trim(htmlspecialchars($_POST['coffee-names']));
    $coffeeQuantities = trim(htmlspecialchars($_POST['coffee-quantities']));
    $coffeePrices = trim(htmlspecialchars($_POST['coffee-prices']));
    $coffeeTotalPrice = trim(htmlspecialchars($_POST['coffee-total-price']));

    $names = explode(" ", $coffeeNames);
    $quantities = explode(" ", $coffeeQuantities);
    $prices = explode(" ", $coffeePrices);
    
    $randomID = randomGeneratedReceiptID();

    for ($i = 0; $i < count($names); $i++) {
        $db->query("INSERT INTO coffee_order (receipt_id, name, quantity, price, total_price) VALUES (:rid, :name, :quantity, :price, :total)", [
            ':rid' => $randomID,
            ':name' => $names[$i],
            ':quantity' => $quantities[$i],
            ':price' => $prices[$i],
            ':total' => $coffeeTotalPrice
        ]);
    }

    $_SESSION['toast'] = 'Successfully added!';
    header("Location: orderhistory.php");
    exit();
}
