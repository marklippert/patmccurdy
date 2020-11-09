<?php
include("inc/dbconfig.php");

$PageTitle = "Album not found";

$aresult = $mysqli->query("SELECT * FROM albums WHERE id = '" . $_SERVER['QUERY_STRING'] . "'");
if (!empty($aresult) && $aresult->num_rows > 0) {
  $arow = $aresult->fetch_array(MYSQLI_ASSOC);
  $PageTitle = $arow['title'];
}
$Sidebar = "no";

include "header.php";

if (!empty($aresult) && $aresult->num_rows > 0) {
?>
  <div class="album-right">
    <img src="images/cds/<?php echo $arow['cover_image']; ?>" alt="<?php echo $PageTitle; ?>"><br>
    <br>
    
    <?php
    $result = $mysqli->query("SELECT * FROM lyrics WHERE album = '" . $_SERVER['QUERY_STRING'] . "' ORDER BY album_track");
    
    if (!empty($result) && $result->num_rows > 0) {
      while($row = $result->fetch_array(MYSQLI_BOTH)) {
        echo "<a href=\"#track" . $row['album_track'] . "\">" . stripslashes($row['title']) . "</a><br>\n";
      }
    }
    ?>
    
    <br>
    
    Copyright &copy; <?php echo $arow['year']; ?><br>
    <br>

    <?php
    if ($arow['itunes'] != "" || $arow['amazon'] != "") echo "Buy on ";
    if ($arow['itunes'] != "") echo "<a href=\"" . $arow['itunes'] . "\">Apple Music</a>\n";
    if ($arow['itunes'] != "" && $arow['amazon'] != "") echo " | ";
    if ($arow['amazon'] != "") echo "<a href=\"" . $arow['amazon'] . "\">Amazon</a>\n";
    ?>
  </div>

  <?php
  if (!empty($result) && $result->num_rows > 0) {
    $result->data_seek(0);

    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
      echo "<h2 id=\"track" . $row['album_track'] . "\" style=\"display: inline;\">" . stripslashes($row['title']) . "</h2>";
      
      $tresult = $mysqli->query("SELECT * FROM tabs WHERE title = \"" . stripslashes($row['title']) . "\"");

      if (!empty($tresult) && $tresult->num_rows > 0) {
        $trow = $tresult->fetch_array(MYSQLI_ASSOC);
        echo " <a href=\"guitar-tabs.php?" . $trow['id'] . "\"><img src=\"images/guitar.gif\" alt=\"guitar tab\" style=\"vertical-align: middle;\"></a>";
      }

      echo "<br>\n";
      
      $lyrics = str_replace("\n", "<br>", stripslashes($row['lyrics']));
      $lyrics = str_replace("<br>", "<br>\n      ", $lyrics);
      echo $lyrics . "<br><br><br><br>\n";
    }
  }
} else {
  echo "Album not found<br><br>";
}

include "footer.php";