<?php
include("../inc/dbconfig.php");
include "login.php";
$PageTitle = "Lyrics | Edit";
include "header.php";

$table = ($_GET['l'] == "holding") ? "lyrics_holding" : "lyrics";

$result = $mysqli->query("SELECT * FROM $table WHERE id = '" . $_GET['id'] . "'");
$row = $result->fetch_array(MYSQLI_BOTH);
?>

<form action="lyricsdb.php?a=<?php echo ($_GET['l'] == "holding") ? "add" : "edit"; ?>" method="POST">
  <div class="sub-center">
    <strong>Title</strong><br>
    <input type="text" name="title" value="<?php echo $row['title'] ?>"><br>
    <br>

    <strong>Lyrics</strong><br>
    <textarea name="lyrics" style="height: 25em;"><?php echo str_replace("<br>", "\n", $row['lyrics']) ?></textarea><br>
    <br>

    <strong>Album</strong>
    <select name="album" id="album-select">
      <option value="">none</option>
      <?php
      $aresult = $mysqli->query("SELECT * FROM albums ORDER BY title ASC");

      while($arow = $aresult->fetch_array(MYSQLI_BOTH)) {
        echo "<option value=\"" . $arow['id'] . "\"";
        if ($arow['id'] == $row['album']) {
          echo " selected";
        }
        echo ">" . $arow['title'] . "</option>\n";
      }

      $aresult->free();
      ?>
    </select><br>
    <br>
    
    <div class="sub-left" style="width: 30%;">
      <strong>Track #</strong> <input type="text" name="album_track" style="width: 25%;" value="<?php echo $row['album_track'] ?>"><br>
      <br>
    </div>
    
    <div class="sub-right" style="width: 66%;">
      <strong>Band</strong> 
      <select name="band" style="width: 75%; margin-right: 3%;">>
        <option value=""<?php if ($row['band'] == "") { echo " selected"; } ?>>Solo</option>
        <option value="Confidentials"<?php if ($row['band'] == "Confidentials") { echo " selected"; } ?>>Confidentials</option>
        <option value="Mankind"<?php if ($row['band'] == "Mankind") { echo " selected"; } ?>>Mankind</option>
        <option value="Men About Town"<?php if ($row['band'] == "Men About Town") { echo " selected"; } ?>>Men About Town</option>
        <option value="Yipes!"<?php if ($row['band'] == "Yipes!") { echo " selected"; } ?>>Yipes!</option>
      </select><br>
      <br>
    </div>

    <div style="clear: both;"></div>

    <?php if ($_GET['l'] != "holding") { ?><input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"><?php } ?>
    <input type="hidden" name="l" value="<?php echo $_GET['l'] ?>">
    
    <input type="submit" value="Update">
  </div>
</form>

<?php
$result->free();
$mysqli->close();

include "footer.php";
?>