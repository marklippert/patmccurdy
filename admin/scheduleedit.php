<?php
include_once "../inc/dbconfig.php";
include "login.php";

$Action = ($_GET['a'] == "edit") ? "Edit" : "Copy";
$PageTitle = "Schedule | " . $Action . " Event";
include "header.php";

$shows = $mysqli->execute_query("SELECT * FROM schedule WHERE id = ?", [$_GET['id']]);
$show = $shows->fetch_assoc();
?>

<form action="scheduledb.php?a=<?php echo ($_GET['a'] == "edit") ? "edit" : "add"; if (!empty($_GET['b'])) echo "&b=".$_GET['b']; ?>" method="POST">
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
      <label>
        Date<br>
        <input type="date" name="date" value="<?php echo date("Y-m-d", $show['date']); ?>" style="width: 100%;">
      </label>
      <label>
        Time
        <input type="time" name="time" value="<?php if (date("H:i", $show['date']) != "00:00") echo date("H:i", $show['date']); ?>">
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
      <input type="text" name="venue" value="<?php echo htmlspecialchars($show['venue']); ?>">
    </label>
    
    <label>Location
      <input type="text" name="location" value="<?php echo htmlspecialchars($show['location']); ?>">
    </label>
    
    <label>URL
      <input type="text" name="url" value="<?php echo htmlspecialchars($show['url']); ?>">
    </label>
    
    <label>Stage
      <input type="text" name="stage" value="<?php echo htmlspecialchars($show['stage']); ?>">
    </label>
    
    <label>Additional Information
      <input type="text" name="additional" value="<?php echo htmlspecialchars($show['additional']); ?>">
    </label>

    <?php if ($_GET['a'] == "edit") { ?>
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
    <?php } ?>

    <input type="submit" value="<?php echo ($_GET['a'] == "edit") ? "Update" : "Copy"; ?>">
  </div>
</form>

<?php include "footer.php"; ?>