<?php
require ("../../back-end/database/db.php");
require ("user-info.php");
$is_logged_in = isset ($fnameShow['fname']);

// Fetch product details
if (isset ($_GET['productID'])) {
    $productID = $_GET['productID'];
    $stmt = mysqli_prepare($connection, "SELECT * FROM product WHERE product_ID = ?");
    mysqli_stmt_bind_param($stmt, "s", $productID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $productShow = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

// Check if productID is set and the user is logged in
if (isset ($_POST['addToCart']) && $is_logged_in) {
    $productID = $_GET['productID'];
    $userID = $fnameShow['user_ID'];
    $quantity = $_POST['quantity'];

    // Check if the product already exists in the user's cart
    $stmt_check = mysqli_prepare($connection, "SELECT * FROM carts WHERE product_ID = ? AND user_ID = ?");
    mysqli_stmt_bind_param($stmt_check, "ss", $productID, $userID);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Product already exists in the cart, update the quantity
        $row = mysqli_fetch_assoc($result_check);
        $quantity = (int) $row['quantity'] + (int) $quantity; // Update quantity to the existing value
        $stmt_update = mysqli_prepare($connection, "UPDATE carts SET quantity = ? WHERE product_ID = ? AND user_ID = ?");
        mysqli_stmt_bind_param($stmt_update, "sss", $quantity, $productID, $userID);
        mysqli_stmt_execute($stmt_update);
        mysqli_stmt_close($stmt_update);
    } else {
        // Product doesn't exist in the cart, insert it
        $stmt_insert = mysqli_prepare($connection, "INSERT INTO carts (product_ID, user_ID, quantity) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt_insert, "sss", $productID, $userID, $quantity);
        mysqli_stmt_execute($stmt_insert);
        mysqli_stmt_close($stmt_insert);
    }

    echo '<script>window.location = "cart.php?fname=' . $fnameShow['fname'] . '&userID=' . $userID . '&productID='.$productShow['product_ID'].'"</script>';

    // Close the statement
    mysqli_stmt_close($stmt_check);
} elseif (isset ($_POST['purchase']) && $is_logged_in) {
    $productID = $_GET['productID'];
    $userID = $fnameShow['user_ID'];
    $quantity = $_POST['quantity'];

    echo '<script>window.location = "orderConfirming.php?fname=' . $fnameShow['fname'] . '&userID=' . $userID . '&total=' . $productShow['product_price'] . '"</script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/detailProduct.css">
</head>

<body>
    <div style='position:sticky; top:0;'>
        <?php require ("components/nav.php"); ?>
    </div>
    <div class="Container">
        <div class="product-image">
            <img src="<?php echo $productShow['image_path'] ?>" alt="<?php echo $productShow['name_product'] ?>">
        </div>
        <div class="product-caption">
            <div class="detail">
                <h1>
                    <?php echo $productShow['name_product'] ?>
                </h1>
                <p style='color:#7C7C7C;' class='caption '>แบรนด์:
                    <?php echo $productShow['product_brand'] ?>
                    &nbsp;&nbsp; ID:
                    <?php echo $productShow['product_ID'] ?>
                </p>
                <hr>
                <p>
                    <?php echo $productShow['product_detail'] ?>
                </p>
                <hr>
                <h1 style='color:red;'>฿
                    <?php echo $productShow['product_price'] ?>
                </h1>
                <?php if ($is_logged_in): ?>
                    <form action="" method='post'>
                        <div class="quantity-input">
                            <p>จำนวน</p>
                            <button type="button" class="quantity-minus">-</button>
                            <input type="number" class="quantity-input-field" value="1" name="quantity" readonly>
                            <button type="button" class="quantity-plus">+</button>
                        </div>
                        <div class="buttons">
                            <a href="#">
                                <button class='cart-btn' name="addToCart">หยิบใส่ตะกร้า</button>
                            </a>
                            <a href="#">
                                <button class='pay-btn' name="purchase">ซื้อสินค้า</button>
                            </a>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="quantity-input">
                        <p>จำนวน</p>
                        <button type="button" class="quantity-minus">-</button>
                        <input type="number" class="quantity-input-field" value="1" readonly>
                        <button type="button" class="quantity-plus">+</button>
                    </div>
                    <div class="buttons">
                        <button class='cart-btn' onclick='login()'>หยิบใส่ตะกร้า</button>
                        <button class='pay-btn' onclick='login()'>ซื้อสินค้า</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php require ("components/footer.php") ?>

    <script>
        // Function to send quantity to cart and redirect to cart.php
        function login() {
            alert("โปรดเข้าสู่ระบบ เพื่อซื้อสินค้า")
        }
        function updateCartQuantity(quantity) {
            // Get the product ID from the URL query parameter
            const urlParams = new URLSearchParams(window.location.search);
            const productID = urlParams.get('productID');

            // Create a FormData object to send the data
            const formData = new FormData();
            formData.append('productID', productID);
            formData.append('quantity', quantity);

            // Create a new XMLHttpRequest object
            const xhr = new XMLHttpRequest();

            // Configure the request
            xhr.open("POST", "update_cart_quantity.php", true);

            // Send the request with the form data
            xhr.send(formData);
        }


        // Increment and decrement buttons functionality
        const quantityMinus = document.querySelector('.quantity-minus');
        const quantityPlus = document.querySelector('.quantity-plus');
        const quantityInput = document.querySelector('.quantity-input-field');

        quantityMinus.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                value--;
                quantityInput.value = value;
                updateCartQuantity(value);
            }
        });

        quantityPlus.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            value++;
            quantityInput.value = value;
            updateCartQuantity(value);
        });
    </script>

</body>

</html>