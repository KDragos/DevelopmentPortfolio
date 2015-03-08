<?php 

require_once('../initialize.php');

	$query = new ItemModel;
	$listItems = $query->getAll();
	$trows = "";
	// <td><a href="profile.php?id=' . $row['customer_id'] . '">View Details</a></td>
	foreach($listItems as $row) {
		$trows .= '<tr><td>' . $row['name'] . '</td><td>' . $row['price'] .
		 '</td><td><a href="./editItem.php?item_id=' . $row['item_id'] . '">Edit</a>
		 </td><td><a href="./deleteItem.php?item_id=' . $row['item_id'] . '">Remove</a></td></tr>';
	}
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inventory</title>
</head>
<body>
	<h2>Our Inventory</h2>
	<table border="1">
		<tr>
			<td>Item Name</td>
			<td>Price</td>
			<td>Edit</td>
			<td>Remove</td>
		</tr>
		<?php echo $trows; ?>
	</table>
	<a href="./addItem.php">Insert New Item</a>
	<a href="../main.php">Home</a>
</body>
</html>