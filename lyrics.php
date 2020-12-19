<?php
$PageTitle = "Lyrics";
include "header.php";

$total = $mysqli->query("SELECT * FROM lyrics");
?>

<h2><a href="songlist.php">The Big Ass Song List</a></h2>
This is where you can find a list of <?php echo $total->num_rows; ?> of Pat's songs, including all the albums. Many have links to the lyrics and guitar tabs. You can also go straight to the individual albums below.<br>
<br>

<div id="lyrics-album">
  <?php
  $albums = $mysqli->query("SELECT * FROM albums ORDER BY year DESC");

  while($row = $albums->fetch_array(MYSQLI_ASSOC)) {
    ?>
    <a href="album.php?<?php echo $row['id']; ?>" style="background-image: url(images/cds/<?php echo $row['cover_image']; ?>);">
      <div><?php echo $row['title']; ?></div>
    </a>
    <?php
  }
  ?>
</div>

<?php include "footer.php"; ?>