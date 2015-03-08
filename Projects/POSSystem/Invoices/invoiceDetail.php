<?php 

require('../initialize.php');

try {

	if (!isset($_GET['invId'])) {
		echo "There was a problem.";
		header("Location: allInvoices.php");
	}	
	// To populate the information for the invoice.
	$sql = "
	SELECT *
	FROM invoice
	JOIN customer USING (customer_id)
	LEFT OUTER JOIN invoice_item using (invoice_id)
	LEFT OUTER Join item using (item_id)
	WHERE invoice_id = :invId
	";

	$statement = DB::prepare($sql);
	$prepare_values = [
		':invId' => $_GET['invId']
	];
	// $invId = $_GET['invId'];
	DB::execute($statement, $prepare_values);

	$results = $statement->fetchAll();
	
	$invId = '';
	$sum = 0;
	$tblrows = '';

	if(isset($results[0]['invoice_item_id'])){
		$invId = $results[0]['invoice_id'];
		foreach ($results as $result) {
			$qty = $result['quantity'];
			$cost = $result['price'];
			$item = $result['name'];
			$total = $qty * $cost;
			$sum += $total;
			$itId = $result['item_id'];
			$invId = $result['invoice_id'];
			$tblrows .= "</tr><td>" . $qty . "</td><td>" . $item . "</td><td>" .
						 $cost . "</td><td>" . $total . "</td><td>
						<a href=\"deleteInventoryLineItem.php?invoice_id=$invId&item=$itId\">Remove
						</a></td></tr>";
		}
	}


	// For the dynamimc list of items. 
	$items = "
		SELECT *
		FROM item
		";

	$statement = DB::prepare($items);
	DB::execute($statement);
	$itemList = $statement->fetchAll();	
	$itemToAdd = '';
	foreach($itemList as $key=> $item) {
		$itemToAdd .= "<option value=" . $item['item_id'] . ">" . $item["name"] . "</option>";		
	}


} catch (PDOException $e) {
	die($e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoice Detail</title>
</head>
<body>
	<h2>Invoice Number: <?php echo $invId; ?> </h2>
	<table border="1">
		<tr>
			<td>Quantity</td>
			<td>Item</td>
			<td>Cost</td>
			<td>Sub-Total</td>
			<td>Remove?</td>
		
			<?php echo $tblrows; ?>
		<tr>
			<td></td>
			<td></td>
			<td><strong>Total</strong></td>
			<td>$<?php echo money_format('%.2n', $sum); ?></td>
		</tr>
	</table>
	
	<form action="replaceInventoryLineItem.php" method="POST">
		<input type="hidden" name="invoice_id" value="<?php echo $_GET['invId']; ?>">
		<label>Quantity<input type="number" name="qty" min="0"></label>
		<select name="item">
			<?php echo $itemToAdd; ?>
		</select>
		<button>Add to Invoice</button>
	</form>
	<a href="../main.php">Home</a>
</body>
</html>