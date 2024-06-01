<?php
require_once ("../src/config/database.php");
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="css/estilo.css">
  <title>PRACTICAL KITCHEN</title>
</head>
<main>
  <nav>
    <?php include ("pages/navbar.php"); ?>
  </nav>

  <body>
    <?php include ("pages/body.php"); ?>
    <?php include ("pages/posts.php"); ?>
  </body>
  <footer>
    <?php include ("pages/footer.php"); ?>
  </footer>
</main>

</html>