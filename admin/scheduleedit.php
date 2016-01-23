<?php
include("../inc/dbconfig.php");
include "login.php";

$Action = ($_GET['a'] == "edit") ? "Edit" : "Copy";
$PageTitle = "Schedule | " . $Action . " Event";
include "header.php";

$result = $mysqli->query("SELECT * FROM schedule WHERE id = '" . $_GET['id'] . "'");
$row = $result->fetch_array(MYSQLI_BOTH);
?>

<form action="scheduledb.php?a=<?php echo ($_GET['a'] == "edit") ? "edit" : "add"; if (!empty($_GET['b'])) echo "&b=" . $_GET['b']; ?>" method="POST">
  <?php if ($_GET['a'] == "edit") { ?>
  <div class="sub-sidebar">
    <input type="radio" name="status" value=""<?php if ($row['status'] == "") echo " checked"; ?>> All is well<br>
    <input type="radio" name="status" value="canceled"<?php if ($row['status'] == "canceled") echo " checked"; ?>> Canceled
  </div>
  <?php } ?>

  <div class="sub-center">
    <div class="sub-left">
      <strong>Date</strong>
      <input type="text" name="date" id="date" readonly="true"<?php echo " value=\"" . date("m/d/Y", $row['date']) . "\""; ?>>
    </div>

    <div class="sub-right">
      <?php $TheTime = ($row['date'] > strtotime(date("n/j/Y", $row['date']))) ? date("g:ia", $row['date']) : ""; ?>
      <strong>Time</strong>
      <input type="text" name="time" class="mytimepicker"<?php echo " value=\"" . $TheTime . "\""; ?>>
    </div>
    <div style="clear: both;"></div>

    <div class="sub-left">
      <input type="checkbox" name="donttweet"<?php if ($_GET['a'] == "edit" && $row['donttweet'] != "") echo " checked"; ?>> Don't tweet
    </div>

    <div class="sub-right">
      <input type="checkbox" name="displaytime"<?php if ($row['displaytime'] != "") echo " checked"; ?>> Don't display the time
    </div>

    <div style="clear: both;"></div>
    <br>
    
    <strong>Venue</strong><br>
    <input type="text" name="venue" value="<?php echo $row['venue']; ?>"><br>
    <br>
    
    <strong>Location</strong><br>
    <input type="text" name="location" value="<?php echo $row['location']; ?>"><br>
    <br>
    
    <strong>URL</strong><br>
    <input type="text" name="url" value="<?php echo $row['url']; ?>"><br>
    <br>
    
    <strong>Stage</strong><br>
    <input type="text" name="stage" value="<?php echo $row['stage']; ?>"><br>
    <br>
    
    <strong>Additional Information</strong><br>
    <input type="text" name="additional" value="<?php echo $row['additional']; ?>"><br>
    <br>
    
    <div style="display: <?php echo ($row['event'] != "") ? "block" : "none"; ?>;">
      <strong>Event</strong><br>
      <textarea name="event"><?php echo $row['event']; ?></textarea><br>
      <br>
    </div>
    
    <?php if ($_GET['a'] == "edit") { ?>
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
    <?php } ?>
    <input type="submit" value="<?php echo ($_GET['a'] == "edit") ? "Update" : "Copy"; ?>">
  </div>
</form>

<?php
$result->free();
$mysqli->close();

include "footer.php";
?>