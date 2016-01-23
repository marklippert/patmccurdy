<?php
include "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Main / RSS";
include "header.php";
?>

<div class="toggle-box">
  <div class="toggle-control" data-text="Add Main / RSS Item" data-expanded-text="Hide form">Add Main / RSS Item</div>
  <div id="admin-left">
    <h3>Add Main / RSS Item</h3>

    <form action="maindb.php?a=add" method="POST">
      <div>
        <strong>End Date:</strong>
        <input type="text" name="enddate" id="enddate" readonly="true" style="width: 6em;"><br>
        <br>

        <strong>Title</strong><br>
        <input type="text" name="title"><br>
        <br>

        <strong>Text</strong> <span style="font-size: 85%;">(Remember to use absolute paths)</span><br>
        <textarea name="text"></textarea><br>
        <br>
        
        <input type="radio" name="appears" value="page"> <strong>Page only</strong>
        <input type="radio" name="appears" value="rss" style="margin-left: 5%;"> <strong>RSS only</strong>
        <input type="radio" name="appears" value="both" checked style="margin-left: 5%;"> <strong>Both</strong><br>
        <br>
        
        <input type="submit" value="Add">
      </div>
    </form>

    <div class="spacer-height"></div>
  </div>
</div>

<div id="admin-right">
  <h3>Items</h3>
  
  <?php
  $result = $mysqli->query("SELECT * FROM main ORDER BY id DESC");
  
  while($row = $result->fetch_array(MYSQLI_BOTH)) {
    ?>
    <div class="c2">
      <div class="controls">
        <a href="maindb.php?a=delete&id=<?php echo $row['id']; ?>" onClick="return(confirm('Are you sure you want to delete this record?'));"><img src="images/delete.png" alt="Delete" title="Delete"></a>
        <a href="mainedit.php?id=<?php echo $row['id']; ?>"><img src="images/edit.png" alt="Edit" title="Edit"></a>
      </div>
      
      <div class="info">
        <?php
        echo $row['title'];
        
        if ($row['enddate'] != "" && $row['enddate'] < time()) echo " <span style=\"color: #FF0000;\">[EXPIRED]</span>";
        
        echo "\n";
        ?>
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