<?php
include_once "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Edit Set List";
include "header.php";

$setlists = $mysqli->execute_query("SELECT * FROM setlists WHERE id = ?", [$_GET['id']]);
$setlist = $setlists->fetch_assoc();
?>

<form action="setlistsdb.php?a=edit" method="POST">
  <div>
    <div class="admin-two-col flex">
      <label>
        Date<br>
        <input type="date" name="date" value="<?php echo date("Y-m-d", strtotime($setlist['date'])); ?>">
      </label>

      <label>
        <input type="checkbox" name="approved"<?php if ($setlist['approved'] != "") echo " checked"; ?>> Approved
      </label>
    </div>

    <label>Venue
      <input type="text" name="venue" value="<?php echo $setlist['venue']; ?>">
    </label>
    
    <div class="admin-two-col flex">
      <label>City
        <input type="text" name="city" value="<?php echo $setlist['city']; ?>">
      </label>

      <label>State
        <input type="text" name="state" value="<?php echo $setlist['state']; ?>">
      </label>
    </div>

    <label>Set 1
      <textarea name="set1"><?php echo $setlist['set1']; ?></textarea>
    </label>
    
    <label>Set 2
      <textarea name="set2"><?php echo $setlist['set2']; ?></textarea>
    </label>
    
    <label>Set 3
      <textarea name="set3"><?php echo $setlist['set3']; ?></textarea>
    </label>

    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

    <input type="submit" name="submit" value="Update">
  </div>
</form>

<?php include "footer.php"; ?>