<?php
require_once('../php/auth.php'); // Adjust path accordingly
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
    <link rel="stylesheet" href="/css/contact_us.css">
    <link rel="stylesheet" href="/css/top-bar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <nav class="ml-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="../html/index.php" id="homeDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">HOME</a>
                            <div class="dropdown-menu" aria-labelledby="homeDropdown">
                                <a class="dropdown-item" href="/html/about.php">ABOUT US</a>
                                <a class="dropdown-item" href="/html/feed.php">FROM FEED TO EGG</a>
                                <!-- Add more learn and support links as needed -->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SERVICES</a>
                            <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <a class="dropdown-item" href="/html/buy_now.php">BUY ONLINE</a>
                                <a class="dropdown-item" href="../html/tracking_orders.php">ORDERS</a>
                                <!-- Add more services as needed -->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="learnSupportDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CONTACT</a>
                            <div class="dropdown-menu" aria-labelledby="learnSupportDropdown">
                                <a class="dropdown-item" href="/html/contact_us.php">CONTACT US</a>
                                <!-- <a class="dropdown-item" href="#">FEEDBACK</a> -->
                                <!-- Add more learn and support links as needed -->
                            </div>
                        </li>
                    </ul>
                </nav>
                
<!-- Basket icon and login button -->
<!-- <div class="basket-icon-container">
    <i class="fas fa-shopping-basket fa-lg"></i> 
</div> -->


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
    $connection->close();
    ?>
</div>


            </div>
        </div>
    </div>
<section class="contact_us-info container">
    <div class="row">
        <div class="col-md-6">
            <div class="contact-details">
                <h2 class="mb-5">GET IN TOUCH WITH US AT</h2>
                <address class="mb-5">
                    Packington Free Range,<br>
                    Blakenhall Park,<br>
                    Barton-under-Needwood,<br>
                    Staffordshire, DE13 8AJ
                </address>
                <p class="mb-2"><a href="mailto:bedanafarm@gmail.com">bedanafarm@gmail.com</a></p>
                <p class="mb-2">Bedana Farm: +998 (99) 500-07-07</p>
                <p>Online Sales Enquiries: +998 (99) 500-07-06</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="map-container">
                <!-- Replace the following iframe with your embedded map code -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1467.8767633090802!2d60.54504263484415!3d41.54141033007904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1705924764035!5m2!1sen!2s" style="max-width: 100%; width: 600px; height: 450px; border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>



<div class="footer">
    <div class="contact-info">
        <p class="phone-number">Phone: +998 (99) 500-07-06</p>
    </div>
    <div class="logo-wrapper">
        <a href="https://www.instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram fa-2x"></i></a>
        <a href="https://t.me" target="_blank" class="social-icon"><i class="fab fa-telegram fa-2x"></i></a>
        <a href="https://www.facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook fa-2x"></i></a>
        <a href="https://www.youtube.com" target="_blank" class="social-icon"><i class="fab fa-youtube fa-2x"></i></a>
      </div>
    <div class="contact-info">
        <p class="email-address">Email: bedanafarm@gmail.com</p>
    </div>
</div>

</body>
<script>
    // Common script for both pages

    function redirectToLogin() {
        // Redirect to the login page
        window.location.href = '/html/login_page.php';
    }

    function login() {
        // Implement login logic
        // Redirect to a protected page or update UI as needed
        // For demonstration purposes, you can show an alert
        alert('Login button clicked!');
    }

    document.addEventListener("DOMContentLoaded", function () {
initDropdowns();
});

function initDropdowns() {
// Get all dropdowns
var dropdowns = document.querySelectorAll('.dropdown');

if (dropdowns) {
    // Attach mouseenter event listener to each dropdown
    dropdowns.forEach(function (dropdown) {
        var dropbtn = dropdown.querySelector('.nav-link'); // Assuming 'nav-link' is the class of your dropdown toggle
        if (dropbtn) {
            dropbtn.addEventListener('mouseenter', function () {
                dropdown.classList.add('show');
            });

            // Attach mouseleave event listener to each dropdown
            dropdown.addEventListener('mouseleave', function () {
                dropdown.classList.remove('show');
            });
        }
    });
}
}

// Rest of your code...

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
