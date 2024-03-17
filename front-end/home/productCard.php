<?php
require("../../back-end/product_laptop.php");
require("../../back-end/product_mobile.php");
require("../../back-end/product_mouse.php");
require("../../back-end/product_keyboard.php");
require("../../back-end/product_headphone.php");
if ($is_logged_in) : 
    require("user-info.php");
endif;

// กำหนดจำนวนสินค้าที่จะแสดง
$limit = 4;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style/productCard.css">
</head>
<body>

  <!-- Laptop START -->
    <div class="container">
        <div class="header-product">
            <div class="laptops">
                <h2>โน๊คบุ๊ค | Laptop</h2>
            </div>
            <div class="allLaptops">
            <?php if ($is_logged_in) : ?>
                <a href="laptop.php?fname=<?php echo $fnameShow['fname']?>" style='text-decoration:none;'>
                    ดูทั้งหมด
                </a>
            <?php else: ?>
                <a href="laptop.php" style='text-decoration:none;'>
                    ดูทั้งหมด
                </a>
            <?php endif; ?>
            </div>
        </div>
        
        <div class="container-Product-Card">
            <?php
            for ($i = 0; $i < $limit; $i++) {
            ?>
            <?php if ($is_logged_in) : ?>
                <a href="detailProduct.php?productID=<?php echo $laptops[$i]['product_ID']?>&fname=<?php echo $fnameShow['fname']?>">
                <div class="product-card">
                    <h3><?php echo $laptops[$i]['product_brand'];?></h3>
                    <img src="<?php echo $laptops[$i]['image_path']; ?>" alt="<?php echo $laptops[$i]['name_product']; ?>">
                    <h3><?php echo $laptops[$i]['name_product']; ?></h3>
                    <p>฿<?php echo $laptops[$i]['product_price']; ?></p>
                    <button>ดูรายละเอียด</button>
                </div>
                </a>
            <?php else: ?>
                <a href="detailProduct.php?productID=<?php echo $laptops[$i]['product_ID']?>">
                <div class="product-card">
                    <h3><?php echo $laptops[$i]['product_brand'];?></h3>
                    <img src="<?php echo $laptops[$i]['image_path']; ?>" alt="<?php echo $laptops[$i]['name_product']; ?>">
                    <h3><?php echo $laptops[$i]['name_product']; ?></h3>
                    <p>฿<?php echo $laptops[$i]['product_price']; ?></p>
                    <button>ดูรายละเอียด</button>
                </div>
                </a>
            <?php endif; ?>
            <?php
            }
            ?>
        </div>
        <!-- Laptop END -->


        <!-- Mobile START -->
        <div class="header-product">
            <div class="mobiles">
                <h2>โทรศัพท์ | Mobile</h2>
            </div>
            <div class="allMobile">
            <?php if ($is_logged_in) : ?>
                <a href="mobile.php?fname=<?php echo $fnameShow['fname']?>" style='text-decoration:none;'>
                    ดูทั้งหมด
                </a>
            <?php else: ?>
                <a href="mobile.php" style='text-decoration:none;'>
                    ดูทั้งหมด
                </a>
            <?php endif; ?>
            </div>
        </div>
        
        <div class="container-Product-Card">
        <?php
            for ($i = 0; $i < $limit; $i++) {
            ?>
            <?php if ($is_logged_in) : ?>
                <a href="detailProduct.php?productID=<?php echo $mobiles[$i]['product_ID']?>&fname=<?php echo $fnameShow['fname']?>">
                <div class="product-card">
                    <h3><?php echo $mobiles[$i]['product_brand'];?></h3>
                    <img src="<?php echo $mobiles[$i]['image_path']; ?>" alt="<?php echo $mobiles[$i]['name_product']; ?>">
                    <h3><?php echo $mobiles[$i]['name_product']; ?></h3>
                    <p>฿<?php echo $mobiles[$i]['product_price']; ?></p>
                    <button>ดูรายละเอียด</button>
                </div>
                </a>
            <?php else: ?>
                <a href="detailProduct.php?productID=<?php echo $mobiles[$i]['product_ID']?>">
                <div class="product-card">
                    <h3><?php echo $mobiles[$i]['product_brand'];?></h3>
                    <img src="<?php echo $mobiles[$i]['image_path']; ?>" alt="<?php echo $mobiles[$i]['name_product']; ?>">
                    <h3><?php echo $mobiles[$i]['name_product']; ?></h3>
                    <p>฿<?php echo $mobiles[$i]['product_price']; ?></p>
                    <button>ดูรายละเอียด</button>
                </div>
                </a>
            <?php endif; ?>
            <?php
            }
            ?>
        </div>
        <!-- Mobile END -->

        <!-- Mouse START -->
        <div class="header-product">
            <div class="Mouses">
                <h2>เมาส์ | Mouse</h2>
            </div>
            <div class="allMouse">
            <?php if ($is_logged_in) : ?>
                <a href="mouse.php?fname=<?php echo $fnameShow['fname']?>" style='text-decoration:none;'>
                    ดูทั้งหมด
                </a>
            <?php else: ?>
                <a href="mouse.php" style='text-decoration:none;'>
                    ดูทั้งหมด
                </a>
            <?php endif; ?>
            </div>
        </div>
        
        <div class="container-Product-Card">
        <?php
            for ($i = 0; $i < $limit; $i++) {
            ?>
            <?php if ($is_logged_in) : ?>
                <a href="detailProduct.php?productID=<?php echo $mouses[$i]['product_ID']?>&fname=<?php echo $fnameShow['fname']?>">
                <div class="product-card">
                    <h3><?php echo $mouses[$i]['product_brand'];?></h3>
                    <img src="<?php echo $mouses[$i]['image_path']; ?>" alt="<?php echo $mouses[$i]['name_product']; ?>">
                    <h3><?php echo $mouses[$i]['name_product']; ?></h3>
                    <p>฿<?php echo $mouses[$i]['product_price']; ?></p>
                    <button>ดูรายละเอียด</button>
                </div>
                </a>
            <?php else: ?>
                <a href="detailProduct.php?productID=<?php echo $mouses[$i]['product_ID']?>">
                <div class="product-card">
                    <h3><?php echo $mouses[$i]['product_brand'];?></h3>
                    <img src="<?php echo $mouses[$i]['image_path']; ?>" alt="<?php echo $mouses[$i]['name_product']; ?>">
                    <h3><?php echo $mouses[$i]['name_product']; ?></h3>
                    <p>฿<?php echo $mouses[$i]['product_price']; ?></p>
                    <button>ดูรายละเอียด</button>
                </div>
                </a>
            <?php endif; ?>
            <?php
            }
            ?>
        </div>
        <!-- Mouse END -->

        <!-- KEYBOARD START -->
        <div class="header-product">
            <div class="Keyboards">
                <h2>คีย์บอร์ด | Keyboard</h2>
            </div>
            <div class="allKeyboard">
            <?php if ($is_logged_in) : ?>
                <a href="keyboard.php?fname=<?php echo $fnameShow['fname']?>" style='text-decoration:none;'>
                    ดูทั้งหมด
                </a>
            <?php else: ?>
                <a href="keyboard.php" style='text-decoration:none;'>
                    ดูทั้งหมด
                </a>
            <?php endif; ?>
            </div>
        </div>
        
        <div class="container-Product-Card">
        <?php
            for ($i = 0; $i < $limit; $i++) {
            ?>
            <?php if ($is_logged_in) : ?>
                <a href="detailProduct.php?productID=<?php echo $keyboards[$i]['product_ID']?>&fname=<?php echo $fnameShow['fname']?>">
                <div class="product-card">
                    <h3><?php echo $keyboards[$i]['product_brand'];?></h3>
                    <img src="<?php echo $keyboards[$i]['image_path']; ?>" alt="<?php echo $keyboards[$i]['name_product']; ?>">
                    <h3><?php echo $keyboards[$i]['name_product']; ?></h3>
                    <p>฿<?php echo $keyboards[$i]['product_price']; ?></p>
                    <button>ดูรายละเอียด</button>
                </div>
                </a>
            <?php else: ?>
                <a href="detailProduct.php?productID=<?php echo $keyboards[$i]['product_ID']?>">
                <div class="product-card">
                    <h3><?php echo $keyboards[$i]['product_brand'];?></h3>
                    <img src="<?php echo $keyboards[$i]['image_path']; ?>" alt="<?php echo $keyboards[$i]['name_product']; ?>">
                    <h3><?php echo $keyboards[$i]['name_product']; ?></h3>
                    <p>฿<?php echo $keyboards[$i]['product_price']; ?></p>
                    <button>ดูรายละเอียด</button>
                </div>
                </a>
            <?php endif; ?>
            <?php
            }
            ?>
        </div>
        <!-- KEYBOARD END -->

        <!-- HEADPHONE START -->
        <div class="header-product">
            <div class="Headphones">
                <h2>หูฟัง | Headphone</h2>
            </div>
            <div class="allHeadphone">
            <?php if ($is_logged_in) : ?>
                <a href="headphone.php?fname=<?php echo $fnameShow['fname']?>" style='text-decoration:none;'>
                    ดูทั้งหมด
                </a>
            <?php else: ?>
                <a href="headphone.php" style='text-decoration:none;'>
                    ดูทั้งหมด
                </a>
            <?php endif; ?>
            </div>
        </div>
        
        <div class="container-Product-Card">
        <?php
            for ($i = 0; $i < $limit; $i++) {
            ?>
            <?php if ($is_logged_in) : ?>
                <a href="detailProduct.php?productID=<?php echo $headphones[$i]['product_ID']?>&fname=<?php echo $fnameShow['fname']?>">
                <div class="product-card">
                    <h3><?php echo $headphones[$i]['product_brand'];?></h3>
                    <img src="<?php echo $headphones[$i]['image_path']; ?>" alt="<?php echo $headphones[$i]['name_product']; ?>">
                    <h3><?php echo $headphones[$i]['name_product']; ?></h3>
                    <p>฿<?php echo $headphones[$i]['product_price']; ?></p>
                    <button>ดูรายละเอียด</button>
                </div>
                </a>
            <?php else: ?>
                <a href="detailProduct.php?productID=<?php echo $headphones[$i]['product_ID']?>">
                <div class="product-card">
                    <h3><?php echo $headphones[$i]['product_brand'];?></h3>
                    <img src="<?php echo $headphones[$i]['image_path']; ?>" alt="<?php echo $headphones[$i]['name_product']; ?>">
                    <h3><?php echo $headphones[$i]['name_product']; ?></h3>
                    <p>฿<?php echo $headphones[$i]['product_price']; ?></p>
                    <button>ดูรายละเอียด</button>
                </div>
                </a>
            <?php endif; ?>
            <?php
            }
            ?>
        </div>
        <!-- HEADPHONE END -->
    </div>

</body>
</html>
