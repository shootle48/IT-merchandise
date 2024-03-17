<?php
// 1. เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "it-merchandise";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM bills";
$result = $conn->query($sql);


$bills = [];
while ($row = $result->fetch_assoc()) {
  $bills[] = $row;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>แสดงข้อมูลใบเสร็จ</title>
  <link rel="stylesheet" href="../home/style/styleforBill.css">
</head>
<body>
  <a href="Main_admin_menu.php"><button class="button">กลับหน้าหลัก</button></a>
  <div class="container">
    <h1>ข้อมูลใบเสร็จ</h1><br>
    
    <table class="bills-table">
      <thead>
        <tr>
          <th>รหัสใบเสร็จ</th>
          <th>ชื่อลูกค้า</th>
          <th>เบอร์โทร</th>
          <th>ที่อยู่</th>
          <th>ราคารวม</th>
          <th>หลักฐานใบเสร็จ</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($bills as $bill): ?>
          <tr>
            <td><?php echo $bill["bill_ID"]; ?></td>
            <td><?php echo $bill["emp_Name"]; ?></td>
            <td><?php echo $bill["tel"]; ?></td>
            <td><?php echo $bill["address"]; ?></td>
            <td><?php echo $bill["totalPrice"] . " บาท"; ?></td>
            <td><img src="<?php echo $bill["slip"]?>" style='width:400px;'></td>
            <td>
              <form action="deleteBill.php" method="post" onsubmit="return confirm('ยืนยันการลบใบเสร็จ?');">
                <input type="hidden" name="id" value="<?php echo $bill["bill_ID"]; ?>">
                <input type="submit" value="ลบ" class="delete-btn">
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <br><br>
  <?php
  require("footer.php")
  ?>
</body>
</html>