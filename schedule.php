<?php
// Keep people from snooping too far into the future
$toofar = date("Y") + 5 . "" . date("m");
if (!empty($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] > $toofar) header( "Location: schedule.php" );

include_once "inc/dbconfig.php";

if (!empty($_SERVER['QUERY_STRING'])) {
  $date = mktime(0,0,0,substr($_SERVER['QUERY_STRING'],-2), 1, substr($_SERVER['QUERY_STRING'],0,4));
  $title = date("F Y",$date);
  $lastmonth = mktime(0,0,0,substr($_SERVER['QUERY_STRING'],-2)-1, 1, substr($_SERVER['QUERY_STRING'],0,4));
  $nextmonth = mktime(0,0,0,substr($_SERVER['QUERY_STRING'],-2)+1, 1, substr($_SERVER['QUERY_STRING'],0,4));
} else {
  // Set variables to generate schedule
  $date = time();
  $title = date("F Y");
  $lastmonth = mktime(1, 1, 1, date('m')-1, 1, date('Y'));
  $nextmonth = mktime(1, 1, 1, date('m')+1, 1, date('Y'));

  // Create RSS and iCal feeds
  $today = $date - 86400;

  $RSSFeed = "<?xml version='1.0'?>\n<rss version=\"2.0\">
  <channel>
    <title>Pat McCurdy's Schedule</title>
    <link>https://patmccurdy.com/schedule.php</link>
    <description>Find out where and when Pat McCurdy is playing.</description>
    <image>
      <url>https://patmccurdy.com/images/apple-touch-icon.png</url>
      <title>Pat McCurdy</title>
      <link>https://patmccurdy.com</link>
    </image>\n";
  $iCal = "BEGIN:VCALENDAR\r\nPRODID:-//Apple Computer\, Inc//iCal 2.0//EN\r\nVERSION:2.0\r\nMETHOD:PUBLISH\r\nX-WR-CALNAME:Pat McCurdy\r\nX-WR-TIMEZONE;VALUE=TEXT:US/Central\r\n";

  $xresult = $mysqli->query("SELECT * FROM schedule WHERE date >= '$today' ORDER BY date ASC");

  while($xrow = $xresult->fetch_array(MYSQLI_BOTH)) {
    $idate = ";VALUE=DATE:" . date("Ymd", $xrow['date']);
    $idateend = ";VALUE=DATE:" . date("Ymd", $xrow['date']+86400);

    if ($xrow['venue'] != "") {
      $xtitle = $xrow['venue'];
      $isum = strip_tags(str_replace(",", "\,", $xrow['venue']));

      $xevent = "";
      if ($xrow['url'] != "") $xevent .= "<a href=\"" . $xrow['url'] . "\">";
      $xevent .= $xrow['venue'];
      if ($xrow['url'] != "") $xevent .= "</a>";

      if ($xrow['location'] != "") {
        $xtitle .= " - " . $xrow['location'];
        $xevent .= "<br>" . $xrow['location'];
        $iloc = strip_tags(str_replace(",", "\,", $xrow['location']));
      }

      if ($xrow['displaytime'] == "") {
        if ($xrow['date'] > strtotime(date("n/j/Y", $xrow['date']))) {
          $xtitle .= " - " . date("g:ia", $xrow['date']);
          $xevent .= "<br>" . date("g:ia", $xrow['date']);
          $idate = ";TZID=US/Central:" . date("Ymd\THis", $xrow['date']);
          $idateend = ";TZID=US/Central:" . date("Ymd\THis", $xrow['date']+7200);
        }
      }

      $idesc = "";
      if ($xrow['stage'] != "" || $xrow['additional'] != "") $idesc .= "\r\nDESCRIPTION:";

      if ($xrow['stage'] != "") {
        $xevent .= "<br>" . $xrow['stage'];
        $idesc .= $xrow['stage'];
      }

      if ($xrow['stage'] != "" && $xrow['additional'] != "") $idesc .= "\\n";

      if ($xrow['additional'] != "") {
        $xevent .= "<br>" . $xrow['additional'];
        $idesc .= $xrow['additional'];
      }
    } else {
      // XML stuff
      $xevent = str_replace("\n", "<br>", $xrow['event']);
      $xtitle = strip_tags(str_replace("<br>", " - ", $xevent));

      // iCal stuff
      $pos = strpos($xevent, "<br>");
      if ($pos != "") {
        $isum = substr($xevent, 0, $pos);
        $iloc = substr($xevent, $pos+4);
      } else {
        $isum = $xevent;
        $iloc = "";
      }

      $isum = strip_tags(str_replace(",", "\,", $isum));
      $iloc = str_replace("<br>", "\\r\\n", $iloc);
      $iloc = strip_tags(str_replace(",", "\,", $iloc));
    }

    if ($xrow['status'] == "canceled") {
      $xtitle = "!!!CANCELED!!! " . $xtitle . " !!!CANCELED!!!";
      $xevent = "!!!CANCELED!!!<br>" . $xevent . "<br>!!!CANCELED!!!";
      $isum = "CANCELED - " . $isum;
    }

    $RSSFeed .= "    <item>
      <title>" . date("n/j/y", $xrow['date']) . " " . htmlspecialchars($xtitle) . "</title>
      <link>https://patmccurdy.com/schedule.php</link>
      <description><![CDATA[$xevent]]></description>
      <guid>" . $xrow['date'] . "</guid>
      <pubDate>" . date("r", $xrow['date']) . "</pubDate>
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

  $xresult->free();
}

$first_day = strtotime("First day of " . $title . " 00:00");
$last_day = strtotime("First day of " . date("F Y", $nextmonth) . " 00:00");
$days_in_month = date("j", $last_day-1);
$blanks = date("w", $first_day);

$Sidebar = "no";
$PageTitle = $title;
$HeaderExtra = "<link rel=\"alternate\" type=\"application/rss+xml\" href=\"schedule.xml\" title=\"Pat McCurdy's Schedule\">"; 
include "header.php";
?>

<div class="calendar">
  <div class="calendar-header">
    <a href="schedule.php?<?php echo date("Ym", $lastmonth); ?>" class="cal-nav-l">&lt;&lt; <?php echo date("F", $lastmonth); ?></a>
    <a href="schedule.php?<?php echo date("Ym", $nextmonth); ?>" class="cal-nav-r"><?php echo date("F", $nextmonth); ?> &gt;&gt;</a>
    <div style="clear: both;"></div>
  </div>

  <ul class="weekdays">
    <li>Sunday</li>
    <li>Monday</li>
    <li>Tuesday</li>
    <li>Wednesday</li>
    <li>Thursday</li>
    <li>Friday</li>
    <li>Saturday</li>
  </ul>

  <ul class="week1">
    <?php
    $week = 1;

    // Display blank days before the month starts
    for ($day_count = 0; $day_count < $blanks; $day_count++) {
      echo "<li class=\"calendar-day blank-start\"></li>\n";
    }

    // Get any shows for this month and put them in an array
    $result = $mysqli->query("SELECT * FROM schedule WHERE date >= '$first_day' AND date <= '$last_day' ORDER BY date ASC");

    if ($result->num_rows == 0) echo "<li class=\"calendar-day list-noshows\">No shows scheduled for this month yet. Check back later.</li>\n";

    $eventarr = array();
    while($row = $result->fetch_array(MYSQLI_BOTH)) {
      $MyDay = date("j", $row['date']);
      $eventarr[$MyDay][] = $row;
    }
    $result->close();

    $day_num = 1;

    // Create the calendar by counting up to the last day of the month
    while ($day_num <= $days_in_month) {
      echo "<li class=\"calendar-day";
      if (date("F", $date) . " " . $day_num . " " . date("Y", $date) == date("F j Y")) echo " cal-today";
      if (empty($eventarr[$day_num][0]['venue'])) echo " noshow";
      echo "\">\n";
        echo "
        <div class=\"cal-datebox\">
          <div class=\"cal-date\">$day_num</div>
          <div class=\"cal-day\">" . date("D", $eventarr[$day_num][0]['date']) . "</div>
        </div>
        ";

        // This day has a show so display it
        if (isset($eventarr[$day_num])) {
          $i = 1;
          foreach($eventarr[$day_num] as $key => $value) {
            echo "<div class=\"cal-info\">\n";

            // Canceled?
            if ($eventarr[$day_num][$key]['status'] == "canceled") echo "<strike>";

            if ($eventarr[$day_num][$key]['venue'] != "") {
              // Display venue and link
              echo (empty($eventarr[$day_num][$key]['url'])) ? $eventarr[$day_num][$key]['venue'] : "<a href=\"" . $eventarr[$day_num][$key]['url'] . "\">" . $eventarr[$day_num][$key]['venue'] . "</a>";

              // Display location
              if (!empty($eventarr[$day_num][$key]['location'])) echo "<br>\n" . $eventarr[$day_num][$key]['location'];

              if ($eventarr[$day_num][$key]['status'] != "canceled") {
                // If not canceled....
                // Display date if set
                if ($eventarr[$day_num][$key]['displaytime'] == "") {
                  if ($eventarr[$day_num][$key]['date'] > strtotime(date("n/j/Y", $eventarr[$day_num][$key]['date']))) echo "<br>\n" . date("g:ia", $eventarr[$day_num][$key]['date']);
                }

                // Display stage
                if ($eventarr[$day_num][$key]['stage'] != "") echo "<div style=\"font-size: 80%; line-height: 1.2em;\">" . $eventarr[$day_num][$key]['stage'] . "</div>";

                // Display additional info
                if ($eventarr[$day_num][$key]['additional'] != "") echo "<div style=\"font-size: 75%; line-height: 1.2em;\">" . $eventarr[$day_num][$key]['additional'] . "</div>";
              }
            } else {
              // Old format (probably don't need this any more, but just to be safe)
              echo $eventarr[$day_num][$key]['event'];
            }

            // Canceled?
            if ($eventarr[$day_num][$key]['status'] == "canceled") echo "</strike><br><strong style=\"color: #FF0000;\">CANCELED</strong>";

            if ($i < count($eventarr[$day_num])) echo "<hr style=\"width: 75%;\">";
            $i++;
          }
        }
      echo "</li>\n";

      $day_num++;
      $day_count++;

      // Start a new row every week
      if ($day_count > 6) {
        $week++;
        echo "</ul>\n<ul class=\"week" . $week . "\">\n";
        $day_count = 0;
      }
    }

    // Finish out the table with some blank details if needed
    $blank_end_first = 1;
    while ($day_count > 0 && $day_count <= 6) {
      echo "<li class=\"calendar-day blank-end";
      if ($blank_end_first == 1) echo " blank-end-first";
      echo "\"></li>\n";
      $day_count++;
      $blank_end_first++;
    }
    ?>
  </ul>
</div>

<div style="clear: both;"></div>

<?php include "footer.php"; ?>