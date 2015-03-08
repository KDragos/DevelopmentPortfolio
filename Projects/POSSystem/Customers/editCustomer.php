<?php 

require_once('../initialize.php');

if(isset($_GET['cust_id'])) {
	$cust_id = $_GET['cust_id'];
} else {
	echo "Looks like we're missing something. Let's go back and try again.";
	header('Location: allCustomers.php');
	exit();
}


try {

	$statement = DB::prepare('SELECT * FROM customer WHERE customer_id = ' . $cust_id);
	$results = DB::execute($statement);
	
	// binding method
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);

	$fullName = $results[0]['first_name'] . ' ' . $results[0]['last_name'];

} catch (PDOException $e) {
	die($e->getMessage());
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h2>Update <?php echo $fullName; ?>'s profile? </h2>
<form action="processEditCustomer.php" method="POST">
	<input type="hidden" name="cust_id" value="<?php echo $_GET['cust_id']; ?>">
	<div>First Name:<input type="text" name="firstName" value="<?php echo $results[0]['first_name']; ?>"></div>
	<div>Last Name:<input type="text" name="lastName" value="<?php echo $results[0]['last_name'] ?>" ></div>
	<div>Email:<input type="email" name="email" value="<?php echo $results[0]['email'] ?>"></div>
	<div>Gender:
		<select name="gender">
			<option value="male" <?php if ($results[0]['gender'] === 'male') { echo "checked"; ?>>male</option>
			<option value="female" <?php } else { echo "checked"; }?>>female </option> 
		</select>
	</div>
	<button>Update</button>
</form>
	<a href="allCustomers.php">Back</a>
</body>
</html>