<?php 
require('../initialize.php');


if (!isset($_POST['name']) || (!isset($_POST['price']))) {
	// header('Location: allItems.php');
	echo "We're not adding yet.";
}

	try { 
		$sql = "
			INSERT INTO item (
				name, price
			) VALUES (
				:name, :price
			)
			";

		$sql_values = [
			':name' => $_POST['name'],
			':price' => $_POST['price']
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



?>