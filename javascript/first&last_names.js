function validateName(inputElement, errorElement, successElement) {
    inputElement.addEventListener('input', function() {
        let input = this.value;

        // Remove digits and symbols
        input = input.replace(/[^a-zA-Z]/g, '');

        // Automatically capitalize the first letter
        if (input.length > 0) {
            input = input.charAt(0).toUpperCase() + input.slice(1);
            this.value = input;
        }

        // Check if the input is valid: contains only letters and the first letter is capitalized
        const isValid = /^[A-Z][a-zA-Z]*$/.test(input);
        const isLengthValid = input.length >= 4 && input.length <= 15;

        if (isValid && isLengthValid) {
            errorElement.style.display = 'none';
            successElement.style.display = 'block';
        } else {
            errorElement.style.display = 'block';
            successElement.style.display = 'none';
        }
    });

    inputElement.addEventListener('blur', function() {
        successElement.style.display = 'none';
    });
}

const firstNameInput = document.getElementById('first-name');
const firstNameError = document.getElementById('first-name-error');
const firstNameSuccess = document.getElementById('first-name-success');
validateName(firstNameInput, firstNameError, firstNameSuccess);

const lastNameInput = document.getElementById('last-name');
const lastNameError = document.getElementById('last-name-error');
const lastNameSuccess = document.getElementById('last-name-success');
validateName(lastNameInput, lastNameError, lastNameSuccess);