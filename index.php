<?php
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/coffee-icon.jpg">
    <title>Coffee Order System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="coffee-container">
        <h1>Order a Coffee :&#41;</h1>
        <a class="order-history-link" href="orderhistory.php">Order History</a>
        <hr>
        <div class="coffee-selection">
            <p style="color: red; font-size: 1.6rem;" class="error"></p>
            <div title="Click to expand" class="coffee-imgs">
                <img class="coffee-img" src="assets/choosecoffee.webp" alt="choose a coffee" width="250" height="250">
                <img class="coffee-img hidden" src="assets/choosecoffee.webp" alt="choose a coffee" width="250" height="250">
            </div>
            <div class="slide-btns">
                <button class="prev-btn">
                    <img class="prev-icon" src="assets/prev.svg" alt="prev" width="40" height="40">
                </button>
                <button class="next-btn">
                    <img class="next-icon" src="assets/next.svg" alt="next" width="40" height="40">
                </button>
            </div>
            <select name="coffee-select" id="coffee-select">
                <option value="">--Please choose a &#x2615;--</option>
                <option data-first-img="assets/coffee-imgs/affogato-0.webp" data-second-img="assets/coffee-imgs/affogato-1.webp" value="Affogato" data-price="4.70">
                    Affogato &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/americano-0.webp" data-second-img="assets/coffee-imgs/americano-1.webp" value="Americano" data-price="4.99">
                    Americano &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/black-eye-0.webp" data-second-img="assets/coffee-imgs/black-eye-1.webp" value="Black-Eye" data-price="3.90">
                    Black-Eye &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/breve-0.webp" data-second-img="assets/coffee-imgs/breve-1.webp" value="Breve" data-price="3.77">
                    Breve &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/cafe-au-lait-0.webp" data-second-img="assets/coffee-imgs/cafe-au-lait-1.webp" value="Cafe-au-Lait" data-price="3.88">
                    Cafe-au-Lait &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/cafe-latte-0.webp" data-second-img="assets/coffee-imgs/cafe-latte-1.webp" value="Cafe-Latte" data-price="5.33">
                    Cafe-Latte &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/cappuccino-0.webp" data-second-img="assets/coffee-imgs/cappuccino-1.webp" value="Cappucino" data-price="4.69">
                    Capuccino &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/cortado-0.webp" data-second-img="assets/coffee-imgs/cortado-1.webp" value="Cortado" data-price="3.98">
                    Cortado &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/espresso-0.webp" data-second-img="assets/coffee-imgs/espresso-1.webp" value="Espresso" data-price="4.24">
                    Espresso &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/flat-white-0.webp" data-second-img="assets/coffee-imgs/flat-white-1.webp" value="Flat-White" data-price="4.20">
                    Flat-White &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/iced-coffee-0.webp" data-second-img="assets/coffee-imgs/iced-coffee-1.webp" value="Iced-Coffee" data-price="5.11">
                    Iced-Coffee &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/long-black-0.webp" data-second-img="assets/coffee-imgs/long-black-1.webp" value="Long-Black" data-price="5.12">
                    Long-Black &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/macchiato-0.webp" data-second-img="assets/coffee-imgs/macchiato-1.webp" value="Macchiato" data-price="4.10">
                    Macchiato &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/mocha-0.webp" data-second-img="assets/coffee-imgs/mocha-1.webp" value="Mocha" data-price="5.27">
                    Mocha &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/red-eye-0.webp" data-second-img="assets/coffee-imgs/red-eye-1.webp" value="Red-Eye" data-price="6.20">
                    Red-Eye &#x2615;
                </option>
                <option data-first-img="assets/coffee-imgs/vienna-0.webp" data-second-img="assets/coffee-imgs/vienna-1.webp" value="Vienna" data-price="6.01">
                    Vienna &#x2615;
                </option>
            </select>
            <div class="quantity-container">
                <label for="quantity">Quantity: </label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" max="10" required>
            </div>
            <div class="price-container">
                <span>Price: $<b class="price-value">0</b></span>
                <button type="button" class="add-to-cart-btn">Add to cart</button>
            </div>
        </div>
        <div class="cart-container" id="cart">
            <form class="submit-form" action="submitorder.php" method="post">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th scope="col">Coffee</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="cart-info">
                    <p>Coffee added to the cart will be shown here!. :&#41;</p>
                </div>
                <input type="hidden" name="coffee-names">
                <input type="hidden" name="coffee-quantities">
                <input type="hidden" name="coffee-prices">
                <input type="hidden" name="coffee-total-price">
                <div class="submit-order-container">
                    <h4 class="total-price">Total Price: $<b class="total-price-value">0</b></h4>
                    <button type="submit" class="submit-order-btn">Submit Order</button>
                </div>
            </form>
        </div>
    </div>
    <dialog class="coffee-modal">
        <img src="" alt="" width="500" height="500">
    </dialog>
    <script src="js/index.js"></script>
</body>
</html>