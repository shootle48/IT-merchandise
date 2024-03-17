
<?php

// เชื่อมต่อกับ database
$servername = "localhost";

$dbname = "it-merchandise";

$conn = new mysqli($servername,'root' , '' , $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// ดึงข้อมูล
$sql = "SELECT * FROM product";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();



?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>รายการสินค้า</title>
  <style>
    body {
    background-color: #F3E4FF;
    font-family: Arial, sans-serif;
    color: #5D00A7;
  }

  table {
    border-collapse: collapse;
    border: 1px solid #5D00A7;
    margin: auto;
    width: 70%;
  }

  th, td {
    padding: 5px;
    border: 1px solid #5D00A7;
    text-align: center;
  }

  th {
    background-color: #5D00A7;
    color: #F3E4FF;
  }

  a {
    text-decoration: none;
    color: #5D00A7;
  }

  a:hover {
    color: #F3E4FF;
  }

  .button {
    background-color: #5D00A7;
    color: #F3E4FF;
    font-size: 16px;
    padding: 5px 10px;
    border: 1px solid #5D00A7;
    border-radius: 5px;
    margin-right: 10px;
    text-decoration: none;
  }

  .button:hover {
    background-color: #b050ff;
    color: #F3E4FF;
  }
  .product-message {
  font-family: Lato, sans-serif;
  font-size: 48px;
  font-weight: bold;
  margin-top: 20px;
  text-align: center;
  color: #5D00A7;
}
  </style>
</head>
<body>
    <a href="Main_admin_menu.php"><button class="button">กลับหน้าหลัก</button></a>
    <a href="AddProduct.php"><button class="button">เพิ่มสินค้า</button></a>
    <div class="product-message">รายการสินค้า</div><br><br><br><br>
  <table style="background-color: #FFFFFF">
    <tr>
      <th>ชื่อสินค้า</th>
      <th>ราคา</th>
      <th>รูปภาพ</th>
      <th>จัดการ</th>
    </tr>

    <?php
    while ($product = $result->fetch_assoc()) {
    ?>
      <tr>
        <td><?php echo $product['name_product']; ?></td>
        <td><?php echo $product['product_price']; ?></td>
        <td><img src="<?php echo $product['image_path']; ?>" alt="Product Image" width="100"></td>
        <td>
          <a href="editProduct.php?product_ID=<?php echo $product['product_ID']; ?>" class="button">แก้ไข</a>
          <a href="deleteProduct.php?product_ID=<?php echo $product['product_ID']; ?>" onclick="return confirm('คุณต้องการที่จะลบสินค้านี้ใช้หรือไม่?')" class="button">ลบ</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </table>
  <br><br>
  <br><br>
  
  <?php
  require("footer.php")
  ?>
</body>
</html>