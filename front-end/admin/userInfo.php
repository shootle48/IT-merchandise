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


$sql = "SELECT * FROM user_info";
$result = $conn->query($sql);


$users = [];
while ($row = $result->fetch_assoc()) {
  $users[] = $row;
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
    <h1>ข้อมูลลูกค้า</h1><br>
    
    <table class="bills-table">
      <thead>
        <tr>
          <th>รหัสผู้ใช้</th>
          <th>ชื่อ</th>
          <th>นามสกุล</th>
          <th>อีเมล</th>
          <th>วันที่สมัคร</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?php echo $user["user_ID"]; ?></td>
            <td><?php echo $user["fname"]; ?></td>
            <td><?php echo $user["lname"]; ?></td>
            <td><?php echo $user["email"]; ?></td>
            <td><?php echo $user["createDate"]; ?></td>
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