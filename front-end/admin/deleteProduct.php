<?php
$link = mysqli_connect('localhost', 'root', '', 'it-merchandise') or die ('Connect Failed' . mysqli_connect_error());
$product_ID = $_REQUEST["product_ID"];

$sql = "delete from product where product_ID='$product_ID'";

$result = mysqli_query($link, $sql);
if ($result) {
    echo "<script>alert('ลบข้อมูลสำเร็จ');</script>";
    echo "<script>window.location='admin_product.php';</script>";
} else {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
}
?>