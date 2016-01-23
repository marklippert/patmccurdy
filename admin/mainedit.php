<?php
include "../inc/dbconfig.php";
include "login.php";
$PageTitle = "Edit Main / RSS";
include "header.php";

$result = $mysqli->query("SELECT * FROM main WHERE id = '" . $_GET['id'] . "'");
$row = $result->fetch_array(MYSQLI_BOTH);
?>

<form action="maindb.php?a=edit" method="POST">
  <div class="sub-center">
    <strong>End Date:</strong>
    <input type="text" name="enddate" id="enddate" readonly="true" style="width: 6em;" value="<?php if ($row['enddate'] != "") echo date("m/d/Y",$row['enddate']); ?>"><br>
    <br>

    <strong>Title</strong> <input type="text" name="title" value="<?php echo $row['title']; ?>"><br>
    <br>

    <strong>Text</strong> <span style="font-size: 85%;">(Remember to use absolute paths)</span><br>
    <textarea name="text"><?php echo htmlentities($row['text']); ?></textarea><br>
    <br>
    
    <input type="radio" name="appears" value="page"<?php if ($row['appears'] == "page") echo " checked"; ?>> <strong>Page only</strong>
    <input type="radio" name="appears" value="rss"<?php if ($row['appears'] == "rss") echo " checked"; ?> style="margin-left: 5%;"> <strong>RSS only</strong>
    <input type="radio" name="appears" value="both"<?php if ($row['appears'] == "both") echo " checked"; ?> style="margin-left: 5%;"> <strong>Both</strong><br>
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