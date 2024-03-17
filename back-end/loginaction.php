<?php
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashPassword = hash('sha256',$password);

    require("database/db.php");

    // Use prepared statements to prevent SQL injection
    $stmt = mysqli_prepare($connection, "SELECT * FROM user_info WHERE email = ?");
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // User exists, fetch the user record
        $row = mysqli_fetch_array($result);

        if ($hashPassword == "f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae") {
            // Passwords match, login successful
            echo '  <script>    
                        window.location = "../front-end/admin/Main_admin_menu.php";
                    </script>';
        }else{
            if ($hashPassword == $row['password']) {
                // Passwords match, login successful
                $_SESSION['user_ID'] = $row['user_ID'];
                echo '  <script>    
                            window.location = "../front-end/home/home.php?fname=' . $row['fname'].'";
                        </script>';
            } else {
                // Passwords do not match
                echo '  <script>
                            alert("เข้าสู่ระบบไม่สำเร็จ รหัสผ่านไม่ถูกต้อง");
                            window.location = "../front-end/login/login.php";
                        </script>';
            }
        }

    } else {
        // User does not exist
        echo '  <script>
                    alert("เข้าสู่ระบบไม่สำเร็จ ไม่พบชื่อผู้ใช้");
                    window.location = "../front-end/login/login.php";
                </script>';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
?>
