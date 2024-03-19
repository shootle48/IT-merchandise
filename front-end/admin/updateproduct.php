<?php
$conn = mysqli_connect('localhost', 'root', '', 'it-merchandise') or die ('Connect Failed' . mysqli_connect_error());

$product_id = $_GET["product_ID"];
$sql = "SELECT * FROM product WHERE product_ID = '$product_id'";
$result = $conn->query($sql);

$product = $result->fetch_assoc();

$sql_type = "SELECT type FROM product";
$result_type = $conn->query($sql_type);

$current_type = $product['type'];

$sql_type = "SELECT type FROM product";
$result_type = $conn->query($sql_type);
if (isset ($_POST["submit"])) {
  $name_product = $_POST["name_product"];
  $product_detail = $_POST["product_detail"];
  $product_price = $_POST["product_price"];
  $product_brand = $_POST["product_brand"];
  $type = $_POST["type"];

  // Upload image
  if ($_FILES["image_path"]["name"] != "") {
    $image_path = "image/" . $_FILES["image_path"]["name"];
    $target_dir = "image/";
    $target_file = $target_dir . basename($image_path);

    // ตรวจสอบประเภทไฟล์
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowTypes = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $allowTypes)) {
      if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file)) {
        $sql = "UPDATE product SET name_product = '$name_product', product_detail = '$product_detail', product_price = '$product_price', image_path = '$image_path', product_brand = '$product_brand', type = '$type' WHERE product_ID = '$product_id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo "<script>window.location.href='admin_product.php';</script>";
      } else {
        echo "อัพโหลดรูปภาพไม่สำเร็จ";
      }
    } else {
      echo "ไฟล์รูปภาพไม่ถูกต้อง";
    }
  } else {
    $sql = "UPDATE product SET name_product = '$name_product', product_detail = '$product_detail', product_price = '$product_price', product_brand = '$product_brand', type = '$type' WHERE product_ID = '$product_id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo "<script>window.location.href='admin_product.php';</script>";
  }
}
?>