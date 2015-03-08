<?php 
require('../initialize.php');

if (!isset($_POST['item_id'])) {
	header('Location: allItems.php');
} else {
	$item_id = $_POST['item_id'];
	try {	
		$update = DB::prepare('
			UPDATE item
			SET name= :name,
			price= :price
			WHERE item_id= :item_id
			');

		$update_values = [
			":name" => $_POST["name"],
			":price" => $_POST["price"],
			":item_id" => $_POST["item_id"]
		];

		DB::execute($update, $update_values);

		header('Location: allItems.php');
		exit();

	} catch (PDOException $e) {
		die($e->getMessage());
	}
}