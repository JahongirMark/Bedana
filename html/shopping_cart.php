<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../php/auth.php'); // Adjust path accordingly
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bedana</title>
    <link rel="stylesheet" href="../css/shopping_cart.css">
    <link rel="stylesheet" href="../css/top-bar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="top-bar navbar navbar-expand-lg navbar-green bg-green" id="topBar">
        <div class="container">
            <div class="farm-name-overlay d-flex justify-content-center align-items-center">
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
                                <a class="dropdown-item" href="/html/about.php">ABOUT US</a>
                                <a class="dropdown-item" href="/html/feed.php">FROM FEED TO EGG</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SERVICES</a>
                            <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <a class="dropdown-item" href="/html/buy_now.php">BUY ONLINE</a>
                                <a class="dropdown-item" href="#">TAKE AWAY</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="learnSupportDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CONTACT</a>
                            <div class="dropdown-menu" aria-labelledby="learnSupportDropdown">
                                <a class="dropdown-item" href="/html/contact_us.php">CONTACT US</a>
                                <a class="dropdown-item" href="#">FEEDBACK</a>
                            </div>
                        </li>
                    </ul>
                </nav>
                  <!-- HTML for the shopping cart icon -->
                  <div class="basket-icon-container">
                <a href="../html/shopping_cart.php"> <!-- Add your desired link URL here -->
        <i class="fas fa-shopping-basket fa-lg"></i> <!-- Basket icon from Font Awesome -->
        <span class="cart-item-count">0</span> <!-- Display item count -->
    </a>
</div>
                <div class="me-5">
                    <a href="/php/logout.php" onclick="redirectToLogin()" class="login-button">Logout</a>
                </div>
                <div class="name me-5">
                    <?php
                    require_once('../php/connection.php');
                    $user_id = $_SESSION['user_id'];
                    $sql = "SELECT first_name FROM users WHERE id = '$user_id'";
                    $result = $connection->query($sql);
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $firstName = $row['first_name'];
                        echo '<a href="user_profile.php" class="name-link">Welcome, ' . $firstName . '</a>';
                    }
                    $result->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="shopping-cart container-sub mt-5">
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
            <tbody>

            </tbody>
        </table>
        <div class="cart-btn text-end">
            <a href="#" class="btn btn-success <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to
                Checkout</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script>
function initDropdowns() {
    var dropdowns = document.querySelectorAll('.dropdown');
    if (dropdowns) {
        dropdowns.forEach(function(dropdown) {
            var dropbtn = dropdown.querySelector('.nav-link');
            if (dropbtn) {
                dropbtn.addEventListener('mouseenter', function() {
                    dropdown.classList.add('show');
                });
                dropdown.addEventListener('mouseleave', function() {
                    dropdown.classList.remove('show');
                });
            }
        });
    }
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

document.addEventListener('DOMContentLoaded', function() {
    initDropdowns();
});
</script>

</html>