
    function togglePasswordVisibility(fieldId) {
        var passwordInput = document.getElementById(fieldId);
        var icon = passwordInput.nextElementSibling.querySelector("i");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }

    function validatePasswords() {
        var passwordInput = $("#password").val();
        var confirmPasswordInput = $("#confirm-password").val();
        var passwordPattern = /^(?=.*[0-9]).{8,}$/; // At least 8 characters and one digit

        var isValid = true;

        if (!passwordPattern.test(passwordInput)) {
            $("#password-warning").text("Password must be at least 8 characters long and contain at least one digit.");
            isValid = false;
        } else {
            $("#password-warning").text("");
        }

        if (passwordInput !== confirmPasswordInput) {
            $("#confirm-password-warning").text("Passwords do not match.");
            isValid = false;
        } else {
            $("#confirm-password-warning").text("");
        }

        return isValid;
    }

    $(document).ready(function () {
        $("#password, #confirm-password").on("input", function () {
            validatePasswords();
        });

        $("form").submit(function (event) {
            if (!validatePasswords()) {
                event.preventDefault(); // Prevent form submission if passwords are invalid
            }
        });
    });
