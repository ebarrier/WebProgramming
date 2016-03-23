<?php
require_once "config.php";
include "header.php";
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:".$conn->connect_error);
$conn->query("set names utf8");

$statement = $conn->prepare(
"SELECT
  `etienne_order_products`.`id` AS `order_product_id`,
  `etienne_order_products`.`product_id` AS `product_id`,
  `etienne_products`.`Name` AS `product_name`,
  `etienne_order_products`.`unit_price` AS `order_product_unit_price`,
  `etienne_order_products`.`count` AS `order_product_count`,
  `etienne_order_products`.`unit_price` * `etienne_order_products`.`count` AS `subtotal`
FROM
  `etienne_order_products`
JOIN
  `etienne_products`
ON
  `etienne_order_products`.`product_id` = `etienne_products`.`id`
WHERE
  `etienne_order_products`.`order_id` = ?");
if (!$statement) // Error check
  die("Prepare failed: (" . $conn->errno . ") " . $conn->error);


$statement->bind_param("i", $_GET["id"]);
$statement->execute();
$results = $statement->get_result();
?>
<h1>Order details</h1>
<ul>
<?php
  while ($row = $results->fetch_assoc()) { ?>
    <li>
      <?= $row["product_name"]; ?>
      <?= $row["order_product_count"]; ?>x
      <?= $row["order_product_unit_price"]; ?>EUR
    </li><?php
  }
?>

<a href="index.php">Go back to main page</a>
<?php include "footer.php"; ?>
