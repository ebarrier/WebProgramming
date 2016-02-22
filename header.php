<?php
// Set session variables
session_start();

if (!array_key_exists("cart", $_SESSION)) {
    $_SESSION["cart"] = array();
    // Here we store product it -> count mapping
}

?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8"/>
<meta name="description" content="Etienne webshop to learn web programming">
<title>Etienne Webshop</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/main.js"></script>


</head>


<body>
