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
	echo "Implement profile browsing here... See the assignment specification for more details.<br>";
}

// finish off the HTML for this page:
require_once "footer.php";
?>