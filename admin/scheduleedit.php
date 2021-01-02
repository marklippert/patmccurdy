<?php
include("../inc/dbconfig.php");
include "login.php";

$Action = ($_GET['a'] == "edit") ? "Edit" : "Copy";
$PageTitle = "Schedule | " . $Action . " Event";
include "header.php";

$shows = $mysqli->query("SELECT * FROM schedule WHERE id = '" . $_GET['id'] . "'");
$show = $shows->fetch_array(MYSQLI_BOTH);
?>

<form action="scheduledb.php?a=<?php echo ($_GET['a'] == "edit") ? "edit" : "add"; if (!empty($_GET['b'])) echo "&b=" . $_GET['b']; ?>" method="POST">
  <div>
    <?php if ($_GET['a'] == "edit") { ?>
    <div class="radio">
      <label>
        <input type="radio" name="status" value=""<?php if ($show['status'] == "") echo " checked"; ?>> All is well
      </label>
      <label>
        <input type="radio" name="status" value="canceled"<?php if ($show['status'] == "canceled") echo " checked"; ?>> Canceled
      </label>
    </div>
    <?php } ?>

    <div class="admin-two-col flex">
      <label>Date
        <input type="text" name="date" id="date" readonly="true"<?php echo ' value="'.date("m/d/Y", $show['date']).'"'; ?>>
      </label>
      <?php $TheTime = ($show['date'] > strtotime(date("n/j/Y", $show['date']))) ? date("g:ia", $show['date']) : ""; ?>
      <label>Time
        <input type="text" name="time" class="mytimepicker"<?php echo ' value="'.$TheTime.'"'; ?>>
      </label>
    </div>

    <div class="admin-two-col flex">
      <label>
        <input type="checkbox" name="donttweet"<?php if ($show['donttweet'] != "") echo " checked"; ?>> Don't tweet
      </label>
      <label>
        <input type="checkbox" name="displaytime"<?php if ($show['displaytime'] != "") echo " checked"; ?>> Don't display the time
      </label>
    </div>

    <label>Venue
      <input type="text" name="venue" value="<?php echo $show['venue']; ?>">
    </label>
    
    <label>Location
      <input type="text" name="location" value="<?php echo $show['location']; ?>">
    </label>
    
    <label>URL
      <input type="text" name="url" value="<?php echo $show['url']; ?>">
    </label>
    
    <label>Stage
      <input type="text" name="stage" value="<?php echo $show['stage']; ?>">
    </label>
    
    <label>Additional Information
      <input type="text" name="additional" value="<?php echo $show['additional']; ?>">
    </label>

    <?php if ($_GET['a'] == "edit") { ?>
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
    <?php } ?>

    <input type="submit" value="<?php echo ($_GET['a'] == "edit") ? "Update" : "Copy"; ?>">
  </div>
</form>

<?php include "footer.php"; ?>