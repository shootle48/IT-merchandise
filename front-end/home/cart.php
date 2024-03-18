<?php
require ("../../back-end/database/db.php");
require ("user-info.php");

$userID = $_GET['userID'];

$stmt = mysqli_prepare($connection, "SELECT * FROM carts WHERE user_ID LIKE ?");
mysqli_stmt_bind_param($stmt, "s", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fetch all items in the cart
$cartItems = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cartItems[] = $row;
}
// Close the statement
mysqli_stmt_close($stmt);

// Fetch details of each product in the cart
$total = 0;
$products = [];
foreach ($cartItems as $item) {
    $productID = $item['product_ID'];
    $stmt = mysqli_prepare($connection, "SELECT * FROM product WHERE product_ID LIKE ?");
    mysqli_stmt_bind_param($stmt, "s", $productID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $productShow = mysqli_fetch_assoc($result);
    $products[] = $productShow;
    $total += $productShow['product_price'] * $item['quantity']; // Update total
    // Close the statement
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="style/cart.css">
</head>

<body>

    <div style='position:sticky; top:0;'>
        <?php
        require ("components/nav.php");
        ?>
    </div>

    <div class="container">
        <div class="header">
            <div class="head">
                <h1>ตะกร้าสินค้า(
                    <?php echo count($cartItems); ?>)
                </h1>
                <a href="../home/home.php?fname=<?php echo $fnameShow['fname'] ?>">
                    <h3>ดูสินค้าอื่น ๆ</h4>
                </a>
            </div>
            <!-- Loop through each item in the cart -->
            <?php foreach ($cartItems as $item): ?>
                <?php
                $productID = $item['product_ID'];
                // Fetch product details
                $stmt = mysqli_prepare($connection, "SELECT * FROM product WHERE product_ID LIKE ?");
                mysqli_stmt_bind_param($stmt, "s", $productID);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $productShow = mysqli_fetch_assoc($result);
                // Close the statement
                mysqli_stmt_close($stmt);
                ?>
                <div class="item">
                    <div class="image">
                        <img src="<?php echo $productShow['image_path']; ?>"
                            alt="<?php echo $productShow['name_product']; ?>">
                    </div>
                    <div class="info">
                        <h4>
                            <?php echo $productShow['name_product']; ?>
                        </h4>
                        <p>฿
                            <?php echo $productShow['product_price']; ?>
                        </p>
                        <div class="quantity">
                            <!-- Display the quantity for the current item -->
                            <p>จำนวน
                                <?php echo $item['quantity']; ?>
                            </p>
                        </div>
                        <form action="deleteProduct.php" method='get'>
                            <input type="hidden" name="productID" value="<?php echo $productShow['product_ID']; ?>">
                            <input type="hidden" name="fname" value="<?php echo $fnameShow['fname'] ?>">
                            <input type="hidden" name="userID" value="<?php echo $fnameShow['user_ID'] ?>">
                            <button type="submit" class="trash-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="body">
            <!-- Discount input field and apply button -->
            <!-- Total price and discount -->
            <div class="total">
                <div class="totalPrice">
                    <h3>ยอดรวม</h3>
                    <span id="totalPrice">฿
                        <?php echo $total; ?>
                    </span>
                </div>
                <div class="RealTotal">
                    <h3>ยอดรวมสุทธิ</h3>
                    <span id="realTotal" name='totalPrice'>฿
                        <?php echo $total; ?>
                    </span>
                </div>
            </div>
            <!-- Pay button -->
            <div class="pay-btn">
                <?php if (!empty ($cartItems)): ?>
                    <a href="orderConfirming.php?userID=<?php echo $userID ?>&total=<?php echo $total ?>&fname=<?php echo $fnameShow['fname'] ?>&productID=<?php echo $productShow['product_ID']?>"
                        id="checkout-link">
                        <button type='button' id="checkout">ดำเนินการชำระเงิน</button>
                    </a>
                <?php else: ?>
                    <button type='button' id="checkout">ดำเนินการชำระเงิน</button>
                <?php endif ?>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('checkout').addEventListener('click', function () {
            <?php if (empty ($cartItems)): ?>
                alert("ไม่มีสินค้าในตะกร้า");
            <?php else: ?>
                window.location.href = "orderConfirming.php?userID=<?php echo $userID ?>&total=<?php echo $total ?>&fname=<?php echo $fnameShow['fname'] ?>";
            <?php endif ?>
        });
    </script>
</body>

</html>