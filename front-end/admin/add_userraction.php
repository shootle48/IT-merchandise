<?php
$link = mysqli_connect('localhost', 'root', '', 'it-merchandise');
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$hashPassword = hash('sha256', $password);
$createDate = $_POST["createDate"];

$sql = "INSERT INTO user_info (fname, lname, email, password, createDate) VALUES ('$fname', '$lname', '$email', '$hashPassword', '$createDate')";

$result = mysqli_query($link, $sql);

if ($result) {
    echo "<script>alert('เพิ่มข้อมูลสำเร็จ');</script>";
    echo "<script>window.location='admin_user.php';</script>";
} else {
    echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ');</script>";
}
?>