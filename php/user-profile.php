<?php
require_once('../php/auth.php'); // Include the database connection
require_once('../php/connection.php'); // Include the database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
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

    // Prepare the SQL statement
    $sql = "UPDATE users SET first_name=?, last_name=?, email=?, phone_number=?, date_of_birth=?, district=?, password_hash=? WHERE id=?";

    // Prepare the statement
    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sssssssi", $first_name, $last_name, $email,  $phone_number, $date_of_birth, $district, $hashed_password, $user_id);

      
        // Execute the query
        if ($stmt->execute()) {
            // Registration successful
            $_SESSION['changes_success'] = true;
        } else {
            // Registration failed
            $_SESSION['changes_success'] = false;
            $_SESSION['changes_error'] = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['changes_success'] = false;
        $_SESSION['changes_error'] = "Error: " . $connection->error;
    }

    // Close the connection
    $connection->close();
} else {
    // If the form was not submitted properly, handle the error
    $_SESSION['changes_success'] = false;
    $_SESSION['changes_error'] = "Changes were not submitted properly.";
}

// Redirect back to the registration page
header("Location: ../html/user_profile.php");
exit();
?>
