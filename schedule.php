<?php
include_once("inc/dbconfig.php");

// Keep people from snooping too far into the future
$toofar = date("Y") + 5 . "" . date("m");
if (!empty($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] > $toofar) header("Location: schedule.php");

if (!empty($_SERVER['QUERY_STRING'])) {
  $date = strtotime(substr($_SERVER['QUERY_STRING'],-2)."/1/".substr($_SERVER['QUERY_STRING'],0,4));
} else {
  $date = time();
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
$Description = "Come out and see Pat play! Schedule updates regularly, so check back often.";
include "header.php";
?>

<div id="schedule">
  <div id="schedule-header">
    <a href="schedule.php?<?php echo date("Ym", $lastmonth); ?>" rel="nofollow">&laquo; <?php echo date("F", $lastmonth); ?></a>
    <a href="schedule.php?<?php echo date("Ym", $nextmonth); ?>" rel="nofollow"><?php echo date("F", $nextmonth); ?> &raquo;</a>
  </div> <!-- /#schedule-header -->
  
  <table>
    <tr id="weekdays">
      <td>Sunday</td>
      <td>Monday</td>
      <td>Tuesday</td>
      <td>Wednesday</td>
      <td>Thursday</td>
      <td>Friday</td>
      <td>Saturday</td>
    </tr>

    <tr>
      <?php if ($start_blanks > 0 && $start_blanks < 7) { ?>
        <td colspan="<?php echo $start_blanks; ?>" class="blank">
          <div><?php echo $start_blanks_content; ?></div>
        </td>
      <?php
      }

      $result = $mysqli->query("SELECT * FROM schedule WHERE date >= '$first_day' AND date <= '$last_day' ORDER BY date ASC");

      $schedule = array();

      while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $schedule[date("j", $row['date'])][] = $row;
      }

      $result->close();
      
      $day_count = $start_blanks;
      $day_num = 1;
      $show_num = 1;

      while ($day_num <= $days_in_month) {
        echo '<td class="';
        if (date("F", $date) . " " . $day_num . " " . date("Y", $date) == date("F j Y")) echo "today ";
        if (empty($schedule[$day_num][0]['venue'])) echo "noshow";
        
        // Only needed for mobile formatting
        if (!empty($schedule[$day_num][0]['venue']) && $show_num == 1) {
          echo "show1";
          $show_num++;
        }
        echo '">';

          echo '<div class="date">';
            echo $day_num;
            if (!empty($schedule[$day_num][0]['venue'])) echo '<div class="day">'.date("D", $schedule[$day_num][0]['date'])."</div>\n";
          echo "</div>\n";

          echo '<div class="date-content">';
            if (isset($schedule[$day_num])) {
              $i = 1;

              foreach($schedule[$day_num] as $key => $value) {
                if ($schedule[$day_num][$key]['status'] == "canceled") echo "<strike>";

                if (!empty($schedule[$day_num][$key]['url'])) echo '<a href="'.$schedule[$day_num][$key]['url'].'">';
                if (!empty($schedule[$day_num][$key]['venue'])) echo $schedule[$day_num][$key]['venue'];
                if (!empty($schedule[$day_num][$key]['url'])) echo "</a>\n";

                if (!empty($schedule[$day_num][$key]['location'])) echo '<div class="location">'.$schedule[$day_num][$key]['location']."</div>\n";

                if (empty($schedule[$day_num][$key]['displaytime']) && $schedule[$day_num][$key]['date'] > strtotime(date("n/j/Y", $schedule[$day_num][$key]['date']))) echo '<div class="time">'.date("g:ia", $schedule[$day_num][$key]['date'])."</div>\n";

                if (!empty($schedule[$day_num][$key]['stage'])) echo '<div class="stage">'.$schedule[$day_num][$key]['stage']."</div>\n";

                if (!empty($schedule[$day_num][$key]['additional'])) echo '<div class="additional">'.$schedule[$day_num][$key]['additional']."</div>\n";

                if ($schedule[$day_num][$key]['status'] == "canceled") echo '</strike><strong style="display: block; color: #FF0000;">CANCELED</strong>';

                if ($i < count($schedule[$day_num])) echo "<hr>";

                $i++;
              }
            }
          echo "</div>\n";

        echo "</td>";

        $day_count++;

        // Start a new row every week
        if ($day_count > 6) {
          if ($day_num != $days_in_month) echo "</tr>\n<tr>\n";
          $day_count = 0;
        }

        $day_num++;
      }
      
      if ($end_blanks > 0 && $end_blanks < 7) { ?>
        <td colspan="<?php echo $end_blanks; ?>" class="blank">
          <div><?php echo $end_blanks_content; ?></div>
        </td>
      <?php } ?>
    </tr>
  </table>
  
  <div id="import">
    Add this schedule to your Apple or Google calendar <code>https://patmccurdy.com/pat.ics</code>
  </div>
</div> <!-- /#schedule -->

<?php include "footer.php"; ?>