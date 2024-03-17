<?php
require("../../back-end/database/db.php");
require("user-info.php");

// Check if productID and quantity are set
if (isset($_POST['productID'], $_POST['quantity'])) {
    $productID = $_POST['productID'];
    $quantity = $_POST['quantity'];

    // Update the quantity in the cart
    $stmt_update = mysqli_prepare($connection, "UPDATE carts SET quantity = ? WHERE product_ID = ?");
    mysqli_stmt_bind_param($stmt_update, "ss", $quantity, $productID);
    mysqli_stmt_execute($stmt_update);
    mysqli_stmt_close($stmt_update);
}
?>
