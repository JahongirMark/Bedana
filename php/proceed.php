<?php
session_start();
// Include the database connection file
require_once('../php/connection.php');

// Retrieve form data
$userId = $_SESSION['user_id']; // Retrieve user ID from session
$fullName = $_POST['full_name'];
$email = $_POST['email'];
$address = $_POST['address'];
$district = $_POST['district'];
$phoneNumber = $_POST['phone_number'];
$grandTotal = $_POST['grand_total'];
$cartItems = $_SESSION['cart_items']; // Retrieve cart items from session

// Insert data into the shopping_details table
$sql = "INSERT INTO shopping_details (user_id, full_name, email, address_line, district, phone_number, grand_total, cart_items) 
        VALUES ('$userId', '$fullName', '$email', '$address', '$district', '$phoneNumber', '$grandTotal', '$cartItems')";
        
if (mysqli_query($connection, $sql)) {
    $_SESSION['message'] = "Record inserted successfully";
} else {
    $_SESSION['message'] = "Error: " . $sql . "<br>" . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);


// Redirect to the "tracking_orders" page
header("Location: ../html/tracking_orders.php");
exit;
?>
