<?php
session_start(); // Start the session if it's not already started

// Check if the "Proceed to Payment" button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store the cart items data in a session variable
    $_SESSION['cart_items'] = $_POST['cart_items'];
    $_SESSION['grand_total'] = $_POST['grand_total'];

    // Redirect to the payment page or any other page as needed
    header("Location: ../html/payment.php");
    exit(); // Stop further execution of the current script
}

// Handle other parts of your PHP code as needed
?>
