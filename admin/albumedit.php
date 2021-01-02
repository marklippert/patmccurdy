<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Albums | Edit Album";
include "header.php";

$albums = $mysqli->query("SELECT * FROM albums WHERE id = '" . $_GET['id'] . "'");
$album = $albums->fetch_array(MYSQLI_BOTH);
?>

<form action="albumdb.php?a=edit" method="POST">
  <div>
    <label>Title
      <input type="text" name="title" value="<?php echo $album['title']; ?>">
    </label>

    <label>Cover Image
      <input type="text" name="cover_image" value="<?php echo $album['cover_image']; ?>">
    </label>

    <label>Year
      <input type="number" pattern="[0-9]*" name="year" value="<?php echo $album['year']; ?>">
    </label>

    <label>Apple Music Link
      <input type="text" name="itunes" value="<?php echo $album['itunes']; ?>">
    </label>

    <label>Amazon Link
      <input type="text" name="amazon" value="<?php echo $album['amazon']; ?>">
    </label>

    <label>Liner Notes
      <textarea name="liner_notes"><?php echo $album['liner_notes']; ?></textarea>
    </label>

    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

    <input type="submit" name="submit" value="Update">
  </div>
</form>

<?php include "footer.php"; ?>