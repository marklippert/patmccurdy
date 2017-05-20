<?php
include_once("inc/dbconfig.php");

$RSSFeed = "<?xml version='1.0'?>\n<rss version=\"2.0\">
<channel>
  <title>Pat McCurdy</title>
  <link>https://patmccurdy.com</link>
  <description>Pat McCurdy news and updates.</description>
  <image>
    <url>//patmccurdy.com/images/apple-touch-icon.png</url>
    <title>Pat McCurdy</title>
    <link>https://patmccurdy.com</link>
  </image>\n";

$now = time();

$result = $mysqli->query("SELECT * FROM main WHERE appears != 'page' AND (enddate = '' OR enddate >= '" . $now . "') ORDER BY id DESC");

while($row = $result->fetch_array(MYSQLI_BOTH)) {
  $RSSFeed .= "<item>
    <title>" . strip_tags($row['title']) . "</title>
    <link>https://patmccurdy.com</link>
    <description><![CDATA[" . str_replace("\r", "<br>", $row['text']) . "]]></description>
    <guid>" . $row['id'] . "</guid>
    <pubDate>" . date("r", $row['date']) . "</pubDate>
  </item>\n";
}

$RSSFeed .= "</channel>\n</rss>";

$file= fopen($rsslink, "w");
fwrite($file, $RSSFeed);
fclose($file);

$result->free();
$mysqli->close();
?>