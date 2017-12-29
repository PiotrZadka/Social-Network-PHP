$(document).ready(function() {
  //$('head').append('<link rel="stylesheet" href="styles.css">');
  $("div#afterglow-article").hide();
  $("li#afterglow").click(function(){
    $("div#afterglow-article")
    .toggle()
    .load("afterglow.html");
  });

  $("li#plyr").click(function(){
    $("div#plyr-article")
    .toggle()
    .load("plyr.html");
  });

  $("li#videojs").click(function(){
    $("div#videojs-article")
    .toggle()
    .load("videojs.html");
  });




  });
