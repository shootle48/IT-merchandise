<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <!-- sidebar -->
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
                        <a href="../home/home.php" class="sidebar-link">
                            <p class="btn btn-warning">Logout</p>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <!-- mainpage -->
        <div class="main">
            <div class="container text-center">
                <h1 class="display-4">WELCOME TO ADMIN</h1>
                <img src="image/5883.jpg" alt="logo" class="img-fluid" width="800" height="800">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                    crossorigin="anonymous"></script>
            </div>
        </div>
</body>

</html>