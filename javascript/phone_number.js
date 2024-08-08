var phoneErrorDisplayed = false; // Flag to track if phone number error message has been displayed

function validatePhoneNumber() {
    var phoneInput = document.getElementById('phone-number');
    var phoneWarning = document.getElementById('phone-warning');

    // Regex for Uzbekistan phone numbers: +998 XX XXX XXXX
    var phoneRegex = /^\+998\d{2}\d{7}$/;

    // Remove invalid characters except '+' at the beginning
    phoneInput.value = phoneInput.value.replace(/[^+\d]/g, '');

    // If the phone number does not start with '+998', add it
    if (!phoneInput.value.startsWith('+998')) {
        phoneInput.value = '+998' + phoneInput.value.substring(1);
    }

    // Limit the length of the input
    var maxLength = 13; // Maximum length for "+998 XX XXX XXXX"
    if (phoneInput.value.length > maxLength) {
        phoneInput.value = phoneInput.value.slice(0, maxLength);
        phoneWarning.textContent = ''; // Clear error message when reaching the limit
        phoneErrorDisplayed = false; // Reset flag
    }

    // Validate the phone number format
    if (!phoneRegex.test(phoneInput.value)) {
        phoneWarning.textContent = 'Please enter a valid phone number in the format +998 XX XXX XXXX.';
        phoneWarning.style.color = 'red';
        phoneErrorDisplayed = true; // Set flag to true indicating error message displayed
    } else {
        if (phoneErrorDisplayed) {
            phoneWarning.textContent = ''; // Clear error message only if it was displayed previously
            phoneErrorDisplayed = false; // Reset flag
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    var phoneInput = document.getElementById('phone-number');
    var phoneWarning = document.getElementById('phone-warning');

    phoneInput.addEventListener('blur', validatePhoneNumber);

    phoneInput.addEventListener('input', function () {
        validatePhoneNumber(); // Validate phone number on input
    });
});
