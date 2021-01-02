<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Albums";
include "header.php";
?>

<div id="admin-albums" class="flex main-cols">
  <div>
    <h3>Add An Album</h3>

    <form action="albumdb.php?a=add" method="POST">
      <div>
        <label>Title
          <input type="text" name="title">
        </label>

        <label>Cover Image
          <input type="text" name="cover_image">
        </label>

        <label>Year
          <input type="number" pattern="[0-9]*" name="year">
        </label>

        <label>Apple Music Link
          <input type="text" name="itunes">
        </label>

        <label>Amazon Link
          <input type="text" name="amazon">
        </label>

        <label>Liner Notes
          <textarea name="liner_notes"></textarea>
        </label>

        <input type="submit" name="submit" value="Add">
      </div>
    </form>
  </div>

  <div>
    <h3>Albums</h3>
      
    <?php
    $albums = $mysqli->query("SELECT * FROM albums ORDER BY year DESC");
    
    while($album = $albums->fetch_array(MYSQLI_BOTH)) {
      ?>
      <div class="album flex">
        <div class="controls">
          <a href="albumdb.php?a=delete&id=<?php echo $album['id']; ?>" class="delete" onClick="return(confirm('Are you sure you want to delete this record?'));"></a>
          <a href="albumedit.php?a=edit&id=<?php echo $album['id']; ?>" class="edit"></a>
        </div>

        <div class="info">
          <strong><?php echo $album['title']; ?></strong><br>
          <?php echo $album['year']; ?><br>
          <img src="../images/cds/<?php echo $album['cover_image'] ?>">
        </div>
      </div>
    <?php }?>
  </div>
</div>

<?php include "footer.php"; ?>