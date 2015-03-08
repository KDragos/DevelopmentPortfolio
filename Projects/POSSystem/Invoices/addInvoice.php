<?php

// Initialize Code
require('../initialize.php');

if (!isset($_GET['cust_id'])) {
	header('Location: ../customers/allCustomers.php');
}

$sql = "
	INSERT INTO invoice (
		customer_id, created_at
	) VALUES (
		:customer_id, NOW()
	)
	";

$sql_values = [
	':customer_id' => $_GET['cust_id']
];

try {
	// Make a PDO statement
	$statement = DB::prepare($sql);

	// Execute
	DB::execute($statement, $sql_values);
	// Redirect

} catch (PDOException $e) {
	die($e->getMessage());
}

header('Location: ./invoiceDetail.php?invId=' . DB::lastInsertId());
exit();
