<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>XD Store</title>
  <style>
    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
    }
    body{
      background-color:#F3E4FF;
    }
    .Container{
      display:flex;
      justify-content:center;
      align-items:center;
      margin:1.5rem 0;
      margin-left:auto;
      margin-right:auto;
      border-radius:20px;
      width:1385px;
      background-color:#FFF;
    }
  </style>
</head>
<body>

  <div style='position:sticky; top:0;'>
    <?php
      require("components/nav.php");
    ?>
  </div>
  <div class="Container">
    <?php
    require("productCard.php")
    ?>
  </div>
  
  <?php
  require("components/footer.php")
  ?>

</body>
</html>
