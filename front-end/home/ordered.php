<?php
require("../../back-end/database/db.php");

// Assuming $connection is properly defined elsewhere in your code.

$userID = $_GET['userID'];
$fname = $_GET['fname'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$address = $_POST['address'];
$totalPrice = $_POST['totalPrice'];

if (isset($_GET['userID'])) {
    $stmt = mysqli_prepare($connection, "SELECT * FROM cartStock WHERE user_ID = ?");
    mysqli_stmt_bind_param($stmt, "s", $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_Show = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

// Insert data into bills table
$stmt = mysqli_prepare($connection, "INSERT INTO bills (user_ID, emp_Name, tel, address, totalPrice) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssss", $userID, $name, $tel, $address, $totalPrice);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Retrieve the generated bill_ID
$billID = mysqli_insert_id($connection);

// Insert data into cartStock table
if ($user_Show) {
    foreach ($user_Show as $user) {
        // Assuming you meant to use 'product_ID' instead of 'user_ID' for the condition.
        $productID = $user['product_ID'];
        $stmt_update = mysqli_prepare($connection, "UPDATE cartStock SET bill_ID = ? WHERE product_ID = ?");
        mysqli_stmt_bind_param($stmt_update, "ss", $billID, $productID);
        mysqli_stmt_execute($stmt_update);
        mysqli_stmt_close($stmt_update);
    }

    // Redirecting to warrantyStart.php with parameters
    echo '<script>window.location = "warrantyStart.php?fname=' . $fname . '&userID=' . $userID . '&productID=' . $productID . '"</script>';
} else {
    // Handle error if product details couldn't be fetched
    echo "Error: Product details not found.";
}
?>
