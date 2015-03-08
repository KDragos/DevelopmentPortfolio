<?php  

require('../initialize.php');
echo "We made it!";

$invoice_id = $_GET['invId'];
$item_id = $_GET['itemId'];
$quantity = $_GET['qty'];

	$sql = "
		INSERT INTO invoice_item 
		(invoice_id, item_id, quantity)
		VALUE (:invoice_id, :item_id, :quantity)
		";

	$sql_values = [
		':invoice_id' => $invoice_id,
		':item_id' => $item_id,
		':quantity' => $quantity
	];

	$statement = DB::prepare($sql);

	DB::execute($statement, $sql_values);

	header('Location: invoiceDetail.php?invId=' . $invoice_id);



?>