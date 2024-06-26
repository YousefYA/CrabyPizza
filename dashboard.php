<?php
require 'session_config.php';
require 'db_conn.php';
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header('Location: index.html');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assume form data includes toppings, crust, quantity etc.
    $toppings = $_POST['toppings']; // Make sure you have names set correctly in the form inputs
    $crust = $_POST['crust'];
    $quantity = $_POST['quantity'];
    $extraCheese = isset($_POST['extra-cheese']) ? true : false;
    
    // Calculate costs (example)
    $totalCost = calculateCost($toppings, $crust, $quantity, $extraCheese);

    // Insert order into database
    $stmt = $conn->prepare("INSERT INTO orders (user_id, order_details,
total_cost) VALUES (?, ?, ?)"); $stmt->execute([$_SESSION['user_id'],
json_encode($_POST), $totalCost]); // 
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="theme-color" content="#D58E3C" />

    <title>CrabyPizza Menu Order</title>
    <link rel="stylesheet" href="./assets/dashboard_style.css" />
    <link
      rel="shortcut icon"
      href="assets/images/favicon.png"
      type="image/png"
      sizes="192x192"
    />
    <link rel="stylesheet" href="assets/responsive.css" />
  </head>

  <body>
    <header>
      C<img src="assets/images/logo.png" id="logo-img" />smic Pizzas
    </header>
    <!-- Logout Button -->
    <div class="logout-button-container">
      <form action="logout.php" method="post">
        <button type="submit" class="logout-button">Logout</button>
      </form>
    </div>

    <div class="grid-container">
      <!-- THE PIZZA -->
      <div class="grid-child pizza-container">
        <div class="pizza-title">CUSTOMIZE YOUR PIZZA!</div>
        <div class="pizza-image">
          <img src="assets/images/margherita.png" id="the-pizza" />
          <img
            src="assets/customise/peri-peri-chicken.png"
            class="topping-image"
            id="peri-peri-chicken"
          />
          <img
            src="assets/customise/barbeque.png"
            class="topping-image"
            id="barbeque"
          />
          <img
            src="assets/customise/chicken-sausage.png"
            class="topping-image"
            id="sausage"
          />
          <img
            src="assets/customise/chicken-tikka.png"
            class="topping-image"
            id="chicken-tikka"
          />
          <img
            src="assets/customise/grilled-chicken-rasher.png"
            class="topping-image"
            id="grilled-chicken-rasher"
          />
          <img
            src="assets/customise/capsicum.png"
            class="topping-image"
            id="capsicum"
          />
          <img
            src="assets/customise/mushroom.png"
            class="topping-image"
            id="mushroom"
          />
          <img
            src="assets/customise/onion.png"
            class="topping-image"
            id="onion"
          />
          <img
            src="assets/customise/paneer.png"
            class="topping-image"
            id="paneer"
          />
          <img
            src="assets/customise/paparika.png"
            class="topping-image"
            id="paparika"
          />
          <img
            src="assets/customise/jalapeno.png"
            class="topping-image"
            id="jalapeno"
          />
          <img
            src="assets/customise/greenOlives.png"
            class="topping-image"
            id="green-olives"
          />
          <img
            src="assets/customise/goldenCorn.png"
            class="topping-image"
            id="golden-corn"
          />
        </div>
        <div class="pizza-caption">
          A classic delight loaded with extra 100% real mozzarella cheese.
        </div>
      </div>
      <!-- THE TOPPINGS -->
      <div class="grid-child toppings-container">
        <div class="toppings-head">ADD TOPPINGS</div>
        <div class="toppings-genres">
          <div class="toppings-genre active" onclick="openGenre(event, 'veg')">
            VEG
          </div>
          <div class="toppings-genre" onclick="openGenre(event, 'non')">
            NON VEG
          </div>
        </div>
        <div class="toppings-body">
          <div class="toppings-body-veg toppings-body-child active-genre">
            <div class="topping" title="₹13">
              <img src="assets/thumbnails/Mushroom.png" alt="" srcset="" />
              <span>MUSHROOM</span>
            </div>
            <div class="topping" title="₹30">
              <img src="assets/thumbnails/Onion.png" alt="" srcset="" />
              <span>ONION</span>
            </div>
            <div class="topping" title="₹45">
              <img src="assets/thumbnails/Paneer.png" alt="" srcset="" />
              <span>PANEER</span>
            </div>
            <div class="topping" title="₹23">
              <img src="assets/thumbnails/Paparika.png" alt="" srcset="" />
              <span>PAPARIKA</span>
            </div>
            <div class="topping" title="₹23">
              <img src="assets/thumbnails/Jalapeno.png" alt="" srcset="" />
              <span>JALAPENO</span>
            </div>
            <div class="topping" title="₹67">
              <img src="assets/thumbnails/Olives.png" alt="" srcset="" />
              <span>GREEN OLIVES</span>
            </div>
            <div class="topping" title="₹34">
              <img src="assets/thumbnails/GoldenCorn.png" alt="" srcset="" />
              <span>GOLDEN CORN</span>
            </div>
            <div class="topping" title="₹45">
              <img src="assets/thumbnails/Capsicum.png" alt="" srcset="" />
              <span>CAPSICUM</span>
            </div>
          </div>
          <div class="toppings-body-non toppings-body-child">
            <div class="topping" title="₹34">
              <img
                src="assets/thumbnails/PeriPeriChicken.png"
                alt=""
                srcset=""
              />
              <span>PERI PERI CHICKEN</span>
            </div>
            <div class="topping" title="₹56">
              <img src="assets/thumbnails/Barbeque.png" alt="" srcset="" />
              <span>BARBEQUE</span>
            </div>
            <div class="topping" title="₹23">
              <img
                src="assets/thumbnails/ChickenSausage.png"
                alt=""
                srcset=""
              />
              <span>SAUSAGE</span>
            </div>
            <div class="topping" title="₹76">
              <img src="assets/thumbnails/ChickenTikka.png" alt="" srcset="" />
              <span>CHICKEN TIKKA</span>
            </div>
            <div class="topping" title="₹23">
              <img
                src="assets/thumbnails/GrilledChickenRasher.png"
                alt=""
                srcset=""
              />
              <span>GRILLED CHICKEN RASHER</span>
            </div>
          </div>
        </div>
      </div>
      <!-- THE CRUSTS -->
      <div class="grid-child crust-container">
        <div class="crust-head">CHOOSE YOUR CRUST</div>
        <div class="crust-body">
          <div class="crust selected-crust" title="₹34">
            CLASSIC HAND TOSSED
          </div>
          <div class="crust" title="₹23">CHEESE BURST</div>
          <div class="crust" title="₹43">WHEAT THIN CRUST</div>
          <div class="crust" title="₹34">FRESH PAN</div>
          <div class="crust" title="₹43">NEW HAND TOSSED</div>
        </div>
      </div>
      <!-- THE MONEY 💲💲💲 -->
      <div class="grid-child bill-container">
        <div class="bill-extras">
          <span>Quantity</span>
          <select name="quantity" id="quantity" onclick="updateBill()">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
          <label for="extra-cheese" class="cheese" title="₹15"
            >Extra Cheese
            <input
              type="checkbox"
              name="extra-cheese"
              id="extra-cheese"
              onclick="updateBill()"
            />
            <span class="checkmark" title="₹15"></span>
          </label>
        </div>
        <div class="bill">
          <ul class="bill-list">
            <li>
              <span class="bill-label">Total:</span>
              <span class="bill-value" id="total-cost">₹34</span>
            </li>
            <li>
              <span class="bill-label">Extra Toppings:</span>
              <span class="bill-value" id="toppings-cost">₹0</span>
            </li>
            <li>
              <span class="bill-label">Extra Cheese:</span>
              <span class="bill-value" id="cheese-cost">₹0</span>
            </li>
            <li>
              <span class="bill-label">GST:</span>
              <span class="bill-value" id="gst-cost">₹0</span>
            </li>
            <li id="grand-total">
              <span class="bill-label">Grand Total:</span>
              <span class="bill-value" id="grand-cost">₹34</span>
            </li>
          </ul>
          <div id="buy-now">
            <a><span>Buy Now</span></a>
          </div>
        </div>
      </div>
    </div>

    <div id="popup">
      <p id="close">×</p>
      <h2>Buy now</h2>
      <p>Enter Delivery Address</p>
      <textarea cols="1" rows="8"></textarea>
      <button id="confirm-btn">Confirm Purchase</button>
    </div>

    <script src="./assets/dashboard_app.js"></script>
  </body>
</html>
