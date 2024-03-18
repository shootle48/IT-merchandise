<?php
require ("../../back-end/database/db.php");
$userID = $_GET['userID'];
$fname = $_GET['fname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    welcome Warranty
    <a href="slip.php?fname=<?php echo $fname ?>&userID=<?php echo $userID?>">ไปต่อ</a>
</body>
</html>