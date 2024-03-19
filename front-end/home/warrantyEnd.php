<?php
require ("../../back-end/database/db.php");
$userID = $_GET['userID'];
$fname = $_GET['fname'];

if (isset($_GET['productID'])) {
    $productID = $_GET['productID'];
    $stmt = mysqli_prepare($connection, "SELECT * FROM product WHERE product_ID = ?");
    mysqli_stmt_bind_param($stmt, "s", $productID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $productShow = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}


$Type = $productShow['type'];
$Product_name = $productShow['name_product'];

$sale_date = $_POST['sale_date'];
// Warranty period in years
$warranty_date = $productShow['warranty_date'];

// Calculate future date by adding warranty period to sale date
$futureDate = date('Y-m-d', strtotime($sale_date . ' + ' . $warranty_date .'years'));

$warranty_out = $futureDate;

$text = $productID.'-'.$userID.'-'.$warranty_date;
$serial = $text;

$stmt1 = mysqli_prepare($connection, "INSERT INTO warranty (type, name_product, warranty_date, sale_date, warranty_out, serial) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt1, 'ssssss', $Type, $Product_name, $warranty_date, $sale_date, $warranty_out, $serial);
mysqli_stmt_execute($stmt1);
mysqli_stmt_close($stmt1);

echo '<script>window.location = "slip.php?fname='.$fname.'&userID='.$userID.'"</script>';


?>  