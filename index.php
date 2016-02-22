<?php
require_once "config.php";
include "header.php";
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:".$conn->connect_error);
$conn->query("set names utf8");
?>

<h1>Etienne's webshop</h1>
<p>Welcome to the webshop where you will find everything you need</p><br>

<ul>
<?php echo "The product we have are:";
$result = $conn->query("SELECT id, Name, Price FROM etienne;");

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
