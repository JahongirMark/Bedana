<?php
require_once('connection.php');

// Check if email_address is provided in the AJAX request
if (isset($_POST['email'])) {
    $email_address = $_POST['email'];

    // Query to check if the email_address exists in the database
    $check_email_sql = "SELECT id FROM users WHERE email='$email_address'";
    $check_email_result = $connection->query($check_email_sql);

    if ($check_email_result->num_rows > 0) {
        // Username already exists
        echo "taken";
    } else {
        // Username is available
        echo "available";
    }
} else {
    // Username is not provided in the AJAX request
    echo "error";
}

// Close the database connection
$connection->close();
?>
