<?php
require_once('../php/auth.php');
require_once('../php/connection.php');


if(!isset($_SESSION['user_id'])){
   header('location:../html/login.php');
   exit; // Add exit to stop further execution
}

$user_id = $_SESSION['user_id'];

if(isset($_GET['logout'])){
   session_destroy();
   header('location:../html/login.php');
   exit;
}

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