<?php
$link = mysqli_connect('localhost', 'root', '', 'it-merchandise') or die ('Connect Failed' . mysqli_connect_error());
$bill_ID = $_REQUEST["bill_ID"];

$sql = "delete from bills where bill_ID='$bill_ID'";

$result = mysqli_query($link, $sql);
if ($result) {
    echo "<script>alert('ลบข้อมูลสำเร็จ');</script>";
    echo "<script>window.location='admin_bill.php';</script>";
} else {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
}
?>