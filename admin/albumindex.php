<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Albums";
include "header.php";
?>

<div class="toggle-box">
  <div class="toggle-control" data-text="Add An Album" data-expanded-text="Hide form">Add An Album</div>
  <div id="admin-left">
    <h3>Add An Album</h3>

    <form action="albumdb.php?a=add" method="POST">
      <div>
        <strong>Title</strong><br>
        <input type="text" name="title"><br>
        <br>

        <strong>Cover Image</strong><br>
        <input type="text" name="cover_image"><br>
        <br>

        <strong>Year</strong> 
        <input type="text" name="year" style="width: 4em;"><br>
        <br>
        
        <strong>iTunes Link</strong><br>
        <input type="text" name="itunes"><br>
        <br>
        
        <strong>Amazon Link</strong><br>
        <input type="text" name="amazon"><br>
        <br>

        <strong>Liner Notes</strong><br>
        <textarea name="liner_notes" style="height: 25em;"></textarea><br>
        <br>
        
        <input type="submit" value="Add">
      </div>
    </form>

    <div class="spacer-height"></div>
  </div>
</div>

<div id="admin-right">
  <h3>Albums</h3>
    
    <?php
    $result = $mysqli->query("SELECT * FROM albums ORDER BY year DESC");
    
    while($row = $result->fetch_array(MYSQLI_BOTH)) {
      ?>
      <div class="c2">
        <div class="controls">
          <a href="albumdb.php?id=<?php echo $row['id']; ?>&a=delete" onClick="return(confirm('Are you sure you want to delete this record?'));"><img src="images/delete.png" alt="Delete" title="Delete"></a>
          <a href="albumedit.php?id=<?php echo $row['id']; ?>"><img src="images/edit.png" alt="Edit" title="Edit"></a>
        </div>

        <div class="info">
          <strong><?php echo $row['title']; ?></strong><br>
          <?php echo $row['year']; ?><br>
          <img src="../images/cds/<?php echo $row['cover_image'] ?>">
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