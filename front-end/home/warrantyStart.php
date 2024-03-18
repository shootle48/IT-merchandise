<?php
require ("../../back-end/database/db.php");
$userID = $_GET['userID'];
$fname = $_GET['fname'];

if (isset ($_GET['productID'])) {
    $productID = $_GET['productID'];
    $stmt = mysqli_prepare($connection, "SELECT * FROM product WHERE product_ID = ?");
    mysqli_stmt_bind_param($stmt, "s", $productID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $productShow = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    welcome Warranty
    <a href="slip.php?fname=<?php echo $fname ?>&userID=<?php echo $userID?>">ไปต่อ</a>
    <h1>Product_TYPE = <?php echo $productShow['type']?></h1>
</body>
</html>