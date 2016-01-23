<?php
include "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Press | Edit Article";
include "header.php";

$result = $mysqli->query("SELECT * FROM press WHERE id = '" . $_GET['id'] . "'");
$row = $result->fetch_array(MYSQLI_BOTH);
?>

<form action="pressdb.php?a=edit" method="POST">
  <div class="sub-center">
    <strong>Date:</strong><br>
    <input type="text" name="date" value="<?php echo $row['date']; ?>"><br>
    <br>

    <strong>Source:</strong><br>
    <input type="text" name="source" value="<?php echo $row['source']; ?>"><br>
    <br>

    <strong>Source URL:</strong> <input type="text" name="source_url" value="<?php echo $row['source_url']; ?>"><br>
    <br>

    <strong>Title:</strong> <input type="text" name="title" value="<?php echo $row['title']; ?>"><br>
    <br>

    <strong>Subtitle:</strong> <input type="text" name="subtitle" value="<?php echo $row['subtitle']; ?>"><br>
    <br>

    <strong>Author:</strong><br>
    <input type="text" name="author" value="<?php echo $row['author']; ?>"><br>
    <br>

    <strong>Text:</strong><br>
    <textarea rows="20" cols="43" name="text" style="height: 15em;"><?php echo $row['text']; ?></textarea><br>
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