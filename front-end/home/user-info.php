<?php
$fname = isset ($_GET['fname']) ? $_GET['fname'] : "";
require ("../../back-end/database/db.php");
$fname_user = "SELECT * FROM user_info where fname = '$fname'";
$result = mysqli_query($connection, $fname_user);
$fnameShow = mysqli_fetch_assoc($result);

$is_logged_in = isset ($fnameShow['fname']); // Check if user is logged in


?>