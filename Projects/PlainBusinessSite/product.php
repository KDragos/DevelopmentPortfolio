<?php 
$selection = $_GET["product"];

$starter = "You've chosen ";

if ($selection == "1") {
	$item_message = "MacBook.";
} else if ($selection == "2") {
	$item_message = "Ubuntu.";
} else if ($selection == "3") {
	$item_message = "Windows.";
} else {
	$item_message = "a product that doesn't exist.";
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Product</title>
		<link rel="stylesheet" href="styles.css">
	</head>

	<body>

		<?php include_once("header.php"); ?>

		<main>
			<h1><?php echo $starter . $item_message; ?></h1>
		</main>

		<?php include("footer.php"); ?>
	
	</body>

</html>