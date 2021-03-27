<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Lyrics | Edit";
include "header.php";

$table = ($_GET['l'] == "holding") ? "lyrics_holding" : "lyrics";

$lyrics = $mysqli->query("SELECT * FROM $table WHERE id = '" . $_GET['id'] . "'");
$lyric = $lyrics->fetch_array(MYSQLI_BOTH);
?>

<form action="lyricsdb.php?a=<?php echo ($_GET['l'] == "holding") ? "add" : "edit"; ?>" method="POST">
  <div>
    <label>Title
      <input type="text" name="title" value="<?php echo $lyric['title'] ?>">
    </label>

    <label>Lyrics
      <textarea name="lyrics" style="height: 25em;"><?php echo str_replace("<br>", "\n", $lyric['lyrics']); ?></textarea>
    </label>

    <label>Album
      <select name="album" id="album-select">
        <option value="0">none</option>
        <?php
        $albums = $mysqli->query("SELECT * FROM albums ORDER BY title ASC");

        while($album = $albums->fetch_array(MYSQLI_BOTH)) {
          echo '<option value="' . $album['id'] . '"';
          if ($album['id'] == $lyric['album']) echo " selected";
          echo ">" . $album['title'] . "</option>\n";
        }
        ?>
      </select>
    </label>

    <div class="admin-two-col flex">
      <label>Track #
        <input type="text" name="album_track" value="<?php echo $lyric['album_track'] ?>">
      </label>

      <label>Band
        <select name="band">
          <option value=""<?php if ($lyric['band'] == "") echo " selected"; ?>>Solo</option>
          <option value="Confidentials"<?php if ($lyric['band'] == "Confidentials") echo " selected"; ?>>Confidentials</option>
          <option value="Mankind"<?php if ($lyric['band'] == "Mankind") echo " selected"; ?>>Mankind</option>
          <option value="Men About Town"<?php if ($lyric['band'] == "Men About Town") echo " selected"; ?>>Men About Town</option>
          <option value="Yipes!"<?php if ($lyric['band'] == "Yipes!") echo " selected"; ?>>Yipes!</option>
        </select>
      </label>
    </div>

    <label>Apple Music
      <input type="text" name="apple" value="<?php echo $lyric['apple'] ?>">
    </label>

    <label>Amazon
      <input type="text" name="amazon" value="<?php echo $lyric['amazon'] ?>">
    </label>

    <?php if ($_GET['l'] != "holding") { ?>
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
    <?php } ?>

    <input type="hidden" name="l" value="<?php echo $_GET['l'] ?>">
    
    <input type="submit" name="submit" value="Update">
  </div>
</form>

<?php include "footer.php"; ?>