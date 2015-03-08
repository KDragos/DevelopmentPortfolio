<?php 

class Validator {
	protected $regex = '';

	public function isValid($input) {
		if(strlen($this->regex) === 0) {
			throw new exception("Called empty regex.");
		}
		return preg_match($this->regex, $input);
	}
}


class UsernameValidator extends Validator {
	protected $regex = "/^[a-z0-9]{3,16}$/";
}

class PasswordValidator extends Validator {
	protected $regex = "/^[a-z0-9]{6,18}$/";
}	
	
class PhoneValidator extends Validator {
	protected $regex = "/^[0-9]{10}$/";
}

class NumberValidator extends Validator {
	protected $regex ="/^[0-9]+\.?[0-9]+$/";
}

class EmailValidator extends Validator {
	protected $regex = "/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/";
}

class ValidatorFactory {
	public function getValidator($type) {
		if($type == 'email') {
			return new EmailValidator();
		} else if($type == 'number') {
			return new NumberValidator();
		} else if ($type == 'phone') {
			return new PhoneValidator();
		} else if ($type == "username") {
			return new UsernameValidator();
		} else if ($type == "password") {
			return new PasswordValidator();	
		} else {
			throw new exception('unknown validator type');
		}
	}
}
