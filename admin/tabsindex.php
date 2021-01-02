<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Guitar Tabs";
include "header.php";
?>

<div id="admin-tabs" class="flex main-cols">
  <div>
    <h3>Add Guitar Tab</h3>

    <form action="tabsdb.php?a=add" method="POST">
      <div>
        <label>Title
          <select name="title">
            <option value="">Select title...</option>
            <?php
            $lyrics = $mysqli->query("SELECT * FROM lyrics ORDER BY title ASC");

            while($lyric = $lyrics->fetch_array(MYSQLI_ASSOC)) {
              echo '<option value="' . $lyric['title'] . '">' . $lyric['title'] . "</option>\n";
            }
            ?>
          </select>
        </label>
        
        <label>Tabs
          <textarea name="tab" style="height: 25em; white-space: pre;"></textarea>
        </label>
        
        <label>Name
          <input type="text" name="name">
        </label>
        
        <label>Email
          <input type="email" name="email">
        </label>
        
        <input type="submit" name="submit" value="Add">
      </div>
    </form>
  </div>

  <div>
    <h3>Guitar Tabs</h3>
    
    <?php
    $tabs = $mysqli->query("SELECT * FROM tabs ORDER BY title ASC");
    
    while($tab = $tabs->fetch_array(MYSQLI_BOTH)) {
      ?>
      <div class="guitartab flex">
        <div class="controls">
          <a href="tabsdb.php?a=delete&id=<?php echo $tab['id']; ?>" class="delete" onClick="return(confirm('Are you sure you want to delete this record?'));"></a>
          <a href="tabsedit.php?a=edit&id=<?php echo $tab['id']; ?>" class="edit"></a>
        </div>
        
        <div class="info">
          <?php echo $tab['title']; ?>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php include "footer.php"; ?>