<?php
include_once "inc/dbconfig.php";

$PageTitle = "Album not found";

$album = $mysqli->query("SELECT * FROM albums WHERE id = '" . $_SERVER['QUERY_STRING'] . "'");
if (!empty($album) && $album->num_rows > 0) {
  $row = $album->fetch_array(MYSQLI_ASSOC);
  $PageTitle = $row['title'];
}

$Sidebar = "no";

include "header.php";

if (!empty($album) && $album->num_rows > 0) {
?>

<div id="main-sidebar" class="album">
  <div id="main">
    <?php
    $songs = $mysqli->query("SELECT * FROM lyrics WHERE album = '" . $_SERVER['QUERY_STRING'] . "' ORDER BY album_track");

    if (!empty($songs) && $songs->num_rows > 0) {
      while($song = $songs->fetch_array(MYSQLI_ASSOC)) {
        echo '<h2 id="track' . $song['album_track'] . '">' . stripslashes($song['title']);
        
        $tabs = $mysqli->query("SELECT * FROM tabs WHERE title = \"" . stripslashes($song['title']) . "\"");

        if (!empty($tabs) && $tabs->num_rows > 0) {
          $tab = $tabs->fetch_array(MYSQLI_ASSOC);
          echo ' <a href="guitar-tabs.php?' . $tab['id'] . '" title="Guitar Tabs" class="tab"></a>';
        }

        echo "</h2>\n";

        $lyrics = str_replace("\n", "<br>", stripslashes($song['lyrics']));
        $lyrics = str_replace("<br>", "<br>\n      ", $lyrics);
        echo $lyrics . "\n";
      }
    }

    if ($row['liner_notes'] != "") echo '<h2 id="liner-notes">Liner Notes</h2>'."\n".nl2br($row['liner_notes'])."<br>\n";
    ?>
  </div> <!-- /#main -->

  <div id="sidebar">
    <img src="images/cds/<?php echo $row['cover_image']; ?>" alt="<?php echo $PageTitle; ?>"><br>
    <br>
    
    <?php
    if (!empty($songs) && $songs->num_rows > 0) {
      $songs->data_seek(0);

      while($song = $songs->fetch_array(MYSQLI_ASSOC)) {
        echo "<a href=\"#track" . $song['album_track'] . "\">" . stripslashes($song['title']) . "</a><br>\n";
      }
    }

    if ($row['liner_notes'] != "") echo '<br><a href="#liner-notes">Liner Notes</a><br>';
    ?>
    <br>

    Copyright &copy; <?php echo $row['year']; ?><br>
    <br>

    <?php
    if ($row['itunes'] != "" || $row['amazon'] != "") echo "Buy on ";
    if ($row['itunes'] != "") echo "<a href=\"" . $row['itunes'] . "\">Apple Music</a>\n";
    if ($row['itunes'] != "" && $row['amazon'] != "") echo " | ";
    if ($row['amazon'] != "") echo "<a href=\"" . $row['amazon'] . "\">Amazon</a>\n";
    ?>
  </div> <!-- /#sidebar -->
</div> <!-- /#main-sidebar -->

<?php
} else {
  echo "Album not found\n";
}

include "footer.php";
?>