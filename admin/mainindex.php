<?php
include_once "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Main / RSS";
include "header.php";
?>

<div id="admin-main" class="flex main-cols">
  <div>
    <h3>Add Main / RSS Item</h3>

    <form action="maindb.php?a=add" method="POST">
      <div>
        <label>
          End Date
          <input type="date" name="enddate">
        </label>

        <label>
          Title
          <input type="text" name="title">
        </label>

        <label>
          Text <span style="font-size: 85%;">(Remember to use absolute paths)</span>
          <textarea name="text"></textarea>
        </label>
        
        <div class="radio">
          <label><input type="radio" name="appears" value="page"> Page only</label>
          <label><input type="radio" name="appears" value="rss"> RSS only</label>
          <label><input type="radio" name="appears" value="both" checked> Both</label>
        </div>
        
        <input type="submit" name="submit" value="Add">
      </div>
    </form>
  </div>

  <div>
    <h3>Items</h3>
    
    <?php
    $items = $mysqli->query("SELECT * FROM main ORDER BY id DESC");
    
    while($item = $items->fetch_array(MYSQLI_BOTH)) {
      ?>
      <div class="item flex">
        <div class="controls">
          <a href="maindb.php?a=delete&id=<?php echo $item['id']; ?>" class="delete" onClick="return(confirm('Are you sure you want to delete this record?'));"></a>
          <a href="mainedit.php?a=edit&id=<?php echo $item['id']; ?>" class="edit"></a>
        </div>
        
        <div class="info">
          <?php
          echo $item['title'];
          
          if ($item['enddate'] != "" && $item['enddate'] < time()) echo ' <span style="color: #FF0000;">[EXPIRED]</span>';
          
          echo "\n";
          ?>
        </div>
      </div>
      <?php } ?>
  </div>

</div>

<?php include "footer.php"; ?>