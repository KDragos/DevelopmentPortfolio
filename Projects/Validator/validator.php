<?php 

require_once('classes.php');

$types = ['username', 'password', 'phone', 'number', 'email'];
$form = '';
$numErrors = 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$emailValidator = new EmailValidator();
	if (!$emailValidator->isValid($_POST['email'])) {
		$errors['email'] = "Your email must have a @ in it.";
		$numErrors += 1;
	}
	$usernameValidator = new UsernameValidator();
	if (!$usernameValidator->isValid($_POST['username'])) {
		$errors['username'] = "Your username can only contain 3-16 lowercase letters or numbers as characters.";
		$numErrors += 1;

	}
	$passwordValidator = new PasswordValidator(); 
	if(!$passwordValidator->isValid($_POST['password'])) {
		$errors['password'] = "Your password must have 6-18 characters and contain only lowercase letters and digits.";
		$numErrors += 1;

	}
	$phoneValidator = new PhoneValidator(); 
	if(!$phoneValidator->isValid($_POST['phone'])) {
		$errors['phone'] = "Your phone number must contain only 10 digits.";
		$numErrors += 1;
	}
	$numberValidator = new NumberValidator(); 
	if(!$numberValidator->isValid($_POST['number'])) {
		$errors['number'] = "Your number can only contain digits and a decimal.";
		$numErrors += 1;
	}

}


foreach ($types as $type) {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (strlen($errors[$type]) > 1) {
			$form .= "<p>$type: <input type=\"text\" name=\"$type\" class=\"inValid\">" . $errors[$type] . " You entered: " . $_POST[$type] . "</p>";			
		} else {
			$form .= "<p>$type: <input type=\"text\" name=\"$type\" class=\"valid\" value=\"$_POST[$type]\"></p>";
		}
	} else {
		$form .= "<p>$type: <input type=\"text\" name=\"$type\"></p>";
	}
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Validator</title>

	<style>
		
		a {
			text-decoration: none;
		}
		
		.valid {
			background-color: #0CF71C;
			color: #333;
		}

		.inValid {
			background-color: #F70c2c;
			color: #fff;
		}

	</style>


</head>
<body>
	<h2>Please enter some information to validate.</h2>

	<form action="" method="POST">
		<?php echo $form; ?>
		<button>Validate</button>
		<button type="reset">Reset</button>
	</form>

	<?php if ($numErrors > 0) {echo "You have " . $numErrors . " errors."; } ?>
	
	<p><a href="validator.php">Validate more information?</a></p>

</body>
</html>