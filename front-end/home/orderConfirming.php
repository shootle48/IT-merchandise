<?php
require ("../../back-end/database/db.php");
$userID = $_GET['userID'];
$total = $_GET['total'];
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
    <title>orderConfirming</title>
    <link rel="stylesheet" href="style/orderConfirming.css">

</head>

<body>

    <div style='position:sticky; top:0;'>
        <?php
        require ("components/nav.php");
        ?>
    </div>

    <form action="ordered.php?userID=<?php echo $userID ?>&fname=<?php echo $fname ?>&productID=<?php echo $productShow['product_ID']?>" method="post">
        <div class="orderForm container">
            <div class="order-left header">
                <h1>การชำระเงิน</h1>
                <hr>
                <h3>ที่อยู่จัดส่ง</h3>
                <div class="inputData">
                    <p>ชื่อผู้รับ</p>
                    <input type="text" name="name" required>
                    <p>เบอร์โทรผู้รับ</p>
                    <input type="text" name="tel" required>
                    <p>ที่อยู่ในการจัดส่ง</p>
                    <textarea name="address" id="" cols="30" rows="5" required>
                          </textarea>
                </div>
                <h3>วิธีการชำระเงิน</h3>
                <select name="" id="" value='Paypal'>
                    <option value="PayPal">PayPal</option>
                    <option value="Credit-Card">Credit</option>
                    <option value="Cash">Cash</option>
                    <option value="QRCODE">QRCODE</option>
                </select>
            </div>
            <div class="body">
                <div class="order-right">
                    <p>ยอดรวมสุทธิ</p>
                    <input type="hidden" name='totalPrice' value='<?php echo $total ?>'>
                    <span name='total'>
                        <?php echo $total ?>
                    </span>
                </div>
                <input type="submit" value="ชำระเงิน" class="btn">
            </div>
        </div>
    </form>

    <?php
    require ("components/footer.php")
        ?>

</body>

</html>