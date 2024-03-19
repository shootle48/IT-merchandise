<?php
require("../../back-end/database/db.php");

// Assuming proper validation/sanitization for user input.
$userID = $_GET['userID'];
$fname = $_GET['fname'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$address = $_POST['address'];
$totalPrice = $_POST['totalPrice'];

// Fetching product details if productID is provided
$productShow = null;
if (isset($_GET['productID'])) {
    $productID = $_GET['productID'];
    $stmt = mysqli_prepare($connection, "SELECT * FROM product WHERE product_ID = ?");
    mysqli_stmt_bind_param($stmt, "s", $productID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $productShow = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

// Inserting data into bills table
$stmt = mysqli_prepare($connection, "INSERT INTO bills (user_ID, emp_Name, tel, address, totalPrice) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssss", $userID, $name, $tel, $address, $totalPrice);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Redirecting to warrantyStart.php with parameters
if ($productShow) {
    $productID = $productShow['product_ID'];
    echo '<script>window.location = "warrantyStart.php?fname=' . $fname . '&userID=' . $userID . '&productID=' . $productID . '"</script>';
} else {
    // Handle error if product details couldn't be fetched
    echo "Error: Product details not found.";
}
?>
