<?php
include_once "inc/dbconfig.php";

$RSSFeed = "<?xml version='1.0'?>
<rss version='2.0'>
<channel>
  <title>Pat McCurdy</title>
  <link>https://patmccurdy.com</link>
  <description>Pat McCurdy news and updates.</description>
  <image>
    <url>//patmccurdy.com/images/apple-touch-icon.png</url>
    <title>Pat McCurdy</title>
    <link>https://patmccurdy.com</link>
  </image>\n";

$rss = $mysqli->execute_query("SELECT * FROM main WHERE appears != 'page' AND (enddate = '' OR enddate >= ?) ORDER BY id DESC", [time()]);

foreach ($rss as $row) {
  $RSSFeed .= "<item>
    <title>".strip_tags($row['title'])."</title>
    <link>https://patmccurdy.com</link>
    <description><![CDATA[".str_replace("\r", "<br>", $row['text'])."]]></description>
    <guid>".$row['id']."</guid>
    <pubDate>".date("r", $row['date'])."</pubDate>
  </item>\n";
}

$RSSFeed .= "</channel>\n</rss>";

$file= fopen("rss.xml", "w");
fwrite($file, $RSSFeed);
fclose($file);
?>