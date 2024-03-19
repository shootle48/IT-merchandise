<?php
$conn = mysqli_connect('localhost', 'root', '', 'it-merchandise') or die ('Connect Failed' . mysqli_connect_error());

if (isset ($_GET["bill_ID"])) {
    $bill_id = $_GET["bill_ID"];
} else {
    header("Location: admin_bill.php");
    exit();
}

if (isset ($_POST["submit"])) {
    $emp_Name = $_POST["emp_Name"];
    $tel = $_POST["tel"];
    $address = $_POST["address"];
    $totalPrice = $_POST["totalPrice"];

    if ($_FILES["slip"]["name"] != "") {
        $slip = "slip/" . $_FILES["slip"]["name"];
        $target_dir = "slip/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($slip);

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowTypes = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["slip"]["tmp_name"], $target_file)) {
                $sql = "UPDATE bills SET emp_Name = '$emp_Name', tel = '$tel', address = '$address', totalPrice = '$totalPrice', slip = '$slip' WHERE bill_ID = '$bill_id'";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "<script>alert('แก้ไขข้อมูลบิลสำเร็จ');</script>";
                    echo "<script>window.location='admin_bill.php';</script>";
                } else {
                    echo "<script>alert('ไม่สามารถแก้ไขข้อมูลบิลได้');</script>";
                }
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดไฟล์');</script>";
            }
        } else {
            echo "<script>alert('ไฟล์รูปภาพไม่ถูกต้อง');</script>";
        }

    } else {
        $sql = "UPDATE bills SET emp_Name = '$emp_Name', tel = '$tel', address = '$address', totalPrice = '$totalPrice' WHERE bill_ID = '$bill_id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('แก้ไขข้อมูลบิลสำเร็จ');</script>";
            echo "<script>window.location='admin_bill.php';</script>";
        } else {
            echo "<script>alert('ไม่สามารถแก้ไขข้อมูลบิลได้');</script>";
        }
    }
}


$sql = "SELECT * FROM bills WHERE bill_ID = '$bill_id'";
$result = $conn->query($sql);
$bill = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto my-auto">
                <div class="container">
                    <div class="h4 text-center alert alert-success mb-3 mt-3" role="alert">แก้ไขข้อมูลบิล</div>
                    <form action="editbill.php?bill_ID=<?= $bill_id ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="bill_ID" value="<?= $bill['bill_ID'] ?>">
                        <label for="user_ID">User ID</label><br>
                        <input type="text" name="user_ID" id="user_ID" value="<?= $bill['user_ID'] ?>"
                            class="form-control" readonly><br>
                        <label for="emp_Name">Emp Name</label><br>
                        <input type="text" name="emp_Name" id="emp_Name" value="<?= $bill['emp_Name'] ?>"
                            class="form-control"><br>
                        <label for="tel">Tel</label><br>
                        <input type="text" name="tel" id="tel" value="<?= $bill['tel'] ?>" class="form-control"><br>
                        <label for="address">Address</label><br>
                        <input type="text" name="address" id="address" value="<?= $bill['address'] ?>"
                            class="form-control"><br>
                        <label for="totalPrice">Total Price</label><br>
                        <input type="number" name="totalPrice" id="totalPrice" value="<?= $bill['totalPrice'] ?>"
                            class="form-control"><br>
                        <label for="slip">Slip</label><br>
                        <input type="file" name="slip" id="slip" class="form-control"><br>
                        <?php if (!empty ($bill['slip'])): ?>
                            <img src="<?= $bill['slip'] ?>" alt="slip" width="200"><br><br>
                        <?php endif; ?>
                        <button type="submit" name="submit" class="btn btn-success">Save</button>
                        <a href="admin_bill.php" class="btn btn-danger btn-back">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
$conn->close();
?>