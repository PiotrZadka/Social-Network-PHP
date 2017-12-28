<?php

// Things to notice:
// You need to add your recommendations for the video sharing component to this script
// You should use client-side code (i.e., HTML5/JavaScript/jQuery) to help you organise and present your analysis
// For example, using tables, bullet point lists, images, hyperlinking to relevant materials, etc.

// execute the header script:
require_once "header.php";

if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
else
{

echo <<<_END


_END;

}

// finish off the HTML for this page:
require_once "footer.php";
?>
