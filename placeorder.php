<?php

//This page should move cart content to database as a new order.

require_once "config.php";
include "header.php"; ?>

<?php
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:".$conn->connect_error);
$conn->query("set names utf8");

$statement = $conn->prepare(
"INSERT INTO `etienne_orders` (`user_id`) VALUES (?)"); //the "?" will be replaced by the following values
if (!$statement) die("Prepare failed: (" . $conn->errno . ") " . $conn->error); //check if an error happens
$statement->bind_param("i", $_SESSION["user"]);
if ($statement->execute()) {
  echo "Order was placed successfully. Thank you! <br> <a href=\"index.php\">Go back to main page</a>";
} else {
    die("Execute failed: (" . $statement->errno . ") " . $statement->error); //check if an error happens
  }
$order_id = $conn->insert_id; //This contains the ID for the inserted order (the last row of the table which we need to know)

$statement = $conn->prepare(
"INSERT INTO `etienne_order_products` (`order_id`, `product_id`, `count`) VALUES (?, ?, ?)"); //the "?" will be replaced by the following values
if (!$statement) die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
foreach ($_SESSION["cart"] as $product_id => $count) {
  $statement->bind_param("iii", $order_id, $product_id, $count);
  if (!$statement->execute()) {
    die("Execute failed: (" . $statement->errno . ") " . $statement->error);
  }
}

$_SESSION["cart"] = array(); //we reset shopping cart
//header('Location:orders.php'); //redirects to orders.php

?>
