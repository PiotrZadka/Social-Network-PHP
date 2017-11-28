<?php

// Things to notice:
// This script holds the sanitisation function that we pass all our user data to
// This script holds the validation functions that double-check our user data is valid
// You can add new PHP functions to validate different kinds of user data (e.g., emails, dates) by following the same convention:
// if the data is valid return an empty string, if the data is invalid return a help message

// function to sanitise (clean) user data:
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

function validateSignup($name,$field)
{
	if(!empty($field))
	{
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

// if the data is valid return an empty string, if the data is invalid return a help message
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

// if the data is valid return an empty string, if the data is invalid return a help message
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

function validateEmail($field)
{
	if (!filter_var($field, FILTER_VALIDATE_EMAIL))
    {
		// wasn't a valid email, return a help message:
        return "Not a valid email address";
    }
	// data was valid, return an empty string:
    return "";
}

function validateDOB($field){
	if(empty($field)){
		return "date is empty";
	}
}

// all other validation functions should follow the same rule:
// if the data is valid return an empty string, if the data is invalid return a help message
// ...

?>
