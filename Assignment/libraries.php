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

<h2>JavaScript Video Sharing Libraries</h2>
<section>
<p style='margin-top: 5px;'>There are many video libraries available in the internet to use which are made by other developers who decided they would like to share their ideas and save some time for others trying to achive same thing.</p>
<p style='margin-bottom: 5px;' >Before choosing one there are some questions that we need to ask ourselves such as:</p>
<p>Which one to use?</p>
<p>Which one is the best?</p>
<p>Are they free?</p>
<p>How complex it is to implement them and does it serve the purpose?</p>
<p  style='margin-bottom: 5px;'>…and many more.</p>
<p>I will try to recommend three in my opinion best JavaScript video libraries for further implementation to global feed video sharing.</p>
<h2 style='margin-top: 5px;'>My recommendation are as follows:</h2>
<p>(Please select desired library from below)</p>
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
<section>

</section>
<h2>Performace:</h2>
<p style='margin-top: 5px;'>When it comes to mass video sharing lightweight player is a key. It can reduce bandwidth usage, loading times and improve user experience.</p>
<p>I have loaded three videos on the same html page and made them play the same video </p>
<p>Out of these three libraries Plyr turns out to be the quickest in general</p>
<section>
<h2 style='margin-top: 5px;'>Compatibility:</h2>
<img style='margin-top: 5px;' src="img/compatibility.png" alt="Libraries Compatibility" height="118" width="642"></img>
<p style='margin-top: 5px;'> All libraries support modern browsers however users still using old version of Internet Explorer might find some display errors.</p>
</section>

<section>
<h2 style='margin-top: 5px;'>Overall:</h2>
<p style='margin-top: 5px;'>All mentioned video libraries are perfect for what you willing to achieve with video sharing in global feed. </p>
<p>In my opinion they all look good and professional and usable for the purpose. </p>
<p>Afterglow and Plyr supports all current video formats and can be used really quick and in a simple way, compared to Video.js which requires some additional plugins to support i.e. YouTube format (either links or ID’s).</p>
<p>It’s difficult to decide which one could be a best possible pick but my personal pick would be Plyr library. </p>
<p>It’s most appealing out of those three. It’s easy to use and lightweight.</p>
<h2 style='margin-top: 5px;'>Summary:</h2>
<p style='margin-top: 5px;'>My pick goes to <b>Plyr</b>. </p>
<p>It's lightrweight, pretty design and supports video links to popular hosting websites such as YouTube or Vimeo out of the box (Without any additiona plugins)</p>
<p>It's also the quickest to load video file, and very easy to implement</p>
<p>However, feel free to tinker with other two libraries, but in the end my recommendation goes to Plyr </p>
</section>




_END;
}

require_once "footer.php";
?>
