<?php
include_once "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Schedule";
include "header.php";

$TheB = (!empty($_GET['b'])) ? "&b=".$_GET['b'] : "";
?>

<div id="admin-schedule" class="flex main-cols">
  <div>
    <h3>Add An Event</h3>

    <form action="scheduledb.php?a=add<?php if (!empty($_GET['b'])) echo "&b=".$_GET['b']; ?>" method="POST">
      <div>
        <div class="admin-two-col flex">
          <label>
            Date
            <input type="date" name="date" style="width: 100%;">
          </label>
          <label>
            Time
            <input type="time" name="time">
          </label>
        </div>

        <div class="admin-two-col flex">
          <label>
            <input type="checkbox" name="donttweet"> Don't tweet
          </label>
          <label>
            <input type="checkbox" name="displaytime"> Don't display the time
          </label>
        </div>
        
        <label>Venue
          <input type="text" name="venue">
        </label>
        
        <label>Location
          <input type="text" name="location">
        </label>
        
        <label>URL
          <input type="text" name="url">
        </label>
        
        <label>Stage
          <input type="text" name="stage">
        </label>
        
        <label>Additional Information
          <input type="text" name="additional">
        </label>
        
        <input type="submit" name="submit" value="Add">
      </div>
    </form>
    
    <hr style="margin: 2em 0;">
    
    <?php
    if (!empty($_POST['searchsubmit'])) {
      echo "<h3>Search Results</h3>\n";

      $searchresult = $mysqli->execute_query("SELECT * FROM schedule WHERE venue LIKE ? ORDER BY date ASC", ["%{$_POST['search']}%"]);

      if ($searchresult->num_rows > 0) {
        echo "<table>\n";

        foreach ($searchresult as $search) {
          ?>
          <tr class="show">
            <td class="controls">
              <a href="scheduledb.php?a=delete&id=<?php echo $search['id'].$TheB; ?>" class="delete" onClick="return(confirm('Are you sure you want to delete this record?'));"></a>
              <a href="scheduleedit.php?a=edit&id=<?php echo $search['id'].$TheB; ?>" class="edit"></a>
              <a href="scheduleedit.php?a=copy&id=<?php echo $search['id'].$TheB; ?>" class="copy"></a>
            </td>

            <td class="show-date"><?php echo date("n/j/y",$search['date']); ?></td>

            <td class="show-info">
              <?php
              if ($search['venue'] != "") {
                echo $search['venue'];
                if ($search['location'] != "") echo "<br>\n" . $search['location'];
              } else {
                echo $search['event'];
              }
              ?>
            </td>
          </tr>
          <tr><td colspan="3">&nbsp;</td></tr>
          <?php
        }

        echo "</table>\n";
      } else {
        echo "Nothing found.  Try again.\n";
      }
    }
    ?>
    <form action="scheduleindex.php<?php if (!empty($_GET['b'])) echo "?b=".$_GET['b']; ?>" method="POST" id="searchschedule">
      <div>
        <input type="text" name="search" id="search">
        <input type="submit" name="searchsubmit" value="Search">
      </div>
    </form>
  </div> <!-- /#admin-schedule > DIV -->

  <div>
    <?php
    $date = (!empty($_GET['b'])) ? strtotime(substr($_GET['b'],-2)."/1/".substr($_GET['b'],0,4)) : time();

    $title = date("F Y", $date);
    $lastmonth = strtotime(date("n/1/Y", $date)." -1 month");
    $nextmonth = strtotime(date("n/1/Y", $date)." +1 month");
    $first_day = strtotime("First day of " . $title . " 00:00");
    $last_day = strtotime("First day of " . date("F Y", $nextmonth) . " 00:00");
    ?>
    
    <div id="schedule-header" class="flex">
      <a href="scheduleindex.php?b=<?php echo date("Ym", $lastmonth); ?>">&laquo;</a>
      <h3><?php echo $title; ?></h3>
      <a href="scheduleindex.php?b=<?php echo date("Ym", $nextmonth); ?>">&raquo;</a>
    </div>
    
    <table>
      <?php
      $shows = $mysqli->execute_query("SELECT * FROM schedule WHERE date >= '$first_day' AND date <= '$last_day' ORDER BY date ASC");
      
      foreach ($shows as $show) {
        ?>
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr class="show">
          <td class="controls">
            <a href="scheduledb.php?a=delete&id=<?php echo $show['id'].$TheB; ?>" class="delete" onClick="return(confirm('Are you sure you want to delete this record?'));"></a>
            <a href="scheduleedit.php?a=edit&id=<?php echo $show['id'].$TheB; ?>" class="edit"></a>
            <a href="scheduleedit.php?a=copy&id=<?php echo $show['id'].$TheB; ?>" class="copy"></a>
          </td>

          <td class="show-date"><?php echo date("n/j",$show['date']); ?></td>
          
          <td class="show-info">
            <?php
            if ($show['venue'] != "") {
              if ($show['url'] != "") echo '<a href="' . $show['url'] . '">';
              echo $show['venue'];
              if ($show['url'] != "") echo "</a>\n";

              if ($show['location'] != "") echo "<br>\n" . $show['location'];

              if (date("H:i", $show['date']) != "00:00") echo "<br>\n".date("g:ia", $show['date']);

              if ($show['displaytime'] != "") echo " <em>[Time not displayed]</em>\n";

              if ($show['stage'] != "") echo '<div style="font-size: 80%;">' . $show['stage'] . "</div>\n";
              if ($show['additional'] != "") echo '<div style="font-size: 80%;">' . $show['additional'] . "</div>\n";
            } else {
              echo $show['event'];
            }

            if ($show['status'] == "canceled") echo '<div style="color: red; font-weight: bold;">CANCELED</div>'."\n";
            ?>
          </td> <!-- /.show-info -->
        </tr> <!-- /.show -->
      <?php } ?>
    </table>
  </div> <!-- /#admin-schedule > DIV -->
</div> <!-- /#admin-schedule -->

<?php include "footer.php"; ?>