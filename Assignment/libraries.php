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

<h1>JavaScript Video Sharing Libraries</h1>
<section>
<p>There are many video libraries available in the internet to use which are made by other developers who decided they would like to share their ideas and save some time for others trying to achive same thing.</p>
<p>Before choosing one there are some questions that we need to ask ourselves such as:</p>
<p>Which one to use?</p>
<p>Which one is the best?</p>
<p>Are they free?</p>
<p>How complex it is to implement them and does it serve the purpose?</p>
<p>…and many more.</p>
<p>I will try to recommend three in my opinion best JavaScript video libraries for further implementation to global feed video sharing.</p>
<p>My recommendation is as follows:</p>
</section>

<ul id="libraries_list">
<li id='afterglow'>Afterglow</li>
<li id='plyr'>Plyr</li>
<li id='videojs'>Video.js</li>
</ul>

<div id='afterglow-article'>
</div>

<div id='plyr-article'>
</div>

<div id='videojs-article'>
</div>


_END;
}

require_once "footer.php";
?>
