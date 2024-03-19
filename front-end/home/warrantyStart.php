<?php
require ("../../back-end/database/db.php");
$userID = $_GET['userID'];
$fname = $_GET['fname'];


if (isset($_GET['productID'])) {
    $productID = $_GET['productID'];
    $stmt = mysqli_prepare($connection, "SELECT * FROM product WHERE product_ID = ?");
    mysqli_stmt_bind_param($stmt, "s", $productID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $productShow = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <div style='position:sticky; top:0;'>
        <?php
        require("components/nav.php");
        ?>
    </div>
<div class="Container">
    <div class="container">
        <form id="form"action="warrantyEnd.php?userID=<?php echo $userID ?>&fname=<?php echo $fname ?>&productID=<?php echo $productShow['product_ID']?>" method="post">
            <div>
                <input type="hidden" name="type" value="<?php echo $productShow['type']?>" >                        
                <input type="hidden" name="name_product" value="<?php echo $productShow['name_product']?>">                
                <input type="hidden" name="warranty_date" value="<?php echo $productShow['warranty_date']?>">   
                <input type="hidden" name="warranty_out">                    
                <input type="hidden" name="serial">
                <input type="hidden" name="sale_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            </div>
        </form>
        <script>
            window.onload = function() {
                document.getElementById('form').submit();
            };
        </script>
    </div>  
</div>  
</body>
</html>
