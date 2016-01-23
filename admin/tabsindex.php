<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Guitar Tabs";
include "header.php";
?>

<div class="toggle-box">
  <div class="toggle-control" data-text="Add Guitar Tab" data-expanded-text="Hide form">Add Guitar Tab</div>
  <div id="admin-left">
    <h3>Add Guitar Tab</h3>

    <form action="tabsdb.php?a=add" method="POST">
      <div>
        <strong>Title</strong><br>
        <select name="title">
          <option value="">Select title...</option>
          <?php
          $result = $mysqli->query("SELECT * FROM lyrics ORDER BY title ASC");

          while($row = $result->fetch_array(MYSQLI_BOTH)) {
            echo "<option value=\"" . $row['title'] . "\">" . $row['title'] . "</option>\n";
          }

          $result->free();
          ?>
        </select><br>
        <br>
        
        <strong>Tabs</strong><br> 
        <textarea name="tab" style="height: 25em;"></textarea><br> 
        <br>
        
        <strong>Name</strong><br>
        <input type="text" name="name"><br>
        <br>
        
        <strong>Email</strong><br>
        <input type="text" name="email"><br>
        <br>
        
        <input type="submit" value="Add">
      </div>
    </form>

    <div class="spacer-height"></div>
  </div>
</div>

<div id="admin-right">
  <h3>Guitar Tabs</h3>
  
  <?php
  $result = $mysqli->query("SELECT * FROM tabs ORDER BY title ASC");
  
  while($row = $result->fetch_array(MYSQLI_BOTH)) {
    ?>
    <div class="c2">
      <div class="controls">
        <a href="tabsdb.php?a=delete&id=<?php echo $row['id']; ?>" onClick="return(confirm('Are you sure you want to delete this record?'));"><img src="images/delete.png" alt="Delete" title="Delete"></a>
        <a href="tabsedit.php?id=<?php echo $row['id']; ?>"><img src="images/edit.png" alt="Edit" title="Edit"></a>
      </div>
      
      <div class="info">
        <?php echo $row['title']; ?>
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