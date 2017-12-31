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
		// Charts for number of pets
		echo <<<_END
			<h2> User profile data charts </h2>
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	    <div id="piechart" style="width: 900px; height: 500px;"></div>

			<script>
				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart);

				function drawChart() {

				var data = google.visualization.arrayToDataTable([
				['First Name', 'Number of Pets'],
_END;
				$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
				if (!$connection)
				{
					die("Connection failed: " . $mysqli_connect_error);
				}
				$query = "SELECT firstname, pets FROM profiles";
				$result = mysqli_query($connection, $query);
				$n = mysqli_num_rows($result);
				if ($n > 0)
				{
					for ($i=0; $i<$n; $i++)
					{
						$row = mysqli_fetch_assoc($result);
						$firstname = $row['firstname'];
						$pets = $row['pets'];
						echo "['$firstname', $pets],";
					}
					echo "]);";
				}

		echo <<<_END
			var options = {title: 'Number of pets for each user'};

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));
			chart.draw(data, options);
			}
		</script>
_END;

	// Chart for number of posts in global feed per user
	echo<<<_END
		<div id="top_x_div" style="width: 800px; height: 600px;"></div>
		<script>
		google.charts.load('current', {'packages':['bar']});
		google.charts.setOnLoadCallback(drawStuff);

		function drawStuff() {
			var data = new google.visualization.arrayToDataTable([
				['Username', 'Posts'],
_END;
				$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
				if (!$connection)
				{
					die("Connection failed: " . $mysqli_connect_error);
				}
				$query2 = "SELECT username, count(post_id) FROM posts GROUP BY username;";
				$result2 = mysqli_query($connection, $query2);
				$n2 = mysqli_num_rows($result2);
				if ($n2 > 0)
				{
					for ($i=0; $i<$n2; $i++)
					{
						$row = mysqli_fetch_assoc($result2);
						$username = $row['username'];
						$postCount = $row['count(post_id)'];
						echo "['$username', $postCount],";
					}
					echo "]);";
				}
echo <<<_END
			var options = {
				width: 800,
				legend: { position: 'none' },
				chart: {
					title: 'Number of posts per user'},
				bar: { groupWidth: "90%" },
				vAxis: {
					viewWindow:{
					min:0
				}
          }
			};

			var chart = new google.charts.Bar(document.getElementById('top_x_div'));
			chart.draw(data, google.charts.Bar.convertOptions(options));
		};
		</script>
_END;

	}
	else
	{
		echo "You don't have permission to view this page...<br>";
	}
}

// finish off the HTML for this page:
require_once "footer.php";
?>
