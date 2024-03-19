<?php
$link = mysqli_connect('localhost', 'root', '', 'it-merchandise') or die ('Connect Failed' . mysqli_connect_error());
$user_ID = $_REQUEST["user_ID"];

$sql = "delete from user_info where user_ID='$user_ID'";

$result = mysqli_query($link, $sql);
if ($result) {
    echo "<script>alert('ลบข้อมูลสำเร็จ');</script>";
    echo "<script>window.location='admin_user.php';</script>";
} else {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
}
?>