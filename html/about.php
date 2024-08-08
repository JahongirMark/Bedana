<?php
require_once('../php/auth.php'); // Adjust path accordingly
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="stylesheet" href="/css/about.css">
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
                                <a class="dropdown-item" href="../html/about.php">ABOUT US</a>
                                <a class="dropdown-item" href="../html/feed.php">FROM FEED TO EGG</a>
                                <!-- Add more learn and support links as needed -->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="../html/buy_now.php" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SERVICES</a>
                            <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <a class="dropdown-item" href="../html/buy_now.php">BUY ONLINE</a>
                                <a class="dropdown-item" href="../html/tracking_orders.php">ORDERS</a>
                                <!-- Add more services as needed -->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="learnSupportDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CONTACT</a>
                            <div class="dropdown-menu" aria-labelledby="learnSupportDropdown">
                                <a class="dropdown-item" href="../html/contact_us.php">CONTACT US</a>
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
<a href="../php/logout.php" onclick="redirectToLogin()" class="login-button">Logout</a>
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
    $connection->close();
    ?>
</div>


            </div>
        </div>
    </div>
    <div class="hero-image">
        <img src="../img/about-farm.jpg" alt="Farm Landscape" style="max-width: 100%; height: auto;">
    </div>
    
<section class="about-section">
    <div class="container">
        <div class="about-text">
            <h2>Our Journey</h2>

            <p>Our family-run quail and chicken farm, Bedana Farm, was established in 2017. Rooted in the principles of passion, respect, and excellence, our journey has been marked by unwavering commitment to ethical and sustainable farming practices.</p>

            <h3>PASSION</h3>
            <p>Our fervor lies in the ethical and sustainable cultivation of quails and chickens. These values drive our mission to create an environmentally conscious and welfare-oriented farm.</p>

            <h3>RESPECT</h3>
            <p>Our respect extends beyond our flocks to the land they inhabit. We implement various environmental initiatives on our farms, including grass margins around our fields to protect hedgerows and foster a secure environment for diverse ecosystems. Many field corners are dedicated to wild bird seed mixes and pollen and nectar mixes, providing essential food sources for insects and farmland birds.</p>

            <h3>EXCELLENCE</h3>
            <p>At Bedana Farm, established in 2017, we provide extensive green and lush pastures for our birds to roam freely and ample time for them to mature. This approach not only prioritizes the welfare of our animals but also results in top-quality meat. This recognition is not only echoed by our satisfied customers and numerous industry awards but also acknowledged by renowned chefs. Our caring ethos has been commended, with our free-range quails and chickens earning praise as some of the happiest in the industry.</p>

            <p>Our commitment to ethical farming is exemplified by adherence to Freedom Food accreditation standards for our outdoor-reared quails and chickens. Bedana Farm has been honored with the prestigious Good Chicken and Quail Award from Compassion in World Farming, reflecting our dedication to excellence since our establishment in 2017.</p>
        </div>
        <img src="/img/about-us1.jpg" alt="About Us Image">
    </div>
</section>
<section class="farm-section">
    <div class="container">
        <div class="farm-text">
            <h2>A Blossoming Family Farm: Quail and Chicken Oasis Since 2017</h2>

            <p>Established in 2017, our family farm nestled in a picturesque rural setting has become a beacon of sustainable agriculture. Founded by John and Sarah Thompson, our dream was to create a haven for quail and chickens, offering fresh, locally sourced eggs and poultry to our community.</p>

            <p>Divided into dedicated sections, our quail enjoy spacious aviaries replicating their natural habitat, while free-range areas allow our chickens to roam freely, contributing to the flavor of their eggs. Committed to sustainability, our farm is powered by solar panels, and organic farming practices cultivate feed for our birds, minimizing environmental impact.</p>

            <p>Beyond economic success, our farm has become a community hub, welcoming visitors to learn about responsible farming practices and interact with our happy quails and chickens. We've created jobs for locals and established strong connections with nearby businesses, embodying the essence of a family-run, sustainable enterprise.</p>

            <p>As the sun sets over our fields, casting a warm glow on our coops, it's clear that our dream has blossomed into a thriving reality. Our quails and chickens continue to provide fresh, wholesome products, and our commitment to ethical practices ensures our family farm remains a cherished and sustainable institution for generations to come.</p>
        </div>
        <img src="/img/about-us2.jpg" alt="Farm Image">
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
        window.location.href = '/html/login.php';
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
