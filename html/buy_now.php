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
                <a class="navbar-brand" href="../html/index.php">
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
                            <a class="nav-link dropdown-toggle" href="../html/index.php" id="homeDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">HOME</a>
                            <div class="dropdown-menu" aria-labelledby="homeDropdown">
                                <a class="dropdown-item" href="../html/about.php">ABOUT US</a>
                                <a class="dropdown-item" href="../html/feed.php">FROM FEED TO EGG</a>
                                <!-- Add more learn and support links as needed -->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="../html/buy_now.php" id="servicesDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SERVICES</a>
                            <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <a class="dropdown-item" href="../html/buy_now.php">BUY ONLINE</a>
                                <a class="dropdown-item" href="../html/tracking_orders.php">ORDERS</a>
                                
                                <!-- Add more services as needed -->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="learnSupportDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CONTACT</a>
                            <div class="dropdown-menu" aria-labelledby="learnSupportDropdown">
                                <a class="dropdown-item" href="../html/contact_us.php">CONTACT US</a>
                                <!-- <a class="dropdown-item" href="#">FEEDBACK</a> -->
                                <!-- Add more learn and support links as needed -->
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="basket-icon-container" id="cartLogo">
                     <i class="fas fa-shopping-basket fa-lg"></i> <!-- Basket icon from Font Awesome -->
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
        echo '<a href="../html/user_profile.php" class="name-link">Welcome, ' . $firstName . '</a>';
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
            <div class="box card h-100">
                <img src="../img/<?php echo $fetch_product['image']; ?>" class="card-img-top" alt="<?php echo $fetch_product['name']; ?>">
                <div class="card-body text-center">
                    <h5 class="card-title name"><?php echo $fetch_product['name']; ?></h5>
                    <p class="card-text price"><?php echo $fetch_product['price']; ?>UZS</p>
                    <button type="button" class="btn btn-success add-to-cart-btn"
                        data-product-name="<?php echo $fetch_product['name']; ?>"
                        data-product-price="<?php echo $fetch_product['price']; ?>"
                        data-product-image="<?php echo $fetch_product['image']; ?>">Add to Cart</button>
                    <div class="cart-message" style="display: none; position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); background-color: #28a745; color: white; padding: 5px 10px; border-radius: 5px;">Product added to cart!</div>

                </div>
            </div>
        </div>
        <?php
            };
        };
        ?>
    </div>
</div>
<form action="../php/payment.php" method="POST">
    <div class="shopping-cart container mt-5">
        <h1 class="heading">Shopping Cart</h1>
        <div class="table-responsive">
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
                    <!-- Cart items will be dynamically added here -->
                </tbody>
                <tfoot>
                    <tr id="grand-total-row">
                        <td colspan="4" class="text-end fw-bold">Grand Total:</td>
                        <td id="grand-total" class="fw-bold">0.00UZS</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="cart-btn text-end mt-3">
            <button type="submit" class="btn btn-success" id="proceed-to-checkout-btn">Proceed to Payment</button>
        </div>
    </div>
</form>




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
    // Calculate and update the grand total
    function updateGrandTotal() {
        var grandTotal = 0;

        // Iterate over each row in the cart table
        document.querySelectorAll('#cart-table-body tr').forEach(function(row) {
            var price = parseFloat(row.querySelector('td:nth-child(3)').textContent.replace('UZS', '').replace('/-', ''));
            var quantity = parseInt(row.querySelector('input[name="cart_quantity"]').value);
            var subtotal = price * quantity;
            grandTotal += subtotal;
            // Update the total price for this row
            row.querySelector('td:nth-child(5)').textContent = 'UZS' + subtotal.toFixed(2) + '/-';
        });

        // Update the grand total
        document.getElementById('grand-total').textContent = 'UZS' + grandTotal.toFixed(2) + '/-';
    }

    // Call the function to calculate and update the grand total initially
    updateGrandTotal();

    // Add event listeners to the quantity inputs for dynamic updates
    document.querySelectorAll('input[name="cart_quantity"]').forEach(function(input) {
        input.addEventListener('input', updateGrandTotal);
    });

    // Add event listener to the cart logo
    document.getElementById('cartLogo').addEventListener('click', function() {
        // Scroll to the beginning of the table
        document.querySelector('.shopping-cart').scrollIntoView({ behavior: 'smooth' });
    });

    // Select all "Add to Cart" buttons
    var addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    // Loop through each "Add to Cart" button
    addToCartButtons.forEach(function(button) {
        // Initialize click count for each button
        var clickCount = 0;

        // Add click event listener to each button
        button.addEventListener('click', function() {
            // Increment click count
            clickCount++;

            // Select the cart message element within the scope of the button
            var cartMessage = button.closest('.box').querySelector('.cart-message');

            if (clickCount === 1) {
                // Display the cart message for the first click
                cartMessage.style.display = 'block';
                // Hide the cart message after 3 seconds
                setTimeout(function() {
                    cartMessage.style.display = 'none';
                }, 2000);
            } else if (clickCount === 2) {
                // Scroll to the table for the second click
                document.querySelector('.shopping-cart').scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    var cartTableBody = document.getElementById('cart-table-body');
    var proceedToCheckoutBtn = document.getElementById('proceed-to-checkout-btn');
    var cartMessage = document.getElementById('cart-message');

    addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var productName = button.getAttribute('data-product-name');
            var productPrice = button.getAttribute('data-product-price');
            var productImage = button.getAttribute('data-product-image');
 

            if (isProductInCart(productName)) {
                scrollToCartTable();
            } else {
                addProductToCart(productName, productPrice, productImage, 0);
                showTemporaryMessage('Product added to cart!');
            }
        });
    });

    function isProductInCart(productName) {
        var cartItems = cartTableBody.querySelectorAll('tr td:nth-child(2)');
        for (var i = 0; i < cartItems.length; i++) {
            if (cartItems[i].textContent === productName) {
                return true;
            }
        }
        return false;
    }

    function addProductToCart(name, price, image, quantity) {
        var row = document.createElement('tr');

        row.innerHTML = `
            <td><img src="../img/${image}" height="100" alt="${name}"></td>
            <td>${name}</td>
            <td>UZS${price}/-</td>
            <td><input type="number" min="0" max="10" value="${quantity}" name="cart_quantity" class="form-control w-50 cart-quantity-input"></td>
            <td>UZS${(price * quantity).toFixed(2)}/-</td>
            <td><button class="btn btn-danger remove-cart-item-btn">Remove</button></td>
        `;

        cartTableBody.appendChild(row);

        // Update the cart item count
        updateCartItemCount();

        // Add event listener to the quantity input
        row.querySelector('.cart-quantity-input').addEventListener('change', function(event) {
            var newQuantity = event.target.value;
            updateCartRowTotal(row, newQuantity, price);
            updateGrandTotal();
        });

        // Add event listener to the remove button
        row.querySelector('.remove-cart-item-btn').addEventListener('click', function() {
            row.remove();
            updateCartItemCount();
            updateGrandTotal();
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to the quantity inputs for scrolling updates
    document.querySelectorAll('input[name="cart_quantity"]').forEach(function(input) {
        input.addEventListener('wheel', function(event) {
            event.preventDefault(); // Prevent default scrolling behavior

            // Get the current value of the input
            let value = parseInt(input.value);

            // Increment or decrement the value based on scroll direction
            if (event.deltaY < 0 && value < 5) {
                input.value = value + 1; // Increment value
            } else if (event.deltaY > 0 && value > 0) {
                input.value = value - 1; // Decrement value
            }

            // Dispatch input event to trigger any associated input listeners
            input.dispatchEvent(new Event('input'));
        });

        // Add event listener to prevent keyboard input
        input.addEventListener('keydown', function(event) {
            event.preventDefault(); // Prevent default keyboard input behavior
        });
    });
});

    function updateCartRowTotal(row, quantity, price) {
        var totalPriceCell = row.querySelector('td:nth-child(5)');
        totalPriceCell.textContent = `$${(price * quantity).toFixed(2)}/-`;
    }

    function updateCartItemCount() {
        var itemCount = cartTableBody.querySelectorAll('tr').length;
        document.querySelector('.cart-item-count').textContent = itemCount;
    }

    function scrollToCartTable() {
        cartTableBody.scrollIntoView({ behavior: 'smooth' });
    }

    function showTemporaryMessage(message) {
        cartMessage.textContent = message;
        cartMessage.style.display = 'block';
        setTimeout(function() {
            cartMessage.style.display = 'none';
        }, 3000);
    }

    proceedToCheckoutBtn.addEventListener('click', function() {
        // Collect cart data and send to server for further processing
        var cartItems = [];

        cartTableBody.querySelectorAll('tr').forEach(function(row) {
            var item = {
                name: row.querySelector('td:nth-child(2)').textContent,
                price: row.querySelector('td:nth-child(3)').textContent.replace('UZS', '').replace('/-', ''),
                quantity: row.querySelector('.cart-quantity-input').value,
                image: row.querySelector('img').src
            };
            cartItems.push(item);
        });

        // Send cartItems to the server via AJAX or store them for later submission
        console.log(cartItems);

        // Example: send cart data to the server
        // fetch('/path/to/your/server/endpoint', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json'
        //     },
        //     body: JSON.stringify(cartItems)
        // }).then(response => response.json())
        // .then(data => {
        //     console.log('Success:', data);
        // }).catch((error) => {
        //     console.error('Error:', error);
        // });
      
    });
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.body.addEventListener('click', function(event) {
            if (event.target && event.target.id === 'proceed-to-checkout-btn') {
                event.preventDefault(); // Prevent default form submission behavior

                // Check if cart is empty
            var cartItems = document.getElementById('cart-table-body').querySelectorAll('tr');
            if (cartItems.length === 0) {
                alert('Please add items to the cart before proceeding to payment.');
                return; // Exit the function if cart is empty
            }

            // Check if any item quantity is zero
            var allQuantitiesValid = true;
            cartItems.forEach(function(row) {
                var quantity = parseInt(row.querySelector('.cart-quantity-input').value);
                if (quantity === 0) {
                    allQuantitiesValid = false;
                    return; // Exit the loop if a quantity is zero
                }
            });

            // If any quantity is zero, prevent form submission and display a message
            if (!allQuantitiesValid) {
                alert('Please ensure that the quantity of all items, added to the cart, is greater than zero before proceeding to payment.');
                return;
            }
                // Collect cart data
                var cartItemsData = [];
                var grandTotal = parseFloat(document.getElementById('grand-total').textContent.replace('UZS', '').replace('/-', ''));

                cartItems.forEach(function(row) {
                    var item = {
                        name: row.querySelector('td:nth-child(2)').textContent,
                        price: row.querySelector('td:nth-child(3)').textContent.replace('UZS', '').replace('/-', ''),
                        quantity: row.querySelector('.cart-quantity-input').value,
                        image: row.querySelector('img').src
                    };
                    cartItemsData.push(item);
                });

                // Create a hidden form element
                var form = document.createElement('form');
                form.method = 'post';
                form.action = '../php/payment.php'; // Update this with the correct action URL

                // Create hidden input fields to store the cart items data and grand total
                var inputCartItems = document.createElement('input');
                inputCartItems.type = 'hidden';
                inputCartItems.name = 'cart_items';
                inputCartItems.value = JSON.stringify(cartItemsData); // Serialize the cart items array

                var inputGrandTotal = document.createElement('input');
                inputGrandTotal.type = 'hidden';
                inputGrandTotal.name = 'grand_total';
                inputGrandTotal.value = grandTotal.toFixed(2); // Store the grand total with two decimal places

                // Append the input fields to the form
                form.appendChild(inputCartItems);
                form.appendChild(inputGrandTotal);

                // Append the form to the document body and submit it
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
</script>


<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var proceedToCheckoutBtn = document.getElementById('proceed-to-checkout-btn');
    var cartTableBody = document.getElementById('cart-table-body');

    proceedToCheckoutBtn.addEventListener('click', function() {
        // Collect cart data
        var cartItems = [];
        var grandTotal = parseFloat(document.getElementById('grand-total').textContent.replace('$', '').replace('/-', ''));

        cartTableBody.querySelectorAll('tr').forEach(function(row) {
            var item = {
                name: row.querySelector('td:nth-child(2)').textContent,
                price: row.querySelector('td:nth-child(3)').textContent.replace('$', '').replace('/-', ''),
                quantity: row.querySelector('.cart-quantity-input').value,
                image: row.querySelector('img').src
            };
            cartItems.push(item);
        });

        // Create a hidden form element
        var form = document.createElement('form');
        form.method = 'post';
        form.action = '../php/payment.php'; // Update this with the correct action URL

        // Create hidden input fields to store the cart items data and grand total
        var inputCartItems = document.createElement('input');
        inputCartItems.type = 'hidden';
        inputCartItems.name = 'cart_items';
        inputCartItems.value = JSON.stringify(cartItems); // Serialize the cart items array

        var inputGrandTotal = document.createElement('input');
        inputGrandTotal.type = 'hidden';
        inputGrandTotal.name = 'grand_total';
        inputGrandTotal.value = grandTotal.toFixed(2); // Store the grand total with two decimal places

        // Append the input fields to the form
        form.appendChild(inputCartItems);
        form.appendChild(inputGrandTotal);

        // Append the form to the document body and submit it
        document.body.appendChild(form);
        form.submit();
    });
});
</script> -->






<!-- <script>
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
</script> -->
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
</script>

</html>