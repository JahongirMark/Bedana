<?php
require_once('../php/auth.php'); // Adjust path accordingly
require_once('../php/connection.php');

$changes_success = false;
if (isset($_SESSION['changes_success'])) {
    $changes_success = true;
    unset($_SESSION['changes_success']);
}

// Retrieve user information to populate the input fields
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $connection->query($sql);

// Check if the query was successful and data was retrieved
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Retrieve user data
    $firstName = isset($row['first_name']) ? $row['first_name'] : '';
    $lastName = isset($row['last_name']) ? $row['last_name'] : '';
    $email = isset($row['email']) ? $row['email'] : '';
    $phone = isset($row['phone_number']) ? $row['phone_number'] : '';
    $dob = isset($row['date_of_birth']) ? $row['date_of_birth'] : '';
    $dist = isset($row['district']) ? $row['district'] : '';

    // Close the result set
    $result->close();
} else {
    // Handle the case where user information is not found
    echo "User information not found.";
}

// // Close the database connection
// $result->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user-profile.css">
    <link rel="stylesheet" href="../css/top-bar.css">
    <!-- Latest Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>User Profile</title>
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
                            <a class="nav-link dropdown-toggle" href="../html/buy_now.php" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SERVICES</a>
                            <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <a class="dropdown-item" href="../html/buy_now.php">BUY ONLINE</a>
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

<div class="center-container">
    <div class="registration-container">
    <?php if ($changes_success): ?>
    <div id="success-message" class="alert alert-success" role="alert">
         Changes are submitted! Redirecting to login page in <span id="countdown">3</span> seconds...
    </div>
    <script>
        var countdownElement = document.getElementById('countdown');
        var seconds = 3;

        function countdown() {
            if (seconds > 0) {
                countdownElement.textContent = seconds;
                seconds--;
                setTimeout(countdown, 1000); // Call countdown function again after 1 second
            } else {
                window.location.href = '../php/logout.php'; // Redirect after countdown finishes
            }
        }

        countdown(); // Start the countdown
    </script>
<?php endif; ?>

    <form id="registrationForm" action="../php/user-profile.php" method="POST">
            <div class="text-center">
                <h2 class="mb-3">User Profile</h2>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="first-name" class="mb-1">First Name:</label>
                    <input type="text" class="form-control" id="first-name" name="first-name" placeholder="Ex: Toshmat" maxlength="15" value="<?php echo $firstName; ?>" required>
                    <span id="first-name-error" class="error-message">First name must be between 4 and 15 characters.</span>
                    <span id="first-name-success" class="success-message">First name length is valid.</span>
                </div>

                <div class="col-md-6">
                    <label for="last-name" class="mb-1">Last Name:</label>
                    <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Ex: Mametov" maxlength="15" value="<?php echo $lastName; ?>" required>
                    <span id="last-name-error" class="error-message">Last name must be between 4 and 15 characters.</span>
                    <span id="last-name-success" class="success-message">Last name length is valid.</span>
                </div>
            </div>
        <div class="mb-2">
            <label for="email" class="mb-1">Email Address:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Ex: name.surname@gmail.com" value="<?php echo $email; ?>" required>
            <span id="email-status"></span>
        </div>
        <div class="mb-2">
            <label for="phone-number" class="mb-1">Phone Number:</label>
            <input type="tel" class="form-control" id="phone-number" name="phone-number" placeholder="Ex: +998(99)500-07-06" value="<?php echo $phone; ?>" required oninput="validatePhoneNumber()">
            <p id="phone-warning" class="text-danger"></p>
        </div>
            <div class="row mb-2 mt-2">
                <div class="col-md-6">
                    <label for="date-of-birth" class="mb-1">Date of Birth:</label>
                    <input type="date" class="form-control" id="date-of-birth" name="date-of-birth" value="<?php echo $dob; ?>" required>
                </div>

                <div class="col-md-6">
    <label for="district" class="mb-1">District:</label>
    <select class="form-control form-control-lg" id="dist" name="dist" required>
        <option value="" disabled>Select District</option>
        <option value="Bogot" <?php if ($dist == 'Bogot.') echo 'selected'; ?>>Bogot</option>
        <option value="Gurlan" <?php if ($dist == 'Gurlan.') echo 'selected'; ?>>Gurlan</option>
        <option value="Xonqa" <?php if ($dist == 'Xonqa.') echo 'selected'; ?>>Xonqa</option>
        <option value="Tuproqqala" <?php if ($dist == 'Tuproqqala.') echo 'selected'; ?>>Tuproqqala</option>
        <option value="Khiva" <?php if ($dist == 'Khiva.') echo 'selected'; ?>>Khiva</option>
        <option value="Koshkopir" <?php if ($dist == 'Koshkopir.') echo 'selected'; ?>>Koshkopir</option>
        <option value="Shovot" <?php if ($dist == 'Shovot.') echo 'selected'; ?>>Shovot</option>
        <option value="Urganch" <?php if ($dist == 'Urganch.') echo 'selected'; ?>>Urganch</option>
        <option value="Yangiariq" <?php if ($dist == 'Yangiariq.') echo 'selected'; ?>>Yangiariq</option>
        <option value="Yangibozor" <?php if ($dist == 'Yangibozor.') echo 'selected'; ?>>Yangibozor</option>
        <option value="Hazorasp" <?php if ($dist == 'Hazorasp.') echo 'selected'; ?>>Hazorasp</option>
    </select>
</div>


            </div>

            <div class="row mb-2 mt-2">
                <div class="col-md-6 password-input-container">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" maxlength="15" id="password" name="password" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="toggle-password" onclick="togglePasswordVisibility('password')">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <p id="password-warning" class="text-danger"></p>
                </div>

                <div class="col-md-6 password-input-container">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" maxlength="15" id="confirm-password" name="confirm-password" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="toggle-confirm-password" onclick="togglePasswordVisibility('confirm-password')">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <p id="confirm-password-warning" class="text-danger"></p>
                </div>
            </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="text-center">
                <button type="submit" id="registerButton" class="btn btn-primary">Save</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">
               <button class="btn btn-primary" id="goBackButton">Go back</button>
            </div>
        </div>
    </div>   
    </form>
    </div>
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

<!-- Latest Bootstrap Bundle with Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="../javascript/first&last_names.js"></script>
<script src="../javascript/emailValidation.js"></script>
<script src="../javascript/phone_number.js"></script>
<script src="../javascript/d_of_b.js"></script>
<script src="../javascript/passwords.js"></script>
<script>
    document.getElementById("goBackButton").addEventListener("click", function() {
    // Show a confirmation dialog
    var confirmResult = confirm("Your changes will be lost!");
    
    // If user confirms, redirect to another page
    if (confirmResult) {
        window.location.href = "../html/index.php"; // Change the URL to the desired page
    } else {
        // If user cancels, do nothing
    }
});
</script>
</body>
</html>
