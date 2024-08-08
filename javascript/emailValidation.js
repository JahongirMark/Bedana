var emailInput = document.getElementById("email");
var registerButton = document.getElementById("registerButton");
var emailStatus = document.getElementById("email-status");
var xhr = new XMLHttpRequest();

// Function to check email availability and format
function checkEmailAvailability() {
    var email = emailInput.value;
    // If the email is empty, clear the status message and disable the button
    if (email.trim() === "") {
        emailStatus.textContent = "";
        registerButton.disabled = true;
        return;
    }

    // Check if the email format is valid
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        emailStatus.innerHTML = "<span style='color:red;'>Please enter a valid email address</span>";
        registerButton.disabled = true;
        return;
    }

    // Send an AJAX request to check email availability
    xhr.open("POST", "../php/emailavailability.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Response received from the server
            var response = xhr.responseText;
            if (response == "available") {
                emailStatus.innerHTML = "<span style='color:green;'>Email available</span>"; // Green text
                registerButton.disabled = false;
            } else {
                emailStatus.innerHTML = "<span style='color:red;'>Email already registered</span>"; // Red text
                registerButton.disabled = true;
            }
        }
    };
    xhr.send("email=" + email);
}

// Event listener to trigger email availability check on input change
emailInput.addEventListener("input", checkEmailAvailability);

// Function to clear the email status message if the email is available
function clearEmailStatus() {
    if (!emailStatus.innerHTML.includes("Email already registered")) {
        emailStatus.innerHTML = ""; // Clear the status message
    }
}

// Event listener to clear the status message when user focuses on another input field
var inputFields = document.querySelectorAll("input:not(#email)");
inputFields.forEach(function (inputField) {
    inputField.addEventListener("focus", clearEmailStatus);
});
