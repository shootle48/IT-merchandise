<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cart</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <?php
        $link = mysqli_connect('localhost', 'root', '', 'it-merchandise') or die ('Connect Failed' . mysqli_connect_error());
        if (isset ($_GET['product_ID'])) {
            $cart_ID = $_GET['product_ID'];
            $sql = "SELECT * FROM carts WHERE cart_ID ='$cart_ID'";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_array($result);
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-5 mx-auto my-auto">
                    <div class="h4 text-center alert alert-success mb-3 mt-3" role="alert"> แก้ไขข้อมูลตระกร้าสินค้า
                    </div>
                    <form action="updatecart.php" method="post">
                        <label>cart_ID</label>
                        <input type="hidden" name="cart_ID" value="<?= $row['cart_ID'] ?>">
                        <label for="product_ID">Product ID</label>
                        <input type="text" class="form-control" id="product_ID" name="product_ID"
                            value="<?= $row['product_ID'] ?>" required>
                        <label for="user_ID">user ID</label>
                        <input type="text" class="form-control" id="user_ID" name="user_ID"
                            value="<?= $row['user_ID'] ?>" required>
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity"
                            value="<?= $row['quantity'] ?>" required>
                        <button type="submit" class="btn btn-success mt-3"> Edit </button>
                        <a href="admin_carts.php" class="btn btn-danger mt-3"> Cancel </a>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>