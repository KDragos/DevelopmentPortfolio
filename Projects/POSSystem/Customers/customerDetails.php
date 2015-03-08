<?php
// Initialize Code
require('../initialize.php');

$fullName ='';
$row = [
	'email' => '',
	'gender' => '',
	'customer_since' => ''
];
$invoices ='';
$cust_id ='';


if (isset($_GET['cust_id'])) {
	$cust_id = $_GET['cust_id'];

	$sql = " 
		SELECT first_name, last_name, email, gender, customer_since,
			invoice_id,
			customer_id,
			sum(quantity * price) AS total,
			created_at
		FROM invoice
		JOIN customer USING (customer_id)
		JOIN invoice_item USING (invoice_id)
		JOIN item USING (item_id)
		WHERE customer_id = '$cust_id'
		";

	$prepare_values = [
		':cust_id' => $cust_id
	];

	try { 

		// Make a PDO statement
		$statement = DB::prepare($sql);

		// Execute , $prepare_values
		DB::execute($statement, $prepare_values);

		// Get all the results of the statement into an array
		$results = $statement->fetchAll();

		// Get the first result as a row
		$row = $results[0];
		$fullName = $row['first_name'] . ' ' . $row['last_name'];

		$invoices = "";

		foreach ($results as $i => $result) {
			$invoices .= "<tr><td><a href=\"../invoices/invoiceDetail.php?invId={$results[$i]["invoice_id"]}\">
				{$results[$i]["invoice_id"]}</a></td><td>{$results[$i]["created_at"]}</td></tr>";
		}
	} catch (PDOException $e) {
		die($e->getMessage());
	}

} else {
	// $msg = "Oops. Looks like something happened. Let's try again.";
	header('Location: allCustomers.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profile Page</title>
</head>
<body>
	<?php if (isset($_GET['cust_id'])) { ?>
	<h1>This is the profile for <?php echo $fullName; ?>. </h1>
	<div>
		<h4>Contact Information</h4>
		<table>
			<tr>
				<td>Name:</td>
				<td><?php echo $fullName; ?></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><?php echo $row['email']; ?></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><?php echo $row['gender']; ?></td>
			</tr>
			<tr>
				<td>Customer Since:</td>
				<td><?php echo $row['customer_since']; ?></td>
			</tr>
		</table>
	</div>
	<div>
		<h4><a href="../invoices/addInvoice.php?cust_id=<?php echo $cust_id ?>">Create new invoice for this customer.</a></h4> 
	</div>
	<div>
		<h4>Previous Invoices</h4>
		<table border="1">
			<tr><td>Invoice</td><td>Created At</td></tr>
			<?php echo $invoices; ?>
		</table>
	</div>
	<a href="../main.php">Home</a>
	<?php } else { echo $msg; }?>

</body>
</html>