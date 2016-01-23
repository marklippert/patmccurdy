<?php
header("Cache-Control: no-transform"); // Fix AT&T's wireless servers gzipping bullshit (random characters on page)
// ob_start('ob_gzhandler'); also works

include_once("inc/dbconfig.php");

function email($address, $name="") {
  for ($i = 0; $i < strlen($address); $i++) { $email .= (rand(0, 1) == 0) ? "&#" . ord(substr($address, $i)) . ";" : substr($address, $i, 1); }
  if ($name == "") $name = $email;
  echo "<a href=\"&#109;&#97;&#105;&#108;&#116;&#111;&#58;$email\">$name</a>";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Pat McCurdy<?php if ($PageTitle != "") echo " | " . $PageTitle; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <meta name="description" content="Pat McCurdy is a singer-songwriter with an unusual off-beat sense of humor.  A favorite of the college crowd, this national performer is known for his comic lyrics and hilarious observations on life, love and the wonders of sex and beer.">
    <meta name="keywords" content="sex, beer, sex & beer, sex and beer, chokin the gopher, monkey paw, hey paddy, hey patty, Milwaukee, Madison, La Crosse, Chicago, St. Paul, Minneapolis, Wisconsin, Illinois, Minnesota, music, Yipes, Men About Town, Confidentials">
    <meta name="author" content="Mark Lippert">

    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="inc/main.css">

    <script type="text/javascript" src="inc/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="inc/bootstrap-collapse.js"></script>
    <script type="text/javascript" src="inc/jquery-equalheights.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("a[href^='http'], a[href$='.pdf']").not("[href*='" + window.location.host + "']").attr('target','_blank');
        $(".week1 .calendar-day").equalHeights(100,500);
        $(".week2 .calendar-day").equalHeights(100,500);
        $(".week3 .calendar-day").equalHeights(100,500);
        $(".week4 .calendar-day").equalHeights(100,500);
        $(".week5 .calendar-day").equalHeights(100,500);
        $(".week6 .calendar-day").equalHeights(100,500);
      });
    </script>

    <!--[if lt IE 9]><script src="inc/modernizr-2.6.2-respond-1.1.0.min.js"></script><![endif]-->
    <!--[if lt IE 7 ]>
    <script type="text/javascript" src="inc/dd_belatedpng.js"></script>
    <script type="text/javascript">DD_belatedPNG.fix('img, .png, #outer-wrap, #home-header');</script>
    <![endif]-->

    <?php echo $HeaderExtra; ?>

    <!-- BEGIN Google Analytics -->
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-9892672-2']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
    <!-- END Google Analytics -->
  </head>
  <body>

    <div id="outer-wrap">
      <div id="wrap">
        <header>
          <a href="."><img src="images/logo.png" alt="Pat McCurdy" id="logo"></a>

          <a id="menu-toggle" data-toggle="collapse" data-target="#menu"></a>

          <nav id="menu" class="collapse">
            <ul class="clearfix">
              <li><a href="schedule.php">Schedule</a></li>
              <li>
                <a href="song-of-the-week.php">Music</a>
                <ul>
                  <li><a href="song-of-the-week.php">Song of the Week</a></li>
                  <li><a href="lyrics.php">Lyrics</a></li>
                  <li><a href="guitar-tabs.php">Guitar Tabs</a></li>
                  <li><a href="set-lists.php">Set Lists</a></li>
                </ul>
              </li>
              <li>
                <a href="videos.php">Visual</a>
                <ul>
                  <li><a href="videos.php">Videos</a></li>
                  <li><a href="photos.php">Photos</a></li>
                </ul>
              </li>
              <li>
                <a href="schedule.php">Information</a>
                <ul>
                  <li><a href="schedule.php">Schedule</a></li>
                  <li><a href="faq.php">FAQ</a></li>
                  <li><a href="press.php">Press</a></li>
                  <li><a href="media-kit.php">Media Kit</a></li>
                  <li><a href="contact.php">Contact</a></li>
                </ul>
              </li>
              <li><a href="shop.php">Shop</a></li>
            </ul>
          </nav>

          <div style="clear: both;"></div>

          <?php if ($PageTitle == "") { ?>
          <div id="home-header">
            <div id="home-header-pics">
              <img src="images/home-header-pic1.png" alt="" id="hhp1">
              <img src="images/home-header-pic2.png" alt="" id="hhp2">
              <img src="images/home-header-pic3.png" alt="" id="hhp3">
            </div> <!-- home-header-pics -->

            <div id="playstoday-wrap">
              <div id="playstoday">
              <?php
              $ptresult = $mysqli->query("SELECT * FROM schedule WHERE date >= '" . strtotime("Today 00:00") . "' AND date <= '" . strtotime("Today 23:59") . "' ORDER BY date ASC");
              $pti = 1;
              if ($ptresult->num_rows == 0) {
                echo "Pat is not playing today";
              } else {
                while($ptrow = $ptresult->fetch_array(MYSQLI_BOTH)) {
                  if ($ptrow['status'] == "canceled") echo "<strike>";

                  if ($ptrow['venue'] != "") {
                    if ($ptrow['url'] != "") echo "<a href=\"" . $ptrow['url'] . "\">";
                    echo $ptrow['venue'];
                    if ($ptrow['url'] != "") echo "</a>";

                    if ($ptrow['location'] != "") echo "<br>\n" . $ptrow['location'];

                    if ($ptrow['status'] != "canceled") {
                      if ($ptrow['displaytime'] == "") {
                        if ($ptrow['date'] > strtotime(date("n/j/Y", $ptrow['date']))) echo "<br>\n" . date("g:ia", $ptrow['date']);
                      }

                      if ($ptrow['stage'] != "") echo "<div style=\"font-size: 80%; line-height: 1em;\">" . $ptrow['stage'] . "</div>";

                      if ($ptrow['additional'] != "") echo "<div style=\"font-size: 75%; line-height: 1.1em;\">" . $ptrow['additional'] . "</div>";
                    }
                  } else {
                    echo $ptrow['event'];
                  }

                  if ($ptrow['status'] == "canceled") echo "</strike><div style=\"color: red;\">CANCELED</div>";

                  if ($pti < $ptresult->num_rows) echo "<hr style=\"width: 75%;\">";
                  $pti++;
                }
              }

              $ptresult->free();
              ?>
              </div> <!-- playstoday -->
            </div> <!-- playstoday-wrap -->
          </div> <!-- home-header -->
          <?php } ?>
        </header>

        <div id="content-wrap">
          <h1 class="title"><?php echo ($HeaderTitle != "") ? $HeaderTitle : $PageTitle; ?></h1>
          <article<?php if ($Sidebar != "") echo " class=\"noside\""; ?>>
