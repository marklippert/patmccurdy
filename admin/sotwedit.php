<?php
include_once "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Edit Song of the Week";
include "header.php";

$songs = $mysqli->execute_query("SELECT * FROM sotw WHERE id = ?", [$_GET['id']]);
$song = $songs->fetch_assoc();
?>

<form action="sotwdb.php?a=edit" method="POST">
  <div>
    <div class="admin-two-col flex">
      <label>Start Date
        <input type="date" name="startdate" value="<?php echo date("Y-m-d", $song['startdate']); ?>" style="width: 100%;">
      </label>
      <label>End Date
        <input type="date" name="enddate" value="<?php if ($song['enddate'] != "") echo date("Y-m-d", $song['enddate']); ?>" style="width: 100%;">
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