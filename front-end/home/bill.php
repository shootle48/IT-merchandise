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

// Fetch details of each product in the cart for each bill
$productsByBill = [];
foreach ($billItems as $billItem) {
    $billID = $billItem['bill_ID'];
    $stmt = mysqli_prepare($connection, "SELECT * FROM cartStock WHERE user_ID = ? AND bill_ID = ?");
    mysqli_stmt_bind_param($stmt, "ss", $userID, $billID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $products = [];
    while ($product = mysqli_fetch_assoc($result)) {
        $products[] = $product;
    }
    $productsByBill[$billID] = $products;

    mysqli_stmt_close($stmt);
}

$deleteCart = mysqli_prepare($connection, "DELETE FROM carts WHERE user_ID = ?");
mysqli_stmt_bind_param($deleteCart, "s", $userID);
mysqli_stmt_execute($deleteCart);
mysqli_stmt_close($deleteCart);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bills</title>
    <link rel="stylesheet" href="style/bill.css?v=<?php echo time() ?>">
</head>

<body>
    <?php require ("components/nav.php"); ?>
    <div class="Container">
        <div class="Showdetail">
            <div class="body">
                <?php if (empty($billItems)): ?>
                    <p>No bills found for user <?php echo $fname; ?></p>
                <?php else: ?>
                    <?php foreach ($billItems as $billItem): ?>
                        <div class='detail'>
                            รหัสใบสั่งซื้อ: <div class="billID">
                                <?php echo $billItem['bill_ID']; ?>
                            </div>
                            <hr>
                            ชื่อผู้รับ: <div class="name">
                                <?php echo $billItem['emp_Name']; ?>
                            </div>
                            <hr>
                            เบอร์โทร: <div class="tel">
                                <?php echo $billItem['tel']; ?>
                            </div>
                            <hr>
                            ที่อยู่ในการจัดส่ง: <div class="address">
                                <?php echo $billItem['address']; ?>
                            </div>
                            <hr>
                            <h4>รายละเอียดสินค้า</h4>
                            <hr>
                            <?php if (!empty($productsByBill[$billItem['bill_ID']])): ?>
                                <div class="productShow">
                                    <?php foreach ($productsByBill[$billItem['bill_ID']] as $product): ?>
                                        <div>
                                            <?php echo $product['product_name']; ?> |
                                            จำนวน&nbsp<?php echo $product['quantity'];?>&nbspชิ้น |
                                            ราคา/ชิ้น&nbsp<?php echo $product['product_price']; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p>No products found for this bill.</p>
                            <?php endif; ?>
                            <hr>
                            ยอดรวมสุทธิ: <div class="total">
                                <?php echo $billItem['totalPrice']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>
