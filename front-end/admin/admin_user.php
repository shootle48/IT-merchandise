<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

    <div class="wrapper">
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="adminpage.php">Admin Page</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="admin_detail.php" class="sidebar-link">
                            Admin view
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="admin_user.php" class="sidebar-link">
                            User
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="admin_product.php" class="sidebar-link">
                            Product
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="admin_bill.php" class="sidebar-link">
                            Bill
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="adminpage.php" class="sidebar-link">
                            <p class="btn btn-warning">Back</p>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <div class="container">
                <div class="h4 text-center alert alert-secondary mb-3 mt-3" role="alert"> ข้อมูลสมาชิก </div>
                <a href="add_user.php" class="btn btn-success mb-3 mt-2">Add User</a>
                <table class="table">
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Create Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>

                    <?php
                    $link = mysqli_connect('localhost', 'root', '', 'it-merchandise') or die ('Connect Failed' . mysqli_connect_error());

                    $sql = "SELECT * FROM user_info";
                    $result = mysqli_query($link, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td>
                                <?= $row['user_ID'] ?>
                            </td>
                            <td>
                                <?= $row['fname'] ?>
                            </td>
                            <td>
                                <?= $row['lname'] ?>
                            </td>
                            <td>
                                <?= $row['email'] ?>
                            </td>
                            <td>
                                <?= $row['createDate'] ?>
                            </td>
                            <td><a href="edituser.php?fname=<?= $row["user_ID"] ?>" class="btn btn-warning">Edit</a></td>
                            <td><a href="deleteuser.php?user_ID=<?= $row["user_ID"] ?>" class="btn btn-danger"
                                    onclick="Del(this.href);return false;">Delete</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
<script language="javaScript">
    function Del(mypage) {
        var agree = confirm("ต้องการลบข้อมูลหรือไม่");
        if (agree) {
            window.location = mypage;
        }
    }
</script>