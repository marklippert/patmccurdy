<?php
include "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Press";
include "header.php";
?>

<div class="toggle-box">
  <div class="toggle-control" data-text="Add Article" data-expanded-text="Hide form">Add Article</div>
  <div id="admin-left">
    <h3>Add Article</h3>
    <form action="pressdb.php?a=add" method="POST">
      <strong>Date</strong> <input type="text" name="date"><br>
      <br>

      <strong>Source</strong> <input type="text" name="source"><br>
      <br>

      <strong>Source URL</strong> <input type="text" name="source_url"><br>
      <br>

      <strong>Title</strong> <input type="text" name="title"><br>
      <br>

      <strong>Subtitle</strong> <input type="text" name="subtitle"><br>
      <br>

      <strong>Author</strong> <input type="text" name="author"><br>
      <br>

      <strong>Text</strong><br>
      <textarea name="text" style="height: 15em;"></textarea><br>
      <br>

      <input type="submit" value="Add">
    </form>

    <div class="spacer-height"></div>
  </div>
</div>

<div id="admin-right">
  <h3>Articles</h3>
  
  <?php
  $result = $mysqli->query("SELECT * FROM press ORDER BY sort_date DESC");
  
  while($row = $result->fetch_array(MYSQLI_BOTH)) {
    ?>
    <div class="c2">
      <div class="controls">
        <a href="pressdb.php?a=delete&id=<?php echo $row['id']; ?>" onClick="return(confirm('Are you sure you want to delete this record?'));"><img src="images/delete.png" alt="Delete" title="Delete"></a>
        <a href="pressedit.php?id=<?php echo $row['id']; ?>"><img src="images/edit.png" alt="Edit" title="Edit"></a>
      </div>
      
      <div class="info">
        <strong><?php echo $row['date']; ?></strong> <em><?php echo $row['title']; ?></em>
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