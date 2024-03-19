<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php
    $link = mysqli_connect('localhost', 'root', '', 'it-merchandise') or die ('Connect Failed' . mysqli_connect_error());
    if (isset ($_GET['fname'])) {
        $user_ID = $_GET['fname'];
        $sql = "SELECT * FROM user_info WHERE user_ID='$user_ID'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_array($result);
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto my-auto">
                <div class="h4 text-center alert alert-success mb-3 mt-3" role="alert"> แก้ไขข้อมูลผู้ใช้ </div>
                <form action="edituserraction.php" method="post">
                    <label>User Id</label>
                    <input type="hidden" name="user_ID" value="<?= $row['user_ID'] ?>">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" value="<?= $row['fname'] ?>"
                        required>
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" value="<?= $row['lname'] ?>"
                        required>
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $row['email'] ?>"
                        required>
                    <button type="submit" class="btn btn-success mt-3"> Edit </button>
                    <a href="admin_user.php" class="btn btn-danger mt-3"> Cancel </a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>