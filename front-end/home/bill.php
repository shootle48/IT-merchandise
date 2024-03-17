<?php
require("../../back-end/database/db.php");
$userID = $_GET['userID'];
$fname = $_GET['fname'];

// Select bill items
$stmt = mysqli_prepare($connection, "SELECT * FROM bills WHERE user_ID = ?");
mysqli_stmt_bind_param($stmt, "s", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$billItems = [];
while ($rows = mysqli_fetch_assoc($result)) {
    $billItems[] = $rows;
}
mysqli_stmt_close($stmt);

// Select cart items
$carts = mysqli_prepare($connection, "SELECT * FROM carts WHERE user_ID LIKE ?");
mysqli_stmt_bind_param($carts, "s", $userID);
mysqli_stmt_execute($carts);
$result = mysqli_stmt_get_result($carts);

// Fetch all items in the cart
$cartItems = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cartItems[] = $row;
}
// Close the statement
mysqli_stmt_close($carts);

// Fetch details of each product in the cart
$products = [];
foreach ($cartItems as $item) {
    $productID = $item['product_ID'];
    $stmt = mysqli_prepare($connection, "SELECT * FROM product WHERE product_ID LIKE ?");
    mysqli_stmt_bind_param($stmt, "s", $productID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $productShow = mysqli_fetch_assoc($result);
    $products[] = $productShow;
    // Close the statement
    mysqli_stmt_close($stmt);
}

$deleteCart = mysqli_prepare($connection, "DELETE FROM carts WHERE user_ID = ?");
mysqli_stmt_bind_param($deleteCart,"s",$userID);
mysqli_stmt_execute($deleteCart);
mysqli_stmt_close($deleteCart);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bills</title>
    <link rel="stylesheet" href="style/bill.css">
</head>
<body>
<div style='position:sticky; top:0;'>
    <?php require("components/nav.php"); ?>
    <div class="Container">
        <!-- Display bill items -->
        <div class="ShowDetail">
            <div class="header">
                <h1>ขอบคุณสำหรับคำสั่งซื้อ</h1>
            </div>
            <div class="body">
                <?php foreach ($billItems as $billItem): ?>
                    <div class='detail'>
                        รหัสใบสั่งซื้อ: <div class="billID"><?php echo $billItem['bill_ID']; ?></div>
                        <hr>
                        ชื่อผู้รับ: <div class="name"><?php echo $billItem['emp_Name']; ?></div>
                        <hr>
                        เบอร์โทร: <div class="tel"><?php echo $billItem['tel']; ?></div>
                        <hr>
                        ที่อยู่ในการจัดส่ง: <div class="address"><?php echo $billItem['address']; ?></div>
                        <hr>
                        <h4>รายละเอียดสินค้า</h4>
                        <hr>
                        <div class="productShow">
                            <?php foreach ($products as $product): ?>
                                <div>
                                    <?php echo $product['name_product']; ?>
                                    <?php echo $product['product_price']; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <hr>
                        ยอดรวมสุทธิ: <div class="total"><?php echo $billItem['totalPrice']; ?></div>
                    </div>
                    <?php endforeach; ?>
                    <div class="btn-home">
                        <a href="home.php?fname=<?php echo $fname?>"><p>กลับหน้าแรก</p></a>
                    </div>
            </div>
        </div>
    </div>
</div>

<?php require("components/footer.php") ?>
</body>
</html>
