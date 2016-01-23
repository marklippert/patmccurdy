<?php
include "inc/dbconfig.php";
$PageTitle = "Lyrics";
include "header.php";
?>

<h2><a href="songlist.php">The Big Ass Song List</a></h2>
This is where you can find a list of over 700 of Pat's songs, including all the albums. Many have links to the lyrics, guitar tabs and mp3 files. You can also go straight to the individual albums below.<br>
<br>

<?php
$result = $mysqli->query("SELECT * FROM albums ORDER BY year DESC");

while($row = $result->fetch_array(MYSQLI_BOTH)) {
  list($width, $height, $type, $attr) = getimagesize("images/cds/" . $row['cover_image']);

  $ratio = ceil(($width / $height) * 100);
  $adjust = ($ratio - 100) / 2;

  $adj_pos = ($width/$height > 1) ? "width: " . $ratio . "%; left: -" . $adjust . "%;" : "width: 100%; top: " . $adjust . "%;";
?>
<div class="lyrics-album">
  <a href="album.php?<?php echo $row['id']; ?>">
    <img src="images/cds/<?php echo $row['cover_image']; ?>" alt="<?php echo $row['title']; ?>" style="<?php echo $adj_pos; ?>">
    <span class="text"><span><?php echo $row['title']; ?></span></span>
  </a>
</div>
<?php
}

$result->free();
?>

<div style="clear: both;"></div>

<?php
$mysqli->close();

include "footer.php";
?>