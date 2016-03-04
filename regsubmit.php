<?php
require_once "config.php";
include "header.php";
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:".$conn->connect_error);
$conn->query("set names utf8");

$statement = $conn->prepare(
"INSERT INTO `etienne_users` (
    `email`,
    `password`,
    `firstname`,
    `lastname`,
    `phone`,
    `dob`,
    `salutation`,
    `vatin`,
    `company`,
    `country`,
    `address`)
VALUES (?, PASSWORD(?), ?, ?, ?, ?, ?, ?, ?, ?, ?)"); //the "?" will be replaced by the following values

if (!$statement) die("Prepare failed: (" . $conn->errno . ") " . $conn->error); //check if an error happens

$statement->bind_param("sssssssssss", //"s" stands for "String"
    //POST values coming from the body of the request of the page registration.php
    $_POST["email"],
    $_POST["password"],
    $_POST["firstname"],
    $_POST["lastname"],
    $_POST["phone"],
    $_POST["dob"],
    $_POST["salutation"],
    $_POST["vatin"],
    $_POST["company"],
    $_POST["country"],
    $_POST["address"]);
if ($statement->execute()) {
  echo "Registration successful. Thank you! <br> <a href=\"index.php\">Go back to main page</a>";
} else {
    if (!$statement->errno == 1062) {
      //This is result in 200 OK
      echo "This e-mail is already registered";
    } else {
      //This will result in 500 internal server error
        die("Execute failed: (" . $statement->errno . ") " . $statement->error); //check if an error happens
      }
  }
?>




<?php
include "footer.php";
?>
