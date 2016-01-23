<?php
include "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Edit Song of the Week";
include "header.php";

$result = $mysqli->query("SELECT * FROM sotw WHERE id = '" . $_GET['id'] . "'");
$row = $result->fetch_array(MYSQLI_BOTH);
?>

<form action="sotwdb.php?a=edit" method="POST">
  <div class="sub-center">
    <div class="sub-left">
      <strong>Start Date</strong>
      <input type="text" name="startdate" id="date" readonly="true" value="<?php echo date("m/d/Y",$row['startdate']); ?>"><br>
      <br>
    </div>

    <div class="sub-right">
      <strong>End Date</strong>
      <input type="text" name="enddate" id="enddate" readonly="true" value="<?php if ($row['enddate'] != "") echo date("m/d/Y",$row['enddate']); ?>"><br>
      <br>
    </div>

    <div style="clear: both;"></div>

    <strong>Title</strong><br>
    <input type="text" name="title" value="<?php echo $row['title']; ?>"><br>
    <br>

    <strong>File</strong><br>
    <select name="file">
      <option value="">Select...</option>
      <?php
      $dir = opendir("../audio");
      while (false != ($file = readdir($dir))) {
        if (($file != ".") and ($file != "..")) {
          $files[] = $file;
        }
      }
      closedir($dir);
      natcasesort($files);
      
      foreach ($files as $file) {
        echo "<option value=\"$file\"";
        if ($row['file'] == $file) echo " selected";
        echo ">$file</option>\n";
      }
      ?>
    </select><br>
    <br>

    <strong>Recorded At</strong><br>
    <input type="text" name="recat" value="<?php echo $row['recat']; ?>"><br>
    <br>

    <strong>Band</strong><br>
    <input type="text" name="band" value="<?php echo $row['band']; ?>"><br>
    <br>

    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    
    <input type="submit" value="Update">
  </div>
</form>

<?php
$result->free();
$mysqli->close();

include "footer.php";
?>