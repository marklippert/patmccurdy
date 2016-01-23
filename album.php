<?php
include("inc/dbconfig.php");

$aresult = $mysqli->query("SELECT * FROM albums WHERE id = '" . $_SERVER['QUERY_STRING'] . "'");
$arow = $aresult->fetch_array(MYSQLI_BOTH);
$PageTitle = $arow['title'];
$Sidebar = "no";

include "header.php";
?>

<div class="album-right">
  <img src="images/cds/<?php echo $arow['cover_image']; ?>" alt="<?php echo $PageTitle; ?>"><br>
  <br>
  
  <?php
  $result = $mysqli->query("SELECT * FROM lyrics WHERE album = '" . $_SERVER['QUERY_STRING'] . "' ORDER BY album_track");

  while($row = $result->fetch_array(MYSQLI_BOTH)) {
    echo "<a href=\"#track" . $row['album_track'] . "\">" . stripslashes($row['title']) . "</a><br>\n";
  }
  ?>
  
  <br>
  
  Copyright &copy; <?php echo $arow['year']; ?><br>
  <br>

  <?php
  if ($arow['itunes'] != "" || $arow['amazon'] != "") echo "Download on ";
  if ($arow['itunes'] != "") echo "<a href=\"" . $arow['itunes'] . "\">iTunes</a>\n";
  if ($arow['itunes'] != "" && $arow['amazon'] != "") echo " | ";
  if ($arow['amazon'] != "") echo "<a href=\"" . $arow['amazon'] . "\">Amazon</a>\n";
  ?>
</div>

<?php
$result->data_seek(0);

while($row = $result->fetch_array(MYSQLI_BOTH)) {
  echo "<h2 id=\"track" . $row['album_track'] . "\" style=\"display: inline;\">" . stripslashes($row['title']) . "</h2>";
  
  $tresult = $mysqli->query("SELECT * FROM tabs WHERE title = \"" . stripslashes($row['title']) . "\"");

  if ($tresult->num_rows > 0) {
    $trow = $tresult->fetch_array(MYSQLI_BOTH);
    echo " <a href=\"guitar-tabs.php?" . $trow['id'] . "\"><img src=\"images/guitar.gif\" alt=\"guitar tab\" style=\"vertical-align: middle;\"></a>";
  }

  $tresult->free();
  
  echo "<br>\n";
  
  $lyrics = str_replace("\n", "<br>", stripslashes($row['lyrics']));
  $lyrics = str_replace("<br>", "<br>\n      ", $lyrics);
  echo $lyrics . "<br><br><br><br>\n";
}

$result->free();
$aresult->free();
$mysqli->close();

include "footer.php";