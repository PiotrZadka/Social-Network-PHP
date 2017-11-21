<?php

// Things to notice:
// You need to add code to this script to implement the global feed
// A simple example has been included to show how you might display extra content/functionality to the admin

// execute the header script:
require_once "header.php";

if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
else
{
	echo "Implement the global feed here... ";
	// a little extra text that only the admin will see!:
	if ($_SESSION['username'] == "admin")
	{
		echo "[admin sees more!]<br>";
	}
	echo "See the assignment specification for more details.<br>";
}

// finish off the HTML for this page:
require_once "footer.php";
?>