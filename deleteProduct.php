<?php
session_start();
require ("../../back-end/database/db.php");

$productID = $_GET['productID'];
$userID = $_GET['userID'];
$fname = $_GET['fname'];

// Delete related rows in the bills table first
$stmt_delete_bills = mysqli_prepare($connection, "DELETE FROM bills WHERE user_ID IN (SELECT user_ID FROM carts WHERE product_ID = ?)");
mysqli_stmt_bind_param($stmt_delete_bills, 's', $productID);
mysqli_stmt_execute($stmt_delete_bills);
mysqli_stmt_close($stmt_delete_bills);

// Then delete the row from the carts table
$stmt_delete_cart = mysqli_prepare($connection, "DELETE FROM carts WHERE product_ID = ?");
mysqli_stmt_bind_param($stmt_delete_cart, 's', $productID);
mysqli_stmt_execute($stmt_delete_cart);
mysqli_stmt_close($stmt_delete_cart);

// Redirect to cart page
echo '<script>window.location = "cart.php?fname=' . $fname . '&userID=' . $userID . '"</script>';
?>