<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Set Lists";
include "header.php";
?>

<div id="admin-setlists" class="flex main-cols">
  <div>
    <h3>Add Set List</h3>

    <form action="setlistsdb.php?a=add" method="POST">
      <div>
        <div class="admin-two-col flex">
          <label>Date
            <input type="text" name="date" id="date" readonly="true">
          </label>
          <label>
            <input type="checkbox" name="approved" checked> Approved
          </label>
        </div>
        
        <label>Venue
          <input type="text" name="venue">
        </label>
        
        <div class="admin-two-col flex">
          <label>City
            <input type="text" name="city">
          </label>

          <label>State
            <input type="text" name="state">
          </label>
        </div>

        <label>Set 1
          <textarea name="set1"></textarea>
        </label>
        
        <label>Set 2
          <textarea name="set2"></textarea>
        </label>
        
        <label>Set 3
          <textarea name="set3"></textarea>
        </label>
        
        <input type="submit" name="submit" value="Add">
      </div>
    </form>
  </div>

  <div>
    <h3>Set Lists</h3>
    
    <?php
    $setlists = $mysqli->query("SELECT * FROM setlists ORDER BY date DESC");
    
    while($setlist = $setlists->fetch_array(MYSQLI_BOTH)) {
      ?>
      <div class="setlist flex">
        <div class="controls">
          <a href="setlistsdb.php?a=delete&id=<?php echo $setlist['id']; ?>" class="delete" onClick="return(confirm('Are you sure you want to delete this record?'));"></a>
          <a href="setlistsedit.php?a=edit&id=<?php echo $setlist['id']; ?>" class="edit"></a>
          <a href="setlistsdb.php?a=approve&id=<?php echo $setlist['id']; ?>" class="<?php echo (empty($setlist['approved'])) ? "publish-n" : "publish-y"; ?>"></a>
        </div>
        
        <div class="info">
          <?php echo date("F j, Y", strtotime($setlist['date'])) . " - " . $setlist['venue']; ?>
        </div>
      </div>
      <?php
    }
    ?>
  </div>
</div>

<?php include "footer.php"; ?>