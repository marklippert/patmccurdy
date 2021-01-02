<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Edit Set List";
include "header.php";

$setlists = $mysqli->query("SELECT * FROM setlists WHERE id = '" . $_GET['id'] . "'");
$setlist = $setlists->fetch_array(MYSQLI_BOTH);
?>

<form action="setlistsdb.php?a=edit" method="POST">
  <div>
    <div class="admin-two-col flex">
      <label>Date
        <input type="text" name="date" id="date" readonly="true"<?php echo ' value="'.date("m/d/Y", strtotime($setlist['date'])).'"'; ?>>
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