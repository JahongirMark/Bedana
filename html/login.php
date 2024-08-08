<?php
session_start();
require_once('../php/connection.php'); // Adjust path accordingly
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page Of Bedana Farm</title>
    <!-- Latest Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<div class="container">
    <div class="text-center">
        <div class="text-decoration-none text-warning">
            <h1 class="mb-2">Bedana</h1>
        </div>
        <h2 class="mb-4">Welcome Back! Sign in</h2>
    </div>
    <!-- PHP Error Message -->
    <?php if (isset($_GET['error'])): ?>
        <div id="error-message" class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>
    <form id="loginForm" action="../php/login.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</address></label>
            <input type="email" class="form-control" id="email" name="email" required oninput="validateEmail()">
            <p id="email-warning" class="text-danger"></p>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" maxlength="15" id="password" name="password" required oninput="validatePassword()">
                <div class="input-group-append">
                    <span class="input-group-text" id="toggle-password">
                        <i class="fas fa-eye" aria-hidden="true"></i>
                    </span>
                </div>
            </div>
        </div>
        <p id="password-warning" class="text-danger"></p>
        

        <!-- Checkbox for Remember Me -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember Me</label>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <a href="#" class="text-decoration-none">Forgot your password?</a>
            </div>
            <div class="col-md-6">
                <a href="/html/registration_page.php" class="text-decoration-none">Don't have an account?</a>
            </div>
        </div>
    </form>
</div>

<!-- Latest Bootstrap Bundle with Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="../javascript/l_password.js"></script>
<script src="../javascript/l_email.js"></script>
<!-- JavaScript to hide the error message when the user starts typing -->

</body>
</html>
