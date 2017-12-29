<?php

// You need to add code to this script that allows users to browse other user profiles
// Hint: get started by echoing out all the other usernames

// execute the header script:
require_once "header.php";
if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
else
{
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if (!$connection)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}
	$username = $_SESSION["username"];
	$query = "SELECT username, firstname, lastname FROM profiles WHERE username NOT LIKE '$username' ORDER BY lastname ASC";
	$result = mysqli_query($connection, $query);

	$n = mysqli_num_rows($result);
	if ($n > 0)
	{
		echo "<ul>";
		for ($i=0; $i<$n; $i++)
		{
			// fetch one row as an associative array (elements named after columns):
			$row = mysqli_fetch_assoc($result);
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$hyperusername = $row['username'];

			echo "<li id='browse-profiles-links'><a href='/assignment/show_profile.php?username=$hyperusername'>$firstname $lastname</a></li>";
		}
		echo "</ul>";
}
else
{
	echo "NO PROFILES FOUND! CHECK DB CONNECTION";
}

// we're finished with the database, close the connection:
mysqli_close($connection);
}

// finish off the HTML for this page:
require_once "footer.php";
?>
