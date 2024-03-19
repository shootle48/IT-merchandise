<?php
require("../../back-end/database/db.php");

// Assuming you're getting serial from POST parameter
$serial = $_POST['serial'] ?? null;

$warrantyShow = null; // Initialize $warrantyShow to null

// Fetch warranty data from the database based on the provided serial number
if ($serial) {
    $stmt1 = mysqli_prepare($connection, "SELECT * FROM warranty WHERE serial = ?");
    mysqli_stmt_bind_param($stmt1, "s", $serial);
    mysqli_stmt_execute($stmt1);
    $result = mysqli_stmt_get_result($stmt1);
    $warrantyShow = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt1);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warranty result</title>
    <link rel="stylesheet" href="style/productCard.css"> <!-- Assuming you have a CSS file for styling product cards -->
    <style>
        *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        }
        body{
        background-color:#F3E4FF;
        }
        .Container{
        display:flex;
        justify-content:center;
        align-items:center;
        margin:1.5rem 0;
        margin-left:auto;
        margin-right:auto;
        border-radius:20px;
        width:1385px;
        background-color:#FFF;
        }
        .container{
            display:grid;
            grid-template-columns:auto auto auto auto;
        }
    </style>
</head>
<body>
<?php require("components/nav.php")?>
<div class="Container">
    <div class="container">
        <div class="header-warranty">
            <div>
                <h1>ข้อมูลการรับประกันสินค้า</h1>
            </div>
        </div><br>
        <div><br><br><br>
            <?php if($warrantyShow !== null) : ?>
                <p>ประเภท : <?php echo $warrantyShow['type']; ?></p>
                <p>ชื่อสินค้า : <?php echo $warrantyShow['name_product']; ?></p>
                <p>รับประกัน : <?php echo $warrantyShow['warranty_date']; ?> ปี</p>
                <p>วันที่ซื้อ : <?php echo $warrantyShow['sale_date']; ?></p>
                <p>วันหมดอายุประกัน : <?php echo $warrantyShow['warranty_out']; ?></p>
                <p>Serial: <?php echo $warrantyShow['serial']; ?></p>
            <?php else : ?>
                <p>No warranty information found for provided serial number.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>