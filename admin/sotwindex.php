<?php
include "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Song of the Week";
include "header.php";
?>

<div class="toggle-box">
  <div class="toggle-control" data-text="Add Song of the Week" data-expanded-text="Hide form">Add Song of the Week</div>
  <div id="admin-left">
    <h3>Add Song of the Week</h3>
    <form action="sotwdb.php?a=add" method="POST">
      <div>
        <div class="sub-left">
          <strong>Start Date</strong>
          <input type="text" name="startdate" id="date" readonly="true"><br>
          <br>
        </div>

        <div class="sub-right">
          <strong>End Date</strong>
          <input type="text" name="enddate" id="enddate" readonly="true"><br>
          <br>
        </div>

        <div style="clear: both;"></div>

        <strong>Title</strong><br>
        <input type="text" name="title"><br>
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
            echo "<option value=\"$file\">$file</option>\n";
          }
          ?>
        </select><br>
        <br>

        <strong>Recorded At</strong><br>
        <input type="text" name="recat"><br>
        <br>

        <strong>Band</strong><br>
        <input type="text" name="band"><br>
        <br>

        <input type="submit" value="Add">
      </div>
    </form>
    
    <div class="spacer-height"></div>
    <div class="spacer-height"></div>
    
    <a href="sotw-future.php">Songs never done</a><br>
    <a href="sotw-past.php">Past songs (Yipes!, MAT, Confidentials)</a>

    <div class="spacer-height"></div>
    <div class="spacer-height"></div>
  </div>
</div>

<div id="admin-right">
  <h3>Song of the Week <span style="font-size: 75%; white-space: nowrap;"><?php echo ($_SERVER['QUERY_STRING'] == "alpha") ? "<a href=\"sotwindex.php\">sort by date</a>" : "<a href=\"sotwindex.php?alpha\">sort alphabetically</a>"; ?></span></h3>
  
  <?php
  $orderby = ($_SERVER['QUERY_STRING'] == "alpha") ? "title ASC" : "startdate+0 DESC";
  $result = $mysqli->query("SELECT * FROM sotw ORDER BY $orderby");
  
  while($row = $result->fetch_array(MYSQLI_BOTH)) {
    $enddate = ($row['enddate'] != "") ? date("m/d/y", $row['enddate']) : "No end date";
    ?>
    <div class="c2">
      <div class="controls">
        <a href="sotwdb.php?a=delete&id=<?php echo $row['id']; ?>" onClick="return(confirm('Are you sure you want to delete this record?'));"><img src="images/delete.png" alt="Delete" title="Delete"></a>
        <a href="sotwedit.php?id=<?php echo $row['id']; ?>"><img src="images/edit.png" alt="Edit" title="Edit"></a>
      </div>
      
      <div class="info">
        <span style="font-size: 80%;"><?php echo date("m/d/y", $row['startdate']); ?> - <?php echo $enddate; ?></span><br>
        <strong><?php echo $row['title']; ?></strong>
      </div>

      <div class="spacer-height"></div>
    </div>
    <?php
  }

  $result->free();
  ?>
</div>

<div style="clear: both;"></div>

<?php
$mysqli->close();

include "footer.php";
?>