<?php
include "inc/dbconfig.php";
$Sidebar = "no";
$PageTitle = "The Big Ass Song List";
include "header.php";
?>

<form action="search.php" method="POST" class="songlist-search">
  <div>
    <input type="text" name="search" value="Find a song" onClick="if(this.value=='Find a song')this.value='';" onBlur="if(this.value=='')this.value='Find a song';">
    <input type="hidden" name="lyrics" value="yes">
  </div>
</form>

<!-- BEGIN albums -->
<?php
// Get all albums by reverse chronological release year
$result = $mysqli->query("SELECT * FROM albums ORDER BY year DESC");

while($row = $result->fetch_array(MYSQLI_BOTH)) {
  ?>
  <div class="songlist-cd">
    <a href="album.php?<?php echo $row['id']; ?>"><img src="images/cds/<?php echo $row['cover_image']; ?>" alt="<?php echo $row['title']; ?>"></a>
    <?php
    if ($row['itunes'] != "" || $row['amazon'] != "") echo "Download on<br>\n";
    if ($row['itunes'] != "") echo "<a href=\"" . $row['itunes'] . "\">iTunes</a>\n";
    if ($row['itunes'] != "" && $row['amazon'] != "") echo " | ";
    if ($row['amazon'] != "") echo "<a href=\"" . $row['amazon'] . "\">Amazon</a>\n";
    ?>
  </div>

  <div class="songlist-tracks">
    <h2><a href="album.php?<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h2>
    <?php
    // Display track list for each album
    $cd_result = $mysqli->query("SELECT * FROM lyrics WHERE album = '" . $row['id'] . "' ORDER BY album_track ASC");

    while($cd_row = $cd_result->fetch_array(MYSQLI_BOTH)) {
      echo "<a href=\"song.php?" . $cd_row['id'] . "\">" . stripslashes($cd_row['title']) . "</a>";

      $tresult = $mysqli->query("SELECT * FROM tabs WHERE title = \"" . ($cd_row['title']) . "\"");

      if ($tresult->num_rows > 0) {
        $trow = $tresult->fetch_array(MYSQLI_BOTH);
        echo " <a href=\"guitar-tabs.php?" . $trow['id'] . "\"><img src=\"images/guitar.gif\" alt=\"guitar tab\" style=\"vertical-align: middle;\"></a>";
      }

      echo "<br>\n";

      $tresult->free();
    }

    $cd_result->free();
    ?>
  </div>

  <div style="clear: both; height: 2em;"></div>
<?php } ?>
<!-- END albums -->

<?php
// Create a two column layout of songs
function TwoCol($mysqli, $band) {
  $result = $mysqli->query("SELECT * FROM lyrics WHERE album = 0 AND band = '" . $band . "' ORDER BY title ASC");

  $num_rows = $result->num_rows;
  $half = round($num_rows / 2);

  $count = 1;
  while($row = $result->fetch_array(MYSQLI_BOTH)) {
    if ($count == $half+1) echo "</div>\n<div class=\"songlist-twocol\">\n";

    if ($row['lyrics'] != "") echo "<a href=\"song.php?" . $row['id'] . "\">";
    echo stripslashes($row['title']);
    if ($row['lyrics'] != "") echo "</a>";

    $tresult = $mysqli->query("SELECT * FROM tabs WHERE title = \"" . stripslashes($row['title']) . "\"");

    if ($tresult->num_rows > 0) {
      $trow = $tresult->fetch_array(MYSQLI_BOTH);
      echo " <a href=\"guitar-tabs.php?" . $trow['id'] . "\"><img src=\"images/guitar.gif\" alt=\"guitar tab\" style=\"vertical-align: middle;\"></a>";
    }

    echo "<br>\n";

    $count++;

    $tresult->free();
  }

  $result->free();
}
?>

<h2 style="text-align: center;">Songs you have to see Pat live to hear</h2>
<div class="songlist-twocol">
  <?php TwoCol($mysqli, ""); ?>
</div>
<div style="clear: both; height: 1.5em;"></div>

<h2 style="text-align: center; margin-bottom: 1em;">Pat's old bands (A.K.A. "Songs you'll probably never hear him play")</h2>

<h2>Confidentials</h2>
<div class="songlist-twocol">
  <?php TwoCol($mysqli, "Confidentials"); ?>
</div>
<div style="clear: both; height: 1.5em;"></div>

<h2>Mankind</h2>
<div class="songlist-twocol">
  <?php TwoCol($mysqli, "Mankind"); ?>
</div>
<div style="clear: both; height: 1.5em;"></div>

<h2>Men About Town</h2>
<div class="songlist-twocol">
  <?php TwoCol($mysqli, "Men About Town"); ?>
</div>
<div style="clear: both; height: 1.5em;"></div>

<h2>Yipes!</h2>
<div class="songlist-twocol">
  <?php TwoCol($mysqli, "Yipes!"); ?>
</div>
<div style="clear: both;"></div>

<?php
$mysqli->close();

include "footer.php";
?>