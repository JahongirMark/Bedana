<?php
require_once('../php/auth.php'); // Adjust path accordingly
require_once('../php/connection.php'); // Adjust path accordingly

// Initialize an empty array to store data
$data = array();

// Get the current user's ID
$user_id = $_SESSION['user_id'];

// Query to retrieve data from the shopping_details table for the current user
$sql = "SELECT id, full_name, email, address_line AS address, district, phone_number, grand_total, created_at
        FROM shopping_details
        WHERE user_id = '$user_id'";

// Execute the query
$result = $connection->query($sql);

// Check if query was successful
if ($result && $result->num_rows > 0) {
    // Fetch data from the result set and push it into the $data array
    while ($row = $result->fetch_assoc()) {
        // Add form type to the row data
        $row['form_type'] = 'shopping_details';
        $data[] = $row;
    }
} else {
    echo "No data found in shopping_details table for user with ID: $user_id.<br>";
}

// Close the database connection
$result->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driving License Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- For DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/top-bar.css">
    <link rel="stylesheet" href="../css/tracking_orders.css">

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
                                <a class="dropdown-item" href="../html/contact_us.php">CONTACT US</a>
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

<h1 class="text-center">Tracking Orders Datatable</h1>

<div class="datatable-container">
    <table id="example" class="table table-striped nowrap" style="width:100%">
        <thead>
            <tr>
                <th style="width: 10%">Order ID</th>
                <th style="width: 25%">Customer's Full Name</th>
                <th style="width: 25%">Delivered Address</th>
                <th style="width: 10%">Grand Total Price</th>
                <th style="width: 15%">Order Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through each row of data and output table rows
            foreach ($data as $row) {
                echo "<tr>";
                echo "<td><a href='../html/datatable.php?id={$row['id']}'>{$row['id']}</a></td>";
                echo "<td>{$row['full_name']}</td>";
                echo "<td>{$row['address']}</td>";
                echo "<td>{$row['grand_total']}</td>";
                echo "<td>{$row['created_at']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
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

<!-- Bootstrap JS and jQuery (for dropdowns) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- For DataTable -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true
        });
    });
</script>
</body>
</html>
