<?php
    session_start();
    require_once 'Database.php';
    $db = new Database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/coffee-icon.jpg">
    <title>Order History</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="coffee-container">
        <h1>Order History</h1>
        <a class="order-history-link" href="/">Home</a>
        <small style="font-size: 1.2rem; color: lightgreen;"><?= $_SESSION['toast'] ?? '' ?></small>
        <hr/>
        <?php foreach($receipts as $receipt): ?>
            <?php
                $orders = $db->query("SELECT receipt_id, name, quantity, price, total_price, created_at FROM coffee_order WHERE receipt_id = :id", [
                    ':id' => $receipt['receipt_id'],
                ])->getAll();
            ?>
            <div class="order-receipt-card">
                <div class="order-receipt-header">
                    <h2><?= $receipt['receipt_id'] ?></h2>
                    <small>Receipt ID</small>
                </div>
                <p class="order-receipt-date">Date: <?= $receipt['created_at'] ?></p>
                <hr/>
                <div class="order-receipt-details">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Coffee</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $order): ?>
                            <tr>
                                <td><?= $order['name']?></td>
                                <td><?= $order['quantity']?></td>
                                <td>$<?= number_format($order['price'], 2)?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="order-receipt-total-price">
                    <span>Total: $<?= $receipt['total_price'] ?></span>
                </div>
                <div class="order-receipt-delete">
                    <form action="deletereceipt.php" method="post">
                        <input type="hidden" name="receipt_id" value="<?= $receipt['receipt_id']?>">
                        <button type="submit">Delete Receipt</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
        $db = null;
    ?>
</body>
</html>