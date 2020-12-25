<?php
include_once("inc/dbconfig.php");

function email($address, $name="") {
  $email = "";
  for ($i = 0; $i < strlen($address); $i++) { $email .= (rand(0, 1) == 0) ? "&#" . ord(substr($address, $i)) . ";" : substr($address, $i, 1); }
  if ($name == "") $name = $email;
  echo "<a href=\"&#109;&#97;&#105;&#108;&#116;&#111;&#58;$email\">$name</a>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pat McCurdy<?php if (isset($PageTitle)) echo " | " . $PageTitle; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <meta name="description" content="">

    <link rel="alternate" type="application/rss+xml" href="rss.xml" title="Pat McCurdy RSS Feed">
    <link rel="alternate" type="application/rss+xml" href="schedule.xml" title="Pat McCurdy's Schedule">
    <link rel="alternate" type="application/rss+xml" href="sotw.xml" title="Pat McCurdy's Song of the Week">

    <link rel="stylesheet" href="inc/main.css?<?php echo filemtime('inc/main.css'); ?>">

    <script type="text/javascript" src="inc/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("a[href^='http']").not("[href*='" + window.location.host + "']").prop('target','new');
        $("a[href$='.pdf']").prop('target', 'new');
      });
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-9892672-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-9892672-2');
    </script>
  </head>
  <body>

    <header<?php if (!isset($PageTitle)) echo ' class="home-header"'; ?>>
      <div class="site-width">
        <a href="."><img src="images/logo.png" alt="" id="logo"></a>

        <input type="checkbox" id="toggle-menu" role="button">
        <label for="toggle-menu"><div></div></label>
        <ul id="menu">
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
            <a href="faq.php">Information</a>
            <ul>
              <li><a href="faq.php">FAQ</a></li>
              <li><a href="press.php">Press</a></li>
              <li><a href="media-kit.php">Media Kit</a></li>
              <li><a href="contact.php">Contact</a></li>
            </ul>
          </li>
          <li><a href="shop.php">Shop</a></li>
        </ul>
      </div> <!-- /.site-width -->
    </header>

    <?php if (!isset($PageTitle)) { ?>
    <div id="home-header">
      <img src="images/header1.jpg" alt="" id="himg1">
      <img src="images/header2.jpg" alt="" id="himg2">
      <img src="images/header3.jpg" alt="" id="himg3">

      <div id="plays-today">
        TODAY'S SHOW

        <div>
          <?php
          $playstoday = $mysqli->query("SELECT * FROM schedule WHERE date >= '" . strtotime("Today 00:00") . "' AND date <= '" . strtotime("Today 23:59") . "' ORDER BY date ASC");
          ?>
          <div<?php if ($playstoday->num_rows > 1) echo ' class="multiple"'; ?>>
            <?php
            if ($playstoday->num_rows == 0) {
                echo "Pat is not playing today";
              } else {
                $pti = 1;
                while($ptrow = $playstoday->fetch_array(MYSQLI_ASSOC)) {
                  if ($ptrow['status'] == "canceled") echo "<strike>";

                  if ($ptrow['venue'] != "") {
                    if ($ptrow['url'] != "") echo '<a href="' . $ptrow['url'] . '">';
                    echo $ptrow['venue'];
                    if ($ptrow['url'] != "") echo "</a>";

                    if ($ptrow['location'] != "") echo "<br>\n" . $ptrow['location'];

                    if ($ptrow['status'] != "canceled") {
                      if ($ptrow['displaytime'] == "") {
                        if ($ptrow['date'] > strtotime(date("n/j/Y", $ptrow['date']))) echo "<br>\n" . date("g:ia", $ptrow['date']);
                      }

                      if ($ptrow['stage'] != "") echo '<div class="stage">' . $ptrow['stage'] . "</div>\n";

                      if ($ptrow['additional'] != "") echo '<div class="additional">' . $ptrow['additional'] . "</div>\n";
                    }
                  }

                  if ($ptrow['status'] == "canceled") echo "</strike>\n<div style=\"color: #FF0000;\">CANCELED</div>\n";

                  if ($pti < $playstoday->num_rows) echo "<hr>\n";
                  $pti++;
                }
              }
            ?>
          </div>
        </div>
      </div>
    </div> <!-- /#home-header -->
    <?php } ?>

    <div id="content" class="site-width<?php if (isset($ContentClass)) echo " ".$ContentClass; ?>">
      <h1><?php if (isset($PageTitle)) echo $PageTitle; ?></h1>

      <?php if (!isset($Sidebar)) echo '<div id="main-sidebar"><div id="main">'; ?>