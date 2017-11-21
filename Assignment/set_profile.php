<?php

// Things to notice:
// The main job of this script is to execute an INSERT or UPDATE statement to create or update a user's profile information...
// ... but only once the data the user supplied has been validated on the client-side, and then sanitised ("cleaned") and validated again on the server-side
// It's your job to add these steps into the code
// Both sign_up.php and sign_in.php do client-side validation, followed by sanitisation and validation again on the server-side -- you may find it helpful to look at how they work
// HTML5 can validate all the profile data for you on the client-side
// The PHP functions in helper.php will allow you to sanitise the data on the server-side and validate *some* of the fields...
// ... but you'll also need to add some new PHP functions of your own to validate email addresses and dates

// execute the header script:
require_once "header.php";

// default values we show in the form:
$firstname = "";
$lastname = "";
$pets = "";
$email = "";
$dob = "";
// strings to hold any validation error messages:
$firstname_val = "";
$lastname_val = "";
$pets_val = "";
$email_val = "";
$dob_val = "";
// should we show the set profile form?:
$show_profile_form = false;
// message to output to user:
$message = "";

if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
elseif (isset($_POST['firstname']))
{
	// user just tried to update their profile

	// connect directly to our database (notice 4th argument) we need the connection for sanitisation:
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	// if the connection fails, we need to know, so allow this exit:
	if (!$connection)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}

	// SANITISATION CODE MISSING:
	// DONE!
	$firstname = sanitise($_POST['firstname'], $connection);
	$lastname = sanitise($_POST['lastname'], $connection);
	$pets = sanitise($_POST['pets'], $connection);
	$email = sanitise($_POST['email'], $connection);
	$dob = sanitise($_POST['dob'], $connection);

	// SERVER-SIDE VALIDATION CODE MISSING:
	// ...

	$fname = 'First name';
	$lname = 'Last name';
	$pname = 'pets';
	$ename = "Email";

	$firstname_val = validateProfileString($fname,$firstname, 1, 16);
	$lastname_val = validateProfileString($lname,$lastname, 1, 16);
	$pets_val = validateInt($pname,$pets, 0, 4);
	$email_val = validateEmail($email);
	$dob_val = validateDOB($dob);
	$errors = $firstname_val . $lastname_val . $pets_val . $email_val . $dob_val;


	// check that all the validation tests passed before going to the database:
	if ($errors == "")
	{
		// read their username from the session:
		$username = $_SESSION["username"];

		// now write the new data to our database table...

		// check to see if this user already had a favourite:
		$query = "SELECT * FROM profiles WHERE username='$username'";

		// this query can return data ($result is an identifier):
		$result = mysqli_query($connection, $query);

		// how many rows came back? (can only be 1 or 0 because username is the primary key in our table):
		$n = mysqli_num_rows($result);

		// if there was a match then UPDATE their profile data, otherwise INSERT it:
		if ($n > 0)
		{
			// we need an UPDATE:
			$query = "UPDATE profiles SET firstname='$firstname',lastname='$lastname',pets=$pets,email='$email',dob='$dob' WHERE username='$username'";
			$result = mysqli_query($connection, $query);
		}
		else
		{
			// we need an INSERT:
			$query = "INSERT INTO profiles (username,firstname,lastname,pets,email,dob) VALUES ('$username','$firstname','$lastname',$pets,'$email','$dob')";
			$result = mysqli_query($connection, $query);
		}

		// no data returned, we just test for true(success)/false(failure):
		if ($result)
		{
			// show a successful update message:
			$message = "Profile successfully updated<br>";
		}
		else
		{
			// show the set profile form:
			$show_profile_form = true;
			// show an unsuccessful update message:
			$message = "Update failed<br>";
		}
	}
	else
	{
		// validation failed, show the form again with guidance:
		$show_profile_form = true;
		// show an unsuccessful update message:
		$message = $errors;
		//$message = "Update failed, please check the errors above and try again<br>";
	}

	// we're finished with the database, close the connection:
	mysqli_close($connection);

}
else
{
	// arrived at the page for the first time, show any data already in the table:

	// read the username from the session:
	$username = $_SESSION["username"];

	// now read their profile data from the table...

	// connect directly to our database (notice 4th argument):
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	// if the connection fails, we need to know, so allow this exit:
	if (!$connection)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}

	// check for a row in our profiles table with a matching username:
	$query = "SELECT * FROM profiles WHERE username='$username'";

	// this query can return data ($result is an identifier):
	$result = mysqli_query($connection, $query);

	// how many rows came back? (can only be 1 or 0 because username is the primary key in our table):
	$n = mysqli_num_rows($result);

	// if there was a match then extract their profile data:
	if ($n > 0)
	{
		// use the identifier to fetch one row as an associative array (elements named after columns):
		$row = mysqli_fetch_assoc($result);
		// extract their profile data for use in the HTML:
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$pets = $row['pets'];
		$email = $row['email'];
		$dob = $row['dob'];
	}

	// show the set profile form:
	$show_profile_form = true;

	// we're finished with the database, close the connection:
	mysqli_close($connection);

}

if ($show_profile_form)
{
echo <<<_END

<!-- CLIENT-SIDE VALIDATION MISSING -->

<form action="set_profile.php" method="post">
  Update your profile info:<br>
  First name: <input type="text" name="firstname" minlength ="1" maxlength="16" value="$firstname">
  <br>
  Last name: <input type="text" name="lastname" minlength ="1" maxlength="16" value="$lastname">
  <br>
  Number of pets: <input type="text" minlength ="0" maxlength="5" name="pets" value="$pets">
  <br>
  Email address: <input type="text" name="email" value="$email">
  <br>
  Date of birth: <input type="date" name="dob" min="1987-01-01">
  <br>
  <input type="submit" value="Submit">
</form>
_END;
}

// display our message to the user:
echo $message;

// finish of the HTML for this page:
require_once "footer.php";
?>
