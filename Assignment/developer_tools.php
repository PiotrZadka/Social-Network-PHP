<?php

// Things to notice:
// You need to add code to this script to implement the developer tools
// Notice that the code not only checks whether the user is logged in, but also whether they are the admin, before it displays the page content
// You can implement all the developer tools functionality from this script, or...
// ... You may wish to add admin-only features to other pages as well - e.g., global_feed.php (where a simple example has been included)

// execute the header script:
require_once "header.php";

if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
else
{
	// only display the page content if this is the admin account (all other users get a "you don't have permission..." message):
	if ($_SESSION['username'] == "admin")
	{
		echo "Implement the developer tools here... See the assignment specification for more details.<br>";
	}
	else
	{
		echo "You don't have permission to view this page...<br>";
	}
}

// finish off the HTML for this page:
require_once "footer.php";
?>