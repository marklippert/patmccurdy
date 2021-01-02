<?php
include "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Edit Song of the Week";
include "header.php";

$songs = $mysqli->query("SELECT * FROM sotw WHERE id = '" . $_GET['id'] . "'");
$song = $songs->fetch_array(MYSQLI_BOTH);
?>

<form action="sotwdb.php?a=edit" method="POST">
  <div>
    <div class="admin-two-col flex">
      <label>Start Date
        <input type="text" name="startdate" id="date" readonly="true" value="<?php echo date("m/d/Y",$song['startdate']); ?>">
      </label>
      <label>End Date
        <input type="text" name="enddate" id="enddate" readonly="true" value="<?php if ($song['enddate'] != "") echo date("m/d/Y",$song['enddate']); ?>">
      </label>
    </div>

    <label>Title
      <input type="text" name="title" value="<?php echo $song['title']; ?>">
    </label>

    <label>File
      <select name="file">
        <option value="">Select...</option>
        <?php
        $dir = opendir("../audio");
        while (false != ($file = readdir($dir))) {
          if (($file != ".") and ($file != "..")) $files[] = $file;
        }
        closedir($dir);
        natcasesort($files);
        
        foreach ($files as $file) {
          echo '<option value="'.$file.'"';
          if ($song['file'] == $file) echo " selected";
          echo ">".$file."</option>\n";
        }
        ?>
      </select>
    </label>

    <label>Recorded At
      <input type="text" name="recat" value="<?php echo $song['recat']; ?>">
    </label>

    <label>Band
      <input type="text" name="band" value="<?php echo $song['band']; ?>">
    </label>

    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    
    <input type="submit" name="submit" value="Update">
  </div>
</form>

<?php include "footer.php"; ?>