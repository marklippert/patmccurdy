<?php
$PageTitle = "";
$HeaderExtra = "<link rel=\"alternate\" type=\"application/rss+xml\" href=\"rss.xml\" title=\"Pat McCurdy RSS Feed\">\n<link rel=\"alternate\" type=\"application/rss+xml\" href=\"schedule.xml\" title=\"Pat McCurdy's Schedule\">";
include "header.php";
?>

<?php
$now = time();
$result = $mysqli->query("SELECT * FROM main WHERE appears != 'rss' AND (enddate = '' OR enddate >= '" . $now . "') ORDER BY date DESC");

while($row = $result->fetch_array(MYSQLI_BOTH)) {
  echo "<h2>" . $row['title'] . "</h2>\n";
  echo str_replace("\r", "<br>", $row['text']) . "<br>\n<br>\n";
}

$result->free();

// Update RSS
$rsslink = "rss.xml";
if (filemtime($rsslink) < $now-21600) include "rss.php";
?>

<?php
// $mysqli->close();

include "footer.php";
?>