<?php
require_once('../php/auth.php'); // Adjust path accordingly
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
    <link rel="stylesheet" href="/css/feed.css">
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
        <img src="../img/about-feed.jpg" alt="Farm Landscape"  style="max-width: 100%; height: auto;">
    </div>
    <div class="content">
        <header class="section-header">
            <h1>From Feed to Egg: Understanding Quail Nutrition</h1>
        </header>
        <section class="feed-section">
            <div class="feed-info">
                <img id="starter-feed-image" src="/img/starter_feed.png" alt="Starter Feed">
                <h2>Starter Feed</h2>
                <p>This type of feed is given to young quails, typically from the day of hatching up to a few weeks of age. Starter feeds are formulated to provide the essential nutrients needed for healthy growth and development.</p>
            </div>
        </section>

        <section class="feed-section">
            <div class="feed-info">
                <img id="grower-feed-image" src="/img/grower_feed.png" alt="Developer Feed">
                <h2>Developer Feed</h2>
                <p>As quails mature, they transition to developer feed. This type of feed is suitable for quails in the juvenile or growing stage, providing the right balance of nutrients to support their continued development.</p>
            </div>
        </section>

        <section class="feed-section">
            <div class="feed-info">
                <img src="/img/layer_feed.png" alt="Layer Feed">
                <h2>Layer Feed</h2>
                <p>Layer feed is formulated for adult quails that are actively laying eggs. It contains higher levels of calcium to support eggshell formation and other nutrients essential for reproductive health.</p>
            </div>
        </section>

        <section class="feed-section">
            <div class="feed-info">
                <img id="finisher-feed-image" src="/img/finisher_feed.jpeg" alt="Finisher Feed">
                <h2>Finisher Feed</h2>
                <p>This feed is given to quails that have completed the laying cycle or are not intended for egg production. Finisher feeds help maintain the health of quails in their later stages of life.</p>
            </div>
        </section>
    </div>
    <div class="content">
        <header class="section-header">
            <h1>Understanding Chicken Nutrition</h1>
        </header>

        <section class="feed-section">
            <div class="feed-info">
                <img src="/img/starter_chicken.jpeg" alt="Starter Feed">
                <h2>Starter Feed</h2>
                <p>Given to young chicks from the day of hatching up to a few weeks of age. Formulated to provide essential nutrients for healthy growth and development. Usually has higher protein content to support muscle and feather development.</p>
            </div>
        </section>

        <section class="feed-section">
            <div class="feed-info">
                <img src="/img/developer-chicken.jpg" alt="Grower Feed">
                <h2>Grower Feed</h2>
                <p>Provided to growing chickens after the starter stage until they reach the point of lay. Balanced nutrients to support continued development without excessive protein.</p>
            </div>
        </section>

        <section class="feed-section">
            <div class="feed-info">
                <img src="/img/layer-chicken.jpg" alt="Layer Feed">
                <h2>Layer Feed</h2>
                <p>Fed to laying hens to support egg production. Contains higher levels of calcium to promote strong eggshells. Balanced with other nutrients for overall health.</p>
            </div>
        </section>

        <section class="feed-section">
            <div class="feed-info">
                <img src="/img/finisher-chicken.jpeg" alt="Finisher Feed">
                <h2>Finisher Feed</h2>
                <p>Given to chickens that are not intended for egg production or have completed their laying cycle. Maintains their overall health during the later stages of life.</p>
            </div>
        </section>
    </div>

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


    <!-- Include any scripts or additional content if needed -->
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
