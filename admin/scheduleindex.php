<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Schedule";
include "header.php";
?>

<div class="toggle-box">
  <div class="toggle-control" data-text="Add An Event" data-expanded-text="Hide form">Add An Event</div>
  <div id="admin-left">
    <h3>Add An Event</h3>
    <form action="scheduledb.php?a=add<?php if (!empty($_GET['b'])) { echo "&b=" . $_GET['b']; } ?>" method="POST" style="margin-bottom: 2em;">
      <div>
        <div class="sub-left">
          <strong>Date</strong>
          <input type="text" name="date" id="date" readonly="true">
        </div>
        <div class="sub-right">
          <strong>Time</strong>
          <input type="text" name="time" class="mytimepicker">
        </div>
        <div style="clear: both;"></div>

        <div class="sub-left">
          <input type="checkbox" name="donttweet"> Don't tweet
        </div>
        <div class="sub-right">
          <input type="checkbox" name="displaytime"> Don't display the time
        </div>
        <div style="clear: both;"></div>
        <br>
        
        <strong>Venue</strong><br>
        <input type="text" name="venue"><br>
        <br>
        
        <strong>Location</strong><br>
        <input type="text" name="location"><br>
        <br>
        
        <strong>URL</strong><br>
        <input type="text" name="url"><br>
        <br>
        
        <strong>Stage</strong><br>
        <input type="text" name="stage"><br>
        <br>
        
        <strong>Additional Information</strong><br>
        <input type="text" name="additional"><br>
        <br>
        
        <input type="submit" value="Add">
      </div>
    </form>
    
    <hr style="margin-bottom: 2em;">
    
    <?php
    if (!empty($_POST['ssubmit'])) {
      echo "<h3>Search Results</h3>\n";
      
      $sresult = $mysqli->query("SELECT * FROM schedule WHERE event LIKE '%" . $_POST['ssearch'] . "%' OR venue LIKE '%" . $_POST['ssearch'] . "%' ORDER BY date ASC");
      
      if ($sresult->num_rows > 0) {
        while($srow = $sresult->fetch_array(MYSQLI_BOTH)) {
          ?>
          <div class="c1">
            <div class="controls">
              <a href="scheduleedit.php?a=copy&id=<?php echo $srow['id']; ?>"><img src="images/copy.png" alt="Copy" title="Copy"></a>
            </div>
            
            <div class="sched-date "><?php echo date("n/j/y",$srow['date']); ?></div>
            
            <div class="info">
              <?php
              if ($srow['venue'] != "") {
                echo $srow['venue'];
                if ($srow['location'] != "") echo "<br>\n" . $srow['location'];
              } else {
                echo $srow['event'];
              }
              ?>
            </div>
          </div>
          
          <div class="spacer-height"></div>
          <?php
        }
      } else {
        echo "Nothing found.  Try again.\n";
      }

      $sresult->free();
    }
    ?>
    <form action="scheduleindex.php<?php if (!empty($_GET['b'])) { echo "?b=" . $_GET['b']; } ?>" method="POST">
      <input type="text" name="ssearch" id="ssearch"> <input type="submit" name="ssubmit" value="Search">
    </form>
  </div>
</div>

<div id="admin-right">
  <?php
  if (!empty($_GET['b'])) {
    $date = mktime(0,0,0,substr($_GET['b'],-2), 1, substr($_GET['b'],0,4));
    $title = date("F Y",$date);
    $lastmonth = mktime(0,0,0,substr($_GET['b'],-2)-1, 1, substr($_GET['b'],0,4));
    $nextmonth = mktime(0,0,0,substr($_GET['b'],-2)+1, 1, substr($_GET['b'],0,4));
    $prev = date("Ym",$lastmonth);
    $next = date("Ym",$nextmonth);
    $first_day = mktime(0,0,0,date("m", $date), 1, date("Y", $date));
    $last_day = mktime(23,59,59,date("m", $date), cal_days_in_month(0, date("m", $date), date("Y", $date)), date("Y", $date));
  } else {
    $title = date("F Y");
    $prev = date("Ym",strtotime("last month"));
    $next = date("Ym",strtotime("next month"));
    $first_day = mktime(0,0,0,date("m"), 1, date("Y"));
    $last_day = mktime(23,59,59,date("m"), cal_days_in_month(0, date("m"), date("Y")), date("Y"));
  }
  ?>
  
  <div style="text-align: center;">
    <h3 id="sched-prev"><a href="scheduleindex.php?b=<?php echo $prev; ?>"><<</a></h3>
    <h3 id="sched-month"><?php echo $title; ?></h3>
    <h3 id="sched-next"><a href="scheduleindex.php?b=<?php echo $next; ?>">>></a></h3>
    <div style="clear: both;"></div>
  </div>
  
  <?php
  if (!empty($_GET['b'])) {
    $TheB = "&b=" . $_GET['b'];
  } else {
    $TheB = "";
  }
  
  $result = $mysqli->query("SELECT * FROM schedule WHERE date >= '$first_day' AND date <= '$last_day' ORDER BY date ASC");
  
  while($row = $result->fetch_array(MYSQLI_BOTH)) {
  ?>
    <div class="c3">
      <div class="controls">
        <a href="scheduledb.php?a=delete&id=<?php echo $row['id'] . $TheB; ?>" onClick="return(confirm('Are you sure you want to delete this record?'));"><img src="images/delete.png" alt="Delete" title="Delete"></a>
        <a href="scheduleedit.php?a=edit&id=<?php echo $row['id'] . $TheB; ?>"><img src="images/edit.png" alt="Edit" title="Edit"></a>
        <a href="scheduleedit.php?a=copy&id=<?php echo $row['id'] . $TheB; ?>"><img src="images/copy.png" alt="Copy" title="Copy"></a>
      </div>
      
      <div class="sched-date"><?php echo date("n/j",$row['date']); ?></div>
      
      <div class="sched-info">
        <?php
        if ($row['venue'] != "") {
          if ($row['url'] != "") echo "<a href=\"" . $row['url'] . "\">";
          echo $row['venue'];
          if ($row['url'] != "") echo "</a>";
          if ($row['location'] != "") echo "<br>\n" . $row['location'];
          if ($row['date'] > strtotime(date("n/j/Y", $row['date']))) echo "<br>\n" . date("g:ia", $row['date']);
          if ($row['displaytime'] != "") echo " <em>[Time not displayed]</em>";
          if ($row['stage'] != "") echo "<br>\n<span style=\"font-size: 80%;\">" . $row['stage'] . "</span>";
          if ($row['additional'] != "") echo "<br>\n<span style=\"font-size: 80%;\">" . $row['additional'] . "</span>";
        } else {
          echo $row['event'];
        }

        if ($row['status'] == "canceled") echo "<br>\n<strong style=\"color: red;\">CANCELED</strong>";
        ?>
      </div>
    </div>
    
    <div class="spacer-height"></div>
  <?php
  }

  $result->free();
  ?>
  
</div>

<div style="clear: both;"></div>

<?php
$mysqli->close();

include "footer.php";
?>