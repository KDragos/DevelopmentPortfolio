<?php 
require("../initialize.php");

print_r($_POST);


if (isset($_POST['invoice_id'])) {
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
	try {
	$statement = DB::prepare($sql);

	DB::execute($statement, $sql_values);

	print_r($_POST);
	header("Location: processAddInvoiceItem.php?invId=" . 
		$invoice_id . "&itemId=" . $item_id . "&qty=" . $quantity);
	}  catch (PDOException $e) {
	die($e->getMessage());
	}
	

} else {
	echo "You made it but you're wrong. Your code sucks.";
	// header("Location: allInvoices.php");
}


 ?>