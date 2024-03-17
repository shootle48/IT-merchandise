<?php

require("database/db.php");

$search = "%โน๊ตบุ๊ค%";

$stmt = mysqli_prepare($connection, "SELECT * FROM product WHERE type LIKE ?");
mysqli_stmt_bind_param($stmt, "s", $search);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$laptops = array();
while ($row = mysqli_fetch_assoc($result)) {
  $laptops[] = $row;
}

mysqli_stmt_close($stmt);


?>
