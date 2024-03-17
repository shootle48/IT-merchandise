<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$hashPassword = hash('sha256', $password);

require ("database/db.php");

$sqlCheck = "SELECT * FROM user_info WHERE email = '$email'";
$resultCheck = mysqli_query($connection, $sqlCheck);

if (mysqli_num_rows($resultCheck) > 0) {
    echo '  <script>
                alert("รหัสผู้ใช้นี้ถูกใช้งานแล้ว กรุณาลองใหม่อีกครั้ง");
                window.location = "../front-end/register/register.php";
            </script>';
} else {
    $sqlInsert = "INSERT INTO user_info (fname, lname, email, password,createDate) VALUES ('$fname', '$lname', '$email', '$hashPassword', NOW())";
    $resultInsert = mysqli_query($connection, $sqlInsert);

    if (!$resultInsert) {
        echo '  <script>
                    alert("สมัครไม่สำเร็จ กรุณาลองใหม่อีกครั้ง");
                    window.location = "../front-end/register/register.php";
                </script>';
    } else {
        echo '  <script>
                    alert("สมัครสำเร็จ");
                    window.location = "../front-end/login/login.php";
                </script>';
    }
}

$connection->close();
?>