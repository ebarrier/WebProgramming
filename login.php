<?php // We check on this page if user provided proper credentials

session_start();

include "header.php";
include "config.php";

var_dump($_POST);

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:".$conn->connect_error);
$conn->query("set names utf8");

$statement = $conn->prepare("SELECT id FROM etienne_users WHERE email = ? AND password = PASSWORD(?)"); // not to use this in production!
$statement->bind_param("ss", $_POST["user"], $_POST["password"]); //GET to extract it from the page's URL (?id=12)
$statement->execute();
$result = $statement->get_result();
$row = $result->fetch_assoc(); //fetch_assoc stores info as key-value pair

if($row) { //if the key-value pair user_id-password exists
  $_SESSION["user"] = $row["id"]; // This just stores user row number
  header('Location: index.php'); //This will redirect back to index.php
} else {
  echo "You are not known"?> <a href="registration.php">please sign up!</a>

<?php 
} 
?>
