<?php

// Things to notice:
// You need to add code to this script to implement the global feed
// A simple example has been included to show how you might display extra content/functionality to the admin

// execute the header script:
require_once "header.php";
$user_message = '';
$likes_number = '';

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
	//check if user is muted before alowing to post
	$username = $_SESSION['username'];
	$query_muted = "SELECT muted FROM members WHERE username = '$username'";
	$muted_result = mysqli_query($connection,$query_muted);
	$muted_row = mysqli_fetch_assoc($muted_result);
	$muted_value = $muted_row['muted'];
	//checking in table if value is 0 - Unmutted
	if($muted_value == 0)
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
	// LIKING POSTS
	if(isset($_POST['like']))
	{
		$like_id = $_POST['like_id'];
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		if (!$connection)
		{
			die("Connection failed: " . $mysqli_connect_error);
		}
		$like_query = "UPDATE posts SET likes=likes+1 WHERE post_id='$like_id'";
		$like_result = mysqli_query($connection, $like_query);
	}
}
// Otherwise disable posting messages
else{
	$user_message = "You are muted!";
}
	// Handling muting users
	if ($_SESSION['username'] == "admin")
	{
		if(isset($_POST['mute']))
		{
			$muted_user = $_POST['mute_username'];
			$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
			if (!$connection)
			{
				die("Connection failed: " . $mysqli_connect_error);
			}
			//update mute status of user in db
			$mute_query = "UPDATE members SET muted='1' WHERE username='$muted_user'";
			mysqli_query($connection, $mute_query);
			$user_message = "User $muted_user is now MUTED!";
		}
		elseif(isset($_POST['unmute']))
		{
			$unmuted_user = $_POST['unmute_username'];
			$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
			if (!$connection)
			{
				die("Connection failed: " . $mysqli_connect_error);
			}
			//update unmute status of user in db
			$unmute_query = "UPDATE members SET muted='0' WHERE username='$unmuted_user'";
			mysqli_query($connection, $unmute_query);
			$user_message = "User $unmuted_user is now unMUTED!";
		}

		// list muted users
		$list_muted = "SELECT username FROM members WHERE muted = 1";
		$list_muted_result = mysqli_query($connection, $list_muted);
		$list_muted_n = mysqli_num_rows($list_muted_result);
		if ($list_muted_n > 0)
		{
			echo "<div id='muted_list'>";
			echo "<p id='muted_title'>Muted users:</p>";
			for ($i=0; $i<$list_muted_n; $i++)
			{
				$list_muted_row = mysqli_fetch_assoc($list_muted_result);
				$list_muted_username = $list_muted_row['username'];
				echo "<p id='muted_username'>$list_muted_username</p>";
				// Button next to muted user
				echo "<form method='POST' action=''>";
				echo "<input type='hidden' name='unmute_username' value='$list_muted_username'>";
				echo "<input id='unmute' type='submit' name='unmute' value='unMute'></button>";
				echo "</form>";
			}
			echo "</div>";
		}

	}
}
echo <<<_END
      <form id='post-form' method='post'>
      <textarea name='userpost' style='resize:none' cols='50' rows='5' maxlength='140' none placeholder='Type here to post a message...' required></textarea><br>
      <input id='submit-button' type='submit' value='Post Message'>
			</form>
_END;

echo "<p style='margin-left: 5px; color: red; font-weight: bold;'>".$user_message."</p>";

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

		// like button
		echo "<form method='POST' action=''>";
		echo "<input type='hidden' name='like_id' value='$post_id'>";

		// Display current likes
		$check_like_query ="SELECT likes FROM posts WHERE post_id ='$post_id'";
		$check_like_result = mysqli_query($connection, $check_like_query);
		$like_row = mysqli_fetch_assoc($check_like_result);
		$likes_number = $like_row['likes'];

		echo "<input id='like' type='submit' name='like' value='$likes_number Like this!'></button>";
		echo "</form>";

		//show mute button if logged in as admin
		if ($_SESSION['username'] == "admin")
		{
			echo "<form method='POST' action=''>";
			echo "<input type='hidden' name='mute_username' value='$post_username'>";
			echo "<input id='mute' type='submit' name='mute' value='Mute'></button>";
			echo "</form>";
		}
		echo "</div>";
	}
	echo "</div>";
}


require_once "footer.php";
?>
