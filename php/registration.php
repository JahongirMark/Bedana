<?php
session_start();
require_once('../php/connection.php'); // Adjust path accordingly

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone-number'];
    $date_of_birth = $_POST['date-of-birth'];
    $district = $_POST['dist'];
    $password = $_POST['password']; // Plain text password
    $confirm_password = $_POST['confirm-password'];

    // Validate form data (add more validation as needed)
    if ($password !== $confirm_password) {
        die('Passwords do not match.');
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to insert data into users table
    $sql = "INSERT INTO users (first_name, last_name, email, phone_number, date_of_birth, district, password_hash)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone_number, $date_of_birth, $district, $hashed_password);

        // Execute the query
        if ($stmt->execute()) {
            // Registration successful
            $_SESSION['registration_success'] = true;
        } else {
            // Registration failed
            $_SESSION['registration_success'] = false;
            $_SESSION['registration_error'] = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['registration_success'] = false;
        $_SESSION['registration_error'] = "Error: " . $connection->error;
    }

    // Close the connection
    $connection->close();
} else {
    // If the form was not submitted properly, handle the error
    $_SESSION['registration_success'] = false;
    $_SESSION['registration_error'] = "Form was not submitted properly.";
}

// Redirect back to the registration page
header("Location: ../html/registration_page.php");
exit();
?>
