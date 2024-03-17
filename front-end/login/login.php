<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../home/style/login.css">
</head>

<body>

    <form action="../../back-end/loginaction.php" method='post'>
        <div class="container">
            <div class="login-container">
                <div class="loginForm">
                    <div class="header">
                        <h1>เข้าสู่ระบบ</h1>
                    </div>
                    <div class="fill">
                        <div class="inputData">
                            <input type="text" name="email" placeholder='อีเมล'>
                            <input type="password" name="password" placeholder='รหัสผ่าน'>
                        </div>
                        <input type="submit" value="เข้าสู่ระบบ" class="btn">
                        <div class='register'>
                            ยังไม่มีบัญชีผู้ใช้ ? <a href="../register/register.php"">สมัครสมาชิกใหม่</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            require ("../home/components/footer.php")
                ?>
        </div>
    </form>


</body>
</html>