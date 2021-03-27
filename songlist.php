<?php
include "inc/dbconfig.php";
$ContentClass = "songlist";
$Sidebar = "no";
$PageTitle = "The Big Ass Song List";
include "header.php";
?>

<input type="checkbox" id="toggle-search" role="button">
<label for="toggle-search" title="Search"></label>
<form action="search.php" method="POST" id="lyric-search">
  <div>
    <input type="text" name="search" placeholder="Find a song title or lyrics"><input type="submit" name="submit" value="Search">
  </div>
</form>

<?php
function ListSongs($band = "", $album = 0, $order = "title") {
  global $mysqli;

  $bandwhere = ($band != "") ? " AND band = '".$band."' " : "";

  $songs = $mysqli->query("SELECT * FROM lyrics WHERE album = ".$album." ".$bandwhere." ORDER BY ".$order." ASC");

  while($song = $songs->fetch_array(MYSQLI_ASSOC)) {
    if ($song['lyrics'] != "") echo '<a href="song.php?' . $song['id'] . '">';
    echo stripslashes($song['title']);
    if ($song['lyrics'] != "") echo "</a>";

    $tabs = $mysqli->query("SELECT * FROM tabs WHERE title = \"" . ($song['title']) . "\"");

    if ($tabs->num_rows > 0) {
      $tab = $tabs->fetch_array(MYSQLI_ASSOC);
      echo ' <a href="guitar-tabs.php?' . $tab['id'] . '" title="Guitar Tabs" class="tab"></a>';
    }

    if ($song['apple'] != "") echo '<a href="' . $song['apple'] . '" title="Buy on Apple Music" class="apple"></a>';
    if ($song['amazon'] != "") echo '<a href="' . $song['amazon'] . '" title="Buy on Amazon" class="amazon"></a>';

    echo "<br>\n";
  }
}

// Get all albums by reverse chronological release year
$albums = $mysqli->query("SELECT * FROM albums ORDER BY year DESC");

while($album = $albums->fetch_array(MYSQLI_ASSOC)) {
  ?>
  <div class="songlist-album">
    <div class="image">
      <a href="album.php?<?php echo $album['id']; ?>"><img src="images/cds/<?php echo $album['cover_image']; ?>" alt="<?php echo $album['title']; ?>"></a>
      <?php
      if ($album['itunes'] != "" || $album['amazon'] != "") echo "Buy on<br>\n";
      if ($album['itunes'] != "") echo '<a href="' . $album['itunes'] . '">Apple Music</a>';
      if ($album['itunes'] != "" && $album['amazon'] != "") echo " | ";
      if ($album['amazon'] != "") echo '<a href="' . $album['amazon'] . '">Amazon</a>';
      ?>
    </div> <!-- /.image-->

    <div class="tracks">
      <h2><a href="album.php?<?php echo $album['id']; ?>"><?php echo $album['title']; ?></a></h2>
      <?php ListSongs("", $album['id'], "album_track"); ?>
    </div> <!-- /.tracks -->
  </div> <!-- /.songlist-album -->
<?php } ?>

<h2 style="text-align: center;">Songs you have to see Pat live to hear</h2>
<div class="songlist-twocol">
  <?php ListSongs(); ?>
</div>

<h2 style="text-align: center; margin-bottom: 0.5em;">Pat's old bands (A.K.A. "Songs you'll probably never hear him play")</h2>

<h3>Confidentials</h3>
<div class="songlist-twocol">
  <?php ListSongs("Confidentials"); ?>
</div>

<h3>Mankind</h3>
<div class="songlist-twocol">
  <?php ListSongs("Mankind"); ?>
</div>

<h3>Men About Town</h3>
<div class="songlist-twocol">
  <?php ListSongs("Men About Town"); ?>
</div>

<h3>Yipes!</h3>
<div class="songlist-twocol">
  <?php ListSongs("Yipes!"); ?>
</div>

<?php include "footer.php"; ?>