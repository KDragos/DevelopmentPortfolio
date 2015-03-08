<?php 

require_once('../initialize.php');

if (!isset($_GET['item_id'])) {
	header('Location: allItems.php');
} else {
	$item_id = $_GET['item_id'];
}

try {
	$statement = DB::prepare('SELECT * FROM item WHERE item_id = ' . $item_id);
	$results = DB::execute($statement);
	
	// binding method
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$itemName = $result[0]['name'];
	// $fullName = $results[0]['first_name'] . ' ' . $results[0]['last_name'];

} catch (PDOException $e) {
	die($e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Item</title>
</head>
<body>
	
	<h2>Update <?php echo $itemName; ?>? </h2>
<form action="processEditItem.php" method="POST">
	<input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
	<div>Item Name: <input type="text" name="name" value="<?php echo $result[0]['name']; ?>"></div>
	<div>Price: <input type="text" name="price" value="<?php echo $result[0]['price'] ?>" ></div>
	<button>Update</button>
</form>
	<a href="allItems.php">Back</a>

</body>
</html>