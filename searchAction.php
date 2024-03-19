<?php
require ("../../back-end/database/db.php");
require ("user-info.php");

$searchResults = array();

if (isset ($_POST['search'])) {
    $search = $_POST['search'];

    // Sanitize the input
    $search = mysqli_real_escape_string($connection, $search);

    // Query to fetch search results
    $query = "SELECT * FROM product WHERE name_product LIKE '%$search%'";
    $result = mysqli_query($connection, $query);

    // Fetch search results
    while ($row = mysqli_fetch_assoc($result)) {
        $searchResults[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="style/productCard.css"> <!-- Assuming you have a CSS file for styling product cards -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #F3E4FF;
        }

        .Container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 1.5rem 0;
            margin-left: auto;
            margin-right: auto;
            border-radius: 20px;
            width: 1385px;
            background-color: #FFF;
        }

        .container {
            display: grid;
            grid-template-columns: auto auto auto auto;
        }
    </style>
</head>

<body>
    <?php require ("components/nav.php") ?>
    <div class="Container">
        <div class="container">
            <?php if ($is_logged_in): ?>
                <?php
                if (!empty ($searchResults)) {
                    foreach ($searchResults as $product) {
                        ?>
                        <a href="detailProduct.php?productID=<?php echo $product['product_ID'] ?>&fname=<?php echo $fnameShow['fname'] ?>"
                            style='text-decoration:none;'>
                            <div class="product-card">
                                <h3>
                                    <?php echo $product['product_brand']; ?>
                                </h3>
                                <img src="<?php echo $product['image_path']; ?>" alt="<?php echo $product['name_product']; ?>">
                                <h3>
                                    <?php echo $product['name_product']; ?>
                                </h3>
                                <p>฿
                                    <?php echo $product['product_price']; ?>
                                </p>
                                <button>ดูรายละเอียด</button>
                            </div>
                        </a>
                        <?php
                    }
                } else {
                    echo '  <script>
                    alert("ไม่พบสินค้าที่ค้นหา");
                    window.location = "home.php";
                    </script>';
                    ?>
                    <?php
                }
                ?>
            <?php else: ?>
                <?php
                if (!empty ($searchResults)) {
                    foreach ($searchResults as $product) {
                        ?>
                        <a href="detailProduct.php?productID=<?php echo $product['product_ID'] ?>" style='text-decoration:none;'>
                            <div class="product-card">
                                <h3>
                                    <?php echo $product['product_brand']; ?>
                                </h3>
                                <img src="<?php echo $product['image_path']; ?>" alt="<?php echo $product['name_product']; ?>">
                                <h3>
                                    <?php echo $product['name_product']; ?>
                                </h3>
                                <p>฿
                                    <?php echo $product['product_price']; ?>
                                </p>
                                <button>ดูรายละเอียด</button>
                            </div>
                        </a>
                        <?php
                    }
                } else {
                    echo '  <script>
                    alert("ไม่พบสินค้าที่ค้นหา");
                    window.location = "home.php";
                    </script>';
                    ?>
                    <?php
                }
                ?>
            <?php endif; ?>
        </div>
    </div>
    <?php
    require ("components/footer.php")
        ?>

</body>

</html>