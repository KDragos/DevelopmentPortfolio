<?php 
require("../initialize.php");

if (isset($_GET['invoice_id']) && (isset($_GET['item']))) {
	$invoice_id = $_GET['invoice_id'];
	$item_id = $_GET['item'];


	$sql = "
		DELETE FROM invoice_item 
		WHERE invoice_id = :invoice_id
		AND  item_id = :item_id
	";

	$sql_values = [
		':invoice_id' => $invoice_id,
		':item_id' => $item_id
	];
	try {
	$statement = DB::prepare($sql);

	DB::execute($statement, $sql_values);

	} catch (PDOException $e) {
	die($e->getMessage());
	}

	header("Location: invoiceDetail.php?invId=" . 
		$invoice_id);
} else {
	echo "You made it but you're wrong. Your code sucks.";
	// header("Location: allInvoices.php");
}


 ?>