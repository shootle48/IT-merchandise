<?php
$link = mysqli_connect('localhost', 'root', '', 'it-merchandise');
$user_ID = $_POST["user_ID"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];

$sql = "UPDATE user_info SET fname = '$fname', lname = '$lname', email = '$email' WHERE user_ID = '$user_ID'";

$result = mysqli_query($link, $sql);
if ($result) {
    echo "<script>alert('แก้ไขข้อมูลสำเร็จ');</script>";
    echo "<script>window.location='admin_user.php';</script>";
} else {
    echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้');</script>";
}
?>