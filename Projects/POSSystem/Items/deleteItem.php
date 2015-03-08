<?php 
// Initialize Code
require('../initialize.php');

if (!isset($_GET['item_id'])) {
	header('Location: allItems.php');
} else {
	$item_id = $_GET['item_id'];
}

try { 
	$sql = "
		DELETE FROM item
		WHERE item_id=:id";

	$sql_values = [
		':id' => $_GET['item_id']
	];

	// Make a PDO statement
	$statement = DB::prepare($sql);

	// Execute
	DB::execute($statement, $sql_values);
	// Redirect
	header('Location: allItems.php');
	exit();

} catch (PDOException $e) {
	die($e->getMessage());
}
