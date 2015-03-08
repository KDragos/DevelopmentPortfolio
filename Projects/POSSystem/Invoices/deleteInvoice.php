<?php 
// Initialize Code
require('../initialize.php');

if (isset($_GET['inv_id'])) {
	try { 
		$sql = "
			DELETE FROM invoice
			WHERE invoice_id= :inv_id";

		$sql_values = [
			':inv_id' => $_GET['inv_id']
		];

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute
		DB::execute($statement, $sql_values);
		// Redirect
		header('Location: allInvoices.php');
		exit();

	} catch (PDOException $e) {
		die($e->getMessage());
	}
} else {
	header('refresh:5; url=allInvoices.php');
}