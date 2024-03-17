<?php

require("database/db.php");

$search = "%โทรศัพท์%";

$stmt = mysqli_prepare($connection, "SELECT * FROM product WHERE type LIKE ?");
mysqli_stmt_bind_param($stmt, "s", $search);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$mobiles = array();
while ($row = mysqli_fetch_assoc($result)) {
  $mobiles[] = $row;
}

mysqli_stmt_close($stmt);


?>
