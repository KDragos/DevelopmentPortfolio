<?php

// Initialize Code
require('../initialize.php');

$msg = '';
if(!isset($_POST['firstName']) || !isset($_POST['lastName']) || !isset($_POST['gender']) || !isset($_POST['email'])) {
	$msg .= "You are missing information to create a customer."
	header('Location: addCustomer.php');
} else {

	$sql = "
		INSERT INTO customer (
			first_name, last_name, email, gender, customer_since
		) VALUES (
			:first_name, :last_name, :email, :gender, CURDATE()
		)
		";

	$sql_values = [
		'first_name' => $_POST['firstName'],
		'last_name' => $_POST['lastName'],
		'email' => $_POST['email'],
		'gender' => $_POST['gender']
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

	header('Location: customerDetails.php?cust_id=' . DB::lastInsertId());
	exit();
}
echo $msg;