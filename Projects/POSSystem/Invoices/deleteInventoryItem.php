<?php 
require("../initialize.php");

if (isset($_POST['invoice_id']) && isset($_POST['item'])) {
	$invoice_id = $_POST['invoice_id'];
	$item_id = $_POST['item'];
	$quantity = $_POST['qty'];

	$sql = "
		DELETE FROM invoice_item 
		WHERE invoice_id = :invoice_id
		AND  item_id = :item_id
	";

	$sql_values = [
		':invoice_id' => $invoice_id,
		':item_id' => $item_id
	];

	$statement = DB::prepare($sql);

	DB::execute($statement, $sql_values);

	header("Location: processAddInvoiceItem.php?invId=" . 
		$invoice_id . "&itemId=" . $item_id . "&qty=" . $quantity);
} else {
	echo "Oops, looks like something is wrong. Let's try again.";
	header("Location: allInvoices.php");
}

 
?>