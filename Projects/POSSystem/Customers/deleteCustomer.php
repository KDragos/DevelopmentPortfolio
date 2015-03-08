<?php 
// Initialize Code
require('../initialize.php');

if (isset($_GET['cust_id'])) {
try { 
	$sql = "
		DELETE FROM customer
		WHERE customer_id= :cust_id";

	$sql_values = [
		':cust_id' => $_GET['cust_id']
	];

	// Make a PDO statement
	$statement = DB::prepare($sql);

	// Execute
	DB::execute($statement, $sql_values);
	// Redirect
	header('Location: allCustomers.php');
	exit();

} catch (PDOException $e) {
	die($e->getMessage());
}
} else {

	header('Location: allCustomers.php');
}