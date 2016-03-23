<?php
require_once "config.php";
include "header.php";
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:".$conn->connect_error);
$conn->query("set names utf8");

if (!array_key_exists("timestamp", $_SESSION)) {
  $_SESSION["timestamp"] = date('l jS \of F Y h:i:s A');
}
//var_dump($_SESSION); //This is just to show the content of $_SESSION variable
?>


<h1>Etienne's webshop</h1>
<p>Welcome to the webshop where you will find everything you need</p>
<p>You have a cookie set up for you since: <?=$_SESSION["timestamp"];?></p>

<p>Please login<p>

<?php
if (array_key_exists("user", $_SESSION)) {
    //If the $_SESSION["user"] is set we say hello with his name
    $results = $conn->query("SELECT * FROM etienne_users
    WHERE id = " . $_SESSION["user"]);
    $row = $results->fetch_assoc();
    echo "Hello " . $row["firstname"] . " " . $row["lastname"];?>
    <br>
    <a href="logout.php">Log out<a>
<?php
} else { //else we display the login page ?>
  <form action="login.php" method="post">
    <input type="text" name="user"/>
    <input type="password" name="password"/>
    <input type="submit" value="Log in!"/>
  </form> 
  <a href="registration.php">Sign up!</a>
<?php } ?>

<h2>Products in your shopping cart</h2>
<a href="cart.php">See your cart</a>

<?php var_dump($_SESSION["cart"]); ?>

<h2>The product we have are:</h2>
<ul>
<?php 
$result = $conn->query("SELECT id, Name, Price FROM etienne_products;");

while ($row = $result->fetch_assoc()) {
    echo "<li><a href=\"description.php?id=" . $row["id"] . "\">" .  $row["Name"] . "</a> " . $row["Price"] . "eur</li>";
}

$conn->close();

?>

<p>
<img 
    onClick="alert('Set me free!');"
    src="images.jpeg" alt="Photo of me"> 
</p>

<p>
 <a href="http://www.itcollege.ee">itcollege.ee</a>
</p>

<?php
include "footer.php";
?>
