<?php

$productID = $_GET['product_ID'];

$servername = "localhost";
$dbname = "it-merchandise";
$conn = new mysqli($servername, 'root', '', $dbname);

if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM product WHERE product_ID = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $productID);

$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "<script>alert('ลบข้อมูลสินค้าเรียบร้อย'); window.location.href='Productlist.php';</script>";
} else {
    echo "<script>alert('ไม่พบข้อมูลสินค้า'); window.location.href='Productlist.php';</script>";
}

$stmt->close();
$conn->close();

?>