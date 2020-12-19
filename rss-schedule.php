<?php
include_once("inc/dbconfig.php");

$RSSFeed = "<?xml version='1.0'?>
<rss version='2.0'>
<channel>
  <title>Pat McCurdy's Schedule</title>
  <link>https://patmccurdy.com/schedule.php</link>
    <description>Find out where and when Pat McCurdy is playing.</description>
  <image>
    <url>//patmccurdy.com/images/apple-touch-icon.png</url>
    <title>Pat McCurdy</title>
    <link>https://patmccurdy.com</link>
  </image>\n";

$iCal = "BEGIN:VCALENDAR\r\nPRODID:-//Apple Computer\, Inc//iCal 2.0//EN\r\nVERSION:2.0\r\nMETHOD:PUBLISH\r\nX-WR-CALNAME:Pat McCurdy's Schedule\r\nX-WR-TIMEZONE;VALUE=TEXT:US/Central\r\n";

$rss = $mysqli->query("SELECT * FROM schedule WHERE date >= '".time()."' ORDER BY date ASC");

while($row = $rss->fetch_array(MYSQLI_ASSOC)) {
  $idate = ";VALUE=DATE:" . date("Ymd", $row['date']);
  $idateend = ";VALUE=DATE:" . date("Ymd", $row['date']+86400);

  if ($row['venue'] != "") {
    $title = $row['venue'];
    $isum = strip_tags(str_replace(",", "\,", $row['venue']));

    $event = "";
    if ($row['url'] != "") $event .= '<a href="'.$row['url'].'">';
    $event .= $row['venue'];
    if ($row['url'] != "") $event .= "</a>";

    if ($row['location'] != "") {
      $title .= " - " . $row['location'];
      $event .= "<br>" . $row['location'];
      $iloc = strip_tags(str_replace(",", "\,", $row['location']));
    } else {
      $iloc = "";
    }

    if ($row['displaytime'] == "") {
      if ($row['date'] > strtotime(date("n/j/Y", $row['date']))) {
        $title .= " - " . date("g:ia", $row['date']);
        $event .= "<br>" . date("g:ia", $row['date']);
        $idate = ";TZID=US/Central:" . date("Ymd\THis", $row['date']);
        $idateend = ";TZID=US/Central:" . date("Ymd\THis", $row['date']+7200);
      }
    }

    $idesc = "";
    if ($row['stage'] != "" || $row['additional'] != "") $idesc .= "\r\nDESCRIPTION:";

    if ($row['stage'] != "") {
      $event .= "<br>" . $row['stage'];
      $idesc .= $row['stage'];
    }

    if ($row['stage'] != "" && $row['additional'] != "") $idesc .= "\\n";

    if ($row['additional'] != "") {
      $event .= "<br>" . $row['additional'];
      $idesc .= $row['additional'];
    }
  } else {
    $event = str_replace("\n", "<br>", $row['event']);
    $title = strip_tags(str_replace("<br>", " - ", $event));

    $pos = strpos($event, "<br>");
    if ($pos != "") {
      $isum = substr($event, 0, $pos);
      $iloc = substr($event, $pos+4);
    } else {
      $isum = $event;
      $iloc = "";
    }

    $isum = strip_tags(str_replace(",", "\,", $isum));
    $iloc = str_replace("<br>", "\\r\\n", $iloc);
    $iloc = strip_tags(str_replace(",", "\,", $iloc));
  }

  if ($row['status'] == "canceled") {
    $title = "!!!CANCELED!!! " . $title . " !!!CANCELED!!!";
    $event = "!!!CANCELED!!!<br>" . $event . "<br>!!!CANCELED!!!";
    $isum = "CANCELED - " . $isum;
  }

  $RSSFeed .= "<item>
    <title>" . date("n/j/y", $row['date']) . " " . htmlspecialchars($title) . "</title>
    <link>https://patmccurdy.com/schedule.php</link>
    <description><![CDATA[$event]]></description>
    <guid>" . $row['date'] . "</guid>
    <pubDate>" . date("r", $row['date']) . "</pubDate>
  </item>\n";

  $iCal .= "BEGIN:VEVENT\r\nDTSTART$idate\r\nDTEND$idateend\r\nSUMMARY:$isum\r\nLOCATION:$iloc" . $idesc . "\r\nEND:VEVENT\r\n";
}

$RSSFeed .= "</channel>\n</rss>";
$iCal .= "END:VCALENDAR";

$file= fopen("schedule.xml", "w");
fwrite($file, $RSSFeed);
fclose($file);

$file= fopen("pat.ics", "w");
fwrite($file, $iCal);
fclose($file);

$rss->free();
?>