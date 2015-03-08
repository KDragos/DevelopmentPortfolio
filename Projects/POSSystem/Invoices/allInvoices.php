<?php 

require('../initialize.php');


// Populate the table. 
$sql = "
	SELECT  
		invoice_id, 
		first_name, 
		last_name, 
		customer_id, 
		sum(price*quantity) AS total
	FROM invoice
	LEFT JOIN customer USING (customer_id)
	LEFT JOIN invoice_item USING (invoice_id)
	LEFT JOIN item USING (item_id)
	GROUP BY invoice_id
";

try {

	$statement = DB::prepare($sql);

	DB::execute($statement);
	$results = $statement->fetchAll();

	// Create table.
	$table = "";
	foreach ($results as $i => $result) {
		$table .= '<tr><td><a href=invoiceDetail.php?invId=' 
		. $result["invoice_id"] .'>' . $result["invoice_id"] 
		. "</a></td><td>" . $result["first_name"] . "</td><td>" 
		. $result["last_name"] . "</td><td>" . $result["total"] 
		. "</td><td><a href=\"deleteInvoice.php?inv_id=" . 
		$result["invoice_id"] . "\">Delete</a></td></tr>";

	};
} catch (PDOException $e) {
	die($e->getMessage());
}

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
			<td>Total</td>
			<td>Delete?</td>
		</tr>
		<?php echo $table; ?>
	</table>
	<a href="../main.php">Home</a>

</body>
</html>