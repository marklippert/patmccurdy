<?php
include_once "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Edit Main / RSS";
include "header.php";

$items = $mysqli->execute_query("SELECT * FROM main WHERE id = ?", [$_GET['id']]);
$item = $items->fetch_assoc();
?>

<form action="maindb.php?a=edit" method="POST">
  <div>
    <label>
      End Date
      <input type="date" name="enddate" value="<?php echo date("Y-m-d", $item['enddate']); ?>">
    </label>

    <label>
      Title
      <input type="text" name="title" value="<?php echo $item['title']; ?>">
    </label>

    <label>
      Text <span style="font-size: 85%;">(Remember to use absolute paths)</span>
      <textarea name="text"><?php echo htmlentities($item['text']); ?></textarea>
    </label>

    <div class="radio">
      <label><input type="radio" name="appears" value="page"<?php if ($item['appears'] == "page") echo " checked"; ?>> Page only</label>
      <label><input type="radio" name="appears" value="rss"<?php if ($item['appears'] == "rss") echo " checked"; ?>> RSS only</label>
      <label><input type="radio" name="appears" value="both"<?php if ($item['appears'] == "both") echo " checked"; ?>> Both</label>
    </div>

    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    
    <input type="submit" name="submit" value="Update">
  </div>
</form>

<?php include "footer.php"; ?>