<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Set Lists";
include "header.php";
?>

<script language="JavaScript" type="text/JavaScript">
  function toggle(obj,obj2) {
    document.getElementById(obj).style.display = (document.getElementById(obj).style.display != 'none' ? 'none' : 'block' );
    document.getElementById(obj2).style.display = (document.getElementById(obj2).style.display != 'none' ? 'none' : 'block' );
  }
</script>

<div class="toggle-box">
  <div class="toggle-control" data-text="Add Set List" data-expanded-text="Hide form">Add Set List</div>
  <div id="admin-left">
    <h3>Add Set List</h3>

    <form action="setlistsdb.php?a=add" method="POST">
      <div>
        <div class="sub-left">
          <strong>Date</strong>
          <input type="text" name="date" id="date" readonly="true" style="width: 6em;"><br>
          <br>
        </div>
        
        <div class="sub-right">
          <strong>Approved</strong> <input type="checkbox" name="approved" checked><br>
          <br>
        </div>
        
        <div style="clear: both;"></div>
        
        <strong>Venue</strong><br>
        <input type="text" name="venue"><br>
        <br>
        
        <div class="sub-left" style="width: 83%;">
          <strong>City</strong><br>
          <input type="text" name="city"><br>
          <br>
        </div>
        
        <div class="sub-right" style="width: 9%;">
          <strong>State</strong><br>
          <input type="text" name="state"><br>
          <br>
        </div>
        
        <div style="clear: both;"></div>
        
        <strong>Set 1</strong><br>
        <textarea name="set1" style="height: 15em;"></textarea><br>
        <br>
        
        <strong>Set 2</strong><br>
        <textarea name="set2" style="height: 15em;"></textarea><br>
        <br>
        
        <div id="set3link"><a href="javascript:toggle('set3','set3link')">Add a third set</a></div>
        <div id="set3" style="display: none;">
        <!-- <div style="cursor: pointer;" data-toggle="collapse" data-target="#set3">Toggle Set 3</div><br> -->
        <!-- <div id="set3" class="collapse"> -->
          <strong>Set 3</strong><br>
          <textarea name="set3" style="height: 15em;"></textarea><br>
        </div>
        <br>
        
        <input type="submit" value="Add">
      </div>
    </form>

    <div class="spacer-height"></div>
  </div>
</div>

<div id="admin-right">
  <h3>Set Lists</h3>
  
  <?php
  $result = $mysqli->query("SELECT * FROM setlists ORDER BY date DESC");
  
  while($row = $result->fetch_array(MYSQLI_BOTH)) {
    ?>
    <div class="c3">
      <div class="controls">
        <a href="setlistsdb.php?a=delete&id=<?php echo $row['id']; ?>" onClick="return(confirm('Are you sure you want to delete this record?'));"><img src="images/delete.png" alt="Delete" title="Delete"></a>
        <a href="setlistsedit.php?id=<?php echo $row['id']; ?>"><img src="images/edit.png" alt="Edit" title="Edit"></a>
        <a href="setlistsdb.php?a=approve&id=<?php echo $row['id']; ?>">
        <?php
        echo (empty($row['approved'])) ? "<img src=\"images/publish-n.png\" alt=\"N\" title=\"Not approved\">" : "<img src=\"images/publish-y.png\" alt=\"Y\" title=\"Approved\">";
        ?>
        </a>
      </div>
      
      <div class="info">
        <?php echo date("F j, Y", strtotime($row['date'])) . " - " . $row['venue']; ?>
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