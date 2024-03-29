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

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto my-auto">
                <div class="container">
                    <div class="h4 text-center alert alert-success mb-3 mt-3" role="alert">แก้ไขข้อมูลสินค้า</div>
                    <form action="editproduct.php?product_ID=<?php echo $product_id; ?>" method="post"
                        enctype="multipart/form-data">
                        <img src="<?php echo $product['image_path']; ?>" alt="รูปสินค้า" width="200"><br><br>
                        <label for="image_path">Image</label><br>
                        <input type="file" name="image_path" id="image_path"><br><br>
                        <label for="name_product">Product Name</label><br>
                        <input type="text" name="name_product" id="name_product"
                            value="<?php echo $product['name_product']; ?>"><br><br>
                        <label for="product_detail">Product Detail</label><br>
                        <textarea name="product_detail"
                            id="product_detail"><?php echo $product['product_detail']; ?></textarea><br><br>
                        <label for="product_price">Price</label><br>
                        <input type="number" name="product_price" id="product_price"
                            value="<?php echo $product['product_price']; ?>"><br><br>
                        <label for="product_brand">Brand</label><br>
                        <input type="text" name="product_brand" id="product_brand"
                            value="<?php echo $product['product_brand']; ?>"><br><br>
                        <label for="type">Type</label><br>
                        <select name="type" id="type">
                            <option value="<?php echo $current_type; ?>" selected>
                                <?php echo $current_type; ?>
                            </option>
                            <option value="โน๊ตบุ๊ค">โน๊ตบุ๊ค</option>
                            <option value="โทรศัพท์">โทรศัพท์</option>
                            <option value="คีย์บอร์ด">คีย์บอร์ด</option>
                            <option value="หูฟัง">หูฟัง</option>
                            <option value="เมาส์">เมาส์</option>
                        </select><br><br>
                        <button type="submit" name="submit" class="btn btn-success">Save</button>
                        <a href='admin_product.php' class='btn btn-danger btn-back'>Back</a>
                    </form>
                </div>

</body>

</html>

<?php
$conn->close();
?>