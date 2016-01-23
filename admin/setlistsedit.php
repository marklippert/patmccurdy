<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Edit Set List";
include "header.php";

$result = $mysqli->query("SELECT * FROM setlists WHERE id = '" . $_GET['id'] . "'");
$row = $result->fetch_array(MYSQLI_BOTH);
?>

<form action="setlistsdb.php?a=edit" method="POST">
  <div class="sub-center">
    <div class="sub-left">
      <strong>Date</strong> <input type="text" name="date" class="mydatepicker" value="<?php echo date("m/d/Y", strtotime($row['date'])); ?>">
    </div>
    
    <div class="sub-right">
      <strong>Approved</strong> <input type="checkbox" name="approved"<?php if ($row['approved'] != "") echo " checked"; ?>>
    </div>
    
    <div style="clear: both;"></div><br>
    
    <strong>Venue</strong><br>
    <input type="text" name="venue" value="<?php echo $row['venue']; ?>"><br>
    <br>
    
    <div class="sub-left" style="width: 83%;">
      <strong>City</strong><br>
      <input type="text" name="city" value="<?php echo $row['city']; ?>">
    </div>
    
    <div class="sub-right" style="width: 9%;">
      <strong>State</strong><br>
      <input type="text" name="state" value="<?php echo $row['state']; ?>">
    </div>
    
    <div style="clear: both;"></div><br>
    
    <strong>Set 1</strong><br>
    <textarea name="set1" style="height: 15em;"><?php echo $row['set1']; ?></textarea><br>
    <br>
    
    <strong>Set 2</strong><br>
    <textarea name="set2" style="height: 15em;"><?php echo $row['set2']; ?></textarea><br>
    <br>
    
    <div style="cursor: pointer;<?php if ($row['set3'] != "") echo " display: none;"; ?>" data-toggle="collapse" data-target="#set3">Toggle Set 3<br></div>
    <div id="set3" class="collapse<?php if ($row['set3'] != "") echo " in"; ?>">
      <strong>Set 3</strong><br>
      <textarea name="set3" style="height: 15em;"><?php echo $row['set3']; ?></textarea><br>
      <br>
    </div>
    
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input type="submit" value="Update">
  </div>
</form>

<?php
$result->free();
$mysqli->close();

include "footer.php";
?>