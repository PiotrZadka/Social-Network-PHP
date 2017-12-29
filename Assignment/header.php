<?php

// Things to notice:
// This script is called by every other script (via require_once)
// It starts the session and displays a different set of menu links depending on whether the user is logged in or not...
// ... And, if they are logged in, whether or not they are the admin
// It also reads in the credentials for our database connection from credentials.php

// database connection details:
require_once "credentials.php";

// our helper functions:
require_once "helper.php";

// start/restart the session:
session_start();

if (isset($_SESSION['loggedInSkeleton']))
{
	// THIS PERSON IS LOGGED IN
	// show the logged in menu options:

echo <<<_END
<!DOCTYPE html>
<html>
<head>
	 <link rel="stylesheet" href="styles.css">
	 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	 <script src="libraries.js"></script>
</head>
<body>

<div id='menu-bar'>
<a href='about.php'>about</a>
<a href='set_profile.php'>set profile</a>
<a href='show_profile.php'>show profile</a>
<a href='browse_profiles.php'>browse profiles</a>
<a href='global_feed.php'>global feed</a>
<a href='libraries.php'>video sharing</a>
<a id='signout' href='sign_out.php'>sign out ({$_SESSION['username']})</a>
_END;
	// add an extra menu option if this was the admin:
	if ($_SESSION['username'] == "admin")
	{
		echo "<a id='devtools-menu' href='developer_tools.php'>developer tools</a>";
	}
echo "</div>";
}
else
{
	// THIS PERSON IS NOT LOGGED IN
	// show the logged out menu options:

echo <<<_END
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="styles.css">
<body>
<div id='menu-bar'>
	<a href='about.php'>about</a>
	<a href='sign_up.php'>sign up</a>
	<a href='sign_in.php' style="border-right: 1px solid">sign in</a>
</div>
_END;
}
echo <<<_END
<br>
<h1 id="main-title">2CWK50: A Social Network</h1>
_END;
?>
