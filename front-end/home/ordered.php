<?php
require("../../back-end/database/db.php");
$userID = $_GET['userID'];
$fname = $_GET['fname'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$address = $_POST['address'];
$totalPrice = $_POST['totalPrice'];


$stmt = mysqli_prepare($connection, "INSERT INTO bills (user_ID,emp_Name,tel,address,totalPrice) VALUES (?,?,?,?,?)");
mysqli_stmt_bind_param($stmt, "sssss", $userID, $name, $tel, $address, $totalPrice);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

echo '<script>window.location = "slip.php?fname='.$fname.'&userID='.$userID.'"</script>';

?>