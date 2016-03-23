<?php
require_once "config.php";
include "header.php";
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:".$conn->connect_error);
$conn->query("set names utf8");
?>

<h1>Description of the product</h1>

<a href="index.php">Go back to main page</a>

<?php 
$statement = $conn->prepare("SELECT Name, Description, Price FROM etienne_products WHERE id = ?");
if (!$statement) die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
$statement->bind_param("i", $_GET["id"]); //GET to extract it from the page's URL (?id=12)
if (!$statement->execute()) {
    die("Execute failed: (" . $statement->errno . ") " . $statement->error);}

$result = $statement->get_result();
$row = $result->fetch_assoc();
?>

<h1><?=$row["Name"];?></h1>
<h2><?=$row["Price"];?> eur</h2>

<p>
  <?=$row["Description"];?>
</p>

<form method="post" action="cart.php">
  <input type="hidden" name="id" value="<?=$_GET["id"];?>"/>
  <input type="hidden" name="count" value="1"/>
  <input type="submit" value="Add to cart"/>
</form>


<?php
include 'footer.php';
?>
