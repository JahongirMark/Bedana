<?php
session_start();
require_once('../php/connection.php'); // Adjust path accordingly

$registration_success = false;
if (isset($_SESSION['registration_success'])) {
    $registration_success = true;
    unset($_SESSION['registration_success']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/registration_page.css">
    <!-- Latest Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>Farm Registration</title>
</head>
<body>
<div class="center-container">
    <div class="registration-container">
    <?php if ($registration_success): ?>
    <div id="success-message" class="alert alert-success" role="alert">
        Registration successful! Redirecting to login page in <span id="countdown">3</span> seconds...
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
                window.location.href = '../html/login.php'; // Redirect after countdown finishes
            }
        }

        countdown(); // Start the countdown
    </script>
<?php endif; ?>

    <form id="registrationForm" action="../php/registration.php" method="POST">
            <div class="text-center">
                <div class="text-decoration-none text-warning">
                    <h1 class="mb-2">Bedana</h1>
                </div>
                <h2>Create an Account</h2>
            </div>

            <div class="row mb-2">
            <div class="col-md-6">
        <label for="first-name" class="mb-1">First Name:</label>
        <input type="text" class="form-control" id="first-name" name="first-name" placeholder="Ex: Toshmat" minlength="4" maxlength="15" required>
        <span id="first-name-error" class="error-message">First name must be between 4 and 15 characters.</span>
        <span id="first-name-success" class="success-message">First name length is valid.</span>
    </div>
    <div class="col-md-6">
        <label for="last-name" class="mb-1">Last Name:</label>
        <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Ex: Smithov" minlength="4" maxlength="15" required>
        <span id="last-name-error" class="error-message">Last name must be between 4 and 15 characters.</span>
        <span id="last-name-success" class="success-message">Last name length is valid.</span>
    </div>
            </div>
        <div class="mb-2">
            <label for="email" class="mb-1">Email Address:</label>
            <input type="email" class="form-control" id="email" name="email" maxlength="60" placeholder="Ex: name.surname@gmail.com" required>
            <span id="email-status"></span>
        </div>

            <div class="mb-2">
            <label for="phone-number" class="mb-1">Phone Number:</label>
            <input type="tel" class="form-control" id="phone-number" name="phone-number" placeholder="Ex: +998995000706" required oninput="validatePhoneNumber()">
            <p id="phone-warning" class="text-danger"></p>
            </div>
            <div class="row mb-2 mt-2">
                <div class="col-md-6">
                    <label for="date-of-birth" class="mb-1">Date of Birth:</label>
                    <input type="date" class="form-control" id="date-of-birth" name="date-of-birth" required>
                </div>

                <div class="col-md-6">
    <label for="district" class="mb-1">District:</label>
    <select class="form-control form-control-lg" id="dist" name="dist" required>
        <option value="">Select District</option>
        <option value="Bogot">Bogot</option>
        <option value="Gurlan">Gurlan</option>
        <option value="Xonqa">Xonqa</option>
        <option value="Tuproqqala">Tuproqqala</option>
        <option value="Khiva">Khiva</option>
        <option value="Koshkopir">Koshkopir</option>
        <option value="Shovot">Shovot</option>
        <option value="Urganch">Urganch</option>
        <option value="Yangiariq">Yangiariq</option>
        <option value="Yangibozor">Yangibozor</option>
        <option value="Hazorasp">Hazorasp</option>
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
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" id="registerButton"  class="btn btn-primary">Sign up</button>
            </div>    
    </form>
        <div class="form-options">
               <p>Already have an account? <a href="/html/login.php">Login here</a></p>
        </div>
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
</body>
</html>
