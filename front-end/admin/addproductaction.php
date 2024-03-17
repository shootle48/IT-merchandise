<?php

// เชื่อมต่อกับ database
$servername = "localhost";
$dbname = "it-merchandise";
$conn = new mysqli($servername,'root' , '' , $dbname);

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}


$name_product = $_POST['name_product'];
$product_detail = $_POST['product_detail'];
$product_price = $_POST['product_price'];
$image_path = "image/" . $_POST['image_path'];
$product_brand = $_POST['product_brand'];
$type = $_POST['type'];



$sql = "INSERT INTO product SET name_product = '$name_product',product_detail = '$product_detail', product_price = '$product_price', image_path = '$image_path ', product_brand = ' $product_brand ', type = '$type' ";

$stmt = $conn->prepare($sql);

// Execute query and print errors
if (!$stmt->execute()) {
    echo "Error executing query: " . $stmt->error;
    exit;
}

if ($stmt->affected_rows > 0) {
    echo "<p>เพิ่มสินค้าสำเร็จ!</p>";
    echo "<a href='Productlist.php". "'>ไปหน้ารายการสินค้า</a>";
} else {
    echo "<p>เกิดข้อผิดพลาด! ไม่สามารถเพิ่มสินค้าได้</p>";
    echo "<a href='Productlist.php". "'>ไปหน้ารายการสินค้า</a>";
}

// ปิด connection
$stmt->close();
$conn->close();

?>
