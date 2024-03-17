<?php
session_start(); // Start session

$fname = isset($_GET['fname']) ? $_GET['fname'] : "";
require("../../back-end/database/db.php");
$fname_user = "SELECT * FROM user_info where fname = '$fname'";
$result = mysqli_query($connection,$fname_user);
$fnameShow = mysqli_fetch_assoc($result);

$is_logged_in = isset($fnameShow['fname']); // Check if user is logged in

?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>XD Store</title>
  <link rel="stylesheet" href="style/nav.css">
</head>
<body>
<header>
  <div class="catagory">
    <div class="image">
    <?php if ($is_logged_in) : ?>
        <a href="../home/home.php?fname=<?php echo $fnameShow['fname']?>"><img src="image/logo.jpg" alt="XD Store" class='logo'></a>
    <?php else: ?>
        <a href="../home/home.php"><img src="image/logo.jpg" alt="XD Store" class='logo'></a>
    <?php endif; ?>
    </div>
    <?php if ($is_logged_in) : ?>
        <div class="dropdown" >
            <div class="select">
                <span class='selected'>ทั้งหมด</span>
                <div class="caret"></div>
            </div>
            <ul class="menu">
                <a href="../home/home.php?fname=<?php echo $fnameShow['fname']?>"><li class='active'>ทั้งหมด</li></a>
                <a href="../home/laptop.php?fname=<?php echo $fnameShow['fname']?>"><li>โน๊คบุ๊ค</li></a>
                <a href="../home/mobile.php?fname=<?php echo $fnameShow['fname']?>"><li>โทรศัพท์</li></a>
                <a href="../home/mouse.php?fname=<?php echo $fnameShow['fname']?>"><li>เมาส์</li></a>
                <a href="../home/keyboard.php?fname=<?php echo $fnameShow['fname']?>"><li>คีย์บอร์ด</li></a>
                <a href="../home/headphone.php?fname=<?php echo $fnameShow['fname']?>"><li>หูฟัง</li></a>
            </ul>
        </div>

    <?php else: ?>
        <div class="dropdown" >
            <div class="select">
                <span class='selected'>ทั้งหมด</span>
                <div class="caret"></div>
            </div>
            <ul class="menu">
                <a href="../home/home.php"><li class='active'>ทั้งหมด</li></a>
                <a href="../home/laptop.php"><li>โน๊คบุ๊ค</li></a>
                <a href="../home/mobile.php"><li>โทรศัพท์</li></a>
                <a href="../home/mouse.php"><li>เมาส์</li></a>
                <a href="../home/keyboard.php"><li>คีย์บอร์ด</li></a>
                <a href="../home/headphone.php"><li>หูฟัง</li></a>
            </ul>
        </div>

    <?php endif; ?>
  </div>

  <div class="search">
    <?php if ($is_logged_in) : ?>
        <form action="../home/searchAction.php?fname=<?php echo $fnameShow['fname']?>" method="post">
            <input type="text" placeholder="ค้นหาสินค้าที่ต้องการ" name="search">
            <button type="submit" style='margin-left:1.2rem; cursor:pointer; background-color:transparent; border:1px solid transparent;'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </form>
    <?php else: ?>
        <form action="../home/searchAction.php" method="post">
        <input type="text" placeholder="ค้นหาสินค้าที่ต้องการ" name="search">
        <button type="submit" style='margin-left:1.2rem; cursor:pointer; background-color:transparent; border:1px solid transparent;'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
        </form>
    <?php endif; ?>
    </div>
  <div class="login">
      <?php if ($is_logged_in) : ?>
            <div class="cart">
                <a href="cart.php?fname=<?php echo $fnameShow['fname']?>&userID=<?php echo $fnameShow['user_ID']?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                </svg>
                </a>
            </div>

            <div class="dropdownUser">
                <div class="selectUser">
                    <div class="user">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg>
                        <span><?php echo $fnameShow['fname']?></span>
                        <div class="caret"></div>
                    </div>
                </div>
                <ul class="menuUser">
                    <li onclick='logout()'>ออกจากระบบ</li>
                </ul>
            </div>
      <?php else: ?>
            <a href="../login/login.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                </svg>
                <span>เข้าสู่ระบบ</span>
            </a>
      <?php endif; ?>
  </div>
</header>

<script>
    function logout() {
            let confirmLogout = confirm("คุณต้องการที่จะออกจากระบบใช่หรือไม่?");

            if (confirmLogout) {
                // Perform the logout action, redirect to home.php in this case
                window.location = "../home/home.php";
            }
    }
    document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(dropdown => {
            const select = dropdown.querySelector('.select');
            const caret = dropdown.querySelector('.caret');
            const menu = dropdown.querySelector('.menu');

            select.addEventListener('click', () => {
                caret.classList.toggle('caret-rotate');
                menu.classList.toggle('menu-open');
            });
        });
        const dropdownsUser = document.querySelectorAll('.dropdownUser');

        dropdownsUser.forEach(dropdownUser => {
            const selectUser = dropdownUser.querySelector('.selectUser');
            const caret = dropdownUser.querySelector('.caret');
            const menuUser = document.querySelector('.menuUser');

            selectUser.addEventListener('click', () => {
                caret.classList.toggle('caret-rotate');
                menuUser.classList.toggle('menu-open');
            });
        })
    });
</script>
</body>
</html>