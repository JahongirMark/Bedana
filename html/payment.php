<?php
require_once('../php/auth.php'); // Adjust path accordingly
// Include the database connection file
require_once('../php/connection.php');
// Check if a message is set in the session
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    // Unset or clear the message to avoid displaying it again on page refresh
    unset($_SESSION['message']);
}
// Now you can use the database connection in this file
// Fetch phone number and email address from the database based on user ID
$user_id = $_SESSION['user_id']; // Assuming you have the user ID stored in the session
$data = $_SESSION['cart_items'];
$data1 = $_SESSION['grand_total'];

// echo $data;
// echo $data1;

$sql = "SELECT first_name, last_name, phone_number, district, email FROM users WHERE id = '$user_id'";
$result = mysqli_query($connection, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $phone_number = $row["phone_number"];
    $district = $row["district"];
    $email = $row['email'];
} else {
    // Handle the case where user information is not found
    $phone_number = ""; // Set default values if user information is not found
    $email = "";
}

// Close the database connection
mysqli_close($connection);
?>
<?php
// payment.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cartItems = json_decode($_POST['cart_items'], true);
    $grandTotal = $_POST['grand_total'];

    // Debugging: Print the received data
    echo '<pre>';
    print_r($cartItems);
    echo 'Grand Total: ' . $grandTotal;
    echo '</pre>';

    // Process the payment and cart data as needed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/payment.css">

</head>
<body>

<div class="container">
<div id="message">
        <?php
        // Check if a message is set in the session
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            // Unset or clear the message to avoid displaying it again on page refresh
            unset($_SESSION['message']);
        }
        ?>
    </div>

    <form action="../php/proceed.php" method="POST">

        <div class="row">

            <div class="col">

                <h3 class="title">CUSTOMER'S DETAILS</h3>

                <div class="inputBox">
                    <span>full name :</span>
                    <input type="text" name="full_name" id="full_name" placeholder="john deo" value="<?php echo $first_name . ' ' . $last_name; ?>" readonly>                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" name="email" id="email" placeholder="example@example.com" value="<?php echo $email ?>" readonly>
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" name="address" id="address" placeholder="room - street - locality" required>
                </div>
                <div class="inputBox">
                    <span>distrcit :</span>
                    <input type="text" name="district" id="district" placeholder="khonka" value="<?php echo $district ?>" readonly>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Phone Number :</span>
                        <input type="tel" name="phone_number" id="phone_number" placeholder="123 456" value="<?php echo $phone_number ?>" readonly>
                    </div>
                    <div class="inputBox">
                        <span>Grand Total Price:</span>
                        <input type="text" name="grand_total" id="grand_total" value="<?php echo number_format($data1, 3); ?> UZS" readonly>
                    </div>

                </div>

            </div>

            <div class="col">

                <h3 class="title">payment</h3>

                <div class="inputBox">
                    <span>cards accepted :</span>
                    <img src="../img/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>name on card :</span>
                    <input type="text" placeholder="mr. john deo">
                </div>
                <div class="inputBox">
                    <span>credit card number :</span>
                    <input type="number" placeholder="1111-2222-3333-4444">
                </div>
                <div class="inputBox">
                    <span>exp month :</span>
                    <input type="text" placeholder="january">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>exp year :</span>
                        <input type="number" placeholder="2022">
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" placeholder="1234">
                    </div>
                </div>

            </div>
    
        </div>

        <button type="submit" class="submit-btn">proceed to checkout</button>

    </form>

</div> 
<script>
    // JavaScript code to hide the message after 3 seconds
    document.getElementById('payment-form').addEventListener('submit', function(event) {
        setTimeout(function() {
            var messageDiv = document.getElementById('message');
            if (messageDiv) {
                messageDiv.style.display = 'none';
            }
        }, 3000); // 3000 milliseconds = 3 seconds
    });
</script>   
<script>
        // Disable the back button
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
    
</body>
</html>