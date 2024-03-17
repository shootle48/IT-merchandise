<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "it-merchandise";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die ("Connection failed: " . $conn->connect_error);
}

$id = $_POST["id"];

$sql = "DELETE FROM bills WHERE bill_ID = $id";
$conn->query($sql);

echo "<script>alert('ลบข้อมูลใบเสร็จเรียบร้อย'); window.location.href='Bill.php';</script>";

$conn->close();
?>