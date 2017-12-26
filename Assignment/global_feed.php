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
	//POSTING MESSAGES
	if(isset($_POST['userpost']))
	{
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		if (!$connection)
		{
			die("Connection failed: " . $mysqli_connect_error);
		}
		$timestamp = date('Y/m/d H:i:s');
		$username = $_SESSION['username'];
		$content = sanitise($_POST['userpost'], $connection);
		$query = "INSERT INTO posts (post_id, username,content,timestamp) VALUES ('', '$username','$content','$timestamp');";
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
      <form id='post-form' method='post' method='post'>
      Type here to post a message:<br>
      <textarea name='userpost' cols='50' rows='5' maxlength='140'></textarea><br>
      <input id='submit-button' type='submit' value='Post Message'></form>
_END;

echo $user_message;

// RETRIEVE ALL POSTS
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection)
{
	die("Connection failed: " . $mysqli_connect_error);
}
$ret_posts = "SELECT * FROM posts ORDER BY timestamp DESC";
$ret_result = mysqli_query($connection, $ret_posts);
$ret_n = mysqli_num_rows($ret_result);
if ($ret_n > 0)
{
	echo "<div id='posts'>";
	for ($i=0; $i<$ret_n; $i++)
	{
		$posts_row = mysqli_fetch_assoc($ret_result);
		$post_id = $posts_row['post_id'];
		$post_username = $posts_row['username'];
		$post_content = $posts_row['content'];
		$post_timestamp = $posts_row['timestamp'];
		$post_likes = $posts_row['likes'];

		//create div within div
		echo "<div id='$post_id'>";
		if($post_username == 'admin'){
			echo "<p id='username' style='color:red'>$post_username</p>";
		}
		else{
			echo "<p id='username'>$post_username</p>";
		}
		echo "<p id='timestamp'>$post_timestamp</p><br>";
		echo "<p id='content'>$post_content</p>";
		//echo "<p id='likes'>$post_likes</p>";

		echo "</div>";

	}
	echo "</div>";
}

require_once "footer.php";
?>
