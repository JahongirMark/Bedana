<?php
require_once('../php/auth.php'); // Adjust path accordingly
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/top-bar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
                                <a class="dropdown-item" href="#">TAKE AWAY</a>
                                <!-- Add more services as needed -->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="learnSupportDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CONTACT</a>
                            <div class="dropdown-menu" aria-labelledby="learnSupportDropdown">
                                <a class="dropdown-item" href="/html/contact_us.php">CONTACT US</a>
                                <a class="dropdown-item" href="#">FEEDBACK</a>
                                <!-- Add more learn and support links as needed -->
                            </div>
                        </li>
                    </ul>
                </nav>
                
<!-- Basket icon and login button -->
<div class="basket-icon-container">
    <i class="fas fa-shopping-basket fa-lg"></i> <!-- Basket icon from Font Awesome -->
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
    $connection->close();
    ?>
</div>


            </div>
        </div>
    </div>
    <div class="container">
        <div>
            <img id="productImage" src="" alt="">
        </div>
        <div>
            <h3 id="productName"></h3>
        </div>
        <div>
            <p id="productInfo"></p>
        </div>
    </div>
</body>

<script>
    const urlParams = new URLSearchParams(window.location.search);

// Get the values of the 'product' and 'image' parameters
    const productName = urlParams.get('product');
    const productImage = urlParams.get('image');
    const info = localStorage.getItem('productInfo');
    document.getElementById('productInfo').textContent = info;

// Now you can use productName and productImage in your HTML or JavaScript logic
    // console.log('Selected Product: ', productName);
    // console.log('Product Image: ', productImage);
    // console.log('Product Info: ', productInfo);


// Example: Update the content of an HTML element with the product information
    document.getElementById('productName').innerText = productName;
    document.getElementById('productImage').src = productImage;

    const product_info_1 = 'Whole Chicken, apx 1.8kg. We still remember how chicken used to taste when we were kids, and it’s a standard we’re committed to bringing back! This is how chicken used to taste before intensive farming introduced breeds with no flavour. It’s perfect centrepiece for Sunday lunch or family dinner. Check out our recipes for inspiration.';
</script>
</html>