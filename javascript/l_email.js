
function validateEmail() {
    var emailInput = document.getElementById('email');
    var emailWarning = document.getElementById('email-warning');

    // Regular expression for a simple email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(emailInput.value)) {
        emailWarning.textContent = 'Please enter a valid email address.';
    } else {
        emailWarning.textContent = '';
    }
}

function validatePassword() {
    var passwordInput = document.getElementById('password');
    var passwordWarning = document.getElementById('password-warning');

    // Regular expression for password validation: at least 8 characters and one digit
    var passwordPattern = /^(?=.*[0-9]).{8,}$/;

    if (!passwordPattern.test(passwordInput.value)) {
        passwordWarning.textContent = 'Password must be at least 8 characters long and contain at least one digit.';
    } else {
        passwordWarning.textContent = '';
    }
}

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('email').addEventListener('input', validateEmail);
    document.getElementById('password').addEventListener('input', validatePassword);
});