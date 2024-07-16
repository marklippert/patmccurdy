<?php
include_once "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Song of the Week";
include "header.php";
?>

<div id="admin-sotw" class="flex main-cols">
  <div>
    <h3>Add Song of the Week</h3>

    <form action="sotwdb.php?a=add" method="POST">
      <div>
        <div class="admin-two-col flex">
          <label>Start Date
            <input type="date" name="startdate" style="width: 100%;">
          </label>
          <label>End Date
            <input type="date" name="enddate" style="width: 100%;">
          </label>
        </div>

        <label>Title
          <input type="text" name="title">
        </label>

        <label>File
          <select name="file">
            <option value="">Select...</option>
            <?php
            $dir = opendir("../audio");
            $files = [];
            while (false != ($file = readdir($dir))) {
              if (($file != ".") and ($file != "..")) $files[] = $file;
            }
            closedir($dir);
            natcasesort($files);
            
            foreach ($files as $file) echo '<option value="'.$file.'">'.$file."</option>\n";
            ?>
          </select>
        </label>

        <label>Recorded At
          <input type="text" name="recat">
        </label>

        <label>Band
          <input type="text" name="band">
        </label>

        <input type="submit" name="submit" value="Add">
      </div>
    </form>

    <br><br>

    <a href="sotw-future.php">Songs never done</a><br>
    <a href="sotw-past.php">Past songs (Yipes!, MAT, Confidentials)</a>
  </div>

  <div id="admin-right">
    <h3>Song of the Week <span style="font-size: 75%; white-space: nowrap;"><?php echo ($_SERVER['QUERY_STRING'] == "alpha") ? '<a href="sotwindex.php">sort by date</a>' : '<a href="sotwindex.php?alpha">sort alphabetically</a>'; ?></span></h3>
    
    <?php
    $orderby = ($_SERVER['QUERY_STRING'] == "alpha") ? "title ASC" : "startdate+0 DESC";
    $songs = $mysqli->execute_query("SELECT * FROM sotw ORDER BY $orderby");
    
    foreach($songs as $song) {
      $enddate = ($song['enddate'] != "") ? date("m/d/y", $song['enddate']) : "No end date";
      ?>
      <div class="sotw flex">
        <div class="controls">
          <a href="sotwdb.php?a=delete&id=<?php echo $song['id']; ?>" class="delete" onClick="return(confirm('Are you sure you want to delete this record?'));"></a>
          <a href="sotwedit.php?a=edit&id=<?php echo $song['id']; ?>" class="edit"></a>
        </div>
        
        <div class="info">
          <div style="font-size: 80%;"><?php echo date("m/d/y", $song['startdate'])." - ".$enddate; ?></div>
          <strong><?php echo $song['title']; ?></strong>
        </div>
      </div>
      <?php
    }
    ?>
  </div>
</div>

<?php include "footer.php"; ?>