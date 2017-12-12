<?php

// Things to notice:
// You need to add code to this script to implement the global feed
// A simple example has been included to show how you might display extra content/functionality to the admin

// execute the header script:
require_once "header.php";
$user_message = '';

if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
else
{
	if(isset($_POST['userpost']))
	{

		//Put code here!!
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		if (!$connection)
		{
			die("Connection failed: " . $mysqli_connect_error);
		}
		$timestamp = date('Y/m/d H:i:s');
		$username = $_SESSION['username'];
		$content = sanitise($_POST['userpost'], $connection);
		$query = "INSERT INTO feed (post_id, username,content,timestamp) VALUES ('', '$username','$content','$timestamp');";
		$result = mysqli_query($connection, $query);
		if ($result)
		{
			// show a successful signup message:
			$user_message = "Message posted!";
		}
		else
		{
			// show unsuccessfull message
			$user_message = "Message failed to post";
		}

	}
	// a little extra text that only the admin will see!:
	if ($_SESSION['username'] == "admin")
	{

	}
}
echo <<<_END
      <form method='post' method='post'>
      Type here to post a message:<br>
      <textarea name='userpost' cols='50' rows='5'></textarea><br>
      <input type='submit' value='Post Message'></form><br>
			echo $user_message;
_END;


// finish off the HTML for this page:
require_once "footer.php";
?>
