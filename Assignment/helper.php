<?php
// I've added extra validaton because there is no way to make one validation to rule them all!
// Signup requires different validation than Signin or Profile Update

// Sanitise (clean) user data:
function sanitise($str, $connection)
{
	if (get_magic_quotes_gpc())
	{
		// just in case server is running an old version of PHP with "magic quotes" running:
		$str = stripslashes($str);
	}
	// escape any dangerous characters, e.g. quotes:
	$str = mysqli_real_escape_string($connection, $str);
	// ensure any html code is safe by converting reserved characters to entities:
	$str = htmlentities($str);
	// return the cleaned string:
	return $str;
}

// Simple String Validation
function validateString($field, $minlength, $maxlength)
{
    if (strlen($field)<$minlength)
    {
		// wasn't a valid length, return a help message:
        return "Minimum length: " . $minlength;
    }
	elseif (strlen($field)>$maxlength)
    {
		// wasn't a valid length, return a help message:
        return "Maximum length: " . $maxlength;
    }
	// data was valid, return an empty string:
    return "";
}

// Validation for signup process
function validateSignup($name,$field)
{
	//validation to check if username already exists in db
	if($name == "Username"){
		require "credentials.php";
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		$query = "SELECT username FROM members WHERE username = '$field' ";
		$result = mysqli_query($connection, $query);
		$exists = mysqli_num_rows($result);
		if($exists == 1)
		{
			return $field." is not available!";
		}
	}
	else
	{
		if(!empty($field))
		{
			// if username doesn't include non alphanumeric
			if(!preg_match('/[\'^£$%&*!()}{@#~?><>,|=_+¬-]/', $field))
			{
			// if it's letter/number and not empty than allow
	    return "";
			}
			else
			{
				return $name." can't contain any special characters!";
			}
		}
		return $name. "can't be empty";
	}
}

// Validation for String in Profile Setup
function validateProfileString($name, $field, $minlength, $maxlength)
{
	if(!empty($field)){
		if(ctype_alpha($field))
		{
	    if (strlen($field)<$minlength)
	    {
			// wasn't a valid length, return a help message:
	        return $name. " minimum length: " . $minlength . "<br>";
	    }
			elseif (strlen($field)>$maxlength)
	    {
			// wasn't a valid length, return a help message:
	        return $name . " maximum length: " . $maxlength . "<br>";
	    }
		// data was valid, return an empty string:
	    return "";
		}
		else
		{
				return $name . " must be a letter <br>";
		}
	}
	return $name . " can't be empty <br>";
}

// Validation for Integers in Profile Setup
function validateInt($name,$field, $min, $max)
{
	// see PHP manual for more info on the options: http://php.net/manual/en/function.filter-var.php
	$options = array("options" => array("min_range"=>$min,"max_range"=>$max));

	if (!filter_var($field, FILTER_VALIDATE_INT, $options))
    {
		// wasn't a valid integer, return a help message:
        return "Number of $name is not a valid number (must be whole and in the range: " . $min . " to " . $max . ")<br>";
    }
	// data was valid, return an empty string:
    return "";
}

// Validation for Email in Profile Setup
function validateEmail($field)
{
	if (!filter_var($field, FILTER_VALIDATE_EMAIL))
    {
		// wasn't a valid email, return a help message:
        return "Not a valid email address<br>";
    }
	// data was valid, return an empty string:
    return "";
}

// Validation for DOB in Profile Setup
function validateDOB($field)
{
	if(empty($field))
	{
		return "Date is empty";
	}
	return "";
}

// all other validation functions should follow the same rule:
// if the data is valid return an empty string, if the data is invalid return a help message
// ...

?>
