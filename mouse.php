<?php
require ("../../back-end/product_mouse.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/productCard.css">
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
    </style>
</head>

<body>
    <div style='position:sticky; top:0;'>
        <?php
        require ("components/nav.php");
        ?>
    </div>
    <div class="Container">
        <div class="container">
            <div class="header-product">
                <div class="laptops">
                    <h2>เมาส์ | Mouse</h2>
                </div>
                <div class="allLaptops">
                    <a href="home.php">
                        กลับหน้าแรก
                    </a>
                </div>
            </div>

            <div class="container-Product-Card">
                <?php if ($is_logged_in): ?>
                    <?php
                    foreach ($mouses as $mouse) {
                        ?>
                        <a
                            href="detailProduct.php?productID=<?php echo $mouse['product_ID'] ?>&fname=<?php echo $fnameShow['fname'] ?>">
                            <div class="product-card">
                                <h3>
                                    <?php echo $mouse['product_brand']; ?>
                                </h3>
                                <img src="<?php echo $mouse['image_path']; ?>" alt="<?php echo $mouse['name_product']; ?>">
                                <h3>
                                    <?php echo $mouse['name_product']; ?>
                                </h3>
                                <p>฿
                                    <?php echo $mouse['product_price']; ?>
                                </p>
                                <button>ดูรายละเอียด</button>
                            </div>
                        </a>
                        <?php
                    }
                    ?>
                <?php else: ?>
                    <?php
                    foreach ($mouses as $mouse) {
                        ?>
                        <a href="detailProduct.php?productID=<?php echo $mouse['product_ID'] ?>">
                            <div class="product-card">
                                <h3>
                                    <?php echo $mouse['product_brand']; ?>
                                </h3>
                                <img src="<?php echo $mouse['image_path']; ?>" alt="<?php echo $mouse['name_product']; ?>">
                                <h3>
                                    <?php echo $mouse['name_product']; ?>
                                </h3>
                                <p>฿
                                    <?php echo $mouse['product_price']; ?>
                                </p>
                                <button>ดูรายละเอียด</button>
                            </div>
                        </a>
                        <?php
                    }
                    ?>
                <?php endif; ?>
            </div>
            <!-- Laptop END -->
        </div>
    </div>
    <?php
    require ("components/footer.php")
        ?>
</body>

</html>