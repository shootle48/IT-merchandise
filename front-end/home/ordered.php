<?php
require("../../back-end/database/db.php");

// Assuming $connection is properly defined elsewhere in your code.

$userID = $_GET['userID']; // Assuming you sanitize user input
$fname = $_GET['fname'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$address = $_POST['address'];
$totalPrice = $_POST['total'];

if (isset($_GET['userID'])) {
    $stmt = mysqli_prepare($connection, "SELECT * FROM cartStock WHERE user_ID = ?");
    mysqli_stmt_bind_param($stmt, "i", $userID); // Assuming user_ID is of type integer
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_Show = mysqli_fetch_all($result, MYSQLI_ASSOC); // Fetching all rows as associative array
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
        $productID = $user['product_ID']; // Assuming you have product_ID column in cartStock
        $stmt_update = mysqli_prepare($connection, "UPDATE cartStock SET bill_ID = ? WHERE product_ID = ?");
        mysqli_stmt_bind_param($stmt_update, "ii", $billID, $productID);
        mysqli_stmt_execute($stmt_update);
        mysqli_stmt_close($stmt_update);
    }

    // Redirecting to warrantyStart.php with parameters
    echo '<script>window.location = "slip.php?fname='.$fname.'&userID='.$userID.'"</script>';
} else {
    // Handle error if product details couldn't be fetched
    echo "Error: Product details not found.";
}
?>
