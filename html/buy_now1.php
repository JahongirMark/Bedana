<?php
require_once('../php/auth.php'); // Adjust the path accordingly
require_once('../php/connection.php'); // Ensure this path is correct
// Ensure session is started only once
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../html/login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:../html/login.php');
};

 if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($connection, "SELECT * FROM shopping_cart WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart!';
   }else{
      mysqli_query($connection, "INSERT INTO shopping_cart(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($connection, "UPDATE shopping_cart SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($connection, "DELETE FROM shopping_cart WHERE id = '$remove_id'") or die('query failed');
   header('location:../html/buy_now.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($connection, "DELETE FROM shopping_cart WHERE user_id = '$user_id'") or die('query failed');
   header('location:../html/buy_now.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/buy_now.css"> <!-- Link to your main stylesheet -->
    <link rel="stylesheet" href="/css/top-bar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <title>About Farm</title>
</head>

<body>
    <div class="top-bar navbar navbar-expand-lg navbar-green bg-green" id="topBar">
        <div class="container">
            <div class=""></div>
            <div class="farm-name-overlay  d-flex justify-content-center align-items-center">
                <a class="navbar-brand" href="/html/index.html">
                    <h1>Bedana</h1>
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarNav">
                <nav class="ml-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="/html/index.html" id="homeDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">HOME</a>
                            <div class="dropdown-menu" aria-labelledby="homeDropdown">
                                <a class="dropdown-item" href="/html/about.php">ABOUT US</a>
                                <a class="dropdown-item" href="/html/feed.php">FROM FEED TO EGG</a>
                                <!-- Add more learn and support links as needed -->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SERVICES</a>
                            <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <a class="dropdown-item" href="/html/buy_now.php">BUY ONLINE</a>
                                <a class="dropdown-item" href="#">TAKE AWAY</a>
                                <!-- Add more services as needed -->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="learnSupportDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CONTACT</a>
                            <div class="dropdown-menu" aria-labelledby="learnSupportDropdown">
                                <a class="dropdown-item" href="/html/contact_us.php">CONTACT US</a>
                                <a class="dropdown-item" href="#">FEEDBACK</a>
                                <!-- Add more learn and support links as needed -->
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- HTML for the shopping cart icon -->
                <div class="basket-icon-container">
                    < <i class="fas fa-shopping-basket fa-lg"></i> <!-- Basket icon from Font Awesome -->
                        <span class="cart-item-count">0</span> <!-- Display item count -->

                </div>


                <div class="me-5">
                    <a href="/php/logout.php" onclick="redirectToLogin()" class="login-button">Logout</a>
                </div>

                <div class="name me-5">
                    <?php
    require_once('../php/connection.php');

    $user_id = $_SESSION['user_id'];

    // Query to retrieve user information including first name
    $sql = "SELECT first_name FROM users WHERE id = '$user_id'";

    $result = $connection->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['first_name'];
        // Output the welcome message and first name inside an anchor tag with a class for styling
        echo '<a href="user_profile.php" class="name-link">Welcome, ' . $firstName . '</a>';
    } else {
        // Handle the case where user information is not found
    }

    // Close the database connection
    $result->close();
    ?>
                </div>


            </div>
        </div>
    </div>
    <div class="container mt-5 products">

        <h1 class="heading text-center mb-5">Latest Products</h1>

        <div class="row box-container">

            <?php
         $select_product = mysqli_query($connection, "SELECT * FROM products") or die('query failed');
         if(mysqli_num_rows($select_product) > 0){
            while($fetch_product = mysqli_fetch_assoc($select_product)){
      ?>
            <div class="col-md-4 col-lg-4 mb-4">
                <form method="post" class="box card h-100" action="">
                    <img src="../img/<?php echo $fetch_product['image']; ?>" class="card-img-top"
                        alt="<?php echo $fetch_product['name']; ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title name"><?php echo $fetch_product['name']; ?></h5>
                        <p class="card-text price">$<?php echo $fetch_product['price']; ?>/-</p>
                        <!-- <input type="number" min="1" name="product_quantity" value="1" class="form-control mb-3"> -->
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                        <?php
                     $product_id = $fetch_product['id'];
                     echo '<button type="submit" class="btn btn-primary" name="add_to_cart" onClick="updateBasketIndex(' . $product_id . ')">Add to Cart</button>';
                   ?>

                    </div>
                </form>
            </div>
            <?php
         };
      };
      ?>

        </div>

    </div>

    <div class="shopping-cart container mt-5">
    <h1 class="heading">Shopping Cart</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="cart-table-body">
            <!-- Table rows will be dynamically added here -->
        </tbody>
    </table>

    <div class="cart-total">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Grand Total:</td>
                            <td id="grand-total">$0.00/-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="cart-btn text-end">
        <a href="#" id="proceed-to-checkout-btn" class="btn btn-success disabled">Proceed to Checkout</a>
    </div>
</div>



    <div class="delivery-info">
        <img src="/img/delivery-logo.png" alt="Delivery Logo" class="delivery-logo">
        <div class="delivery-text">
            <p>We currently deliver orders on Mondays and Fridays. Please place your orders by Saturday for delivery the
                following Monday and by Wednesday for delivery the following Friday. Free delivery on all orders 250000
                UZS and above.</p>
            <p>Please call Bekzod on 998 99 500 07 06 with any queries regarding online sales.</p>
        </div>
    </div>



    <div class="footer">
        <div class="contact-info">
            <p class="phone-number">Phone: +998 (99) 500-07-06</p>
        </div>
        <div class="logo-wrapper">
            <a href="https://www.instagram.com" target="_blank" class="social-icon"><i
                    class="fab fa-instagram fa-2x"></i></a>
            <a href="https://t.me" target="_blank" class="social-icon"><i class="fab fa-telegram fa-2x"></i></a>
            <a href="https://www.facebook.com" target="_blank" class="social-icon"><i
                    class="fab fa-facebook fa-2x"></i></a>
            <a href="https://www.youtube.com" target="_blank" class="social-icon"><i
                    class="fab fa-youtube fa-2x"></i></a>
        </div>
        <div class="contact-info">
            <p class="email-address">Email: bedanafarm@gmail.com</p>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz4fnFO9gybbyQDz4NH8a68+sGF6V/ntP1YYF2eIT5xJt8xaYbIbO/2iX6" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-QNp+45ND5aAOQ5zYEGzDdA1Tr9e7xVpY54ASWJmALmYPk0EVL/2QK4kKeSI5SIeV" crossorigin="anonymous">
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var cartTableBody = document.getElementById('cart-table-body');
        var proceedToCheckoutBtn = document.getElementById('proceed-to-checkout-btn');

        var cartItems = [
            { name: 'Product 1', price: 10, quantity: 2, image: 'product1.jpg' },
            { name: 'Product 2', price: 15, quantity: 1, image: 'product2.jpg' },
            // Add more items as needed
        ];

        // Populate the cart table
        cartItems.forEach(function(item) {
            addProductToCart(item.name, item.price, item.image, item.quantity);
        });

        function addProductToCart(name, price, image, quantity) {
    var row = document.createElement('tr');

    row.innerHTML = `
        <td><img src="../img/${image}" height="100" alt="${name}"></td>
        <td>${name}</td>
        <td>$${price}/-</td>
        <td><input type="number" min="1" value="${quantity}" class="form-control w-50 cart-quantity-input"></td>
        <td>$${(price * quantity).toFixed(2)}/-</td>
        <td><button class="btn btn-danger remove-cart-item-btn">Remove</button></td>
    `;

    cartTableBody.appendChild(row);

    // Add event listener to the quantity input
    row.querySelector('.cart-quantity-input').addEventListener('change', function(event) {
        var newQuantity = event.target.value;
        updateCartRowTotal(row, newQuantity, price);
        updateGrandTotal();
    });

    // Add event listener to the remove button
    row.querySelector('.remove-cart-item-btn').addEventListener('click', function() {
        row.remove();
        updateGrandTotal();
    });

    // Send product details to the server to add to the database
    var formData = new FormData();
    formData.append('name', name);
    formData.append('price', price);
    formData.append('quantity', quantity);
    formData.append('image', image);

    fetch('/path/to/your/server/endpoint', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            console.log('Product added to database');
        } else {
            console.error('Failed to add product to database');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

</script>


<!-- <script>
function updateBasketIndex(productId) {

    var basketContent = document.querySelector('.cart-item-count');

    var newIndex = productId + 1;
    basketContent.textContent = newIndex;
}
</script>

<script>
function redirectToCheckout(productName, productImage) {
    // Retrieve the current item count from the basket icon
    var currentItemCount = parseInt(document.querySelector('.cart-item-count').textContent);

    // Increment the item count by one
    var updatedItemCount = currentItemCount + 1;

    // Update the item count display in the basket icon
    document.querySelector('.cart-item-count').textContent = updatedItemCount;

    // Redirect to the checkout page
    const queryString = `product=${encodeURIComponent(productName)}&image=${encodeURIComponent(productImage)}`;
    window.location.href = `basket.html?${queryString}`;
}
</script>
<script>
// Common script for both pages

function redirectToLogin() {
    // Redirect to the login page
    window.location.href = 'login_page.html';
}

function login() {
    // Implement login logic
    // Redirect to a protected page or update UI as needed
    // For demonstration purposes, you can show an alert
    alert('Login button clicked!');
}

// Add the following script for improved dropdown hover behavior
document.addEventListener("DOMContentLoaded", function() {
    initDropdowns();
});

function initDropdowns() {
    // Get all dropdowns
    var dropdowns = document.querySelectorAll('.dropdown');

    // Attach mouseenter event listener to each dropdown
    dropdowns.forEach(function(dropdown) {
        var dropbtn = dropdown.querySelector('.dropbtn');
        dropbtn.addEventListener('mouseenter', function() {
            dropdown.classList.add('show');
        });

        // Attach mouseleave event listener to each dropdown
        dropdown.addEventListener('mouseleave', function() {
            dropdown.classList.remove('show');
        });
    });
}
window.onscroll = function() {
    scrollFunction();
};

function scrollFunction() {
    var topBar = document.getElementById("topBar");

    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        topBar.style.position = "fixed";
        topBar.style.width = "100%";
        topBar.style.top = "0";
    } else {
        topBar.style.position = "relative";
    }
}



function redirectToCheckout(productName, productImage) {

    const queryString = `product=${encodeURIComponent(productName)}&image=${encodeURIComponent(productImage)}`;
    window.location.href = `basket.html?${queryString}`;
}
</script> -->

</html>