<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>New Customer</title>
</head>
<body>
	<h2>New Customer</h2>
	<form action="processAddCustomer.php" method="POST">
		<div>First Name:<input type="text" name="firstName"></div>
		<div>Last Name:<input type="text" name="lastName"></div>
		<div>Email:<input type="email" name="email"></div>
		<div>Gender:
			<select name="gender">
				<option value="male">male</option>
				<option value="female">female</option> 
			</select>
		</div>
		<button>Create</button>
	</form>
	<a href="allCustomers.php">Go Back</a>
</body>
</html>