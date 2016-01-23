<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Albums | Edit Album";
include "header.php";

$result = $mysqli->query("SELECT * FROM albums WHERE id = '" . $_GET['id'] . "'");
$row = $result->fetch_array(MYSQLI_BOTH);
?>

<form action="albumdb.php?a=edit" method="POST">
  <div class="sub-center">
    <strong>Title</strong><br>
    <input type="text" name="title" value="<?php echo $row['title']; ?>"><br>
    <br>

    <strong>Cover Image</strong><br>
    <input type="text" name="cover_image" value="<?php echo $row['cover_image']; ?>"><br>
    <br>

    <strong>Year</strong>
    <input type="text" name="year" style="width: 4em;" value="<?php echo $row['year']; ?>"><br>
    <br>

    <strong>iTunes Link</strong><br>
    <input type="text" name="itunes" value="<?php echo $row['itunes']; ?>"><br>
    <br>
    
    <strong>Amazon Link</strong><br>
    <input type="text" name="amazon" value="<?php echo $row['amazon']; ?>"><br>
    <br>
    
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input type="submit" value="Update">
  </div>
</form>

<?php
$result->free();
$mysqli->close();

include "footer.php";
?>