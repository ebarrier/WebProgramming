<?php

//This page shows the orders of the user

require_once "config.php";
include "header.php"; ?>

<?php
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:".$conn->connect_error);
$conn->query("set names utf8");
 
$statement = $conn->prepare("SELECT * FROM etienne_orders WHERE user_id = ?");
if (!$statement) die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
$statement->bind_param("i", $_SESSION["user"]);
if (!$statement->execute()) {
    die("Execute failed: (" . $statement->errno . ") " . $statement->error);}

$result = $statement->get_result();
?>


<h1>Orders you have placed</h1>
<ul>
<?php
  while ($row = $result->fetch_assoc()) { ?>
    <li>
    <a href="orderdetail.php?id=<?= $row["id"]; ?>">Order #<? $row["id"]; ?>
    <?= $row["created"]; ?>
    <?= $row["shipped"]; ?>
    <?= $row["paid"]; ?>
    <?= $row["shipping_address"]; ?></a>
    </li><?php
  } ?>
    
</ul>

<a href="index.php">Go back to main page</a>

<?php
include 'footer.php';
?>
