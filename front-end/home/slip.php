<?php
$fname = $_GET['fname'];
$userID = $_GET['userID'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <style>
        body {
            background-color: #F3E4FF;
        }

        .container {
            display: flex;
            flex-direction: column;
            /* justify-content: center; */
            gap: 2rem;
            margin: 5rem;
            padding: 5rem 10rem;
            background-color: #fff;
            border-radius: 10px;
        }

        button {
            height: 50px;
            font-size: 1.1rem;
            background-color: #5D00A7;
            border: none;
            color: #fff;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php require ("components/nav.php"); ?>
    <form action="slipAction.php?fname=<?php echo $fname; ?>&userID=<?php echo $userID ?>" method="post"
        enctype="multipart/form-data">
        <div class="container">
            <h1>หลักฐานการชำระเงิน</h1>
            <h3>โปรดส่งไฟล์รูปภาพหลักฐานการชำระเงิน</h3>
            <input type="file" name="image" accept="image/*" required>
            <button type="submit">ส่งสลิป</button>
        </div>
    </form>
    <?php require ("components/footer.php") ?>
</body>

</html>