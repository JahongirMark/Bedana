<?php
error_reporting(E_ALL);
ini_set('display_errors', 0); // Set to 0 to hide errors from users

session_start();
require_once('../php/connection.php'); // Adjust path accordingly

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Debugging output
    // echo "Entered Password: " . $password . "<br>";
    // SQL to retrieve user from database
    $sql = "SELECT * FROM users WHERE email='$email'";
    
    $result = $connection->query($sql);

    if (!$result) {
        // Handle SQL query error more gracefully
        die("Error in SQL query: " . $connection->error);
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password_hash']; // Debugging output
        // echo "Stored Password: " . $stored_password . "<br>";
        $user_id = $row['id'];

        // Compare the hashed password using password_verify()
        if (password_verify($password, $stored_password)) {
            $_SESSION['user_id'] = $user_id;
            // Redirect to dashboard or any other page
            header("Location: ../html/index.php");
            exit();
        } else {
            // Invalid password
            $error = "Invalid password.";
            header("Location: ../html/login.php?error=" . urlencode($error)); // Redirect with error message
            exit();
        }
    } else {
        // User not found
        $error = "User not found.";
        header("Location: ../html/login.php?error=" . urlencode($error)); // Redirect with error message
        exit();
    }
}
?>
