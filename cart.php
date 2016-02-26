<?php
require_once "config.php";
include "header.php";
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$conn or die("Connection to database failed:".$conn->connect_error); /*this line is equivalent to 
if ($conn->connect_error)
  die("Connection to database failed:".$conn->connect_error);*/
$conn->query("set names utf8");

$product_id = intval($_POST["id"]); //intval to make the value an integer
if (array_key_exists($product_id, $_SESSION["cart"])) {
    $_SESSION["cart"][$product_id] += 1;
} else {
    $_SESSION["cart"][$product_id] = 1;
}

?>

<h1>Etienne's webshop</h1>
<p>Welcome to the webshop where you will find everything you need</p>
<p>You have a cookie set up for you since: <?=$_SESSION["timestamp"];?></p>

<h2>Products in your shopping cart</h2>

<?php var_dump($_SESSION["cart"]); ?>

<?php 
$result = $conn->query("SELECT id, Name, Price FROM etienne;");
$result or die("Connection to database failed:".$conn->connect_error); //if result is true, the second expression is not checked.

while ($row = $result->fetch_assoc()) {
  if (array_key_exists($row['id'], $_SESSION["cart"])) {
  $count = $_SESSION["cart"][$row['id']];?>   
  <li>
    <?=$count;?> item(s) of <a href="description.php?id=<?=$row['id']?>">
      <?=$row['Name']?></a>
      <?=$row['Price']?>Eur. <?= $row['Price']*$count?> in total
  </li>

  <?php
    
  }
}

$conn->close();

?>


<?php
include "footer.php";
?>
