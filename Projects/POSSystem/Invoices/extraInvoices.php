<?php 

require('../initialize.php');

// try {
	//Delete query. 
	if (isset($_GET['d'])) {
		$delStmt = 'DELETE FROM invoice
			WHERE invoice_id = :invId';
			
		$delValues[':invId'] = $_GET["invId"];

		$del = DB::prepare($delStmt);
		DB::execute($del, $delValues);
	}

	// Populate the table. 
	$sql = "
		SELECT  
			invoice_id, 
			first_name, 
			last_name, 
			customer_id, 
			sum(price*quantity) AS total
		FROM customer
		JOIN invoice USING (customer_id)
		JOIN invoice_item USING (invoice_id)
		JOIN item USING (item_id)
		GROUP BY invoice_id
	";

	$statement = DB::prepare($sql);

	DB::execute($statement);
	$results = $statement->fetchAll();
	print_r($results[0]);
	// Create table.
	$table = "";
	foreach ($results as $i => $result) {
		echo $result;
		// $table .= '<tr><td><a href=invoiceDetail.php?invId=' 
		// . $result["invoice_id"] .'>' . $results[$i]["invoice_id"] 
		// . "</a></td><td>" . $results[$i]["first_name"] . "</td><td>" 
		// . $results[$i]["last_name"] . "</td><td>" . $results[$i]["total"] 
		// . "</td><<td><a href=\"invoices.php?d=y&invId=" 
		// . $results[$i]["invoice_id"] . ">Delete</a>";

// } catch (PDOException $e) {
// 	die($e->getMessage());
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoices</title>
</head>
<body>
	<h3>Invoices</h3>
	<table border="1">
		<tr>
			<td>Invoice</td>
			<td>First Name</td>
			<td>Last Name</td>
			<td>Delete</td>
			<td>Created At</td>
		</tr>
		<?php ?>
	</table>
	<a href="../main.php">Home</a>

</body>
</html>