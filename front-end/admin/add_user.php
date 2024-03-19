<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto my-auto">
                <div class="h4 text-center alert alert-success mb-3 mt-3" role="alert"> เพิ่มข้อมูลผู้ใช้ </div>
                <form action="add_userraction.php" method="post">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                    <input type="hidden" name="createDate" value="<?php echo date('Y-m-d\TH:i:s'); ?>">
                    <input type="submit" value="Agree" class="btn btn-success mt-3">
                    <a href="admin_user.php" class="btn btn-danger mt-3">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>