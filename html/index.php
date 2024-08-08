<?php
require_once('../php/auth.php'); // Adjust path accordingly
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bedana</title>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/top-bar.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-dPrvJsPeJdDs0+hqKyK2Fj2J2xyBBj0sNyli2Q8pr1XhNTe0CTCQyC8afNOy7Vpsd2jtLXEcObDStHe4UgyxkrA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">
    
   
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
                            <a class="nav-link dropdown-toggle" href="/html/contact_us.php" id="learnSupportDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CONTACT</a>
                            <div class="dropdown-menu" aria-labelledby="learnSupportDropdown">
                                <a class="dropdown-item" href="/html/contact_us.php">CONTACT US</a>
                                <!-- <a class="dropdown-item" href="#">FEEDBACK</a> -->
                                <!-- Add more learn and support links as needed -->
                            </div>
                        </li>
                    </ul>
                </nav>

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
    <section class="hero">
        <div class="hero-image">
            <img src="/img/home-main.jpg" alt="Farm Landscape">
        </div>
        <div class="hero-text">
            <h2>Welcome to Bedana Farm!</h2>
            <p>Welcome to the beauty of nature, where fresh and nutritious eggs are produced.</p>
            <p>Explore our farm's rich history, discover our sustainable practices, and savor the taste of our premium products.</p>
        </div>
    </section>

    <div class="container">
        <section class="image-info-section d-flex justify-content-center">
            <div class="row">
                <div class="col-md-6">
                  <div class="image-container d-flex justify-content-center">
                    <img src="/img/home-photo2.jpg" alt="Section Image">
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="info-container">
                     <h2>Healthy Quails, Wholesome Eggs: </h2>
                     <p>
                       At Our Quail Farm, our primary mission is centered around nurturing healthy quails to produce eggs of the highest nutritional quality. Our quails, living in thoughtfully designed communal cages, are dedicated to providing you with eggs that stand out for their health benefits.
                     </p>
                    </div>
                </div>
            </div>
        </section>  
    
    <!-- Add this section after the existing "About Quails" section -->
<section id="normal-eggs" class="image-info-section d-flex justify-content-center">
    <div class="row">
        <div class="col-md-6">
    <div class="image-container d-flex justify-content-center">
        <!-- Add an image related to normal chicken eggs -->
        <img src="/img/chicken-egg.png" alt="Normal Chicken Eggs">
    </div>
</div>
<div class="col-md-6">
    
    <div class="info-container">
        <h2>Quality Chicken Eggs:</h2>
        <p>
            In addition to our quail eggs, we also prioritize providing high-quality chicken eggs. Our traditional farming practices ensure that the chicken eggs are fresh, nutritious, and produced in a sustainable environment.
        </p>
    </div>
</div>
</div>
</section>
    </div>
<section class="about-us-info">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about-us-text">
                    <h2>PASSION, RESPECT & EXCELLENCE</h2>
                    <p>Learn more about Bedana and our commitment to providing high-quality eggs. Discover our story, values, and the people behind our sustainable farm practices.</p>
                    <a href="../html/about.php" class="feed-button">Explore More</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-us-image">
                    <img src="/img/about_usi.jpg" alt="About Us Image">
                </div>
           
        </div>
    </div>
</div>
</section>
<section class="feed-to-egg-info">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="feed-to-egg-image">
                    <!-- Update the image source -->
                    <img src="/img/feed-to-egg-image.jpeg" alt="From Feed to Egg Image">
                </div>
            </div>
            <div class="col-md-6">
                <div class="feed-to-egg-text">
                    <h2>FROM FEED TO EGG</h2>
                    <p>Explore the journey from feed to egg at Bedana. Learn about our sustainable farming practices, the nutritional quality of our eggs, and how we ensure the well-being of our quails and chickens</p>
                    <a href="../html/feed.php" class="feed-button">Explore More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-section">
    <div class="container">
        <div class="row">
            <div class="col  d-flex justify-content-center">
                <div class="product card">
                    <img src="/img/chicken.jpg" class="card-img-top" alt="Product 1 Image">
                    <a href="../html/buy_now.php" class="buy-now-btn">Buy Now</a>
                </div>
            </div>
            <div class="col  d-flex justify-content-center">
                <div class="product card">
                    <img src="/img/eggs.png" class="card-img-top" alt="Product 2 Image">
                    <a href="../html/buy_now.php" class="buy-now-btn">Buy Now</a>
                </div>
            </div>
            <div class="col  d-flex justify-content-center">
                <div class="product card">
                    <img src="/img/quail eggs.png" class="card-img-top" alt="Product 3 Image">
                    <a href="../html/buy_now.php" class="buy-now-btn">Buy Now</a>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center full-range-btn"><a href="/html/buy_now.php" class="feed-button">Shop Our Full Range</a></div>
        
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

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
</body>

</html>

