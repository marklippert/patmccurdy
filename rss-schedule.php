<?php
include_once "inc/dbconfig.php";

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

$iCal = "BEGIN:VCALENDAR\r\nVERSION:2.0\r\nPRODID:-//Apple Computer\, Inc//iCal 2.0//EN\r\nMETHOD:PUBLISH\r\nX-WR-CALNAME:Pat McCurdy's Schedule\r\nNAME:Pat McCurdy's Schedule\r\n";

$iCal .= "BEGIN:VTIMEZONE\r\nTZID:America/Chicago\r\nLAST-MODIFIED:20201011T015911Z\r\nX-LIC-LOCATION:America/Chicago\r\nBEGIN:DAYLIGHT\r\nTZNAME:CDT\r\nTZOFFSETFROM:-0600\r\nTZOFFSETTO:-0500\r\nDTSTART:19700308T020000\r\nRRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=2SU\r\nEND:DAYLIGHT\r\nBEGIN:STANDARD\r\nTZNAME:CST\r\nTZOFFSETFROM:-0500\r\nTZOFFSETTO:-0600\r\nDTSTART:19701101T020000\r\nRRULE:FREQ=YEARLY;BYMONTH=11;BYDAY=1SU\r\nEND:STANDARD\r\nEND:VTIMEZONE\r\n";

$epoch = time();

$rss = $mysqli->execute_query("SELECT * FROM schedule WHERE date >= ? ORDER BY date ASC", [$epoch]);

foreach ($rss as $row) {
  $idtstamp = date("Ymd\THis", $epoch);
  $iuid = time()."-".$row['id']."@patmccurdy.com";

  $idate = ";VALUE=DATE:".date("Ymd", $row['date']);
  $idateend = ";VALUE=DATE:".date("Ymd", $row['date']+86400);

  if ($row['venue'] != "") {
    $title = $row['venue'];
    $isum = strip_tags(str_replace(",", "\,", $row['venue']));

    $event = "";
    if ($row['url'] != "") $event .= '<a href="'.$row['url'].'">';
    $event .= $row['venue'];
    if ($row['url'] != "") $event .= "</a>";

    if ($row['location'] != "") {
      $title .= " - ".$row['location'];
      $event .= "<br>".$row['location'];
      $iloc = "LOCATION:".strip_tags(str_replace(",", "\,", $row['location']))."\r\n";
    } else {
      $iloc = "";
    }

    if ($row['displaytime'] == "") {
      if ($row['date'] > strtotime(date("n/j/Y", $row['date']))) {
        $title .= " - ".date("g:ia", $row['date']);
        $event .= "<br>".date("g:ia", $row['date']);
        $idate = ";TZID=America/Chicago:".date("Ymd\THis", $row['date']);
        $idateend = ";TZID=America/Chicago:".date("Ymd\THis", $row['date']+9000);
      }
    }

    $idesc = "";
    if ($row['url'] != "" || $row['stage'] != "" || $row['additional'] != "") $idesc .= "DESCRIPTION:";

    if ($row['url'] != "") $idesc .= $row['url'];

    if ($row['url'] != "" && ($row['stage'] != "" || $row['additional'] != "")) $idesc .= "\\n\\n";

    if ($row['stage'] != "") {
      $event .= "<br>".$row['stage'];
      $idesc .= $row['stage'];
    }

    if ($row['stage'] != "" && $row['additional'] != "") $idesc .= "\\n\\n";

    if ($row['additional'] != "") {
      $event .= "<br>".$row['additional'];
      $idesc .= $row['additional'];
    }

    if ($row['url'] != "" || $row['stage'] != "" || $row['additional'] != "") $idesc .= "\r\n";
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
    $title = "!!!CANCELED!!! ".$title." !!!CANCELED!!!";
    $event = "!!!CANCELED!!!<br>".$event."<br>!!!CANCELED!!!";
    $isum = "CANCELED - ".$isum;
  }

  $RSSFeed .= "<item>
    <title>".date("n/j/y", $row['date'])." ".htmlspecialchars($title)."</title>
    <link>https://patmccurdy.com/schedule.php</link>
    <description><![CDATA[$event]]></description>
    <guid>".$row['date']."</guid>
    <pubDate>".date("r", $row['date'])."</pubDate>
  </item>\n";

  $iCal .= "BEGIN:VEVENT\r\nDTSTAMP:$idtstamp\r\nUID:$iuid\r\nDTSTART$idate\r\nDTEND$idateend\r\nSUMMARY:$isum\r\n".$iloc.$idesc."TRANSP:TRANSPARENT\r\nEND:VEVENT\r\n";
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