<?php

require("database/db.php");

$search = "%คีย์บอร์ด%";

$stmt = mysqli_prepare($connection, "SELECT * FROM product WHERE type LIKE ?");
mysqli_stmt_bind_param($stmt, "s", $search);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$keyboards = array();
while ($row = mysqli_fetch_assoc($result)) {
  $keyboards[] = $row;
}

mysqli_stmt_close($stmt);


?>
