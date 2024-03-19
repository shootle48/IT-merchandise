<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>warranty check</title>
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

        .header-warranty {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 2.0rem;
            text-align: center;

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
            <div class="header-warranty">
                <div>
                    <h1>ตรวจสอบอายุประกันสินค้า</h1>
                </div>
            </div><br>
            <div>
                <h3>ตรวจสอบสถานะการรับประกันผลิตภัณฑ์ของคุณ เพียงกรอกรหัส Serial ผลิตภัณฑ์</h3>
            </div><br>
            <div class="searchwarranty">
                <form action="../home/warrantyAction.php?fname=<?php echo $fnameShow['fname'] ?>" method="post">
                    <input type="text" placeholder="กรอกข้อมูลผลิตภัณฑ์" name="serial">
                    <button type="submit">ตรวจสอบ</button>
                </form>

            </div>


</body>

</html>