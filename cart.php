<?php
require_once "config.php";
include "header.php";
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$conn or die("Connection to database failed:".$conn->connect_error); /*this line is equivalent to 
                                                                      if ($conn->connect_error)
                                                                        die("Connection to database failed:".$conn->connect_error);*/
$conn->query("set names utf8");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  // If method is POST, we update the cart. Else GET, just display the cart.
  $product_id = intval($_POST["id"]); //intval to make the value an integer
  if (array_key_exists($product_id, $_SESSION["cart"])) {
      $_SESSION["cart"][$product_id] += intval($_POST["count"]); //$_SESSION["cart"][$product_id] is a dictionnary.  [$product_id] is the key and the value is the count.
  } else {
      $_SESSION["cart"][$product_id] = intval($_POST["count"]);
  }
  if ($_SESSION["cart"][$product_id]<=0) {
    unset($_SESSION["cart"][$product_id]);
  }
}
?>

<h1>Etienne's webshop</h1>
<p>Welcome to the webshop where you will find everything you need</p>
<p>You have a cookie set up for you since: <?=$_SESSION["timestamp"];?></p>
<a href="index.php">Go back to main page</a>
<h2>Products in your shopping cart</h2>
  <form method="post" action="placeorder.php">
      <input type="submit" value="Place order"/>
  </form>

<?php// var_dump($_SESSION["cart"]); ?>

<?php 
$result = $conn->query("SELECT id, Name, Price FROM etienne_products;");
$result or die("Connection to database failed:".$conn->connect_error); //if result is true, the second expression is not checked.

while ($row = $result->fetch_assoc()) {
  $product_id= $row['id'];
  if (array_key_exists($row['id'], $_SESSION["cart"])) {
    $count = $_SESSION["cart"][$product_id];?>
  <div id="shopping_cart">  
  <li>
    <?=$count;?> item(s) of <a href="description.php?id=<?=$product_id?>">
      <?=$row['Name']?></a>
      <?=$row['Price']?>Eur. <?= $row['Price']*$count?> in total
    <form  method="post">
      <input type="hidden" name="id" value="<?=$product_id;?>"/>
      <input type="hidden" name="count" value="-1"/>
      <input type="submit" value="Remove"/>
    </form>
  </li>
  </div>
  <?php
  }
} 

$conn->close();

include "footer.php";
?>
