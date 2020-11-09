<?php
// Keep people from snooping too far into the future
$toofar = date("Y") + 5 . "" . date("m");
if (!empty($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] > $toofar) header( "Location: schedule.php" );

include_once "inc/dbconfig.php";

if (!empty($_SERVER['QUERY_STRING'])) {
  $date = strtotime(substr($_SERVER['QUERY_STRING'],-2)."/1/".substr($_SERVER['QUERY_STRING'],0,4));
} else {
  $date = time();

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
      } else {
        $iloc = "";
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

$title = date("F Y", $date);
$lastmonth = strtotime(date("n/1/Y", $date)." -1 month");
$nextmonth = strtotime(date("n/1/Y", $date)." +1 month");

$first_day = strtotime("First day of " . $title . " 00:00");
$last_day = strtotime("First day of " . date("F Y", $nextmonth) . " 00:00");
$days_in_month = date("j", $last_day-1);

$start_blanks = date("w", $first_day);
$end_blanks = (7 - date("w", $last_day));

if ($start_blanks > $end_blanks || $start_blanks == $end_blanks || $end_blanks == 7 || $start_blanks > 3) {
  $start_blanks_content = $title;
  $end_blanks_content = "";
} else {
  $start_blanks_content = "";
  $end_blanks_content = $title;
}

$Sidebar = "no";
$PageTitle = $title;
$HeaderExtra = "<link rel=\"alternate\" type=\"application/rss+xml\" href=\"schedule.xml\" title=\"Pat McCurdy's Schedule\">\n<link rel=\"stylesheet\" href=\"inc/print.css\">"; 
include "header.php";
?>

<div class="calendar">
  <div class="calendar-header">
    <a href="schedule.php?<?php echo date("Ym", $lastmonth); ?>" class="cal-nav-l">&lt;&lt; <?php echo date("F", $lastmonth); ?></a>
    <a href="schedule.php?<?php echo date("Ym", $nextmonth); ?>" class="cal-nav-r"><?php echo date("F", $nextmonth); ?> &gt;&gt;</a>
    <div style="clear: both;"></div>
  </div>

  <table>
    <tr class="weekdays">
      <td>Sunday</td>
      <td>Monday</td>
      <td>Tuesday</td>
      <td>Wednesday</td>
      <td>Thursday</td>
      <td>Friday</td>
      <td>Saturday</td>
    </tr>

    <?php
    $result = $mysqli->query("SELECT * FROM schedule WHERE date >= '$first_day' AND date <= '$last_day' ORDER BY date ASC");

    $eventarr = array();

    while($row = $result->fetch_array(MYSQLI_BOTH)) {
      $MyDay = date("j", $row['date']);
      $eventarr[$MyDay][] = $row;
    }

    $result->close();
    ?>

    <tr>
      <?php if ($start_blanks > 0 && $start_blanks < 7) { ?>
      <td colspan="<?php echo $start_blanks; ?>" class="blanks blanks<?php echo $start_blanks; ?>">
        <div class="spacer"></div>
        <div class="blank_date"><?php echo $start_blanks_content; ?></div>
      </td>
      <?php } ?>

      <?php
      $day_count = $start_blanks;
      $day_num = 1;

      while ($day_num <= $days_in_month) {
        echo '<td class="';
        if (date("F", $date) . " " . $day_num . " " . date("Y", $date) == date("F j Y")) echo " cal-today";
        if (empty($eventarr[$day_num][0]['venue'])) echo " noshow";
        echo '">';
          echo '
          <div class="cal-datebox">
            <div class="cal-date">'.$day_num.'</div>
            <div class="cal-day">';
            if (!empty($eventarr[$day_num][0]['venue'])) echo date("D", $eventarr[$day_num][0]['date']);
            echo "</div>
          </div>\n";

          if (isset($eventarr[$day_num])) {
            $i = 1;
            
            echo "<div class=\"cal-info\">\n";
              foreach($eventarr[$day_num] as $key => $value) {
                if ($eventarr[$day_num][$key]['status'] == "canceled") echo "<strike>";

                if ($eventarr[$day_num][$key]['url'] != "") echo '<a href="'.$eventarr[$day_num][$key]['url'].'">';
                echo $eventarr[$day_num][$key]['venue'];
                if ($eventarr[$day_num][$key]['url'] != "") echo "</a>\n";

                if (!empty($eventarr[$day_num][$key]['location'])) echo "\n<div class=\"cal-location\">" . $eventarr[$day_num][$key]['location'] . "</div>";

                // Display time if set
                if ($eventarr[$day_num][$key]['displaytime'] == "") {
                  if ($eventarr[$day_num][$key]['date'] > strtotime(date("n/j/Y", $eventarr[$day_num][$key]['date']))) echo "\n<div class=\"cal-time\">" . date("g:ia", $eventarr[$day_num][$key]['date']) . "</div>";
                }

                // Display stage
                if ($eventarr[$day_num][$key]['stage'] != "") echo "<div class=\"cal-stage\">" . $eventarr[$day_num][$key]['stage'] . "</div>";

                // Display additional info
                if ($eventarr[$day_num][$key]['additional'] != "") echo "<div class=\"cal-additional\">" . $eventarr[$day_num][$key]['additional'] . "</div>";

                if ($eventarr[$day_num][$key]['status'] == "canceled") echo "</strike><br><strong style=\"color: #FF0000;\">CANCELED</strong>";

                if ($i < count($eventarr[$day_num])) echo "<hr>";
                
                $i++;
              }
            echo "</div>\n";
          } else {
            echo '<div class="spacer"></div>';
          }
        echo "</td>\n";
        
        $day_count++;

        // Start a new row every week
        if ($day_count > 6) {
          if ($day_num != $days_in_month) echo "</tr>\n<tr>\n";
          $day_count = 0;
        }

        $day_num++;
      }
      ?>

      <?php if ($end_blanks > 0 && $end_blanks < 7) { ?>
      <td colspan="<?php echo $end_blanks; ?>" class="blanks blanks<?php echo $end_blanks; ?>">
        <div class="spacer"></div>
        <div class="blank_date"><?php echo $end_blanks_content; ?></div>
      </td>
      <?php } ?>
    </tr>
  </table>
</div>

<?php include "footer.php"; ?>