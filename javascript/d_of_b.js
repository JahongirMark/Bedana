
    $(document).ready(function () {
        var dobInput = $("#date-of-birth");

        dobInput.on("input", function () {
            validateDateOfBirth();
        });

        $("form").submit(function (event) {
            if (!validateDateOfBirth()) {
                event.preventDefault(); // Prevent form submission if Date of Birth is invalid
            }
        });
    });

    function validateDateOfBirth() {
        var dobInput = $("#date-of-birth");
        var dob = dobInput.val();

        if (!isValidDateOfBirth(dob)) {
            alert("You must be at least 18 years old to register.");
            dobInput.val(''); // Reset the Date of Birth input field
            dobInput.focus(); // Set focus back to the Date of Birth input
            return false;
        }

        return true;
    }

    function isValidDateOfBirth(dob) {
        var dobDate = new Date(dob);
        var today = new Date();
        var age = today.getFullYear() - dobDate.getFullYear();

        if (today.getMonth() < dobDate.getMonth() || (today.getMonth() === dobDate.getMonth() && today.getDate() < dobDate.getDate())) {
            age--;
        }

        return age >= 18;
    }
