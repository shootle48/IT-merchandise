<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../home/style/register.css">
</head>

<body>

    <form action="../../back-end/registeraction.php" method="post">
        <div class="container">
            <div class="login-container">
                <div class="loginForm">
                    <div class="header">
                        <h1>สมัครสมาชิก</h1>
                        <div class='register'>
                            เป็นสมาชิกอยู่แล้ว, <a href="../login/login.php"">เข้าสู่ระบบ</a>
                            </div>
                    </div>
                    <div class=" fill">
                                <div class="inputData">
                                    <input type="text" name="fname" placeholder="ชื่อ" required>
                                    <input type="text" name="lname" placeholder="นามสกุล" required>
                                    <input type="text" name="email" placeholder="อีเมล" required>
                                    <input type="password" name="password" placeholder="รหัสผ่าน" required>
                                </div>
                                <input type="submit" value="สมัครสมาชิก" class="btn">
                        </div>
                    </div>
                </div>
                <?php
                require ("../home/components/footer.php")
                    ?>
            </div>
        </div>
    </form>

</body>

</html>