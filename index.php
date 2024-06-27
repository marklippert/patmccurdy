<?php
include "header.php";

$main = $mysqli->execute_query("SELECT * FROM main WHERE appears != 'rss' AND (enddate = '' OR enddate >= ?) ORDER BY date DESC", [time()]);

foreach ($main as $item) {
  echo "<h2>".$item['title']."</h2>\n";
  echo str_replace("\r", "<br>", $item['text'])."<br>\n<br>\n";
}

// Update RSS
if (filemtime("rss.xml") < time()-21600) include "rss.php";
if (filemtime("schedule.xml") < time()-21600) include "rss-schedule.php";

include "footer.php";
?>