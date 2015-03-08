<?php 
require('../initialize.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>New Item</title>
</head>
<body>
	<h2>New Item</h2>
	<form action="processAddItem.php" method="POST">
		<div>Name: <input type="text" name="name"></div>
		<div>Price: <input type="text" name="price"></div>
		<button>Create</button>
	</form>
	<a href="allItems.php">Go Back</a>
</body>
</html>