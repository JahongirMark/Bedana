<?php
// Include database connection
require_once('../php/connection.php');

// Check if ID parameter is set in the URL
if(isset($_GET['id'])) {
    // Retrieve the ID from the URL
    $id = $_GET['id'];

    // Prepare a SQL statement to fetch cart_items based on the ID
    $sql = "SELECT cart_items, grand_total FROM shopping_details WHERE id = '$id'";

    // Execute the SQL statement
    $result = mysqli_query($connection, $sql);

    // Check if the query was successful
    if($result && mysqli_num_rows($result) > 0) {
        // Fetch the cart_items data
        $row = mysqli_fetch_assoc($result);
        $cartItems = $row['cart_items'];
        $grandTotal = $row['grand_total'];

        // Convert the JSON string to an associative array
        $cartItemsArray = json_decode($cartItems, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchased Products</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="shopping-cart container mt-5">
        <h1 class="heading">Purchased Products</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody id="cart-table-body">
                    <?php
                    // Loop through each item in the cart
                    foreach ($cartItemsArray as $item) {
                        echo "<tr>";
                        echo "<td><img src='{$item['image']}' alt='{$item['name']}' width='50'></td>";
                        echo "<td>{$item['name']}</td>";
                        echo "<td>{$item['price']}</td>";
                        echo "<td>{$item['quantity']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr id="grand-total-row">
                        <td colspan="3" class="text-end fw-bold">Grand Total:</td>
                        <td id="grand-total" class="fw-bold"><?php echo number_format($grandTotal, 2); ?> UZS</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="cart-btn text-end mt-3">
          <a href="../html/tracking_orders.php" class="btn btn-success">Return To Datatable</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    } else {
        echo "No cart items found for this ID.";
    }

    // Free the result set
    mysqli_free_result($result);
}

// Close the database connection
mysqli_close($connection);
?>
