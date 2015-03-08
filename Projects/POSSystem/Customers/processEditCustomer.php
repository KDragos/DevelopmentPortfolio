<?php 

require_once('../initialize.php');

$msg = '';
if (isset($_POST['cust_id'])) {
	$cust_id = $_POST['cust_id'];		
} else {
	$msg = "Oops. Looks like something happened. Let's try again.";
	header('Location: allCustomers.php');
}

try {
		
	$update = DB::prepare('
		UPDATE customer
		SET first_name= :first_name,
		last_name= :last_name,
		email= :email,
		gender= :gender
		WHERE customer_id= :customer_id
		');

	$update_values = [
		":first_name" => $_POST['firstName'],
		":last_name" => $_POST['lastName'],
		":email" => $_POST['email'],
		":gender" => $_POST['gender'],
		":customer_id" => $_POST['cust_id']
	];

	DB::execute($update, $update_values);

	header('Location: customerDetails.php?cust_id=' . $cust_id);
	exit();	

}  catch (PDOException $e) {
	die($e->getMessage());
}
