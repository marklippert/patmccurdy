<?php
include "header.php";

$main = $mysqli->query("SELECT * FROM main WHERE appears != 'rss' AND (enddate = '' OR enddate >= '" . time() . "') ORDER BY date DESC");

while($row = $main->fetch_array(MYSQLI_ASSOC)) {
  echo "<h2>" . $row['title'] . "</h2>\n";
  echo str_replace("\r", "<br>", $row['text']) . "<br>\n<br>\n";
}

// Update RSS
if (filemtime("rss.xml") < time()-21600) include "rss.php";
if (filemtime("schedule.xml") < time()-21600) include "rss-schedule.php";

include "footer.php";
?>